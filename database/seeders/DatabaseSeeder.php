<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('categories')->insert([
                'name' => 'Danh mục ' . $i,
                'slug' => 'danh-muc-' . $i,
                'description' => 'Đây là nội dung ' . $i,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            DB::table('countries')->insert([
                'name' => 'Quốc gia ' . $i,
                'slug' => 'quoc-gia-' . $i,
                'description' => 'Đây là nội dung ' . $i,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            DB::table('genres')->insert([
                'name' => 'Thể loại ' . $i,
                'slug' => 'the-loai-' . $i,
                'description' => 'Đây là nội dung ' . $i,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
