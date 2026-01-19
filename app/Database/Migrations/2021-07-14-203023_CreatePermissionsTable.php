<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePermissionsTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id"                    => [
										"type"            => "INT",
										"unsigned"        => TRUE,
										"auto_increment"  => TRUE,
								    ],
			"name"                  => [
										"type"            => "VARCHAR",
                                        "constraint"      => 255,
                                        "unique"          => TRUE,
								    ],
            "created_at"            => [
                                        "type"            => "DATETIME"
                                    ],
            "updated_at"            => [
                                        "type"            => "DATETIME",
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                    ],
            "deleted_at"            => [
                                        "type"            => "DATETIME",
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                    ],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('permissions', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('permissions');
	}
}
