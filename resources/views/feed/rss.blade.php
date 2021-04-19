<rss xmlns:yandex="http://news.yandex.ru" xmlns:media="http://search.yahoo.com/mrss/" xmlns:turbo="http://turbo.yandex.ru" version="2.0">
    <channel>
        <title>История РФ</title>
        <link></link>
        <img src="https://histrf.ru/favicon.ico">

        <turbo:analytics type="Yandex" id="77777777"></turbo:analytics>

        @foreach( $articles as $article )
        <item turbo="true">
            <link>{{ url('read/articles', $article->slug) }}</link>
{{--            <author>{{ $article->authors->first()->lastname.$article->authors->first()->name }}</author>--}}
{{--            <category>{{ $article->tags()->get()->first()->title }}</category>--}}
            <pubDate>{{ \Carbon\Carbon::parse( $article->published_at )->format( 'D, d M Y H:i:s O' ) }}</pubDate>
            <yandex:genre>article</yandex:genre>
            <guid>{{ url('read/articles', $article->slug) }}</guid>
            <description>{{ $article->announce }}</description>
            <yandex:full-text>{{ $article->body }}</yandex:full-text>
            <turbo:content>
                <![CDATA[
                <header>
                    <h1>{{ $article->heading }}</h1>
                    <figure>
                        <img src="{{$article->image->preview}}">
                    </figure>
                    <menu>
{{--                        @foreach( $categories as $category )--}}
{{--                        <a href="{{ url('category', $category->slug) }}">{{ $category->name }}</a>--}}
{{--                        @endforeach--}}
                    </menu>
                </header>
                {!! $article->body !!}
                ]]>
            </turbo:content>
        </item>
        @endforeach
    </channel>
</rss>
