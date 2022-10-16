<?php

namespace frontend\controllers;
use frontend\models\Group;
use yii\web\Controller;
use yii\web\Request;

class GroupController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreate(){
        $data = \Yii::$app->request->post();
        $file = \Yii::$app->request->post('goods_file');
        print_r($file);exit();
        $model = new Group();
        $res = $model->save($data);
        var_dump($res);
    }
}