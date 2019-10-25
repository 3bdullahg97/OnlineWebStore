<?php

use App\ItemSpecification;
use Illuminate\Database\Seeder;

class ItemSpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ItemSpecification::class, 1000)->create();
    }
}
