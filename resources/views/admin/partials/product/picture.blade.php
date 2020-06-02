<div class="col text-center">
    @php
    if(isset($data)){
    @endphp
    <img id="product-img" class="img-fluid productPageImgPreview"
        src={{asset('pictures/games/'.$data->picture->url)}} />
    @php
    }else {
    @endphp
    <img id="product-img" class="img-fluid productPageImgPreview" src={{asset('pictures/games/default.png')}} />
    @php
    }
    @endphp
    <span class="btn btn-orange btn-lg btn-file mt-3">
        Upload Photo<input id="img-upload" name="img-upload" name="picture" type="file">
    </span>
</div>