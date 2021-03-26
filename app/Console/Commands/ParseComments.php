<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Old\CommentThreads;
use Illuminate\Console\Command;
use App\Models\Old\Comments as OldComment;
use App\Models\Old\Article as OldArticle;
use Illuminate\Support\Facades\DB;

class ParseComments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:comments'; // {--T|truncate : Clear comment table before parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse comments';

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
/*        $truncate = $this->option('truncate');
        $this->info('Start parsing articles...');

        if ($truncate) {
            $this->line('Clearing table');

            Comment::truncate();
        }
*/
        $this->newLine();
        $this->line('Parsing articles');

        $articles = Article::cursor();

        $bar = $this->output->createProgressBar($articles->count());

        foreach ($articles as $article){
            $oldArticle = OldArticle::find($article->id);
            $oldComments = OldComment::where('thread_id','=',$oldArticle->thread_id)->where('state','=',0);//OldArticle::find($article->id)->thread_id;
            $oldThread = CommentThreads::where('id','=',$oldArticle->thread_id)->first();
            foreach ($oldComments as $oldComment){
                $comment = Comment::create(
                    [
                        'id' => $oldComment->id,
                        'commentable_type' => 'article',
                        'commentable_id' => $oldArticle->id,
                        'text' => $oldComment->body,
                        'liked' => $oldArticle->score,
                        'children_count' => 0,
                        'user_id' => $oldComment->author_id,
                        'created_at' => $oldComment->created_at,
                        'updated_at' => $oldComment->created_at
                    ]
                );

            }
            $article->commented = $oldThread->num_comments;
            $article->save;

            $bar->advance();
        }

        DB::unprepared("SELECT SETVAL('comments_id_seq', (SELECT MAX(id) + 1 FROM comments))");
        $bar->finish();
        $this->newLine();
        $this->info('All articles processed!');

        return 1;
    }
}
