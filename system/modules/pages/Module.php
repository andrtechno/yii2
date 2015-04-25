<?php

namespace app\system\modules\pages;

//use Yii;
use yii\base\BootstrapInterface; // implements BootstrapInterface
use app\cms\components\WebModule;

class Module extends WebModule {

    public $controllerNamespace = 'app\system\modules\pages\controllers';

    public function init() {
        parent::init();
    }

    protected function getDefaultModelClasses() {
        return [
            'Pages' => 'app\system\modules\pages\models\Pages',
            'PagesSearch' => 'app\system\modules\pages\models\PagesSearch',
        ];
    }

   /* public function bootstrap($app) {
        // add rules for admin/copy/auth controllers
        $groupUrlRule = new GroupUrlRule([
                    'prefix' => $this->id,
                    'rules' => [
                       // '<controller:(admin)>' => 'admin/<controller>',
                        'admin/pages/<action:\w+>' => 'admin/default/<action>',
                        //'<action:\w+>' => 'default/<action>',
                        ],
                ]);
        $app->getUrlManager()->addRules($groupUrlRule->rules, false);
    }*/

}
