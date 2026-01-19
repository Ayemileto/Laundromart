<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvoiceTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'                => [
                                    'type'              => 'INT',
                                    'unsigned'          => TRUE,
                                    'auto_increment'    => TRUE,
                                ],
            'user_id'           => [
                                    'type'              => 'INT',
                                    'unsigned'          => TRUE,
                                ],
            'reference'         => [
                                    'type'              => 'VARCHAR',
                                    'constraint'        => '16',
                                    'null'              => TRUE,
                                    'unique'            => TRUE,
                                    'default'           => NULL,
                                ],
			'items'             => [
                                    'type'              => 'TEXT',
                                ],
            'item_type'         => [
                                    'type'              => 'ENUM',
                                    'constraint'        => ['custom','product','subscription'],
                                    'default'           => 'custom',
                                ],
			'total_price'       => [
                                    'type'              => 'NUMERIC',
                                    'constraint'        => '10,2',
                                    'default'           => 0.00,
                                ],
			'tax'               => [
                                    'type'              => 'NUMERIC',
                                    'constraint'        => '10,2',
                                    'default'           => 0.00,
                                ],
			'total_due'         => [
                                    'type'              => 'NUMERIC',
                                    'constraint'        => '10,2',
                                    'default'           => 0.00,
                                ],
			'total_paid'        => [
                                    'type'              => 'NUMERIC',
                                    'constraint'        => '10,2',
                                    'null'              => TRUE,
                                    'default'           => NULL,
                                ],
			'payment_reference' => [
                                    'type'              => 'VARCHAR',
                                    'constraint'        => '255',
                                    'null'              => TRUE,
                                    'default'           => NULL,
                                ],
			'payment_method'    => [
                                    'type'              => 'VARCHAR',
                                    'constraint'        => '255',
                                    'null'              => TRUE,
                                    'default'           => NULL,
                                ],
            'status'            => [
                                    'type'              => 'ENUM',
                                    'constraint'        => ['unpaid','paid','cancelled','failed','refunded'],
                                    'default'           => 'unpaid',
                                ],
			'note'              => [
                                    'type'              => 'VARCHAR',
                                    'constraint'        => '1000',
                                    'null'              => TRUE,
                                    'default'           => NULL,
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
		$this->forge->addForeignKey('user_id','users','id','CASCADE','CASCADE');
        $this->forge->createTable('invoices', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('invoices');
	}
}
