<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         $this->call(StatesSeeder::class);
         $this->call(RegionsTableSeeder::class);
         $this->call(TimezonesTableSeeder::class);
         $this->call(UpdateStatesTimezoneRegionSeeder::class);
         $this->call(AdjacentStatesTableSeeder::class);
         $this->call(StatesSeeder::class);
         $this->call(MercuryApprTypesSeeder::class);
         $this->call(MercuryColumnMapSeeder::class);
         $this->call(MercuryLoanReasonSeeder::class);
         $this->call(MercuryLoanTypesSeeder::class);
         $this->call(MercuryStatusesSeeder::class);
    }
}
