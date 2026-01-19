<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLocationsTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'                => [
                                    'type'            => 'INT',
                                    'unsigned'        => TRUE,
                                    'auto_increment'  => TRUE,
                                    ],
            'name'                  => [
										'type'          => 'VARCHAR',
                                        'constraint'    => '255',
                                    ],
            'zipcode'              => [
										'type'          => 'VARCHAR',
                                        'constraint'    => '255',
                                        'null'          => TRUE,
                                        'default'       => NULL,
                                    ],
			'pickup_only_price'     => [
                                        'type'            => 'NUMERIC',
                                        'constraint'      => '10,2',
                                        'null'            => TRUE,
                                        'default'         => NULL,
                                    ],
			'delivery_only_price'    => [
                                        'type'            => 'NUMERIC',
                                        'constraint'      => '10,2',
                                        'null'            => TRUE,
                                        'default'         => NULL,
                                ],
			'pickup_delivery_price' => [
                                        'type'            => 'NUMERIC',
                                        'constraint'      => '10,2',
                                        'null'            => TRUE,
                                        'default'         => NULL,
                                    ],
            'status'                => [
                                        'type'            => 'ENUM',
                                        'constraint'      => ['active','inactive'],
                                        'default'         => 'active',
                                    ],
            'created_at'            =>  [
                                        'type'            => 'DATETIME'
                                    ],
            'updated_at'            =>  [
                                        'type'            => 'DATETIME',
                                        'null'            => TRUE,
                                        'default'         => NULL,
                                    ],
            'deleted_at'            =>  [
                                        'type'            => 'DATETIME',
                                        'null'            => TRUE,
                                        'default'         => NULL,
                                    ]
        ]);
        
        $this->forge->addKey('id', TRUE);
		$this->forge->createTable('locations', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('locations');
	}
}
