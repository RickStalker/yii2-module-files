<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 31.12.2017
 * Time: 21:28
 */

namespace rickstalker\files\assets;


use yii\web\AssetBundle;


class FileInputWidgetAsset extends AssetBundle
{
    public $sourcePath = '@vendor/rickstalker/yii2-module-files/assets/';

    public $css = [
        'yii2-floor12-files.css',
    ];
    public $js = [
        'yii2-floor12-files.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
        'floor12\notification\NotificationAsset',
        'rickstalker\files\assets\CropperAsset',
        'rickstalker\files\assets\SimpleAjaxUploaderAsset',
    ];
}
