<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rowsAuthors = DB::table('authors')->count();
        $limit = 20 - $rowsAuthors;

        if ($limit > 0) {
            Author::factory()->count($limit)->create();
            $this->command->newLine();
            $this->command->info('It has created ' . $limit . ' lines', 'info');
            $this->command->newLine();
        } else {
            $this->command->warn('You have already 20 lines, table will be re-created', 'warn');

            if ($this->command->confirm('Do you wish to continue?')) {
                DB::table('authors')->truncate();
                Author::factory()->count($limit)->create();
                $this->command->info('Your table was re-created');
                $this->command->newLine();
            }
        }
    }
}
