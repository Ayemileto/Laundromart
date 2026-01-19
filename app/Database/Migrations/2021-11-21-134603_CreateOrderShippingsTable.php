<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderShippingsTable extends Migration
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
			"location_id"           => [
										"type"            => "INT",
										"unsigned"        => TRUE,
                                    ],
            "firstname"             =>[
										"type"            => "VARCHAR",
										"constraint"      => 255,
								    ],
			"lastname"              =>[
										"type"            => "VARCHAR",
										"constraint"      => 255,
								    ],
			"address"               =>[
										"type"            => "VARCHAR",
										"constraint"      => 1000,
                                        "null"            => TRUE,
                                        "default"         => NULL,
								    ],
            "address2"              =>[
										"type"            => "VARCHAR",
										"constraint"      => 1000,
                                        "null"            => TRUE,
                                        "default"         => NULL,
								    ],
            "pickup_date"           =>  [
                                        "type"            => "DATE",
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                    ],
            "pickup_time"           =>  [
                                        "type"            => "TIME",
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                    ],
            "delivery_date"         =>  [
                                        "type"            => "DATE",
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                    ],
            "delivery_time"         =>  [
                                        "type"            => "TIME",
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                    ],
			"shipping_type"         => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['pickup_only','delivery_only','pickup_delivery'],
                                        "default"         => "pickup_delivery",
                                    ],
			"pickup_status"         => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['pending','completed','failed'],
                                        "default"         => "pending",
                                    ],
			"pickup_message"        => [
                                        "type"            => "VARCHAR",
                                        "constraint"      => 255,
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                    ],
			"delivery_status"       => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['pending','completed','failed'],
                                        "default"         => "pending",
                                    ],
			"delivery_message"      => [
                                        "type"            => "VARCHAR",
                                        "constraint"      => 255,
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
        $this->forge->addForeignKey('location_id','locations','id','CASCADE','CASCADE');
		$this->forge->createTable('order_shippings', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('order_shippings');
	}
}
