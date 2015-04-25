<?php

namespace app\system\modules\user\controllers\admin;

use Yii;
use app\system\modules\user\models\User;
use app\system\modules\user\models\UserKey;
use app\system\modules\user\models\UserAuth;
use app\cms\controllers\AdminController;
//use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminController implements the CRUD actions for User model.
 */
class DefaultController extends AdminController {

    // public $pageName;
    public function init() {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
            ],
                ],
        ];
    }

    /**
     * List all User models
     *
     * @return mixed
     */
    public function actionIndex() {
        $this->pageName = Yii::t('user','User');
        $this->buttons = [
            [
                'label' => Yii::t('user','CREATE_USER'),
                'url' => '/',
                'options'=>['class' => 'btn btn-success']
            ]
        ];
        /** @var \amnah\yii2\user\models\search\UserSearch $searchModel */
        $searchModel = Yii::$app->getModule("user")->model("UserSearch");
        $dataProvider = new $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                ]);
    }

    /**
     * Display a single User model
     *
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'user' => $this->findModel($id),
                ]);
    }

    /**
     * Create a new User model. If creation is successful, the browser will
     * be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate() {
        /** @var \amnah\yii2\user\models\User $user */
        /** @var \amnah\yii2\user\models\Profile $profile */
        $user = Yii::$app->getModule("user")->model("User");
        $user->setScenario("admin");
        $profile = Yii::$app->getModule("user")->model("Profile");

        $post = Yii::$app->request->post();
        if ($user->load($post) && $user->validate() && $profile->load($post) && $profile->validate()) {
            $user->save(false);
            $profile->setUser($user->id)->save(false);
            return $this->redirect(['view', 'id' => $user->id]);
        }

        // render
        return $this->render('create', [
                    'user' => $user,
                    'profile' => $profile,
                ]);
    }

    /**
     * Update an existing User model. If update is successful, the browser
     * will be redirected to the 'view' page.
     *
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        // set up user and profile
        $user = $this->findModel($id);
        $user->setScenario("admin");
        $profile = $user->profile;

        // load post data and validate
        $post = Yii::$app->request->post();
        if ($user->load($post) && $user->validate() && $profile->load($post) && $profile->validate()) {
            $user->save(false);
            $profile->setUser($user->id)->save(false);
            return $this->redirect(['view', 'id' => $user->id]);
        }

        // render
        return $this->render('update', [
                    'user' => $user,
                    'profile' => $profile,
                ]);
    }

    /**
     * Delete an existing User model. If deletion is successful, the browser
     * will be redirected to the 'index' page.
     *
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        // delete profile and userkeys first to handle foreign key constraint
        $user = $this->findModel($id);
        $profile = $user->profile;
        UserKey::deleteAll(['user_id' => $user->id]);
        UserAuth::deleteAll(['user_id' => $user->id]);
        $profile->delete();
        $user->delete();

        return $this->redirect(['index']);
    }

    /**
     * Find the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        /** @var \amnah\yii2\user\models\User $user */
        $user = Yii::$app->getModule("user")->model("User");
        if (($user = $user::findOne($id)) !== null) {
            return $user;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
