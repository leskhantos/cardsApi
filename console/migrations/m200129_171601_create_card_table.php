<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%card}}`.
 */
class m200129_171601_create_card_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%card}}', [
            'id' => $this->primaryKey(),
            'title' =>$this->string(512),
            'description' => $this->text(),
            'created_at' => $this->date(),
            'created_by' => $this->integer(),
            'participant' => $this->integer()
        ]);
        $this->addForeignKey('FK_card_user_created_by','{{%card}}','created_by','{{%user}}','id');
        $this->addForeignKey('FK_card_user_participant','{{%card}}','participant','{{%user}}','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_card_user_created_by','{{%card}}');
        $this->dropForeignKey('FK_card_user_participant','{{%card}}');

        $this->dropTable('{{%card}}');
    }
}
