<rss xmlns:yandex="http://news.yandex.ru" xmlns:media="http://search.yahoo.com/mrss/" xmlns:turbo="http://turbo.yandex.ru" version="2.0">
    <channel>
        <title>История РФ</title>
        <link>{{url($url.'?page'.$page)}}</link>
        <img src="https://histrf.ru/favicon.ico"></img>

        <turbo:analytics type="Yandex" id="20561137"></turbo:analytics>

        @foreach( $films as $film )
            <item turbo="true">
                <link>{{url($url.'/'.$film->slug)}}</link>
                {{--            <author>{{ $film->authors->first()->lastname.$film->authors->first()->name }}</author>--}}
                {{--            <category>{{ $film->tags()->get()->first()->title }}</category>--}}
                <pubDate>{{ \Carbon\Carbon::parse( $film->published_at )->format( 'D, d M Y H:i:s O' ) }}</pubDate>
                <yandex:genre>{{$type}}</yandex:genre>
                <guid>{{ url($url, $film->slug) }}</guid>
                <description>{{ $film->announce }}</description>
                <yandex:full-text>{{ strip_tags($film->body) }}</yandex:full-text>
                <turbo:content>
                    <![CDATA[
                    <header>
                        <h1>{{ $film->title }}</h1>
                        {{--                    <figure> --}}
                        {{--                        <img src="/{{$film->images()->first()->preview}}"> --}}
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
                    {!! $film->body !!}
                    <iframe
                        width="100%"
                        height="560"
                        src='{{$film->video_code}}'
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                    ></iframe>
                    ]]>
                </turbo:content>
            </item>
        @endforeach
    </channel>
</rss>
