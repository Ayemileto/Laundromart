<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsServicesPricesSeed extends Seeder
{
	public function run()
	{
        $data = [
                    [
                        'product_id'            => 1,
                        'service_id'            => 1,
                        'price'                 => 2.50,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 1,
                        'service_id'            => 2,
                        'price'                 => 1.50,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 1,
                        'service_id'            => 3,
                        'price'                 => 4.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 1,
                        'service_id'            => 4,
                        'price'                 => 6.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 2,
                        'service_id'            => 1,
                        'price'                 => 2.50,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 2,
                        'service_id'            => 2,
                        'price'                 => 1.50,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 2,
                        'service_id'            => 3,
                        'price'                 => 4.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 2,
                        'service_id'            => 4,
                        'price'                 => 6.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 3,
                        'service_id'            => 1,
                        'price'                 => 3.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 3,
                        'service_id'            => 2,
                        'price'                 => 2.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 3,
                        'service_id'            => 3,
                        'price'                 => 5.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 3,
                        'service_id'            => 4,
                        'price'                 => 7.50,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 4,
                        'service_id'            => 1,
                        'price'                 => 6.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 4,
                        'service_id'            => 2,
                        'price'                 => 4.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 4,
                        'service_id'            => 3,
                        'price'                 => 10.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 4,
                        'service_id'            => 4,
                        'price'                 => 13.50,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 5,
                        'service_id'            => 1,
                        'price'                 => 6.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 5,
                        'service_id'            => 2,
                        'price'                 => 4.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 5,
                        'service_id'            => 3,
                        'price'                 => 10.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 5,
                        'service_id'            => 4,
                        'price'                 => 13.50,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 6,
                        'service_id'            => 1,
                        'price'                 => 2.50,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 6,
                        'service_id'            => 2,
                        'price'                 => 1.50,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 6,
                        'service_id'            => 3,
                        'price'                 => 4.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 6,
                        'service_id'            => 4,
                        'price'                 => 6.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 7,
                        'service_id'            => 1,
                        'price'                 => 3.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 7,
                        'service_id'            => 2,
                        'price'                 => 2.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 7,
                        'service_id'            => 3,
                        'price'                 => 5.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 7,
                        'service_id'            => 4,
                        'price'                 => 7.50,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 8,
                        'service_id'            => 1,
                        'price'                 => 2.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'product_id'            => 8,
                        'service_id'            => 4,
                        'price'                 => 5.00,
                        'created_at'            => date("Y-m-d H:i:s"),
                    ]
                ];

        $this->db->table('products_services_prices')->insertBatch($data);
	}
}
