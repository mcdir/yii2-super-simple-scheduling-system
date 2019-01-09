<?php

use yii\db\Migration;

class m181223_143309_create_table_course extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%course}}', [
            'code' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%course}}');
    }
}
