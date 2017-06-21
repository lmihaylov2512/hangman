<?php

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MultiGameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Multiplayer games';
?>
<div class="multi-index">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="row">
        <div class="col-lg-12">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
            ]) ?>
        </div>
    </div>
    
</div>
