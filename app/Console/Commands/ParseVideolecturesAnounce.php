<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Videomaterial;
use App\Services\ImageService;
use Illuminate\Console\Command;
use App\Models\Old\Article as OldArticle;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ParseVideolecturesAnounce extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:videolectures-announce';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse videolectures announce';


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

        $this->info('Start parsing videolectures announce...');

        $this->newLine();

        $lectures = Videomaterial::where('type', 'lecture')->get();

        $bar = $this->output->createProgressBar($lectures->count());

        $bar->start();

        foreach ($lectures as $lecture) {

            $body = $lecture->body;
            $body = strip_tags($body);
            $body = Str::of($body)->before('Вопросы по теме лекции');
            $body = Str::of($body)->after('Аннотация');
            if (!empty($body)) {
                $lecture->announce = '<p>'.$body.'</p>';
                $lecture->save();
            }


            $bar->advance();
        }

        $bar->finish();

        $this->newLine();
        $this->info('All videolectures processed!');

        return 1;
    }
}
