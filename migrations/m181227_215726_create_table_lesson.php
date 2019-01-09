<?php

use yii\db\Migration;

class m181227_215726_create_table_lesson extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%lesson}}', [
            'lesson_id' => $this->primaryKey(),
            'title_about' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%lesson}}');
    }
}
