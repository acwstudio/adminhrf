<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Old\Person;
use Illuminate\Console\Command;

class ParseAuthors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:authors {type=articles : Type of related material: articles|videos} {--T|truncate : Clear articles table before parse}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse authors of related material from old DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $truncate = $this->option('truncate');
        $type = $this->argument('type');
        if (!in_array($type, ['articles', 'videos'])) {
            $this->error('Wrong type provided - available types: articles|videos');
            return 0;
        }

        $this->info('Start parsing authors...');

        if ($truncate) {
            $this->line('Clearing authors table');
            Author::truncate();
        }

        $this->line('Parsing ' . $type . ' authors');

        $persons = Person::with($type)->cursor();

        $bar = $this->output->createProgressBar($persons->count());

        $bar->start();

        foreach ($persons as $person) {

            if (!$truncate) {
                $author = Author::find($person->id);
            }

            if ($truncate || is_null($author)) {

                $author = Author::create($person->setAppends([
                    'created_at' => $person->date,
                    'updated_at' => $person->date,
                ])->toArray());

            }

            $bar->advance();
        }

        $bar->finish();

        $this->newLine();
        $this->info('All authors processed!');

        return 1;
    }
}
