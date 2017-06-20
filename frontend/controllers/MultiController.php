<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\MultiGameSearch;

class MultiController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new MultiGameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
