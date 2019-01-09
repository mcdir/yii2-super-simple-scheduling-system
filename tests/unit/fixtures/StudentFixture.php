<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class StudentFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Student';
    public $dataFile = '@app/tests/unit/fixtures/data/Student.php';
}
