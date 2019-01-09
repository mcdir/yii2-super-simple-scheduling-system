<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Course;
use app\models\Lesson;

/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'course_id')->label('Course title')->widget(Select2::class, [
        'data' => ArrayHelper::map(Course::find()->all(), 'code', 'title'),
        'model' => $model,
        'attribute' => 'course_id',
        'options' => [
            'multiple' => false,
        ],
        'pluginOptions' => [
            'tags' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'lessons_ids')->label('Lessons')->widget(Select2::class, [
        'data' => ArrayHelper::map(Lesson::find()->all(), 'title_about', 'title_about'),
        'model' => $model,
        'attribute' => 'lessons_ids',
        'options' => [
            'multiple' => true,
        ],
        'pluginOptions' => [
            'tags' => true,
        ],
    ]); ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
