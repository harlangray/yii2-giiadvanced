<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CountrySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cn_id') ?>

    <?= $form->field($model, 'cn_continent_id') ?>

    <?= $form->field($model, 'cn_name') ?>

    <?= $form->field($model, 'cn_area') ?>

    <?= $form->field($model, 'cn_is_deleted') ?>

    <?php // echo $form->field($model, 'cn_deleted_at') ?>

    <?php // echo $form->field($model, 'cn_deleted_by') ?>

    <?php // echo $form->field($model, 'cn_created_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
