<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotificationsTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
            "id"            => [
                                    "type"            => "INT",
                                    "unsigned"        => TRUE,
                                    "auto_increment"  => TRUE,
                            ],
            "user_id"       => [
                                    "type"            => "INT",
                                    "unsigned"        => TRUE,
                            ],
			"title"         =>  [
                                    "type"            => "VARCHAR",
                                    "constraint"      => "255",
                                    "null"            => TRUE,
                                    "default"         => NULL,
                            ],
			"message"       =>  [
                                    "type"            => "TEXT",
                                    "null"            => TRUE,
                                    "default"         => NULL,
                            ],
            "created_at"    =>  [
                                    "type"            => "DATETIME"
                            ],
            "created_at"    =>  [
                                    "type"            => "DATETIME",
                                    "null"            => TRUE,
                                    "default"         => NULL,
                            ],
            "created_at"    =>  [
                                    "type"            => "DATETIME",
                                    "null"            => TRUE,
                                    "default"         => NULL,
                            ]
        ]);
        $this->forge->addKey("id", TRUE);
        $this->forge->addForeignKey('user_id','users','id','CASCADE','CASCADE');
        $this->forge->createTable('notifications', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('notifications');
	}
}
