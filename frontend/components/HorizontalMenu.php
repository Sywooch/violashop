<?php


namespace app\components;

use yii\base\Widget;

class HorizontalMenu extends Widget {
    public $Menu = array();
    
    public function init(){
        // your logic here
        parent::init();
    }
    public function run(){
        
        return $this->render('horizontal_menu', array('Menu' => $this -> Menu));
    }
}