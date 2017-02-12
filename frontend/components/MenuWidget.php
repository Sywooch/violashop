<?php


namespace app\components;



use common\models\Category;
use common\models\SubCategory;
use common\models\SubSubCategory;
use yii\base\Widget;

class MenuWidget extends Widget
{
    public $categories;
    public function init(){
        // your logic here
        parent::init();
    }
    public function run(){
        $query = Category::find();
        $categories = $query -> all();
        
        $query = SubCategory::find();
        $subcategory = $query -> all();
        
        $query = SubSubCategory::find();
        $subsubcategory = $query -> all();
        
        
        return $this->render('left_menu', array('categories' => $categories,
            'subcategory' => $subcategory,
            'subsubcategory' => $subsubcategory));
    }

}