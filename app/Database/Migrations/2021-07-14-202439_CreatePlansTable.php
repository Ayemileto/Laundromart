<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePlansTable extends Migration
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
            "orders_per_month"      => [
										"type"            => "INT",
                                        ],
			"tagline"               => [
										"type"            => "VARCHAR",
										"constraint"      => 255,
								    ],
			"monthly_price"         => [
                                        "type"            => "NUMERIC",
                                        "constraint"      => '10,2',
                                        "NULL"            => TRUE,
                                        "default"         => NULL,
                                    ],
			"quarterly_price"       => [
                                        "type"            => "NUMERIC",
                                        "constraint"      => '10,2',
                                        "NULL"            => TRUE,
                                        "default"         => NULL,
                                    ],
			"semi_annually_price"   => [
                                        "type"            => "NUMERIC",
                                        "constraint"      => '10,2',
                                        "NULL"            => TRUE,
                                        "default"         => NULL,
                                    ],
			"yearly_price"          => [
                                        "type"            => "NUMERIC",
                                        "constraint"      => '10,2',
                                        "NULL"            => TRUE,
                                        "default"         => NULL,
                                    ],
            "features"              => [
                                        "type"            => "TEXT",
                                        "constraint"      => 60000,
                                    ],
            "status"                => [
                                        "type"            => "ENUM",
                                        "constraint"      => ['active','inactive'],
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
		$this->forge->createTable('plans', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('plans');
	}
}
