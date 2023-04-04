<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Benchmark;
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
        $elapsed = Benchmark::measure(function() {
            Schema::table('products', function ($table) {
                $table->foreignId($this->getColumnName())
                    ->nullable()
                    ->constrained('products')
                    ->nullOnDelete();
            });
        });

        $this->info(sprintf('Elapsed: %dms', $elapsed));
    }

    protected function getColumnName(): string
    {
        $count = count(Schema::getColumnListing('products'));

        return "product_{$count}_id";
    }
}
