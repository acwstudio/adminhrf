<rss xmlns:yandex="http://news.yandex.ru" xmlns:media="http://search.yahoo.com/mrss/" xmlns:turbo="http://turbo.yandex.ru" version="2.0">
    <channel>
        <title>История РФ</title>
        <link>{{url($url.'?page='.$page)}}</link>
        <img src="https://histrf.ru/favicon.ico"></img>

        <turbo:analytics type="Yandex" id="20561137"></turbo:analytics>

        @foreach( $entities as $entity )
            <item turbo="true">
                <link>{{url($url.'/'.$entity->id)}}</link>
                {{--            <author>{{ $entity->authors->first()->lastname.$entity->authors->first()->name }}</author>--}}
                {{--            <category>{{ $entity->tags()->get()->first()->title }}</category>--}}
                <pubDate>{{ \Carbon\Carbon::parse( $entity->published_at )->format( 'D, d M Y H:i:s O' ) }}</pubDate>
                <yandex:genre>{{$type}}</yandex:genre>
                <guid>{{ url($url, $entity->slug) }}</guid>
                <description>{{ $entity->announce }}</description>
                <yandex:full-text>{{ strip_tags($entity->body) }}</yandex:full-text>
                <turbo:content>
                    <![CDATA[
                    <header>
                        <h1>{{ $entity->title }}</h1>
                        {{--                    <figure> --}}
                        {{--                        <img src="/{{$entity->images()->first()->preview}}"> --}}
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
                    {!! $entity->body !!}
                    ]]>
                </turbo:content>
            </item>
        @endforeach
    </channel>
</rss>
