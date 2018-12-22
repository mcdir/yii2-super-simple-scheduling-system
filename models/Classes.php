<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "classes".
 *
 * @property int $code
 * @property string $title
 * @property string $description
 */
class Classes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'classes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'title'], 'required'],
            [['code'], 'integer'],
            [['title', 'description'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => Yii::t('app', 'Code'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ClassesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClassesQuery(get_called_class());
    }
}
