<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolesPermissionsTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id"                => [
										"type"            => "INT",
										"unsigned"        => TRUE,
										"auto_increment"  => TRUE,
								],
			"role_id"           => [
										"type"            => "INT",
										"unsigned"        => TRUE,
								],
			"permission_id"     =>[
										"type"            => "INT",
										"unsigned"        => TRUE,
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
        $this->forge->addForeignKey('role_id','roles','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('permission_id','permissions','id','CASCADE','CASCADE');
		$this->forge->createTable('roles_permissions', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('roles_permissions');
	}
}
