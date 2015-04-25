<?php

namespace app\system\modules\pages\controllers\admin;

use Yii;
use app\system\modules\pages\models\Pages;
use app\cms\controllers\AdminController;
use app\cms\grid\sortable\SortableGridAction;


class DefaultController extends AdminController {
public function actions()
{
    return [
        'sort' => [
            'class' => SortableGridAction::className(),
            'modelName' => Pages::className(),
        ],
    ];
}
    public function actionIndex() {
        $this->pageName = Yii::t('pages', 'MODNAME');
        $this->buttons = [
            [
                'label' => Yii::t('pages', 'CREATE_BTN'),
                'url' => ['create'],
                'options' => ['class' => 'btn btn-success']
            ]
        ];

$this->view->params['breadcrumbs'][] = $this->pageName;
        $searchModel = Yii::$app->getModule("pages")->model("PagesSearch");
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                ]);
    }

    public function actionUpdate($id) {
        return $this->render('update');
    }

    public function actionCreate() {
        $this->pageName = Yii::t('pages', 'CREATE_BTN');
        $this->buttons = [
            [
                'label' => Yii::t('pages', 'CREATE_BTN'),
                'url' => ['create'],
                'options' => ['class' => 'btn btn-success']
            ]
        ];
        $this->view->params['breadcrumbs'][] = ['label' => Yii::t('pages', 'MODNAME'), 'url' => ['index']];
        $this->view->params['breadcrumbs'][] = $this->pageName;
        $model = Yii::$app->getModule("pages")->model("Pages");
        //$model->setScenario("admin");


        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {
            $model->save();
            \Yii::$app->session->addFlash('success', \Yii::t('app', 'SUCCESS_CREATE'));
           // return $this->redirect(['index']);
            return Yii::$app->getResponse()->redirect(['/admin/pages/index']);
        }
        return $this->render('create', [
                    'model' => $model,
                ]);
    }

}
