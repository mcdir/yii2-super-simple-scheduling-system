<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class LessonFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Lesson';
    public $dataFile = '@app/tests/unit/fixtures/data/Lesson.php';
}
