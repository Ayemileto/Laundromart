<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeed extends Seeder
{
	public function run()
	{
        $date = date("Y-m-d H:i:s");

        $data = [
                    [
                        'name'                  => 'add_branch',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'view_branch',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'update_branch',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'delete_branch',
                        'created_at'            => $date,
                    ],
                    
                    [
                        'name'                  => 'view_calendar',
                        'created_at'            => $date,
                    ],

                    [
                        'name'                  => 'add_invoice',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'view_invoice',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'update_invoice',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'delete_invoice',
                        'created_at'            => $date,
                    ],

                    [
                        'name'                  => 'add_location',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'view_location',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'update_location',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'delete_location',
                        'created_at'            => $date,
                    ],

                    [
                        'name'                  => 'add_order',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'view_order',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'update_order',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'delete_order',
                        'created_at'            => $date,
                    ],

                    [
                        'name'                  => 'add_page',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'view_page',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'update_page',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'delete_page',
                        'created_at'            => $date,
                    ],
                    
                    [
                        'name'                  => 'view_payment_setting',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'update_payment_setting',
                        'created_at'            => $date,
                    ],

                    [
                        'name'                  => 'add_plan',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'view_plan',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'update_plan',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'delete_plan',
                        'created_at'            => $date,
                    ],

                    [
                        'name'                  => 'add_product',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'view_product',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'update_product',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'delete_product',
                        'created_at'            => $date,
                    ],

                    [
                        'name'                  => 'add_product_service',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'view_product_service',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'update_product_service',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'delete_product_service',
                        'created_at'            => $date,
                    ],

                    [
                        'name'                  => 'add_role',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'view_role',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'update_role',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'delete_role',
                        'created_at'            => $date,
                    ],

                    [
                        'name'                  => 'view_setting',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'update_setting',
                        'created_at'            => $date,
                    ],

                    [
                        'name'                  => 'add_shipping',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'view_shipping',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'update_shipping',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'delete_shipping',
                        'created_at'            => $date,
                    ],

                    [
                        'name'                  => 'add_staff',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'view_staff',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'update_staff',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'delete_staff',
                        'created_at'            => $date,
                    ],

                    [
                        'name'                  => 'view_statistic',
                        'created_at'            => $date,
                    ],

                    [
                        'name'                  => 'add_subscription',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'view_subscription',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'update_subscription',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'delete_subscription',
                        'created_at'            => $date,
                    ],

                    [
                        'name'                  => 'add_user',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'view_user',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'update_user',
                        'created_at'            => $date,
                    ],
                    [
                        'name'                  => 'delete_user',
                        'created_at'            => $date,
                    ],
                ];
        
        $this->db->table('permissions')->insertBatch($data);
	}
}
