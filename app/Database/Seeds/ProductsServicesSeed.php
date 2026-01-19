<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsServicesSeed extends Seeder
{
	public function run()
	{
        $data = [
                    [
                        'name'                  => 'Wash Only',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Iron Only',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Wash & Iron',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Dry Clean',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                ];

        $this->db->table('product_services')->insertBatch($data);
	}
}
