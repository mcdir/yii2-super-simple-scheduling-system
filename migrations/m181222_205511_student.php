<?php

use yii\db\Schema;
use yii\db\Migration;

class m181222_205511_student extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%student}}',
            [
                'student_id'=> $this->primaryKey(11),
                'last_name'=> $this->string(255)->notNull(),
                'first_name'=> $this->string(255)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%student}}');
    }
}
