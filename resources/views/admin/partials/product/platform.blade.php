<div class="form-group col mb-auto mr-auto mt-4">
    <label for="gamePlatforms">
        <h6>Platforms</h6>
    </label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button class="btn btnAdminProduct btn-blue dropdown-toggle" type="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Platforms</button>
            <ul id="dropdownPlatform" class="dropdown-menu">
                <li class="dropdown-item">PC</li>
                <li class="dropdown-item">PS4</li>
                <li class="dropdown-item">Xbox</li>
            </ul>
        </div>
        @php
        if(isset($data)){

        $arrayName=array();
        foreach ($data->platforms as $platform) {
        array_push($arrayName,$platform->name);
        }

        $string=implode(",",$arrayName);
        @endphp
        <input id="gamePlatforms" name="gamePlatforms" type="text" class="form-control"
            aria-label="Text input with dropdown button" value={{$string}}>
        @php
        }else{
        @endphp
        <input id="gamePlatforms" name="gamePlatforms" type="text" class="form-control"
            aria-label="Text input with dropdown button" placeholder="Any Platform Selected Yet">
        @php
        }

        @endphp

    </div>
</div>