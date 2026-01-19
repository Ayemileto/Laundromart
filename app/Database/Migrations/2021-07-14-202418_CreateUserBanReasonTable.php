<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserBanReasonTable extends Migration
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
            "reason"            => [
                                        "type"            => "TEXT",
										"null"            => true,
                                        "default"         => NULL,
                                ],
            "created_at"        =>  [
                                        "type"            => "DATETIME"
                                ]
        ]);
        $this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('user_id','users','id','CASCADE','CASCADE');
        $this->forge->createTable('user_ban_reason', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('user_ban_reason');
	}
}
