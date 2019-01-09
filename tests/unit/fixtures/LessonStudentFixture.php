<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class LessonStudentFixture extends ActiveFixture
{
    public $modelClass = 'app\models\LessonStudent';
    public $dataFile = '@app/tests/unit/fixtures/data/LessonStudent.php';
}
