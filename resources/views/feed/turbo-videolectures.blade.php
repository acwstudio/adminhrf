<rss xmlns:yandex="http://news.yandex.ru" xmlns:media="http://search.yahoo.com/mrss/" xmlns:turbo="http://turbo.yandex.ru" version="2.0">
    <channel>
        <title>История РФ</title>
        <link>{{url($url.'?page'.$page)}}</link>
        <img src="https://histrf.ru/favicon.ico"></img>

        <turbo:analytics type="Yandex" id="20561137"></turbo:analytics>

        @foreach( $videolectures as $videolecture )
            <item turbo="true">
                <link>{{url($url.'/'.$videolecture->slug)}}</link>
                {{--            <author>{{ $videolecture->authors->first()->lastname.$videolecture->authors->first()->name }}</author>--}}
                {{--            <category>{{ $videolecture->tags()->get()->first()->title }}</category>--}}
                <pubDate>{{ \Carbon\Carbon::parse( $videolecture->published_at )->format( 'D, d M Y H:i:s O' ) }}</pubDate>
                <yandex:genre>{{$type}}</yandex:genre>
                <guid>{{ url($url, $videolecture->slug) }}</guid>
                <description>{{ $videolecture->announce }}</description>
                <yandex:full-text>{{ strip_tags($videolecture->body) }}</yandex:full-text>
                <turbo:content>
                    <![CDATA[
                    <header>
                        <h1>{{ $videolecture->title }}</h1>
                        {{--                    <figure> --}}
                        {{--                        <img src="/{{$videolecture->images()->first()->preview}}"> --}}
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
                    {!! $videolecture->body !!}
                    <iframe
                        width="100%"
                        height="560"
                        src='{{$videolecture->video_code}}'
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    ></iframe>
                    ]]>
                </turbo:content>
            </item>
        @endforeach
    </channel>
</rss>
