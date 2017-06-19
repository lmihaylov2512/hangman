<?php

namespace frontend\controllers;

use Yii;
use yii\web\{Controller, NotFoundHttpException};
use yii\filters\{AccessControl, VerbFilter};
use common\helpers\{CategoryHelper, WordHelper, GameHelper, AlphabetHelper};
use common\models\Game;
use frontend\models\GameSearch;

/**
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class GameController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'start' => ['post'],
                    'check' => ['post'],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        $searchModel = new GameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $categories = CategoryHelper::getCategoriesOptions();
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
        ]);
    }
    
    public function actionStart()
    {
        if (($word = WordHelper::getRandomWords(Yii::$app->request->post('category_id'))) !== null) {
            if (($game = GameHelper::start(Yii::$app->user->identity, $word)) !== null) {
                return $this->redirect(['play', 'id' => $game->id]);
            }
        }
        
        return $this->goBack();
    }
    
    public function actionPlay($id)
    {
        $model = $this->findModel($id);
        
        $alphabet = AlphabetHelper::getAlphabet('bg', true);
        
        return $this->render('play', [
            'model' => $model,
            'alphabet' => $alphabet,
        ]);
    }
    
    public function actionCheck()
    {
        
    }
    
    protected function findModel($id)
    {
        if (($model = Game::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
