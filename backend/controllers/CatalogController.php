<?php


namespace backend\controllers;


use Yii;
use common\models\Products;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;

class CatalogController extends Controller
{
    public function actionIndex(){
        $query = Products::find();
        $products = $query -> orderBy('id desc') -> all();
        return $this->render('index', array('products' => $products));
    }
    
    public function actionProduct($id = ''){
        if ($id != ''){
            $query = Products::find();
            $product = $query
                ->where(array('id' => $id))
                ->one();
        
            return $this->render('view', array('product' => $product));
        }
        else {
            throw new HttpException(404, 'Товар не найден');
        }
    }
    
    public function actionNew(){
        $product = new Products();
        $product -> save();
        $this -> redirect('/admin/catalog/product/edit/'.$product['id']);
            
        //return $this->render('edit', array('product' => $product));
    }
    
    public function actionEdit($id= ''){
        if ($id != ''){
            $query = Products::find();
            $product = $query
                ->where(array('id' => $id))
                ->one();
        
            return $this->render('edit', array('product' => $product));
        }
        else {
            throw new HttpException(404, 'Товар не найден');
        }
    }
    
    public function actionUpload(){
        $return = array(
            'status' => 'error'
        );
        if (isset($_POST['file'])) {
            $id = $_POST['product_id'];
            $return['status'] = "OK";
            $return['filesize'] = $_FILES['filename']["size"];
            $upload_dir_origin = $_SERVER['DOCUMENT_ROOT'] . '/frontend/web/uploads/products/'.$id.'/';
            if (!is_dir($upload_dir_origin)) {
                mkdir($upload_dir_origin, 0777, true);
            }
            if (is_uploaded_file($_FILES["filename"]["tmp_name"])) {
                // Если файл загружен успешно, перемещаем его
                // из временной директории в конечную
        
                $ext = pathinfo($_FILES['filename']["name"], PATHINFO_EXTENSION);
                $name = time() . '.' . $ext;
                move_uploaded_file($_FILES["filename"]["tmp_name"], $upload_dir_origin . $name);
                if ($_POST['type'] == 'product') {
                    $query = Products::find();
                    $model = $query
                        -> where(array('id' => $id))
                        -> one();
                    $photo = $model['photo'];
                    if ($photo == null)
                        $photo = $name;
                    else
                        $photo .= ':'.$name;
                    $model -> photo = $photo;
                    
                    if ($model->save()) {
                        $return['filename'] = $name;
                        $return['id'] = $model->id;
                    }
                }
                
                /*$doc = new PersonalDocuments();
                $doc -> filename =  $_FILES["filename"]["name"];
                $doc -> name = $name;
                $doc -> cat_id = $_POST['category'];
                $doc -> save();
                $return['fid'] = $doc -> id;*/
            } else {
                echo("Ошибка загрузки файла");
            }
        
        
        }
        if (Yii::$app->request->isAjax) {
            echo Json::encode($return);
        }
    }
    
    public function actionUpdate(){
        $return = array(
            'status' => 'error'
        );
        if (isset($_POST['id'])){
            $id = $_POST['id'];
            $query = Products::find();
            $model = $query
                -> where(array('id' => $id))
                -> one();
            $field = $_POST['field'];
            $value = $_POST['value'];
            $model -> $field = $value;
            if ($model -> save()) {
                $return['field'] = $_POST['field'];
                $return['value'] = $_POST['value'];
                $return['status'] = 'ok';
            }
            
        }
        if (Yii::$app->request->isAjax) {
            echo Json::encode($return);
        }
    }
}