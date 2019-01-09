<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LessonStudent */

$this->title = Yii::t('app', 'Update Lesson Student: {name}', [
    'name' => $model->lesson_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lesson Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->lesson_id, 'url' => ['view', 'lesson_id' => $model->lesson_id, 'student_id' => $model->student_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="lesson-student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
