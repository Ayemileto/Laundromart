<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeed extends Seeder
{
    public function run()
    {
        $this->randomUserData(10);
    }

    public function randomUserData($quantity)
    {
        $names = [
            'John', 'Mia', 'Stone', 'Joe', 'Amelia', 'Elliot', 'Graham', 'Noah',
            'Sophia', 'Brady', 'Johnson', 'Justina', 'Liam', 'Oliver', 'Olivia',
            'Blake', 'William', 'Christopher', 'Hudson', 'Maverick', 'Jonathan',
            'Carlos', 'Victor', 'Victoria', 'Emmanuel', 'Emmanuella', 'Cameron',
            'Santiago', 'Hannah', 'Grace', 'Roman', 'Angel', 'Angelina', 'Mary',
            'Jordan', 'Jose', 'Evan', 'Harrison', 'Maxwell', 'Nicholas', 'Owen',
            'Nolan', 'Aurora', 'Isabella', 'Luis', 'Samantha', 'Lucy', 'Elijah',
            'Jayden', 'Harry', 'James', 'Lucas', 'Ismail', 'Emilia', 'Theodore', 
            'Leah', 'Grayson', 'Maria', 'Mateo', 'Julian', 'Carter', 'Theodore',
            'Lucas', 'Margaret', 'Lucia', 'Rachel', 'Kimberly', 'Tommy', 'Rose',
        ];

        $data = [];

        $i = 0;
        while($i < $quantity)
        {
            $firstname = $names[array_rand($names)];
            $lastname = $names[array_rand($names)];
            $username = $firstname.rand(0, 1000).rand(0, 1000);
            $email = $username.'@test.com';

            $data[] = [
                    'firstname'         => $firstname,
                    'lastname'          => $lastname,
                    'username'          => $username,
                    'email'             => $email,
                    'phone'             => rand(12345678910, 99999999999),
                    'password'          => password_hash("123456789", PASSWORD_DEFAULT),
                    'status'            => "active",
                    'email_verified'    => "yes",
                    'created_at'        => date("Y-m-d H:i:s"),
            ];    
            $i++;
        }

        $this->db->table('users')->insertBatch($data);
    }
}
