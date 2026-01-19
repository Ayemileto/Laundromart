<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOfficeBranchesTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'                    => [
                                        'type'            => 'INT',
                                        'unsigned'        => TRUE,
                                        'auto_increment'  => TRUE,
                                    ],
            'office_address'        => [
                                        'type'          => 'MEDIUMTEXT',
                                        'null'          => TRUE,
                                        'default'       => NULL,
                                    ],
            'zipcode'              => [
                                        'type'          => 'VARCHAR',
                                        'constraint'    => '255',
                                    ],
            'office_phone'          => [
                                        'type'          => 'VARCHAR',
                                        'constraint'    => '255',
                                        'null'          => TRUE,
                                        'default'       => NULL,
                                    ],
            'google_map_location'   => [
										'type'          => 'VARCHAR',
                                        'constraint'    => '1000',
                                        'null'          => TRUE,
                                        'default'       => NULL,
                                    ],
            'status'                => [
                                        'type'            => 'ENUM',
                                        'constraint'      => ['active','inactive'],
                                        'default'         => 'active',
                                    ],
            'show_on_homepage'      => [
                                        'type'            => 'ENUM',
                                        'constraint'      => ['yes','no'],
                                        'default'         => 'no',
                                    ],
            'show_on_contact_page'  => [
                                        'type'            => 'ENUM',
                                        'constraint'      => ['yes','no'],
                                        'default'         => 'no',
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
		$this->forge->createTable('office_branches', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('office_branches');
	}
}
