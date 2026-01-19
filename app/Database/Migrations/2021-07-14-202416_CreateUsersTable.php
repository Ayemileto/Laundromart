<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id"                => [
										"type"            => "INT",
										"unsigned"        => TRUE,
										"auto_increment"  => TRUE,
								],
			"firstname"         =>[
										"type"            => "VARCHAR",
										"constraint"      => 255,
								],
			"lastname"          =>[
										"type"            => "VARCHAR",
										"constraint"      => 255,
								],
			"username"          =>[
										"type"            => "VARCHAR",
										"constraint"      => 255,
								],
			"email"             =>[
										"type"            => "VARCHAR",
										"constraint"      => 255,
										"unique"          => TRUE,
								],
			"phone"             =>[
										"type"            => "VARCHAR",
										"constraint"      => 255,
										"unique"          => TRUE,
								],
			"avatar"            =>[
										"type"            => "VARCHAR",
										"constraint"      => 255,
										"null"            => TRUE,
										"default"         => NULL,
								],
			"password"          =>[
										"type"            => "VARCHAR",
										"constraint"      => 255,
								],
            "status"            => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['active','inactive'],
                                        "default"         => "inactive",
                                ],
            "email_verified"    => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['yes','no'],
                                        "default"         => "no",
                                ],
            "is_banned"         => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['yes','no'],
                                        "default"         => "no",
                                ],
            "is_superadmin"     => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['yes','no'],
                                        "default"         => "no",
                                ],
            "is_staff"          => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['yes','no'],
                                        "default"         => "no",
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
		$this->forge->createTable('users', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
