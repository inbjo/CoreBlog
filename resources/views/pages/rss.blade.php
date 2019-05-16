<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ env('APP_NAME') }}</title>
        <description>{{ env('APP_NAME') }}</description>
        <link>{{ url('/') }}</link>
        <atom:link href="{{ url('/feed.xml') }}" rel="self" type="application/rss+xml"/>
        <?php
        $date = !empty($posts) ? $posts[0]->updated_at->format('D, d M Y H:i:s O') : date("D, d M Y H:i:s O", time())
        ?>
        <pubDate>{{ $date }}</pubDate>
        <lastBuildDate>{{ $date }}</lastBuildDate>
        <generator>Flex</generator>
        @foreach ($posts as $post)
            <item>
                <title>{{ $post->title }}</title>
                <link>{{ route('post.show',$post->hash_id) }}</link>
                <description>{{ $post->description }}</description>
                <pubDate>{{ $post->created_at->format('D, d M Y H:i:s T') }}</pubDate>
                <author>{{ $post->user->email }} ({{$post->user->name}})</author>
                <guid>{{ route('post.show',$post->hash_id) }}</guid>
                <category>{{ $post->category->name }}</category>
            </item>
        @endforeach
    </channel>
</rss>
