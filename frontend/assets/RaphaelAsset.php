<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class RaphaelAsset extends AssetBundle
{
    public $sourcePath = '@bower/raphael';
    public $js = [
        YII_DEBUG ? 'raphael.js' : 'raphael.min.js',
    ];
}
