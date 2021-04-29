<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\Sanctum;

class ClearOldTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:tokens { days=60 : token last used N days ago}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear old tokens from DB';

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
    public function handle()
    {
        $days = (int) $this->argument('days');
        if (!is_int($days) && $days < 1 && $days > 120 ) {
            $this->newLine();
            $this->error('Wrong argument passed, days must be integer between 1 and 120' );
            return 0;
        }

        Sanctum::$personalAccessTokenModel::where('last_used_at', '<', Carbon::now()->subDays($days))->delete();

        $this->newLine();
        $this->info('Old tokens cleared');

        return 1;
    }
}
