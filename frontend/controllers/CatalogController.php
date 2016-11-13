<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Products;
use common\models\SubCategory;
use common\models\SubSubCategory;
use yii\data\Pagination;
use yii\helpers\HtmlPurifier;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

class CatalogController extends Controller
{
    private $pageSizeDef = 12;
    public function actionIndex(){
        $query = Products::find()-> where('child_stock = 1 or head_stock = 1 or stock = 1') -> orderBy('id desc');
        //$products = $query -> limit(12) -> offset(0) ;
        
        $countQuery = clone $query;
        // подключаем класс Pagination, выводим по 10 пунктов на страницу
        $pages = new Pagination(['totalCount' => $countQuery -> count(), 'pageSize' => $this -> pageSizeDef]);
        // приводим параметры в ссылке к ЧПУ
        $pages->pageSizeParam = false;
        $products = $query -> offset($pages->offset)
            -> limit($pages->limit)
            -> all();
        return $this->render('index', array('products' => $products, 'pages' => $pages));
    }
    
    public function actionProduct($id = ''){
        if ($id != ''){
            $query = Products::find();
            $product = $query
                ->where(array('id' => $id))
                ->one();
    
            return $this->render('product', array('product' => $product));
        }
        else {
            throw new HttpException(404, 'Товар не найден');
        }
    }
    
    public function actionAll(){
        $query = Products::find() -> where('category_id != 3 and subcategory_id != 4') -> orderBy('name asc');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery -> count(), 'pageSize' => $this -> pageSizeDef]);
        $pages->pageSizeParam = false;
        $products = $query -> offset($pages->offset)
            -> limit($pages->limit)
            -> all();
        return $this->render('all', array('products' => $products, 'pages' => $pages));
    }
    
    public function actionSpecial(){
        $query = Products::find() -> where('category_id = 3 and stock = 1') -> orderBy('name asc');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery -> count(), 'pageSize' => $this -> pageSizeDef]);
        $pages->pageSizeParam = false;
        $products = $query -> offset($pages->offset)
            -> limit($pages->limit)
            -> all();
        return $this->render('index', array('products' => $products, 'pages' => $pages));
    }
    
    public function actionCategory($id = ''){
        //echo $id;
        if ($id != ''){
            $query = Products::find();
            if (is_numeric($id)) {
                $products = $query->where('category_id = :id and (child_stock = 1 or head_stock = 1 or stock = 1)', [':id' => $id])->orderBy('id desc')->all();
            }
            else {
                $sql = Category::find();
                $category = $sql -> where('url=:url', [':url' => $id]) -> one();
                $id = $category['id'];
                
                $query = Products::find() -> where('category_id = :id and (child_stock = 1 or head_stock = 1 or stock = 1)', [':id' => $id])->orderBy('id desc');
                $countQuery = clone $query;
                // подключаем класс Pagination, выводим по 10 пунктов на страницу
                $pages = new Pagination(['totalCount' => $countQuery -> count(), 'pageSize' => $this -> pageSizeDef]);
                // приводим параметры в ссылке к ЧПУ
                $pages->pageSizeParam = false;
                $products = $query -> offset($pages->offset)
                    -> limit($pages->limit)
                    -> all();
            }
            
            return $this->render('index', array('products' => $products, 'pages' => $pages));
        }
        else {
            throw new HttpException(404, 'Категория не найдена');
        }
        
    }
    
    public function actionSubcategory($category = '', $subcategory = ''){
        //echo $subcategory;
        if ($category != '' && $subcategory != ''){
            $query = Products::find();
            $sql = Category::find();
            $category = $sql -> where('url=:url', [':url' => $category]) -> one();
            $catId = $category['id'];
            
            $sql = SubCategory::find();
            $Subcategory = $sql -> where('url=:url and category_id=:catid', [':url' => $subcategory ,':catid' => $catId]) -> one();
            $id = $Subcategory['id'];
            //var_dump($Subcategory);
            $query =Products::find() -> where('subcategory_id = :id and (child_stock = 1 or head_stock = 1 or stock = 1)', [':id' => $id]) -> orderBy('id desc');
            $countQuery = clone $query;
            // подключаем класс Pagination, выводим по 10 пунктов на страницу
            $pages = new Pagination(['totalCount' => $countQuery -> count(), 'pageSize' => $this -> pageSizeDef]);
            // приводим параметры в ссылке к ЧПУ
            $pages->pageSizeParam = false;
            $products = $query -> offset($pages->offset)
                -> limit($pages->limit)
                -> all();
            return $this->render('index', array('products' => $products, 'pages' => $pages));
        }
        else {
            throw new HttpException(404, 'Подкатегория не найдена');
        }
        
    }
    
    public function actionSubsubcategory($category = '', $subcategory = '',$subsubcategory = ''){
        //echo $subcategory;
        //echo $category . ' ' . $subcategory . ' ' . $subsubcategory;
        if ($category != '' && $subcategory != '' && $subsubcategory != ''){
            $query = Products::find();
            $sql = Category::find();
            $category = $sql -> where('url=:url', [':url' => $category]) -> one();
            $catId = $category['id'];
            
            $sql = SubCategory::find();
            $Subcategory = $sql -> where('url=:url and category_id=:catid', [':url' => $subcategory ,':catid' => $catId]) -> one();
            $sid = $Subcategory['id'];
    
            $sql = SubSubCategory::find();
            $Subcategory = $sql -> where('url=:url and subcategory_id=:catid', [':url' => $subsubcategory ,':catid' => $sid]) -> one();
            $id = $Subcategory['id'];
            //var_dump($Subcategory);
            $query = Products::find() -> where('subsubcategory_id = :id and (child_stock = 1 or head_stock = 1 or stock = 1)', [':id' => $id]) -> orderBy('id desc');
            $countQuery = clone $query;
            // подключаем класс Pagination, выводим по 10 пунктов на страницу
            $pages = new Pagination(['totalCount' => $countQuery -> count(), 'pageSize' => $this -> pageSizeDef]);
            // приводим параметры в ссылке к ЧПУ
            $pages->pageSizeParam = false;
            $products = $query -> offset($pages->offset)
                -> limit($pages->limit)
                -> all();
            //echo $id;
            return $this->render('index', array('products' => $products, 'pages' => $pages));
        }
        else {
            throw new HttpException(404, 'Подкатегория не найдена');
        }
        
    }
    
    public function actionSearch(){
        if (\Yii::$app->request->isAjax) {
            $html = '<div id="products">';
            $name = HtmlPurifier::process($_POST['text']);
            $query = Products::find();
            $products = $query->where("name COLLATE UTF8_GENERAL_CI like '%{$name}%'")->all();
            if ($products != null) {
                foreach ($products as $product) {
                    $html .= '<div class="text-left no-padding-left" style="margin-bottom: 15px; float:left; position:relative;width:100%">
                                    <a href="/catalog/' . $product['category']['url'] . '/' . $product['id'] . '">
                                    <img src="/uploads/products/' . $product['id'] . '/' . explode(':', $product['photo'])[0] . '">
                                    </a>
                                    <span class="searchname" style="margin-left:24px; float:left; font-size:14px">
                                    <a href="/catalog/' . $product['category']['url'] . '/' . $product['id'] . '">' . $product['name'] . '</a>
                                    </span>
                                    
                                    <div class="fade"></div>
                                    </div>
                                    <div class="clearfix"></div>';
                }
            }
            $html .= '</div>';
            \Yii::$app->response->format = Response::FORMAT_HTML;
            echo $this -> renderAjax('_search-results', ['products' => $products]);
            //throw new HttpException('500');
        }
        else return null;
    }
}