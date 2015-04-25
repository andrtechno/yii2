<?php

namespace app\cms\widgets\lang;

use app\models\Languages;

class LangSwitcher extends \yii\bootstrap\Widget {

    public function init() {
        
    }

    public function run() {
        return $this->render('default', [
                    'current' => Languages::getCurrent(),
                    'langs' => Languages::find()->where('id != :current_id', [':current_id' => Languages::getCurrent()->id])->all(),
                ]);
    }

}