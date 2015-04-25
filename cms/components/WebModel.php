<?php

namespace app\cms\components;

use Yii;
use yii\db\ActiveRecord;

class WebModel extends ActiveRecord {

    public function behaviors() {
        if (isset($this->tableSchema->columns['ordern'])) {
            return [
                'sort' => [
                    'class' => \app\cms\grid\sortable\SortableGridBehavior::className(),
                    'sortableAttribute' => 'ordern'
                    ],
            ];
        }
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            //create
            if ($this->isNewRecord) {
                if (isset($this->tableSchema->columns['ip_create'])) {
                    //Текущий IP адресс, автора добавление
                    $this->ip_create = Yii::$app->request->userHostAddress;
                }
                if (isset($this->tableSchema->columns['user_id'])) {
                    $this->user_id = (Yii::$app->user->isGuest) ? 0 : Yii::$app->user->id;
                }
                if (isset($this->tableSchema->columns['user_agent'])) {
                    $this->user_agent = Yii::$app->request->userAgent;
                }
                if (isset($this->tableSchema->columns['date_create'])) {
                    $this->date_create = date('Y-m-d H:i:s');
                }
                if (isset($this->tableSchema->columns['ordern'])) {
                    if (!isset($this->ordern)) {
                        $row = $this->model()->find(array('select' => 'max(ordern) AS maxOrdern'));
                        $this->ordern = $row['maxOrdern'] + 1;
                    }
                }
                //update
            } else {
                if (isset($this->tableSchema->columns['date_update'])) {
                    $this->date_update = date('Y-m-d H:i:s');
                }
            }
            return true;
        } else {
            return false;
        }
    }

}

?>
