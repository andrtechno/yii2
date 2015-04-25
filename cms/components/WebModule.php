<?php

namespace app\cms\components;

use Yii;
use yii\base\Module;
use yii\helpers\FileHelper;

class WebModule extends Module {

    public static $moduleID;
    public $modelClasses = [];
    protected $_models;

    public function init() {
        parent::init();
        $this->registerTranslations();
        $this->modelClasses = array_merge($this->getDefaultModelClasses(), $this->modelClasses);

        self::$moduleID = $this->id;
    }

    /**
     * Функция для translations fileMap
     */
    public function getTranslationsFileMap() {
        $lang = Yii::$app->language;
        $path = Yii::getAlias("@app/system/modules/{$this->id}/messages/{$lang}");
        $s = FileHelper::findFiles($path, [
                    'only' => ['*.php'],
                ]);
        print_r($s);
        //  return $s;
    }

    public function model($name, $config = []) {
        // return object if already created
        if (!empty($this->_models[$name])) {
            return $this->_models[$name];
        }


        // create model and return it
        $className = $this->modelClasses[ucfirst($name)];
        $this->_models[$name] = Yii::createObject(array_merge(["class" => $className], $config));
        return $this->_models[$name];
    }

    public function registerTranslations() {
        // set up i8n
        
        if (empty(Yii::$app->i18n->translations[$this->id])) {
            Yii::$app->i18n->translations[$this->id] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/system/modules/' . $this->id . '/messages',
                //'forceTranslation' => true,
            ];
        }
      /*  Yii::$app->i18n->translations['system/modules/' . $this->id . '/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            // 'sourceLanguage' => 'en',
            'basePath' => '@app/system/modules/' . $this->id . '/messages',
            'fileMap' => [
                'system/modules/' . $this->id . '/default' => 'default.php',
                ],
        ];*/
    }

    public static function t($category, $message, $params = [], $language = null) {

        return Yii::t('system/modules/' . self::$moduleID . '/' . $category, $message, $params, $language);
    }

}
