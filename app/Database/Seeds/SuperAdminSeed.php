<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SuperAdminSeed extends Seeder
{
	public function run()
	{
        $data = [
                    'firstname'         => 'Super Admin FirstName',
                    'lastname'          => 'Super Admin LastName',
                    'username'          => 'SuperAdmin',
                    'email'             => 'superadmin@admin.com',
                    'phone'             => rand(12345678910, 99999999999),
                    'password'          => password_hash("123456789", PASSWORD_DEFAULT),
                    'status'            => "active",
                    'email_verified'    => "yes",
                    'is_staff'          => "yes",
                    'is_superadmin'     => "yes",
                    'created_at'        => date("Y-m-d H:i:s"),
                ];

        $this->db->table('users')->insert($data);
	}
}
