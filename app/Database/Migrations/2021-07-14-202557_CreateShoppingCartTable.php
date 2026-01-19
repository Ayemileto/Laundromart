<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateShoppingCartTable extends Migration
{
	public function up()
	{
        $this->forge->addField([
			// 'id'                => [
			// 							'type'            => 'INT',
			// 							'unsigned'        => TRUE,
			// 							'auto_increment'  => TRUE,
            //                     ],
            'user_id'           => [
										'type'            => 'INT',
                                        'unsigned'        => TRUE,
								],
			'product_id'        => [
										'type'            => 'INT',
                                        'unsigned'        => TRUE,
								],
			'product_service'   => [
										'type'            => 'INT',
                                        'unsigned'        => TRUE,
								],
            'quantity'          => [
                                        'type'            => 'INT',
                                        'unsigned'        => TRUE,
                                        'default'         => 1,
                                ],
            "subscription_id"   => [
                                        "type"            => "INT",
                                        "unsigned"        => TRUE,
                                        "null"            => TRUE,
                                        "default"         => NULL,
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
                                ],
        ]);
        
        // $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('subscription_id','subscriptions','id','CASCADE','CASCADE');
        $this->forge->createTable('shopping_cart', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('shopping_cart');
	}
}
