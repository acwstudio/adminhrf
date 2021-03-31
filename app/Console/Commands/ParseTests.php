<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Old\Test as OldTest;
use App\Models\Old\Answer as OldAnswer;
use App\Models\Old\Question as OldQuestion;
use App\Models\Question;
use App\Models\TAnswer;
use App\Models\Test;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class ParseTests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:tests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $this->info('Start parsing tests...');



        $this->newLine();
        $this->line('Parsing events');

        $tests = OldTest::where('is_active',true)->cursor();

        $bar = $this->output->createProgressBar($tests->count());

        $bar->start();

        foreach ($tests as $test) {

            if($test->questions()->count()>1){
                $newTest = Test::create([
                    'id' => $test->id,
                    'title' => $test->title,
                    'description' => $test->description,
                    'is_active' => $test->is_active,
                    'time' => $test->time,
                    'created_at'=> $test->created_at,
                    'updated_at'=> $test->updated_at,
                    'published_at' => $test->updated_at,
                    'total_questions' => $test->questions,
                    'max_points' => 0,
                    'is_reversable' => false,
                    'has_points' => false,
                    'is_ege' =>str_contains('ЕГЭ',$test->title),
                    'slug' => Str::slug($test->title)
                ]);
                $questions = $test->questions;
                foreach($questions as $question){
                    $newQuestion = $newTest->question([
                        'id' => $question->id,
                        'text' => $question->text,
                        'type' => $question->type,
                        'position'=>$question->position,
                        'points' => 0,
                        'has_points' => false,
                        'created_at'=> $test->created_at,
                        'updated_at'=> $test->updated_at,
                    ]);
                    $answers = $question->answers;
                    foreach ($answers as $answer)
                    {
                        $newAnswer = $newQuestion->answer(
                            [
                                'id' => $answer->id,
                                'title'=> $answer->title,
                                'is_right' => $answer->is_right,
                                'description' => $answer->descrription,
                                'points' => 0
                            ]
                        );
                    }
                }
            }

        }

        return 0;
    }
}
