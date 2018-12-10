<?php

use yii\db\Schema;

class m181210_070101_Currencies extends \yii\db\Migration
{
    public function up()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        if (!in_array(Yii::$app->db->tablePrefix.'components', $tables))  {
            $this->createTable('{{%components}}', [
                'id' => $this->primaryKey(),
                'currency_name' => $this->string(50),
                'currency_code' => $this->string(5),
                'currency_symbol' => $this->string(2),
                'exchange_rate' => $this->float()->defaultValue(1),
                'decimal_places' => $this->integer(5)->defaultValue(2),
                'status' => $this->tinyint(1)->defaultValue(1),
                'created_at' => $this->datetime(),
                'updated_at' => $this->datetime(),
                'created_by' => $this->integer(11),
                'updated_by' => $this->integer(11),
                'deleted' => $this->tinyint(1)->defaultValue(0),
            ], $tableOptions);
        } else {
            echo "\nTable `".Yii::$app->db->tablePrefix."components` already exists!\n";
        }

    }

    public function down()
    {
        $this->dropTable('{{%components}}');
    }
}