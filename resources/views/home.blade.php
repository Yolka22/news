<!DOCTYPE html>
<html lang="en">

<head>
    <link href="homestyles.css" rel="stylesheet">
</head>


<body style="display: flex, flex-direction:column">
    @include('partials.header')
    <div class="content" style="display: flex">
        @php
        $response = app('App\Http\Controllers\Controller')->makeApiCall();
        $data = json_decode($response->content(), true);
        $articles = $data['articles'];
    @endphp

    <main style="flex-grow:1">
    @for ($i = 0; $i < 2; $i++)
    <div class="articles">
            <div class="article">
                <img height="200px" width="300px" src={{ $articles[$i]['urlToImage'] }}>
                <h2>{{ $articles[$i]['title'] }}</h2>
                <p>{{ $articles[$i]['description'] }}</p>
                <p>Published At: {{ $articles[$i]['publishedAt'] }}</p>
                <a href="{{ $articles[$i]['url'] }}" target="_blank">Read More</a>
            </div>
    </div>
    @endfor
    </main>
    <aside style="width: 400px">
        <div class="articles">
            @foreach ($articles as $article)
                <div class="article">
                    <img height="200px" width="300px" src={{ $article['urlToImage'] }}>
                    <h2>{{ $article['title'] }}</h2>
                    <p>{{ $article['description'] }}</p>
                    <p>Published At: {{ $article['publishedAt'] }}</p>
                    <a href="{{ $article['url'] }}" target="_blank">Read More</a>
                </div>
            @endforeach
        </div>
    </aside>
    </div>
    
</body>
</html>
