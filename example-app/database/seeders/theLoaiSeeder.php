<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class theLoaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('theLoai')->insert([
            [
                'name' => 'Trinh thám',
            ],
        ]);
        DB::table('theLoai')->insert([
            [
                'name' => 'Lãng mạng',
            ],
        ]);
        DB::table('theLoai')->insert([
            [
                'name' => 'Kinh dị',
            ],
        ]);
        DB::table('theLoai')->insert([
            [
                'name' => 'Phiêu lưu',
            ],
        ]);
    }
}
