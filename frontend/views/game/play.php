<?php

/* @var $this yii\web\View */
/* @var $model common\models\Game */
/* @var $alphabet array */
/* @var $letters array */
/* @var $failures integer */

use yii\helpers\{Html, Url};
use common\helpers\GameActionHelper;

$this->title = 'Playing game';
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Playing';
?>
<div class="game-play">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="row">
        <div class="col-lg-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="hangman">
                <g id="stand">
                    <title>stand</title>
                    <line fill="none" stroke="#000" stroke-width="5" stroke-linejoin="null" stroke-linecap="null" x1="161" y1="26" x2="161" y2="49" />
                    <line fill="none" stroke="#000" stroke-width="5" stroke-linejoin="null" stroke-linecap="null" x1="161" y1="29" x2="61" y2="29" />
                    <line fill="none" stroke="#000" stroke-width="5" stroke-linejoin="null" stroke-linecap="null" x1="61" y1="26" x2="61" y2="280" />
                    <line fill="none" stroke="#000" stroke-width="5" stroke-linejoin="null" stroke-linecap="null" x1="25" y1="280" x2="101" y2="280" />
                </g>
                <g id="head">
                    <title>head</title>
                    <ellipse fill="#fcf9f9" stroke="#000000" stroke-width="4" cx="160" cy="77" id="svg_1" rx="25" ry="26" />
                </g>
                <g id="torso" class="failure failure-1<?= $failures < 1 ? ' hidden' : '' ?>">
                    <title>torso</title>
                    <line fill="none" stroke="#d9534f" stroke-width="4" stroke-linejoin="null" stroke-linecap="null" x1="161" y1="101" x2="161" y2="190" />
                </g>
                <g id="rightarm" class="failure failure-2<?= $failures < 2 ? ' hidden' : '' ?>">
                    <title>rightarm</title>
                    <line fill="none" stroke="#d9534f" stroke-width="3" stroke-linejoin="null" stroke-linecap="null" x1="161" y1="130" x2="209" y2="108" />
                </g>
                <g id="leftarm" class="failure failure-3<?= $failures < 3 ? ' hidden' : '' ?>">
                    <title>leftarm</title>
                    <line stroke-width="3" y2="108" x2="113" y1="130" x1="161" stroke-linecap="null" stroke-linejoin="null" stroke="#d9534f" fill="none" />
                </g>
                <g id="leftleg" class="failure failure-4<?= $failures < 4 ? ' hidden' : '' ?>">
                    <title>leftleg</title>
                    <line fill="none" stroke="#d9534f" stroke-width="3" stroke-linejoin="null" stroke-linecap="null" x1="161" y1="188" x2="109" y2="229" />
                </g>
                <g id="rightleg" class="failure failure-5<?= $failures < 5 ? ' hidden' : '' ?>">
                    <title>rightleg</title>
                    <line fill="none" stroke="#d9534f" stroke-width="3" stroke-linejoin="null" stroke-linecap="null" x1="161" y1="188" x2="213" y2="229" />
                    <ellipse fill="none" stroke="#d9534f" stroke-width="3" stroke-linejoin="null" stroke-linecap="null" cx="161" cy="112" rx="23" ry="5"/>
                    <line fill="none" stroke="#d9534f" stroke-width="3" stroke-linejoin="null" stroke-linecap="null" x1="139" y1="110" x2="62" y2="27" />
                </g>
            </svg>
        </div>
        
        <div class="col-lg-8">
            
            <div class="row margin-top-20 game-word">
                <div class="col-md-12">
                    <?php foreach ($hiddenWord as $char) : ?>
                    <div class="lead well pull-left<?= $char === ' ' ? ' invisible' : '' ?>"><?= $char ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- .game-word -->
            
            <div class="row margin-top-20 game-alphabet">
                <div class="col-md-12">
                    <div class="btn-toolbar" role="toolbar" aria-label="alphabet">
                        <?php foreach ($alphabet as $group) : ?>
                        <div class="btn-group" role="group">
                            <?php foreach ($group as $letter) : ?>
                            <button type="button" class="btn btn-<?= isset($letters[$letter]) ? ($letters[$letter] ? 'success' : 'danger') : 'default' ?>" data-input="<?= $letter ?>" data-used="<?= (int) isset($letters[$letter]) ?>"><?= $letter ?></button>
                            <?php endforeach; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- .game-alphabet -->
            
            <div class="row margin-top-20 game-action" data-url="<?= Url::to(['check', 'id' => $model->id]) ?>">
                <div class="col-md-12">
                    <div class="list-group list-game-action">
                        <div class="list-group-item">Действия</div>
                        <?php foreach ($model->gameActions as $action) : ?>
                        <div class="list-group-item <?= $action->success ? 'list-group-item-success' : 'list-group-item-danger' ?>"><?= GameActionHelper::getTypesOptions()[$action->type] ?>: <?= Html::encode($action->input) ?></div>
                        <?php endforeach; ?>
                    </div>
                    <!-- .list-game-action -->
                </div>
            </div>
            <!-- .game-action -->
        </div>
    </div>
</div>
<!-- .game-play -->
