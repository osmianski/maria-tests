<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddColumn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'column:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $column = $this->getColumnName();

        $this->info(sprintf('ALTER TABLE: %dms', Benchmark::measure(function() use ($column) {
            Schema::table('products', function ($table) use ($column) {
                $table->foreignId($column)
                    ->nullable()
                    ->constrained('products')
                    ->nullOnDelete();
            });
        })));

        $this->info(sprintf('UPDATE: %dms', Benchmark::measure(function() use ($column) {
            DB::table('products')->update([
                $column => DB::raw("CEIL(RAND() * 1000000)"),
            ]);
        })));
    }

    protected function getColumnName(): string
    {
        $count = count(Schema::getColumnListing('products'));

        return "product_{$count}_id";
    }
}
