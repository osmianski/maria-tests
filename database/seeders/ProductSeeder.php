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
                'uuid' => fake()->uuid,
                'collection' => fake()->randomElement(['avatar', 'project_image', 'cv']),

                'author_id' => fake()->numberBetween(1, 10000),
                'copyright_notice' => fake()->name(),
                'copyright_approved_at' => fake()->optional(0.9)->dateTime,

                'title' => fake()->optional()->sentence,
                'name' => basename($path = fake()->filePath()),
                'position' => fake()->numberBetween(1, 100),

                'disk' => fake()->randomElement(['s3', 'local', 'sftp']),
                'path' => $path,
                'mime_type' => fake()->mimeType(),
                'size' => fake()->numberBetween(1000, 1000000),
                'meta_data' => json_encode([
                    'width' => fake()->numberBetween(320, 4096),
                    'height' => fake()->numberBetween(320, 4096),
                ]),

                'created_at' => fake()->dateTime,
                'updated_at' => fake()->dateTime,
            ];
        }

        return $data;
    }
}
