<?php

use yii\db\Migration;

class m181227_215739_create_table_lesson_student extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%lesson_student}}', [
            'lesson_id' => $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('PRIMARYKEY', '{{%lesson_student}}', ['lesson_id', 'student_id']);
        $this->addForeignKey('fg1', '{{%lesson_student}}', 'lesson_id', '{{%lesson}}', 'lesson_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fg2', '{{%lesson_student}}', 'student_id', '{{%student}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%lesson_student}}');
    }
}
