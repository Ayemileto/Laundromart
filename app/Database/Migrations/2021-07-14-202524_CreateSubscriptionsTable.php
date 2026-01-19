<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubscriptionsTable extends Migration
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
            "plan_id"           => [
                                        "type"            => "INT",
                                        "unsigned"        => TRUE,
                                ],
            "invoice_id"        => [
                                        "type"            => "INT",
										"unsigned"        => TRUE,
                                        "unique"          => TRUE,
                                ],
			"subscription_date" => [
                                        "type"            => "DATETIME",
                                        "null"            => TRUE,
                                        "default"         => NULL,
								],
			"duration"          => [
                                        "type"            => "VARCHAR",
                                        "constraint"      => 10,
                                        "null"            => TRUE,
                                        "default"         => NULL,
								],
			"renewal_date"      => [
                                        "type"            => "DATETIME",
                                        "null"            => TRUE,
                                        "default"         => NULL,
								],
			"expiry_date"       => [
                                        "type"            => "DATETIME",
                                        "null"            => TRUE,
                                        "default"         => NULL,
								],
			"status"            => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['pending', 'active', 'expired', 'cancelled'],
                                        "default"         => "pending",
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
        $this->forge->addForeignKey('plan_id','plans','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('invoice_id','invoices','id','CASCADE','CASCADE');
		$this->forge->createTable('subscriptions', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('subscriptions');
	}
}
