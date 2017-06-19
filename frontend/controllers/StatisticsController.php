<?php

namespace frontend\controllers;

use yii\web\Controller;

/**
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class StatisticsController extends Controller
{
    
    public function actionIndex()
    {
        
        
        return $this->render('index');
    }
    
}
