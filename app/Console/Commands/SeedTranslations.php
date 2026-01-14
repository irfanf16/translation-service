<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Translation;

class SeedTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:seed {count=100000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Translation::factory()
            ->count($this->argument('count'))
            ->create();
    }
}
