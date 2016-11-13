<?php


namespace app\components;


use common\models\Order;
use yii\base\Widget;

class BasketCart extends Widget
{
    public $isMobile = false;
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }
    
    public function run()
    {
        $Order = Order::getClientOrder('blank');
        if (!$this -> isMobile)
            return $this->render('basket_small', array('order' => $Order));
        else
            return $this->render('basket_small_mobile', array('order' => $Order));
    }
    
}