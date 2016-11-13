<?php


namespace frontend\controllers;

use app\components\Helper;
use common\models\Client;
use common\models\OrderProducts;
use common\models\Products;
use frontend\models\City;
use frontend\models\Country;
use Yii;
use common\models\Order;
use yii\helpers\HtmlPurifier;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;

class OrderController extends Controller
{
    
    public function actionIndex(){
        $Order = Order::getClientOrder('blank');
        
        return $this -> render('step1', array('order' => $Order));
    }
    public function actionStep2(){
        $Order = Order::getClientOrder('blank');
        $code = 'RU';
        if ($Order['country'] == 'Россия')
            $code = 'RU';
        else
            $code = 'UA';
        $query = Country::find();
        $country = $query -> where("name='{$Order['country']}'") -> one();
        $countries = $query -> where("visible = true and code is not null") -> all();
        $query = City::find();
        $cities = $query -> where('country_id = :country', [':country' => $country['country_id']]) -> orderBy('name asc') -> all();
        return $this -> render('step2', array('order' => $Order, 'cities' => $cities, 'countries' => $countries));
    }
    
    public function actionConfirm(){
        $this->enableCsrfValidation = false;
        $Order = Order::getClientOrderModel();
        $Order -> status = 'confirmed';
        $Order -> save();
        return $this -> render('confirm', ['order' => $Order]);
    }
    
    public function actionAdd(){
        $price = 0;
        $Order = Order::getClientOrder('blank', $price);
        $return = array('error' => 1,
            'message' => 'Some error');
        
        $count = 1;
        
        $productId = $_POST['productid'];
        $type = $_POST['type'];
        $return['och'] = $Order['order_hash'];
        if ($Order['order_hash'] != null || $Order['order_hash'] != '') {
            $product = Products::find()->where('id = :id', array(':id' => $productId))->one();
            if ($type == 'child')
                $price = $product['child_price'];
            elseif ($type == 'head')
                $price = $product['head_price'];
            else
                $price = $product['price'];
            
            $totalSum = 0;
            $allCount = 0;
            $new = true;
            $orderPid = 0;
            if ($Order['products'] != null) {
                
                foreach ($Order['products'] as $p) {
                    if ($p['type'] == $type && $p['product_id'] == $productId){
                        $count += $p['count'];
                        $new = false;
                        $orderPid = $p['id'];
                        $allCount += $count;
                        $totalSum += $p['price'] * $count;
                    }
                    else {
                        //$new = true;
                        $totalSum += $p['price'] * $p['count'];
                        $allCount += $p['count'];
                    }
                    
                    
                    //$return['count']= $allCount;
                    
                }
                
                
            }
            if ($new) {
                $orderProduct = new OrderProducts();
                $orderProduct -> count = 1;
                $orderProduct -> price = $price;
                $orderProduct -> type = $type;
                $orderProduct -> order_id = $Order['id'];
                $orderProduct -> product_id = $product['id'];
                $orderProduct -> save();
                $totalSum += $price;
                $allCount++;
            }
            else {
                
                /*$Order -> total = $totalSum;
                $Order -> save();*/
                OrderProducts::updateAll(array('count' => $count), 'id=:id', array(':id' => $orderPid)); //find() -> where('id=:id', array(':id' => $orderPid)) -> one();
                /*$orderProd -> count = $count;
                $orderProd -> save();*/
            }
            Order::updateAll(array('total' => $totalSum), 'order_hash = :hash', array(':hash' => $Order['order_hash']) );
            $return['count']= $allCount;
            $return['total'] = $totalSum;
            $return['error'] = 0;
            $return['message'] = 'ok';
        }
        
        $return['cookie'] = isset(Yii::$app -> request -> cookies['OCH']);
        //$return['order'] = $Order['order_hash'];
        return Json::encode($return);
        
    }
    
    public function actionUpdate() {
        if(!isset($_POST['type']) || !isset($_POST['ajax']) || !isset($_POST['field']) || !isset($_POST['value']) || !isset($_POST['id']) || !is_numeric($_POST['id']))
            throw new HttpException(404,'');
        
        //$p = new HtmlPurifier();
        $field = HtmlPurifier::process($_POST['field']);
        $value = HtmlPurifier::process($_POST['value']);
        $id = HtmlPurifier::process($_POST['id']);
        
        $update = 1;
        if ($_POST['type'] == 'product') {

            $orderProduct = OrderProducts::findOne($id);
            //$orderProduct = $query -> where('id=:id', [':id' => $id]) -> one();
            $orderProduct->$field = $value;
            $orderProduct -> save();
                
            
            /*$db = Yii::app()->db;
            $sql = 'Update orders_products SET '.$field.' = '.((is_numeric($value)) ? $value : '\''.$value.'\'').' WHERE id = '.$id.' ';
            $db->createCommand($sql)->execute();*/
            $query = Order::find();
            $Order = $query -> where('order_hash=:order_hash', array(':order_hash' => (string)Yii::$app -> request -> cookies['OCH'])) -> one(); //Order::getClientOrder('blank');
            $all_summ = 0;
            foreach ($Order['products'] as $p) {
                //$discount = $p['discount'];
                $price = $p['price'];
                $newPrice = 0;
                $discountSum = 0;
                /* if ($discount > 0){
                     $newPrice = $price - $price * $discount / 100;
                     //$price = $price - $newPrice;
                 }*/
                $query = Products::find();
                
                /*$prodTempl = RafinadProduct::model() -> findByPk($p['product_id']);
                $time = time();
                $template = $prodTempl['model']['template'];*/
                
                $all_summ += ($price) * $p['count'];
                //$all_count += $p['count'];
                /*if ($p['order_id'] == $Order['id'])
                    $all_summ += $p['price'];*/
                
            }
            $Order -> total = $all_summ;
            $Order -> save();
            $update = 0;
        } else if ($_POST['type'] == 'order') {
            
            $model = Order::getClientOrderModel('blank');
            
            if (isset($model['id']) && $model['id'] > 0){
                $model->$field = $value;
            }
            
            
            if ($field == 'from_phone') {
                $client_id = preg_replace('/[^0-9]+/', '', $value);
                if (is_numeric((int)$client_id)){
                    $model->client_id = $client_id;
                }
            }
            
            $model->save();
            $update = 0;
        }
        else if ($_POST['type'] == 'social_discount') {
            
            $model = Order::getClientOrderModel('blank');
            if (isset($model['id']) && $model['id'] > 0){
                if ($value != '' && !preg_match('/'.$value.'/', $model->social_discount)){
                    
                    $db = Yii::app()->db;
                    $sql = 'SELECT value FROM actions WHERE social=1';
                    $ActionDiscount = $db->createCommand($sql)->queryScalar();
                    $model->discount += (int)$ActionDiscount;
                    $model->social_discount = $model->social_discount.'|'.$value;
                }else {
                    echo Json::encode(array(
                        'error' => '1',
                    ));
                    Yii::$app -> end();
                }
                
            }
            $model->update_time = date('Y-m-d H:i:s');
            $model->save();
            $updateError = 0;
            echo Json::encode(array(
                'error' => $updateError,
                'discount' => $model->discount,
                'content' => $this->widget('widget.BasketCart', array(
                    'social_discount' => true,
                ), true),
            ));
            Yii::$app -> end();
        }
        
        echo Json::encode(array(
            'error' => $update,
        ));
        
    }
    
    public function actionDelete($id)
    {
        $orderProduct = OrderProducts::findOne($id);
        $orderProduct -> delete();
        /*$db = Yii::app()->db;
        $sql = 'DELETE FROM orders_products WHERE id = \''.$id.'\'';
        $db->createCommand($sql)->	execute();*/
        
        $Order = Order::getClientOrderModel();
        $all_summ = 0;
        foreach ($Order['products'] as $p) {
            $price = $p['price'];
            
            
            $all_summ += ($price) * $p['count'];
            //$all_count += $p['count'];
            if ($p['id'] == $Order['id'])
                $all_summ += $price;
            
        }
        $Order -> total = $all_summ;
        $Order -> save();
        
        
        
        if(Yii::$app->request->isPost){
            
            echo Json::encode(array(
                'error' => 0,
                'delete' => 1,
            ));
        }else {
            $this->redirect(Yii::$app -> request -> referrer);
        }
    }
    
    public function actionClientupdate(){
        if ($_POST['type'] == 'client') {
            $query = Order::find();
            $hash = HtmlPurifier::process($_POST['hash']);
            $Order = $query -> where('order_hash=:order_hash', array(':order_hash' => $hash))->one(); //Order::getClientOrder('blank');
            $Order -> payment = $_POST['paytype'];
            $Order -> comment = HtmlPurifier::process($_POST['comment']);
            $country = Helper::getCountryName()[HtmlPurifier::process($_POST['country'])];
            $address = $country.', '.HtmlPurifier::process($_POST['city']).', '.HtmlPurifier::process($_POST['address']);
            $Order -> address = $address;
            $Order -> country = $country;
            $Order -> city = HtmlPurifier::process($_POST['city']);
            
            if (trim(HtmlPurifier::process($_POST['email'])) != '') {
                $query = Client::find();
                $client = $query->where('email=:email', ['email' => HtmlPurifier::process($_POST['email'])])->one();
                if ($client == null) {
                    $client = new Client();
                    $client->email = HtmlPurifier::process($_POST['email']);
                    if (isset($_POST['subscribeBonus']))
                        $client -> subscribe = true;
                    else
                        $client -> subscribe = false;
                    $client->name = HtmlPurifier::process($_POST['nickname']);
                    $client->address = HtmlPurifier::process($address);
                    $client->phone = HtmlPurifier::process($_POST['phone']);
                    $client->city = HtmlPurifier::process($_POST['city']);
                    $client->country = HtmlPurifier::process($country);
                    $client->nickname = HtmlPurifier::process($_POST['nickname']);
                    $client->save();
                    $Order->client_id = $client['id'];
        
                } else {
                    if (isset($_POST['subscribeBonus']))
                        $client -> subscribe = true;
                    else
                        $client -> subscribe = false;
                    $client->email = HtmlPurifier::process($_POST['email']);
                    $client->name = HtmlPurifier::process($_POST['nickname']);
                    $client->address = HtmlPurifier::process($address);
                    $client->phone = HtmlPurifier::process($_POST['phone']);
                    $client->city = HtmlPurifier::process($_POST['city']);
                    $client->country = HtmlPurifier::process($country);
                    $client->nickname = HtmlPurifier::process($_POST['nickname']);
                    $client->save();
                    $Order->client_id = $client['id'];
        
                }
            }
            
            $Order -> save();
            echo Json::encode($_POST);
            
        }
        
        
    }
    
    
    
}