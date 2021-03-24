<?php

namespace App\Console\Commands;

use App\Models\Audiomaterial;
use App\Models\Old\Audio;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParseAudiomaterials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:audiomaterials {--T|truncate : Clear audiomaterials table before parse}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse of audiomaterials';

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
        $this->info('Start parsing audiomaterials...');

        if ($truncate) {
            $this->line('Clearing table');

            $this->withProgressBar(Audiomaterial::all(), function ($item) {
                $item->highlights()->detach();

            });

            Audiomaterial::truncate();

            DB::unprepared("SELECT SETVAL('audiomaterials_id_seq', (SELECT MAX(id) + 1 FROM audiomaterials))");
        }

        $this->newLine();
        $this->line('Parsing audiomaterials');

        $oldaudio = Audio::cursor();

        $bar = $this->output->createProgressBar($oldaudio->count());

        $bar->start();

        foreach ($oldaudio as $item) {

            $audiomaterial = Audiomaterial::create([
                'title' => $item->title,
                'description' => $item->description,
                'path' => Str::replaceFirst('/uploads/media', '', $item->path),
                'position' => $item->position,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
            if(!empty($links = unserialize($item->parameters))) {

                foreach ($links as $key => $link) {

                    $audioChild = Audiomaterial::create([
                        'parent_id' => $audiomaterial->id,
                        'title' => $link['key'],
                        'path' => Str::replaceFirst('/uploads/media', '', $link['value']),
                        'position' => $key,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $audioChild->highlights()->attach($item->category_id);

                }

            }

            $audiomaterial->highlights()->attach($item->category_id);

            $bar->advance();
        }

        $bar->finish();

        $this->newLine();
        $this->info('All audiomaterials processed!');

        return 1;
    }
}
