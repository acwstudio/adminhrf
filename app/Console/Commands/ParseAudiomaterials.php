<?php

namespace App\Console\Commands;

use App\Models\Audiofile;
use App\Models\Audiomaterial;
use App\Models\Old\Audio;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ParseAudiomaterials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:audiomaterials';

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

        $this->info('Start parsing audiomaterials...');


        $this->newLine();
        $this->line('Parsing audiomaterials');

        $audio = Audiomaterial::cursor();

        $bar = $this->output->createProgressBar($audio->count());

        $bar->start();

        foreach ($audio as $item) {

            $audiofile = Audiofile::create([
                'path' => $item->path,
                'audiomaterial_id' => $item->id,
                'size' => Storage::size($item->path),

            ]);

            $bar->advance();
        }

        $bar->finish();

        DB::unprepared("SELECT SETVAL('audiofiles_id_seq', (SELECT MAX(id) + 1 FROM audiofiles))");

        $this->newLine();
        $this->info('All audiomaterials processed!');

        return 1;
    }
}
