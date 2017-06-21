<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\helpers\{PlayerHelper, GameHelper};

/**
 * Reports controller which is using for building custom reports(statistics) pages.
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 * @since 1.0
 */
class StatisticsController extends Controller
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
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    /**
     * Displays donut graphic consists of number of the games for given status.
     * 
     * @return mixed
     */
    public function actionIndex()
    {
        // pull raw report data and prepare it
        $games = array_map(function ($el) { $el['label'] = GameHelper::getStatusesOptions()[$el['label']]; return $el; }, PlayerHelper::doStatistics(Yii::$app->user->identity));
        
        return $this->render('index', [
            'games' => $games,
        ]);
    }
}
