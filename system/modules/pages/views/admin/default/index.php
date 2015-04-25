<?php

use yii\helpers\Html;
//use app\cms\grid\AdminGridView;
use app\cms\grid\sortable\SortableGridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pages\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="pages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>


    <?php Pjax::begin(); ?>
    <?=
    SortableGridView::widget([
        'tableOptions' => ['class' => 'table table-striped'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => $this->render('_grid_layout', ['title' => $this->context->pageName]), //'{items}{pager}{summary}'
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            ['class' => 'app\cms\grid\ActionColumn'],
            ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
