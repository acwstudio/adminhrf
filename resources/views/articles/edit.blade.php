@extends('base')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Edit an Article</h1>
            <div>

                <form method="post" action="{{ route('articles.update',$article->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="title">title:</label>
                        <input type="text" class="form-control" name="title" value="{{$article->title}}"/>
                    </div>

                    <div class="form-group">
                        <label for="slug">slug:</label>
                        <input type="text" class="form-control" name="slug" value="{{$article->slug}}"/>
                    </div>

                    <div class="form-group">
                        <label for="url">url:</label>
                        <input type="text" class="form-control" name="url" value="{{$article->url}}"/>
                    </div>
                    <div class="form-group">
                        <label for="announce">announce:</label>
                        <input type="text" class="form-control" name="announce" value="{{$article->announce}}"/>
                    </div>
                    <div class="form-group">
                        <label for="body">body:</label>
                        <input type="text" class="form-control" name="body" value="{{$article->body}}"/>
                    </div>
                    <div class="form-group">
                        <label for="seo_title">seo_title:</label>
                        <input type="text" class="form-control" name="seo_title" value="{{$article->seo_title}}"/>
                    </div>
                    <div class="form-group">
                        <label for="seo_description">seo_description:</label>
                        <input type="text" class="form-control" name="seo_description" value="{{$article->seo_description}}"/>
                    </div>
                    <div class="form-group">
                        <label for="seo_keywords">seo_keywords:</label>
                        <input type="checkbox" class="form-control" name="seo_keywords" value="{{$article->keywords}}"/>
                    </div>
                    <div class="form-group">
                        <label for="show_in_rss">show_in_rss:</label>
                        <input type="checkbox" class="form-control" name="show_in_rss" value="{{$article->show_in_rss==true?1:0}}"/>
                        <input type="hidden" class="form-control" name="show_in_rss" value="{{$article->show_in_rss==true?0:1}}"/>
                    </div>
                    <div class="form-group">
                        <label for="yatextid">yatextid:</label>
                        <input type="number" class="form-control" name="yatextid" value="{{$article->yatextid}}"/>
                    </div>
                    <div class="form-group">
                        <label for="status">status:</label>
                        <input type="checkbox" class="form-control" name="status" value="{{$article->status}}"/>
                    </div>
                    <div class="form-group">
                        <label for="image_id">image_id:</label>
                        <input type="number" class="form-control" name="image_id" value="{{$article->image_id}}"/>
                    </div>
                    <div class="form-group">
                        <label for="show_in_main">Jshow_in_main:</label>
                        <input type="number" class="form-control" name="show_in_main" value="{{$article->show_in_main}}"/>
                    </div>
                    <div class="form-group">
                        <label for="close_commentations">close_commentations:</label>
                        <input type="number" class="form-control" name="close_commentations" value="{{$article->close_commentation}}"/>
                    </div>
                    <!-- <div class="form-group">
                         <label for="gallery_id">Job Title:</label>
                         <input type="text" class="form-control" name="gallery_id"/>
                     </div> -->
                    <button type="submit" class="btn btn-primary-outline">Update article</button>
                </form>
            </div>
        </div>
    </div>
@endsection
