<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LessonStudent */

$this->title = Yii::t('app', 'Create Lesson Student');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lesson Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
