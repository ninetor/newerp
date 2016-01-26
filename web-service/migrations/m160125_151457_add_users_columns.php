<?php

use yii\db\Schema;
use yii\db\Migration;

class m160125_151457_add_users_columns extends Migration
{
    public function up()
    {
        $this->addColumn('user','auth_key','varchar(32) null');
        $this->addColumn('user','login','varchar(300) not null');
        $this->addColumn('user','password','varchar(300) not null');
        $this->addColumn('user','access_token','varchar(300) null');
    }

    public function down()
    {
        echo "m160125_151457_add_users_columns cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
