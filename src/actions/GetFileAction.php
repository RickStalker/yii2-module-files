<?php

namespace rickstalker\files\actions;

use rickstalker\files\components\SimpleImage;
use rickstalker\files\models\File;
use rickstalker\files\models\FileType;
use Yii;
use yii\base\Action;
use yii\web\NotFoundHttpException;

class GetFileAction extends Action
{
    public function run($hash)
    {
        $model = File::findOne(['hash' => $hash]);

        if (!$model)
            throw new NotFoundHttpException("Запрашиваемый файл не найден");

        if (!file_exists($model->rootPath))
            throw new NotFoundHttpException('Запрашиваемый файл не найден на диске.');

        Yii::$app->response->headers->set('Last-Modified', date("c", $model->created));
        Yii::$app->response->headers->set('Cache-Control', 'public, max-age=' . (60 * 60 * 24 * 15));

        if ($model->type == FileType::IMAGE && $model->watermark) {
            $image = new SimpleImage();
            $image->load($model->rootPath);
            $image->watermark($model->watermark);
            $res = $image->output(IMAGETYPE_JPEG);
            Yii::$app->response->sendContentAsFile($res, $model->title, ['inline' => true, 'mimeType' => "image/jpeg", 'filesize' => $model->size]);
        } else {
            $stream = fopen($model->rootPath, 'rb');
            Yii::$app->response->sendStreamAsFile($stream, $model->title, ['inline' => true, 'mimeType' => $model->content_type, 'filesize' => $model->size]);
        }
    }
}
