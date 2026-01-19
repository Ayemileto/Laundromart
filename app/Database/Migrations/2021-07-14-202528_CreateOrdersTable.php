<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrdersTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id"                => [
										"type"            => "INT",
										"unsigned"        => TRUE,
										"auto_increment"  => TRUE,
								],
            "user_id"           => [
                                        "type"            => "INT",
                                        "unsigned"        => TRUE,
                                ],
			"invoice_id"        => [
                                        "type"            => "INT",
										"unsigned"        => TRUE,
                                        "unique"          => TRUE,
                                        "null"            => TRUE,
                                        "default"         => NULL,    
                                ],
			"subscription_id"   => [
                                        "type"            => "INT",
                                        "unsigned"        => TRUE,
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                ],
			"status"            => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['pending','active','completed','cancelled'],
                                        "default"         => "pending",
                                ],
			"has_shipping"      => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['no','yes'],
                                        "default"         => "no",
                                ],
			"has_custom_items"  => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['no','yes'],
                                        "default"         => "no",
                                ],
            "completed_at"      =>  [
                                        "type"            => "DATETIME",
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                ],
            "created_at"        =>  [
                                        "type"            => "DATETIME"
                                ],
            "updated_at"        =>  [
                                        "type"            => "DATETIME",
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                ],
            "deleted_at"        =>  [
                                        "type"            => "DATETIME",
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                ],
		]);
		$this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('user_id','users','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('invoice_id','invoices','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('subscription_id','subscriptions','id','CASCADE','CASCADE');
		$this->forge->createTable('orders', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('orders');
	}
}
