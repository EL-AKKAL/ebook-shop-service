<?php

namespace App\Console\Commands;

use App\Models\Book;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateBooks extends Command
{
    protected $signature = 'app:generate-books {count?}';

    protected $description = 'generate a given number of books';


    public function handle()
    {
        try {
            $count = $this->argument('count') ?? $this->ask('How many books to create ? (default is 10)', '10');

            $this->info("Inserting {$count} books ...");

            DB::beginTransaction();

            $this->withProgressBar(
                range(1, (int) $count),
                fn($_) =>
                Book::factory()->create()
            );

            DB::commit();

            $this->info('Inserting books completed successfully.');

            return self::SUCCESS;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Error Inserting books: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}
