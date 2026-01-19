<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PagesSeed extends Seeder
{
	public function run()
	{
        $data = [
                    [
                        'name'                  => 'Privacy Policy',
                        'slug'                  => 'privacy-policy',
                        'content'               => '<p>This is Privacy Policy Page</p>',
                        'bottom_menu'           => 'yes',
                        'status'                => 'active',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'About Us',
                        'slug'                  => 'about-us',
                        'content'               => '<p>This is About Us Page</p>',
                        'bottom_menu'           => 'yes',
                        'status'                => 'active',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                    [
                        'name'                  => 'Terms & Conditions',
                        'slug'                  => 'terms-conditions',
                        'content'               => '<p>This is the Terms and Conditions Page</p>',
                        'bottom_menu'           => 'yes',
                        'status'                => 'active',
                        'created_at'            => date("Y-m-d H:i:s"),
                    ],
                ];
        $this->db->table('pages')->insertBatch($data);
	}
}
