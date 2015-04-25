<?php

namespace app\cms\controllers;

use Yii;
use yii\web\Controller;

class WebController extends Controller {



    public function init() {
      //  if (Yii::$app->request->getQueryParam('language')) {
            Yii::$app->language = Yii::$app->languageManager->active->code;
       // }
            echo Yii::$app->languageManager->active->code;
        parent::init();
    }

}
