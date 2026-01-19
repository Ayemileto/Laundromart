<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderCustomItemsTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id"                    => [
										"type"            => "INT",
										"unsigned"        => TRUE,
										"auto_increment"  => TRUE,
								    ],
            "user_id"               => [
                                        "type"            => "INT",
                                        "unsigned"        => TRUE,
                                    ],
			"order_id"              => [
                                        "type"            => "INT",
										"unsigned"        => TRUE,
								    ],
            "name"                  => [
										"type"            => "VARCHAR",
										"constraint"      => 255,
								    ],
			"price"                 => [
                                        "type"            => "NUMERIC",
                                        "constraint"      => '10,2',
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                    ],
            "created_at"            =>  [
                                        "type"            => "DATETIME"
                                    ],
            "updated_at"            =>  [
                                        "type"            => "DATETIME",
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                    ],
            "deleted_at"            =>  [
                                        "type"            => "DATETIME",
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                    ],
		]);
		$this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('user_id','users','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('order_id','orders','id','CASCADE','CASCADE');
		$this->forge->createTable('order_custom_items', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('order_custom_items');
	}
}
