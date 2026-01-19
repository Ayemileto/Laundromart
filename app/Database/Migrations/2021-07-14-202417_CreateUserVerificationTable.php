<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserVerificationTable extends Migration
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
            "type"              => [
                                        "type"            => "VARCHAR",
                                        "constraint"      => 255,
										"null"            => true,
                                        "default"         => NULL,
                                ],
			"token"             => [
										"type"            => "VARCHAR",
                                        "constraint"      => 40
                                ],
            "created_at"        =>  [
                                        "type"            => "DATETIME"
                                ],
            "expires_at"        =>  [
                                        "type"            => "DATETIME",
                                        "null"            => true,
                                        "default"         => NULL,
                                ],

        ]);
        $this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('user_id','users','id','CASCADE','CASCADE');
        $this->forge->createTable('user_verifications', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('user_verifications');
	}
}
