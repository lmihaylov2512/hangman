<?php

/* @var $this yii\web\View */
/* @var $model common\models\Game */
/* @var $alphabet array */

use common\helpers\{GameHelper, GameActionHelper};

$hiddenWord = GameHelper::hideWord($model, array_keys(GameActionHelper::getLetters($model)));

?>
<div class="game-play">
    
    <div class="row">
        <div class="col-lg-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="hangman" style="min-height:350px;">
                <g id="stand">
                    <title>stand</title>
                    <line fill="none" stroke="#000" stroke-width="5" stroke-linejoin="null" stroke-linecap="null" x1="161" y1="26" x2="161" y2="49" />
                    <line fill="none" stroke="#000" stroke-width="5" stroke-linejoin="null" stroke-linecap="null" x1="161" y1="29" x2="61" y2="29" />
                    <line fill="none" stroke="#000" stroke-width="5" stroke-linejoin="null" stroke-linecap="null" x1="61" y1="26" x2="62" y2="316" />
                    <line fill="none" stroke="#000" stroke-width="5" stroke-linejoin="null" stroke-linecap="null" x1="25" y1="315" x2="101" y2="315" />
                </g>
                <g id="head">
                    <title>head</title>
                    <ellipse fill="#fcf9f9" stroke="#000000" stroke-width="4" cx="160" cy="77" id="svg_1" rx="25" ry="26" />
                </g>
                <g id="torso" class="error-1">
                    <title>torso</title>
                    <line fill="none" stroke="#d9534f" stroke-width="4" stroke-linejoin="null" stroke-linecap="null" x1="161" y1="101" x2="161" y2="190" />
                </g>
                <g id="rightarm" class="error-2">
                    <title>rightarm</title>
                    <line fill="none" stroke="#d9534f" stroke-width="3" stroke-linejoin="null" stroke-linecap="null" x1="161" y1="130" x2="209" y2="108" />
                </g>
                <g id="leftarm" class="error-3">
                    <title>leftarm</title>
                    <line stroke-width="3" y2="108" x2="113" y1="130" x1="161" stroke-linecap="null" stroke-linejoin="null" stroke="#d9534f" fill="none" />
                </g>
                <g id="leftleg" class="error-4">
                    <title>leftleg</title>
                    <line fill="none" stroke="#d9534f" stroke-width="3" stroke-linejoin="null" stroke-linecap="null" x1="161" y1="188" x2="109" y2="229" />
                </g>
                <g id="rightleg" class="error-5">
                    <title>rightleg</title>
                    <line fill="none" stroke="#d9534f" stroke-width="3" stroke-linejoin="null" stroke-linecap="null" x1="161" y1="188" x2="213" y2="229" />
                    <ellipse fill="none" stroke="#d9534f" stroke-width="3" stroke-linejoin="null" stroke-linecap="null" cx="161" cy="112" rx="23" ry="5"/>
                    <line fill="none" stroke="#d9534f" stroke-width="3" stroke-linejoin="null" stroke-linecap="null" x1="139" y1="110" x2="62" y2="27" />
                </g>
            </svg>
        </div>
        <div class="col-lg-8">
            <?php foreach ($hiddenWord as $char) : ?>
            <div class="lead well pull-left<?= $char === ' ' ? ' invisible' : '' ?>"><?= $char ?></div>
            <?php endforeach; ?>
            <div class="btn-group" role="group" aria-label="alphabet">
                <?php foreach ($alphabet as $letter) : ?>
                <button type="button" class="btn btn-default"><?= $letter ?></button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <?php foreach ($hiddenWord as $char) : ?>
            <div class="lead well pull-left<?= $char === ' ' ? ' invisible' : '' ?>"><?= $char ?></div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="btn-group" role="group" aria-label="alphabet">
                <?php foreach ($alphabet as $letter) : ?>
                <button type="button" class="btn btn-default"><?= $letter ?></button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
</div>
