<?php

/* @var $this yii\web\View */
/* @var $games array */

use yii\helpers\{Html, Json};
use frontend\assets\MorrisAsset;

$this->title = 'Statistics';
$this->params['breadcrumbs'][] = $this->title;

MorrisAsset::register($this);
?>
<div class="statistics-index">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="row">
        <div class="col-lg-12">
            <div id="donut-games"></div>
        </div>
    </div>    
</div>
<script> window.donutGamesData = <?= Json::encode($games) ?>; </script>
