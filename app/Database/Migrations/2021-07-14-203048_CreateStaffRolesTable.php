<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStaffRolesTable extends Migration
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
                                    "null"            => TRUE,
                                ],
			"role_id"           => [
										"type"            => "INT",
										"unsigned"        => TRUE,
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
        $this->forge->addForeignKey('role_id','roles','id','CASCADE','CASCADE');
		$this->forge->createTable('staff_roles', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('staff_roles');
	}
}
