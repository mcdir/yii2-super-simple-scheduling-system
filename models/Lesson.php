<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%lesson}}".
 *
 * @property int $lesson_id
 * @property string $title_about
 *
 * @property LessonStudent[] $lessonStudents
 * @property Student[] $studenS
 */
class Lesson extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lesson}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_about'], 'required'],
            [['title_about'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lesson_id' => Yii::t('app', 'Lesson ID'),
            'title_about' => Yii::t('app', 'Title About'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLessonStudents()
    {
        return $this->hasMany(LessonStudent::class, ['lesson_id' => 'lesson_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasMany(Student::class, ['id' => 'student_id'])
            ->via('lessonStudents');
        //return $this->hasMany(Student::class, ['id' => 'student_id'])
        //    ->viaTable('{{%lesson_student}}', ['lesson_id' => 'lesson_id']);
    }

    /**
     * {@inheritdoc}
     * @return LessonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LessonQuery(get_called_class());
    }

    /**
     * @param $name
     * @return Lesson|array|null
     */
    public static function getByName($name)
    {
        return self::find()->where(['title_about' => $name])->one();
    }
}
