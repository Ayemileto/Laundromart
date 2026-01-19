<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVisitorsTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id"                => [
										"type"            => "INT",
										"unsigned"        => TRUE,
										"auto_increment"  => TRUE,
								],
			"total_visitors"    => [
										"type"            => "NUMERIC",
                                        "constraint"      => '20,0',
                                ],
            "date"              =>  [
                                        "type"            => "DATE",
                                        "unique"          => TRUE,
                                ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('visitors', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('visitors');
	}
}
