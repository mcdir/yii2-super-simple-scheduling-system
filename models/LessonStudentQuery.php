<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LessonStudent]].
 *
 * @see LessonStudent
 */
class LessonStudentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LessonStudent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LessonStudent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
