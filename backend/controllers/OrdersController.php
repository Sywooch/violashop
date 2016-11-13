<?php


namespace backend\controllers;


use common\models\Notify;
use common\models\Order;
use yii\web\Controller;
use yii\web\HttpException;

class OrdersController extends Controller
{
    public function actionIndex(){
        $query = Order::find();
        $orders = $query -> where('status="confirmed"') -> all();
        return $this -> render('index', ['orders' => $orders]);
    }
    
    public function actionView($id = ''){
        if ($id != ''){
            $order = Order::findOne($id);
            $query = Notify::find();
            $notify = $query -> one();
            $notify -> notify = false;
            $order -> viewed = true;
            $order -> save();
            $notify -> save();
            return $this -> render('view', ['order' => $order]);
        }
        else throw new HttpException('404', 'Заказ не найден');
    }
    
    public function actionApi(){
        $query = Notify::find();
        $notify = $query -> one();
        $arr = array(
            'notify' => $notify['notify'],
            'id' => $notify['order_id']
        );
        return json_encode($arr);
        
    }
}