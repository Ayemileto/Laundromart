<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsServicesPricesTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
            "product_id"        =>  [
                                        "type"            => "INT",
                                        "unsigned"        => TRUE,
                                ],
            "service_id"        =>  [
                                        "type"            => "INT",
                                        "unsigned"        => TRUE,
                                ],
			"price"             =>  [
                                        "type"            => "NUMERIC",
                                        "constraint"     => '10,2',
                                ],
			"discount_price"    =>  [
                                        "type"            => "NUMERIC",
                                        "constraint"     => '10,2',
                                        "null"            => TRUE,
                                        "default"         => 0.00,
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
                                ]
        ]);

		$this->forge->addForeignKey('product_id','products','id','CASCADE','CASCADE');
		$this->forge->addForeignKey('service_id','product_services','id','CASCADE','CASCADE');

        $this->forge->createTable('products_services_prices', FALSE, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->forge->dropTable('products_services_prices');
	}
}
