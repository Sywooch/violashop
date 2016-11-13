<?php
namespace backend\controllers;

use backend\models\ModxContent;
use common\models\Products;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        
                    ],
                    [
                        'actions' => ['logout', 'index', 'getold', 'copy', 'migrate'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionGetold(){
        $query = ModxContent::find();
        $content = $query
            ->joinWith('image as im')
            ->where('parent in (9, 14, 22, 31, 32, 317, 361, 901) and published = 1 and deleted = 0')
            ->all();
        echo count($content);
        foreach($content as $item){
            $image = '';
            $childPrice = 0;
            $headPrice = 0;
            $price = 0;

            foreach($item['image'] as $tmpl){
                if ($tmpl['tmplvarid'] == 5)
                    $image = $tmpl['value'];
                if ($tmpl['tmplvarid'] == 8)
                    $childPrice = $tmpl['value'];
                if ($tmpl['tmplvarid'] == 9)
                    $headPrice = $tmpl['value'];
                if ($tmpl['tmplvarid'] == 4)
                    $price = $tmpl['value'];
            }
            echo $item['pagetitle'] . ' - ' . $image . ' => ' . $childPrice . ' => ' . $headPrice  . ' => ' . $price . ' => ' . $item['description']. ' => ' .$item['introtext'] .'<br>';
        }
    }
    
    public function actionCopy(){
        $query = ModxContent::find();
        $content = $query
            ->joinWith('image as im')
            ->where('parent in (9, 14, 22, 31, 32, 317, 361, 901) and published = 1 and deleted = 0')
            ->all();
        foreach($content as $item){
            $product = Products::find() -> where("name = '{$item['pagetitle']}'") -> one();
            $image = '';
            
            foreach($item['image'] as $tmpl){
                if ($tmpl['tmplvarid'] == 5)
                    $image = $tmpl['value'];
                
               
            }
            if ($this->startsWith($image, 'assets')){
                
                $file = 'D:/work/web/www/violashop/frontend/web/uploads/' . $image;
                $newdir = 'D:/work/web/www/violashop/frontend/web/uploads/products/'.$product['id'] .'/';
                echo $content['pagetitle'];
    
                if (!file_exists($newdir)) {
                    mkdir($newdir, 0777, true);
                }
                $newfile = $newdir .'/' . array_pop(explode('/', $image));
    
                if (!copy($file, $newfile)) {
                    echo "не удалось скопировать $file...\n";
                }
            }
            //echo $item['pagetitle'] . ' - ' . $image . ' => ' . $childPrice . ' => ' . $headPrice  . ' => ' . $price . ' => ' . $item['description']. ' => ' .$item['introtext'] .'<br>';
        }
    }
    
    public function actionMigrate(){
        $query = ModxContent::find();
        $content = $query
            ->joinWith('image as im')
            ->where('parent in (9, 14, 22, 31, 32, 317,361,901) and published = 1 and deleted = 0')
            ->all();
        foreach($content as $item){
            $query = Products::find();
            $prod = $query -> where('name=\''.$item['pagetitle'].'\'') -> one();
            if ($prod != null) {
                $prod -> createdon = $item['createdon'];
                $prod -> editedon = $item['editedon'];
                $prod->save();
            }
            else {
                $prod = new Products();
                $prod -> name = $item['pagetitle'];
                $image = '';
                $childPrice = 0;
                $headPrice = 0;
                $price = 0;
                foreach($item['image'] as $tmpl){
                    if ($tmpl['tmplvarid'] == 5)
                        $image = $tmpl['value'];
        
                    if ($tmpl['tmplvarid'] == 8)
                        $childPrice = $tmpl['value'];
                    if ($tmpl['tmplvarid'] == 9)
                        $headPrice = $tmpl['value'];
                    if ($tmpl['tmplvarid'] == 4)
                        $price = $tmpl['value'];
                }
    
                $prod -> short_description = $item['introtext'];
                if ($item['description'] != null && $item['description']!=''){
                    $prod -> description = $item['description'];
                }
                else
                    $prod -> description = $item['introtext'];
    
                $prod -> head_price = $headPrice;
                if ($headPrice > 0)
                    $prod -> head_stock = 1;
    
                $prod -> child_price = $childPrice;
                if ($childPrice > 0)
                    $prod -> child_stock = 1;
    
                $prod -> price = $price;
                if ($price > 0)
                    $prod -> stock = 1;
                if (!$this->startsWith('http',$image))
                    $prod -> photo = array_pop(explode('/',$image));
                else
                    $prod -> photo = $image;
                $prod -> save();
                
                
            }
        }
    }
    
    function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }
}
