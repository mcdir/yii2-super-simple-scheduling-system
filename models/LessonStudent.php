<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%lesson_student}}".
 *
 * @property int $lesson_id
 * @property int $student_id
 *
 * @property Lesson $lesson
 * @property Student $studen
 */
class LessonStudent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lesson_student}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lesson_id', 'student_id'], 'required'],
            [['lesson_id', 'student_id'], 'integer'],
            [['lesson_id', 'student_id'], 'unique', 'targetAttribute' => ['lesson_id', 'student_id']],
            [['lesson_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lesson::class, 'targetAttribute' => ['lesson_id' => 'lesson_id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lesson_id' => Yii::t('app', 'Lesson ID'),
            'student_id' => Yii::t('app', 'Studen  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLesson()
    {
        return $this->hasOne(Lesson::class, ['lesson_id' => 'lesson_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::class, ['id' => 'student_id']);
    }

    /**
     * {@inheritdoc}
     * @return LessonStudentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LessonStudentQuery(get_called_class());
    }
}
