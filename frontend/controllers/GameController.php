<?php

namespace frontend\controllers;

use Yii;
use yii\web\{Controller, NotFoundHttpException};
use yii\filters\{AccessControl, VerbFilter};
use common\helpers\{CategoryHelper, WordHelper, GameHelper, AlphabetHelper, GameActionHelper};
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
            if (($game = GameHelper::start(Yii::$app->user->identity, $word, Yii::$app->request->post('is_multi'))) !== null) {
                return $this->redirect(['play', 'id' => $game->id]);
            }
        }
        
        return $this->goBack();
    }
    
    public function actionPlay($id)
    {
        $model = $this->findModel($id);
        
        if (!in_array($model->status, GameHelper::getUnfinishedStatuses())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        if ($model->status == GameHelper::STATUS_INCOMPLETE) {
            GameHelper::openClosedGame(Yii::$app->user->identity, $model);
        }
        
        $alphabet = AlphabetHelper::getGroupedAlphabet('bg', 5);
        $letters = array_change_key_case(GameActionHelper::getLetters($model), CASE_LOWER);
        $hiddenWord = GameHelper::hideWord($model, array_keys($letters));
        $failures = GameActionHelper::countFailures($model);
        
        return $this->render('play', [
            'model' => $model,
            'alphabet' => $alphabet,
            'letters' => $letters,
            'hiddenWord' => $hiddenWord,
            'failures' => $failures,
        ]);
    }
    
    public function actionView($id)
    {
        
    }
    
    public function actionCheck($id)
    {
        if (Yii::$app->request->isAjax) {
            $model = $this->findModel($id);
            
            $action = GameActionHelper::create($model, Yii::$app->request->post('input'));
            
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            
            return $action;
        }
    }
    
    protected function findModel($id)
    {
        if (($model = Game::findOne(['id' => $id, 'player_id' => Yii::$app->user->id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
