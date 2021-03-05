<?php

namespace App\Console\Commands;

use App\Models\Old\User as OldUser;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ParseUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:users {--T|truncate : Clear users table before parse}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse users from old DB';

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
        $this->info('Start parsing users...');

        if ($truncate) {
            $this->line('Clearing users table');
            User::truncate();
        }

        $this->line('Parsing users');

        $oldUsers = OldUser::where('enabled', true)->cursor();

        $bar = $this->output->createProgressBar($oldUsers->count());

        $bar->start();

        foreach ($oldUsers as $oldUser) {

            if (!$truncate) {
                $user = User::where('email', $oldUser->email)->first();
            }

            if ($truncate || is_null($user)) {
                User::create(
                    [
                        'email' => $oldUser->email,
                        'id' => $oldUser->id,
                        'name' => preg_replace('/^ +| +$|( ) +/m', '$1',
                            implode(' ', [
                                $oldUser->firstname,
                                $oldUser->patronymic,
                                $oldUser->lastname])),
                        'created_at' => $oldUser->created_at,
                        'legacy' => true
                    ]
                );
            }

            $bar->advance();
        }

        $bar->finish();

        DB::unprepared("SELECT SETVAL('users_id_seq', (SELECT MAX(id) + 1 FROM users))");

        $this->newLine();
        $this->info('All users processed!');

        return 1;

    }
}
