<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('ALTER TABLE products DISABLE KEYS');

        for ($i = 0; $i < 1000; $i++) {
            DB::table('products')->insert($this->data($i));
        }

        DB::statement('ALTER TABLE products ENABLE KEYS');
    }

    protected function data(int $i): array
    {
        $data = [];

        for ($j = 0; $j < 1000; $j++) {
            $data[] = [
                'name' => 'Product ' . ($i * 1000 + $j + 1),
            ];
        }

        return $data;
    }
}
