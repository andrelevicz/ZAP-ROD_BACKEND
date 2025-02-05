<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModulesSeeder extends Seeder
{
    public function run()
    {
        DB::table('modules')->insert([
            [
                'name' => 'AI Sales Agent',
                'description' => 'An AI-powered agent that manages sales processes through multiple online channels.',
                'price' => 499.99,
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '24/7 AI Support',
                'description' => 'A specialized AI agent providing automated support for business rules and product inquiries 24/7.',
                'price' => 299.99,
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Scheduling & Appointments Control',
                'description' => 'A scheduling system for managing client appointments seamlessly.',
                'price' => 199.99,
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

