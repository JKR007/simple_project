<?php

use yii\db\Migration;

/**
 * Class m180723_131619_create_table_place_lang
 */
class m180723_131619_create_table_place_lang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('place_lang', [
        'id' => $this->primaryKey()->unsigned(),
        'place_id' => $this->integer()->unsigned()->notNull(),
        'locality' => $this->string(45)->notNull(),
        'country' => $this->string(45)->notNull(),
        'lang' => $this->string(2)->notNull()
      ]);

      $this->createIndex(
        'idx_place_lang_place_id_place', //index name must be unique among the db
        'place_lang',                    //table name in which index created
        'place_id'                       //index -> key
      );

      $this->addForeignKey(
        'fk_place_lang_place_id_place', //foreign key name
        'place_lang',                   //created in
        'place_id',                     //created for column
        'place',                        //referenced table
        'id',                           //referenced column
        'restrict',                     //on delete 'restrict'
        'cascade'                       //on update 'cascade'
      );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      //remove foreign-keys and indexes
      $this->dropForeignKey('fk_place_lang_place_id_place', 'place_lang');
      $this->dropIndex('idx_place_lang_place_id_place', 'place_lang');

      //then drop the table
      $this->dropTable('place_lang');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180723_131619_create_table_place_lang cannot be reverted.\n";

        return false;
    }
    */
}
