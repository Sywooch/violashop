<?php


namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
* Orders model
* @property integer $id
* @property integer $total
* @property string $order_hash
* @property integer $date
* @property integer $client_id
* @property string $status
* @property string $comment
* @property string $address
* @property string $country
* @property string $city
*/
class Order extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'orders';
    }
    
    public function getProducts(){
        return $this->hasMany(OrderProducts::className(), ['order_id' => 'id']);
    }
    
    public function getClient(){
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }
    
    public static function getClientOrderHash ($new = true) {
        $OrderID = (string)Yii::$app -> request -> cookies['OCH'];
        if($OrderID == '' || $new) {
            $order =  Order::setNewClientOrder();
            $OrderID = $order['order_hash'];
        }
        
        return $OrderID;
    }
    
    public static function getClientOrderCookeie(){
        return (string)Yii::$app -> request -> cookies['OCH'];
    }
    
    public static function getClientOrder ($status = '', $price = 0) {
        
        if (isset(Yii::$app -> request -> cookies['OCH'])) {
            $OrderID = (string)Yii::$app -> request -> cookies['OCH'];
            $Order = Order::find() -> where('order_hash = :OrderID and status = :status', array(':OrderID' => $OrderID, ':status' => $status)) -> orderBy('id desc') -> one();
            
            if (isset($Order['id']) && $OrderID != '') {
                
                //$sql = 'SELECT *  FROM orders_products WHERE order_id = \''.$Order['id'].'\' ';
                //$Order['products']= array();//$db->createCommand($sql)->queryAll();
                
            }
            else{
                Yii::$app -> response -> cookies -> remove('OCH');
                $Order =  Order::setNewClientOrder($price);
            }
        }
        else {
            $Order =  Order::setNewClientOrder($price);
        }
        
        
        return $Order;
    }
    
    public static function getClientOrderModel ($status = '') {
        $OrderID = (string)Yii::$app -> request -> cookies['OCH'];
        $model = Order::find() -> where(' order_hash = \''.$OrderID.'\' '.(($status != '') ? ' AND status = \''.$status.'\' ' : '').' order by id DESC') -> one();
        return $model;
    }
    
    public static function setNewClientOrder($price = 0) {
        
        $OrderID = Order::setNewClientOrderHash();
        
        $Order  = array();
        $model = new Order();
        $model->order_hash = $OrderID;
        //$model->date = time();
        $model -> total = $price;
        $model -> status = 'blank';
        $model->save();
        
        return $model;
    }
    
    public static function setNewClientOrderHash() {
        //unset(Yii::$app->request->cookies['OCH']);
        if (isset(Yii::$app -> request -> cookies['OCH']))
            Yii::$app -> response -> cookies -> remove('OCH');
        $expire = time()+60*60*24*180;
        $OrderID = md5(rand(1000, 100000).$expire.rand(1000, 100000));
        //echo $OrderID;
        $cookies = Yii::$app->response->cookies;

// добавление новой куки в HTTP-ответ
        $cookies->add(new \yii\web\Cookie([
            'name' => 'OCH',
            'value' => $OrderID,
            'expire' => $expire
        ]));
        /*Yii::$app->response -> cookies -> add(new Cookie([
            'name' => 'OCH',
            'value' => $OrderID,
            'expire' => $expire
        ]));*/
        //$cookie -> path = '/';
        //$cookie -> expire = $expire;
        //Yii::$app -> request->cookies['OCH'] = $cookie;
        return $OrderID;
    }
    
    public static function getProductType(){
        return array(
            'head' => 'Черенок',
            'child' => 'Детка',
            'full' => 'Полное растение'
        );
    }
}