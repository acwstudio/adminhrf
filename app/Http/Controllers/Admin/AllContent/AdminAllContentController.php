<?php

namespace App\Http\Controllers\Admin\AllContent;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminAllContentCollection;
use App\Http\Resources\Admin\AdminAllContentResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminAllContentController
 * @package App\Http\Controllers\Admin\AllContent
 */
class AdminAllContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $podcasts = DB::table('podcasts')
            ->select('id', 'title', 'created_at', DB::raw("'podcasts' as type"));
        $videomaterials = DB::table('videomaterials')
            ->select('id', 'title', 'created_at', DB::raw("'videomaterials' as type"));
        $audiomaterials = DB::table('audiomaterials')
            ->select('id', 'title', 'created_at', DB::raw("'audiomaterials' as type"));
        $articles = DB::table('articles')
            ->select('id', 'title', 'created_at', DB::raw("'articles' as type"));
        $news = DB::table('news')
            ->select('id', 'title', 'created_at', DB::raw("'news' as type"));
        $biography = DB::table('biographies')
            ->select('id', DB::raw('surname as title'), 'created_at', DB::raw("'biographies' as type"));
        $documents = DB::table('documents')
            ->select('id', 'title', 'created_at', DB::raw("'documents' as type"));

        $query = QueryBuilder::for(Article::class)
            ->select('id', 'title', 'created_at', DB::raw("'articles' as type"))
            ->union($biography)
            ->union($news)
            ->union($documents)
            ->union($podcasts)
            ->union($videomaterials)
            ->union($audiomaterials)
            ->allowedFilters(db::raw('type'))
            ->allowedSorts(['created_at', 'title'])
//            ->get();
            ->jsonPaginate();

        return AdminAllContentResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
