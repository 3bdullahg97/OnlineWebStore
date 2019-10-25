<?php

use App\SpecificationGroup;
use Illuminate\Database\Seeder;

class SpecificationGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SpecificationGroup::class, 25)->create();
    }
}
