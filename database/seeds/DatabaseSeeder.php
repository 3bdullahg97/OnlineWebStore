<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(SpecificationGroupSeeder::class);
        $this->call(SpecificationSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(ItemImageSeeder::class);
        $this->call(ItemSpecificationSeeder::class);
    }
}
