<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'user_id' => '1',
                'name' => 'Laravel',
                'slug' => 'laravel',
                'is_published' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => '1',
                'name' => 'Javascript',
                'slug' => 'javascript',
                'is_published' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => '1',
                'name' => 'Codeigniter',
                'slug' => 'codeigniter',
                'is_published' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => '1',
                'name' => 'Django',
                'slug' => 'django',
                'is_published' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => '1',
                'name' => 'Tailwind',
                'slug' => 'tailwind',
                'is_published' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
