<rss
     xmlns:content="http://purl.org/rss/1.0/modules/content/"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:media="http://search.yahoo.com/mrss/"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:georss="http://www.georss.org/georss" version="2.0">
    <channel>
        <title>История РФ</title>
        <link>{{url("read/articles?page=".$page)}}</link>
        <img src="https://histrf.ru/favicon.ico"></img>
        @foreach( $articles as $article )
            <item>
                <link>{{ url('read/articles', $article->slug) }}</link>
		<title>{{ $article->title }}</title>
                <pdalink>{{ url('read/articles', $article->slug) }}</pdalink>
                <amplink>{{ url('read/articles', $article->slug) }}</amplink>
                {{--            <author>{{ $article->authors->first()->lastname.$article->authors->first()->name }}</author>--}}
                {{--            <category>{{ $article->tags()->get()->first()->title }}</category>--}}
                <pubDate>{{ \Carbon\Carbon::parse( $article->published_at )->format( 'D, d M Y H:i:s O' ) }}</pubDate>
                <guid>{{ url($url, $article->slug) }}</guid>
                <description>{{ $article->announce }}</description>
                <language>ru</language>
                <content:encoded>
                    <![CDATA[
                    <header>
                        <h1>{{ $article->title }}</h1>
                        {{--                    <figure> --}}
                        {{--                        <img src="/{{$article->images()->first()->preview}}"> --}}
                        {{--                    </figure> --}}
                        <menu>
                            {{--                        @foreach( $categories as $category )  --}}
                            {{--                        <a href="{{ url('category', $category->slug) }}">{{ $category->name }}</a>  --}}
                            {{--                        @endforeach --}}
                            <a href="https://histrf.ru/read">Читать</a>
                            <a href="https://histrf.ru/watch">Смотреть</a>
                            <a href="https://histrf.ru/listen">Слушать</a>
                            <a href="https://histrf.ru/collections">Подборки</a>
                            <a href="https://histrf.ru/timeline">Лента времени</a>
                            <a href="https://histrf.ru/tests">Тесты</a>
                            <a href="https://histrf.ru/poster">Афиша</a>

                        </menu>
                    </header>
                    {!! $article->body !!}
                    ]]>
                </content:encoded>
            </item>
        @endforeach
    </channel>
</rss>
