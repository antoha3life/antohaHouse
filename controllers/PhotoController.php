<?php

namespace app\controllers;

use app\base\BaseController;

class PhotoController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAlbums()
    {
        return $this->render('albums');
    }

    public function actionUploadphoto()
    {
        return $this->render('upload_photo');
    }
}
