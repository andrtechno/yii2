<?php

namespace app\system\modules\pages\models;

use Yii;
use app\cms\components\WebModel;
use app\models\User;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $name
 */
class Pages extends WebModel {



    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'text'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'text' => 'Text',
        ];
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
