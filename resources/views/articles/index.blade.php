@extends('base')

@section('main')
    <div class="col-sm-12">

        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>
    <div>
        <a style="margin: 19px;" href="{{ route('articles.create')}}" class="btn btn-primary">New article</a>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">articles</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Title</td>
                    <td>Url</td>
                    <td>Slug</td>
                    <td>Listorder</td>
                    <td>Body</td>
                    <td>Seo_title</td>
                    <td>Seo_description</td>
                    <td>Seo_keywords</td>
                    <td>Show_in_rss</td>
                    <td>Yatextid</td>
                    <td>Status</td>
                    <td>Image_ID</td>
                    <td>Show in main</td>
                    <td>Close commentation</td>
                    <td>Galery ID</td>


                    <td colspan = 2>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{$article->id}}</td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->url}}</td>
                        <td>{{$article->slug}}</td>
                        <td>{{$article->listorder}}</td>
                        <td>{{$article->body}}</td>
                        <td>{{$article->seo_title}}</td>
                        <td>{{$article->seo_description}}</td>
                        <td>{{$article->seo_keywords}}</td>
                        <td>{{$article->show_in_rss==true?1:0}}</td>
                        <td>{{$article->yatextid}}</td>
                        <td>{{$article->status==true?1:0}}</td>
                        <td>{{$article->image_id}}</td>
                        <td>{{$article->show_in_main==true?1:0}}</td>
                        <td>{{$article->close_commentation==true?0:1}}</td>
                        <td>{{$article->gallery_id}}</td>

                        <td>
                            <a href="{{ route('articles.edit',$article->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('articles.destroy', $article->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
            </div>
@endsection
