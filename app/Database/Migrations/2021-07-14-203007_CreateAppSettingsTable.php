<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAppSettingsTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id"                => [
										"type"            => "INT",
										"unsigned"        => TRUE,
										"auto_increment"  => TRUE,
								],
            "key"               => [
                                        "type"            => "VARCHAR",
                                        "constraint"      => 255,
                                        "unique"          => TRUE,
                                ],
            "value"             => [
                                        "type"            => "TEXT",
                                        "constraint"      => 60000,
                                ],
            "group"             => [
                                        "type"            => "VARCHAR",
                                        "constraint"      => 255,
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
        $this->forge->createTable('app_settings', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('app_settings');
	}
}
