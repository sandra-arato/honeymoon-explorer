<?php

use App\Entry;
use Illuminate\Database\Seeder;

class EntriesTableSeeder extends Seeder
{
  public function run()
  {
    factory(App\Entry::class, 20)->create();
  }
}
