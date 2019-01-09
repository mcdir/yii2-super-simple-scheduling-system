<?php

namespace app\models;

use Yii;
use app\models\Lesson;
use cornernote\linkall\LinkAllBehavior;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string $last_name
 * @property string $first_name
 *
 */
class Student extends \yii\db\ActiveRecord
{
    public $lessons_ids;

    /** {@inheritdoc} */
    public static function tableName()
    {
        return '{{%student}}';
    }

    /** {@inheritdoc} */
    public function behaviors()
    {
        return [
            LinkAllBehavior::class,
        ];
    }

    /** {@inheritdoc} */
    public function rules()
    {
        return [
            [['id','last_name', 'first_name'], 'required'],
            [['id'], 'number'],
            [['last_name', 'first_name'], 'string', 'max' => 255],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::class, 'targetAttribute' => ['course_id' => 'code']],
            [['full_name'], 'safe'],
            [['lessons_ids', ], 'default', 'value' => []],
        ];
    }

    /** {@inheritdoc} */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'last_name' => Yii::t('app', 'Last Name'),
            'first_name' => Yii::t('app', 'First Name'),
            'course_id'  => Yii::t('app', 'Course id'),
            'title'  => Yii::t('app', 'Course title'),
        ];
    }

    /** {@inheritdoc} */
    public function afterSave($insert, $changedAttributes)
    {
        $linkedModels = [
            [
                'class' => Lesson::class,
                'property' => 'lessons',
            ],
        ];
        foreach ($linkedModels as $linkedModel) {
            $models = [];
            $property = $linkedModel['property'] . '_ids';
            foreach ($this->$property as $name) {
                $model = $linkedModel['class']::getByName($name);
                if (!$model) {
                    $model = $linkedModel['class'];
                    $model->name = $name;
                    $model->save(false);
                }
                if ($model) {
                    $models[] = $model;
                }
            }
            $this->linkAll($linkedModel['property'], $models);
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::class, ['code' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLessonsStudents()
    {
        return $this->hasMany(LessonStudent::class, ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLessons()
    {
        //return $this->hasMany(Lesson::class, ['lesson_id' => 'lesson_id'])
        //    ->viaTable('{{%lesson_student}}', ['student_id' => 'id']);
        return $this->hasMany(Lesson::class, ['lesson_id' => 'lesson_id'])
            ->via('lessonsStudents');
    }

    /**
     * {@inheritdoc}
     * @return StudentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StudentQuery(get_called_class());
    }

    public function getFullName()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getTitle()
    {
        if($this->course) {
            return $this->course->title;
        }
        return null;
    }

    public static function findFullName()
    {
        return static::find()
            ->select(['id', 'CONCAT(first_name, last_name) AS full_name']);
    }
}