<?php


namespace frontend\controllers;

use common\models\News;
use yii\web\Controller;



class NewsController extends  Controller
{
    public function actionIndex(){
        $query = News::find();
        $news = $query -> all();
        return $this->render('index', array('news' => $news));
    }
}