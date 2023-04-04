<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('ALTER TABLE products DISABLE KEYS');

        for ($i = 0; $i < 1000; $i++) {
            DB::table('files')->insert($this->data($i));
        }

        DB::statement('ALTER TABLE products ENABLE KEYS');
    }

    protected function data(int $i): array
    {
        $data = [];

        for ($j = 0; $j < 1000; $j++) {
            $id = $i * 1000 + $j + 1;
            $data[] = [
                'id' => $id,
                'related_model' => 'App\Models\Product',
                'related_model_id' => $id,
                'file_path' => fake()->filePath(),
                'file_name' => fake()->filePath(),
                'mime_type' => fake()->mimeType(),
                'size' => fake()->numberBetween(1000, 1000000),
                'disk' => 'local',
                'collection' => 'default',
                'uploaded_by' => 1,

            ];
        }

        return $data;
    }
}
