<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\FormGrid;
use kartik\builder\Form;

use yii\helpers\ArrayHelper;
use app\models\City;

$form = ActiveForm::begin();
echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
    
    
[
'attributes' => [
        'co_main_city_id' => ['type'=>Form::INPUT_DROPDOWN_LIST, 'items' => ArrayHelper::map(City::find()->orderBy('c_name')->asArray()->all(), 'c_id', 'c_name'),'options'=>['placeholder'=>'']],

                        'co_name' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

                        'co_area' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

                ],
],
[
'attributes' => [
        'co_description' => ['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'']],

                ],
],
   
    
    ]
]);

     echo $this->render('_country_grid', [
         'form' => $form,
         'model' => $model,
         'countryMods' => $countryMods,
     ]);

?>    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php
ActiveForm::end();
?>