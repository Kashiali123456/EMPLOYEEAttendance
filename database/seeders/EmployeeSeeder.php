<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
class EmployeeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         Employee::factory(20)->create();
    }
}