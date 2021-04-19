<rss xmlns:yandex="http://news.yandex.ru" xmlns:media="http://search.yahoo.com/mrss/" xmlns:turbo="http://turbo.yandex.ru" version="2.0">
    <channel>
        <title>История РФ</title>
        <link>{{ url('read/articles', $article->slug) }}</link>
        <img src="https://histrf.ru/favicon.ico"></img>

        <turbo:analytics type="Yandex" id="20561137"></turbo:analytics>

        @foreach( $articles as $article )
        <item turbo="true">
            <link>{{ url('read/articles', $article->slug) }}</link>
{{--            <author>{{ $article->authors->first()->lastname.$article->authors->first()->name }}</author>--}}
{{--            <category>{{ $article->tags()->get()->first()->title }}</category>--}}
            <pubDate>{{ \Carbon\Carbon::parse( $article->published_at )->format( 'D, d M Y H:i:s O' ) }}</pubDate>
            <yandex:genre>article</yandex:genre>
            <guid>{{ url('read/articles', $article->slug) }}</guid>
            <description>{{ $article->announce }}</description>
            <yandex:full-text>{{ strip_tags($article->body) }}</yandex:full-text>
            <turbo:content>
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
			<a href="https://histrf.ru/tests">Тесты</a>
			<a href="https://histrf.ru/collections">Подборки</a>
                    </menu>
                </header>
                {!! $article->body !!}
                ]]>
            </turbo:content>
        </item>
        @endforeach
    </channel>
</rss>
