<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rowsImages = DB::table('images')->count();
        $limit = 30 - $rowsImages;

        if ($limit > 0) {
            Image::factory()->count($limit)->create();
            $this->command->newLine();
            $this->command->info('It has created ' . $limit . ' lines', 'info');
            $this->command->newLine();
        } else {
            $this->command->warn('You have already 20 lines, table will be re-created', 'warn');

            if ($this->command->confirm('Do you wish to continue?')) {
                DB::table('images')->truncate();
                Image::factory()->count($limit)->create();
                $this->command->info('Your table was re-created');
                $this->command->newLine();
            }
        }
    }

    private function articleRelation()
    {
        $articles = Article::all();
    }
}
