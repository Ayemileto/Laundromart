<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderDetailsTable extends Migration
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
			"product_id"            => [
										"type"            => "INT",
										"unsigned"        => TRUE,
								    ],
			"product_service_id"    => [
										"type"            => "INT",
										"unsigned"        => TRUE,
								    ],
			"quantity"              => [
                                        "type"            => "INT",
                                    ],
			"unit_price"            => [
                                        "type"            => "NUMERIC",
                                        "constraint"      => '10,2',
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                    ],
			"total_price"           => [
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
        $this->forge->addForeignKey('product_id','products','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('product_service_id','product_services','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('order_id','orders','id','CASCADE','CASCADE');
		$this->forge->createTable('order_details', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('order_details');
	}
}
