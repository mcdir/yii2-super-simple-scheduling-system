<?php

use yii\db\Schema;
use yii\db\Migration;

class m181222_205706_classes extends Migration
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
            '{{%classes}}',
            [
                'code'=> $this->primaryKey(11),
                'title'=> $this->string(255)->notNull(),
                'description'=> $this->string(255)->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%classes}}');
    }
}
