<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $student_id
 * @property string $last_name
 * @property string $first_name
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'last_name', 'first_name'], 'required'],
            [['student_id'], 'integer'],
            [['last_name', 'first_name'], 'string', 'max' => 255],
            [['student_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'student_id' => Yii::t('app', 'Student ID'),
            'last_name' => Yii::t('app', 'Last Name'),
            'first_name' => Yii::t('app', 'First Name'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return StudentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StudentQuery(get_called_class());
    }
}
