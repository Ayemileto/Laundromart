<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubscriptionSchedulesTable extends Migration
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
                                        "unique"          => TRUE,
                                ],
			"subscription_id"   => [
										"type"            => "INT",
										"unsigned"        => TRUE,
                                ],
			"schedule_id"       => [
										"type"            => "VARCHAR",
										"constraint"      => 255,
                                ],
            "schedule_type"     => [
                                        "type"            => "ENUM",
                                        "constraint"      => ["pickup", "delivery"],
                                ],
            "schedule_time"     => [    
                                        "type"            => "DATETIME",
                                ],
            "status"            => [    
                                        "type"            => "ENUM",
                                        "constraint"      => ["pending", "in progress", "complete"]
                                ],
            "notes"             => [    
                                        "type"            => "TEXT",
                                        "constraint"      => 50000,
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
        $this->forge->addForeignKey('subscription_id','subscriptions','id','CASCADE','CASCADE');
		// $this->forge->createTable('subscription_schedules', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('subscription_schedules');
	}
}
