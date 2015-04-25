<?php

namespace app\cms\controllers;

use Yii;

use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\cms\controllers\WebController;

class AdminController extends WebController {

    public $pageName;
    public $buttons = [];
    public $layout = '@app/web/themes/admin/views/layouts/main';



    public function init() {
        if (!empty(Yii::$app->user) && !Yii::$app->user->can("admin")) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        parent::init();
    }

    public function actionSwitch($id, $s) {
        die('act:D');
    }

}
