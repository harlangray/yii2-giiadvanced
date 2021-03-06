<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContinentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Continents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="continent-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Continent',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'co_id',
            [
                'attribute' => 'co_main_city_id',
                'value'=>'coMainCity.c_name',
            ],
            'co_name',
            'co_area',
            'co_description:ntext',
/*            'co_created_by',*/
/*            'co_created_at',*/
/*            'co_updated_by',*/
/*            'co_updated_at',*/
/*            'co_is_deleted',*/
/*            'co_deleted_by',*/
/*            'co_deleted_at',*/

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
