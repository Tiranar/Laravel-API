<?php

use Illuminate\Database\Seeder;
use App\Models\Items;
use App\Models\Files;
use App\Models\ItemFiles;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Items::class, 100)->create()->each(function ($item) {
            factory(Files::class, 1)->create()->each(function ($file) use ($item) {
                $item->file_id = $file->id;
                $item->save();
            });
        });
    }
}
