<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaymentGatewayTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'                => [
                                    'type'            => 'INT',
                                    'unsigned'        => TRUE,
                                    'auto_increment'  => TRUE,
                                ],
            'name'              => [
										'type'          => 'VARCHAR',
                                        'constraint'    => '255',
                                        'unique'        => TRUE,
                                ],
            'public_key'        => [
										'type'          => 'VARCHAR',
                                        'constraint'    => '255',
                                        'null'          => TRUE,
                                        'default'       => NULL,
                                ],
            'secret_key'        => [
										'type'          => 'VARCHAR',
                                        'constraint'    => '255',
                                        'null'          => TRUE,
                                        'default'       => NULL,
                                ],
            'webhook_key'       => [
										'type'          => 'VARCHAR',
                                        'constraint'    => '255',
                                        'null'          => TRUE,
                                        'default'       => NULL,
                                ],
            'currency'          => [
										'type'          => 'VARCHAR',
                                        'constraint'    => '255',
                                        'null'          => TRUE,
                                        'default'       => NULL,
                                ],
            'is_enabled'        => [
                                        'type'            => 'ENUM',
                                        'constraint'      => ['yes','no'],
                                        'default'         => 'no',
                                ],
            'is_default'        => [
                                        'type'            => 'ENUM',
                                        'constraint'      => ['yes','no'],
                                        'default'         => 'no',
                                ],
            'created_at'        =>  [
                                        'type'            => 'DATETIME'
                                ],
            'updated_at'        =>  [
                                        'type'            => 'DATETIME',
                                        'null'            => TRUE,
                                        'default'         => NULL,
                                ],
            'deleted_at'        =>  [
                                        'type'            => 'DATETIME',
                                        'null'            => TRUE,
                                        'default'         => NULL,
                                ]
        ]);
        
        $this->forge->addKey('id', TRUE);
		$this->forge->createTable('payment_gateways', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('payment_gateways');
	}
}
