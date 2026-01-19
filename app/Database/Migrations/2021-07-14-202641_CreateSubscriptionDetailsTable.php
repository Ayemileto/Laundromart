<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubscriptionDetailsTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id"                => [
										"type"            => "INT",
										"unsigned"        => TRUE,
										"auto_increment"  => TRUE,
								],
			"subscription_id"   => [
                                        "type"            => "INT",
										"unsigned"        => TRUE,
                                ],
			"order_id"          => [
                                        "type"            => "INT",
										"unsigned"        => TRUE,
                                ],
			"type"              => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['new','renewal'],
                                ],
			"date"              => [
                                        "type"            => "DATETIME",
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                ],

        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('subscription_id','subscriptions','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('order_id','orders','id','CASCADE','CASCADE');
		// $this->forge->createTable('subscription_details', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('subscription_details');
	}
}
