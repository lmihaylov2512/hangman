<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class MorrisAsset extends AssetBundle
{
    public $sourcePath = '@bower/morrisjs';
    public $css = [
        'morris.css',
    ];
    public $js = [
        YII_DEBUG ? 'morris.js' : 'morris.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'frontend\assets\RaphaelAsset',
    ];
}
