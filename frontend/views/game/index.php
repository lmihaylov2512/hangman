<?php

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\GameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $categories array */

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use common\helpers\GameHelper;

$this->title = 'All games';
$this->params['breadcrumbs'][] = 'Games';
?>
<div class="game-index">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p><?= Html::button('Start a new game', ['class' => 'btn btn-primary', 'data' => ['toggle' => 'modal', 'target' => '#start-game-modal']]) ?></p>
    
    <div class="row">
        <div class="col-lg-12">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'buttons' => [
                            'play' => function ($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span>', ['play', 'id' => $model->id]);
                            }
                        ],
                        'visibleButtons' => [
                            'play' => function ($model) {
                                return in_array($model->status, GameHelper::getUnfinishedStatuses());
                            },
                            'view' => function ($model) {
                                return !in_array($model->status, GameHelper::getUnfinishedStatuses());
                            },
                        ],
                        'template' => '{play} {view}',
                        'contentOptions' => [
                            'class' => 'text-center',
                        ],
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($data) {
                            return GameHelper::getStatusesOptions()[$data->status];
                        },
                        'filter' => Html::activeDropDownList($searchModel, 'status', GameHelper::getStatusesOptions(), ['class' => 'form-control', 'prompt' => '-']),
                    ],
                    [
                        'attribute' => 'word0.category.name',
                    ],
                    'is_multi:boolean',
                    'attempts:text',
                    'started_at:dateTime',
                    'finished_at:dateTime',
                    'closed_at:dateTime',
                    'opened_at:dateTime',
                ],
            ]); ?>
        </div>
    </div>
</div>

<?php Modal::begin(['id' => 'start-game-modal', 'header' => 'Choose a category of the word']) ?>
    <?= Html::beginForm(['/game/start']) ?>
        <div class="row">
            <div class="col-md-12">
                
                <div class="form-group">
                    <?= Html::label('Select a category', 'game-category', ['class' => 'form-label']) ?>
                    <?= Html::dropDownList('category_id', null, $categories, ['class' => 'form-control', 'id' => 'game-category', 'prompt' => 'Всички']) ?>
                </div>
                
                <div class="form-group">
                    <?= Html::checkbox('is_multi', false, ['id' => 'game-is-multi']) ?>
                    <?= Html::label('Enable multiplayer', 'game-is-multi', ['class' => 'form-label']) ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Start the game', ['class' => 'btn btn-primary', 'name' => 'start-game-button']) ?>
                </div>
            </div>
        </div>
    <?= Html::endForm() ?>
<?php Modal::end() ?>
