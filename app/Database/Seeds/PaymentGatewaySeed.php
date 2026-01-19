<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentGatewaySeed extends Seeder
{
	public function run()
	{
        $data = [
                    [
                        'name'                  => 'Paypal',
                        'is_enabled'            => 'no',
                        'is_default'            => 'no',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Stripe',
                        'is_enabled'            => 'no',
                        'is_default'            => 'no',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Flutterwave',
                        'is_enabled'            => 'no',
                        'is_default'            => 'no',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Paystack',
                        'is_enabled'            => 'no',
                        'is_default'            => 'no',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Cash',
                        'is_enabled'            => 'yes',
                        'is_default'            => 'yes',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                ];

        $this->db->table('payment_gateways')->insertBatch($data);
	}
}
