<?php

use yii\db\Migration;

class m181223_143309_create_table_student extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%student}}', [
            'id' => $this->primaryKey(),
            'last_name' => $this->string()->notNull(),
            'first_name' => $this->string()->notNull(),
            'course_id' => $this->integer()->Null(),
        ], $tableOptions);

        $this->addForeignKey('fg_to_course', '{{%student}}', 'course_id', '{{%course}}', 'code', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%student}}');
    }
}
