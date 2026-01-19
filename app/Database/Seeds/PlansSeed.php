<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PlansSeed extends Seeder
{
	public function run()
	{
        $data = [
                    [
                        'name'                  => 'Basic',
                        'tagline'               => 'for individuals',
                        'orders_per_month'      => 5,
                        'monthly_price'         => 3.00,
                        'quarterly_price'       => 8.00,
                        'semi_annually_price'   => 15.50,
                        'yearly_price'          => 30.00,
                        'features'              => '5 orders per subscription month;;10 clothes per order;;wash & ironing only;;5 days turnover',
                        'status'                => 'active',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Standard',
                        'tagline'               => 'for families and small businesses',
                        'orders_per_month'      => 10,
                        'monthly_price'         => 5.00,
                        'quarterly_price'       => 15.00,
                        'semi_annually_price'   => 28.00,
                        'yearly_price'          => 55.00,
                        'features'              => '10 orders per subscription month;;30 clothes per order;;wash & ironing only;;3 days turnover',
                        'status'                => 'active',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Premium',
                        'tagline'               => 'for large businesses',
                        'orders_per_month'      => 0,
                        'monthly_price'         => 100.00,
                        'quarterly_price'       => 295.00,
                        'semi_annually_price'   => 575.00,
                        'yearly_price'          => 1100.00,
                        'features'              => 'Unlimited orders per subscription month;;100 clothes per order;;dry cleaning;;24 hours turnover',
                        'status'                => 'active',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                ];

        $this->db->table('plans')->insertBatch($data);
	}
}
