<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class CourseFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Course';
    public $dataFile = '@app/tests/unit/fixtures/data/Course.php';
}
