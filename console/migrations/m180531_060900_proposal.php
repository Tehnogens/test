<?php

use yii\db\Migration;

/**
 * Class m180531_060900_proposal
 */
class m180531_060900_proposal extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%proposal}}', [
            'id' => $this->primaryKey(),
            'thema' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'client_name' => $this->string()->notNull(),            
            'email' => $this->string()->notNull(),
            'file_name' => $this->string(100)->notNull(),            
            'created_at' => $this->integer()->notNull(),            
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%proposal}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180531_060900_proposal cannot be reverted.\n";

        return false;
    }
    */
}
