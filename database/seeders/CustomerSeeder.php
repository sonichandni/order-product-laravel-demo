<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            [
                'name' => 'Chandni Soni',
                'email' => 'sonichandni279@gmail.com',
            ],
            [
                'name' => 'Mahi Sharma',
                'email' => 'mahis9@gmail.com',
            ],
            [
                'name' => 'John Doe',
                'email' => 'jhoned@gmail.com',
            ],
            [
                'name' => 'Kahan Yadav',
                'email' => 'ky@gmail.com',
            ]
        ];
        
        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
