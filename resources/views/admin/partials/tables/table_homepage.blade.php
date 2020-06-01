<h2>{{ $title }}</h2>
<article class="col-sm-12 col-md-12 col-lg-9 mt-4">
    @foreach($contents as $title => $listing)
        <div class="card mb-4">
            <h4 class="pl-3 py-2">{{ $title }}</h4>
            @foreach($listing as $content)
                <p class="pl-5 py-2">{{ $content }}</p>
            @endforeach
        </div>
    @endforeach
</article>