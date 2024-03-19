<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Eula;

class EulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Eula::create([
            'content' => 'This is your EULA text. Modify it as needed.',
            'version' => 'v1'
        ]);
    }
}
