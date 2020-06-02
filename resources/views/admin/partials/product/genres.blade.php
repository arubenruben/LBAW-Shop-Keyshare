<div class="form-group col mb-auto mr-auto">
    <label for="gameGenres">
        <h6>Genres</h6>
    </label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button class="btn btnAdminProduct btn-blue dropdown-toggle" type="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Genres</button>
            <div id="dropdownGenre" class="dropdown-menu">
                @foreach ($genres as $genre)
                <a class="dropdown-item">{{$genre->name}}</a>
                @endforeach
            </div>
        </div>

        @php
        if(isset($data)){
        $arrayName=array();
        foreach ($data->genres as $genre) {
        array_push($arrayName,$genre->name);
        }

        $string=implode(",",$arrayName);

        @endphp
        <input id="gameGenres" name="gameGenres" type="text" class="form-control"
            aria-label="Text input with dropdown button" value={{$string}}>
        @php
        }else {

        @endphp
        <input id="gameGenres" name="gameGenres" type="text" class="form-control"
            aria-label="Text input with dropdown button" placeholder="Any Genre Selected Yet">
        @php
        }


        @endphp
    </div>
</div>