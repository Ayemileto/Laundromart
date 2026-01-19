<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePagesTable extends Migration
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
                                        "unique"          => TRUE
								    ],
            "title"                 => [
										"type"            => "VARCHAR",
										"constraint"      => 255,
                                        "null"            => TRUE,
                                        "default"         => NULL,
								    ],
            "slug"                  => [
										"type"            => "VARCHAR",
                                        "constraint"      => 255,
                                        "unique"          => TRUE
								    ],
            "content"               => [
										"type"            => "TEXT",
								    ],
			"top_menu"              => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['yes','no'],
                                        "default"         => "no",
                                    ],
			"bottom_menu"           => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['yes','no'],
                                        "default"         => "no",
                                    ],
			"status"                => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['active','inactive'],
                                        "default"         => "active",
                                    ],
            "created_at"            =>  [
                                        "type"            => "DATETIME"
                                    ],
            "updated_at"            =>  [
                                        "type"            => "DATETIME",
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                    ],
            "deleted_at"            =>  [
                                        "type"            => "DATETIME",
                                        "null"            => TRUE,
                                        "default"         => NULL,
                                    ],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('pages', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('pages');
	}
}
