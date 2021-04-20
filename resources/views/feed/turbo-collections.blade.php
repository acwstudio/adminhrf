<rss xmlns:yandex="http://news.yandex.ru" xmlns:media="http://search.yahoo.com/mrss/" xmlns:turbo="http://turbo.yandex.ru" version="2.0">
    <channel>
        <title>История РФ</title>
        <link>{{url($url.'?page'.$page)}}</link>
        <img src="https://histrf.ru/favicon.ico"></img>

        <turbo:analytics type="Yandex" id="20561137"></turbo:analytics>

        @foreach( $highlights as $highlight )
            <item turbo="true">
                <link>{{ url('collections', $highlight->slug) }}</link>
                {{--            <author>{{ $highlight->authors->first()->lastname.$highlight->authors->first()->name }}</author>--}}
                {{--            <category>{{ $highlight->tags()->get()->first()->title }}</category>--}}
                <pubDate>{{ \Carbon\Carbon::parse( $highlight->published_at )->format( 'D, d M Y H:i:s O' ) }}</pubDate>
                <yandex:genre>{{$type}}</yandex:genre>
                <guid>{{ url($url, $highlight->slug) }}</guid>
                <description>{{ $highlight->announce }}</description>
                <yandex:full-text>{{ strip_tags($highlight->body) }}</yandex:full-text>
                <turbo:content>
                    <![CDATA[
                    <header>
                        <h1>{{ $highlight->title }}</h1>
                        {{--                    <figure> --}}
                        {{--                        <img src="/{{$highlight->images()->first()->preview}}"> --}}
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
                    {!! $highlight->body !!}
                    ]]>
                </turbo:content>
            </item>
        @endforeach
    </channel>
</rss>
