<div class="row">
    <div class="col text-center">
        <img class="img-fluid productPageImgPreview" src={{asset('pictures/games/default.png')}} />
        <span class="btn btn-orange btn-lg btn-file mt-3">
            Upload Photo<input id="img-upload" name="picture" type="file">
        </span>
    </div>
    <div class="form-group col mb-auto mr-auto">
        <label for="gameName">Game Name</label>
        @php
        if(isset($data)){
        @endphp
        <input type="text" class="form-control" id="gameName" value={{$data->name}}>

        @php

        }else{
        @endphp

        <input type="text" class="form-control" id="gameName" placeholder="Type Game Name">

        @php
        }
        @endphp
    </div>
</div>