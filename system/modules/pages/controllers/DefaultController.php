<?php

namespace app\modules\pages\controllers;

use Yii;
use app\cms\controllers\WebController;
use app\modules\pages\models\Pages;

class DefaultController extends WebController {



    public function actionIndex() {

        $all = Pages::find()->all();
        $one = Pages::findOne(3);
        echo Yii::$app->request->getQueryParam('language');
        return $this->render('index', [
                    'model' => $all,
                    'one' => $one
                ]);
    }

    public function actionView($id) {

        $model = Pages::findOne($id);
        return $this->render('view', [
                    'model' => $model
                ]);
    }

}
