<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsSeed extends Seeder
{
	public function run()
	{
        $data = [
                    [
                        'name'                  => 'T Shirt',
                        'description'           => 'Flexible T-shirts',
                        'file'                  => 't_shirt.jpg',
                        'status'                => 'active',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Packing Shirt',
                        'description'           => 'Flexible packing shirts',
                        'file'                  => 'packing_shirt.jpg',
                        'status'                => 'active',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Sweater',
                        'description'           => 'Sweater',
                        'file'                  => 'sweater.jpg',
                        'status'                => 'active',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Suit',
                        'description'           => 'Male and Female Suit',
                        'file'                  => 'suit.jpg',
                        'status'                => 'active',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Blazer',
                        'description'           => 'Male and Female Blazer',
                        'file'                  => 'blazer.jpg',
                        'status'                => 'active',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Skirt',
                        'description'           => 'Ladies skirt',
                        'file'                  => 'skirt.jpg',
                        'status'                => 'active',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Jeans Pants',
                        'description'           => 'Jeans trouser for men and women',
                        'file'                  => 'jeans_pants.jpg',
                        'status'                => 'active',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Canvas',
                        'description'           => 'Leather Sports Shoe',
                        'file'                  => 'canvas.jpg',
                        'status'                => 'active',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ]
                ];
        $this->db->table('products')->insertBatch($data);
	}
}
