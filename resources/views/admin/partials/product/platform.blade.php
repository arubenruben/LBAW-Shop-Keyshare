<div class="form-group col mb-auto mr-auto mt-4">
    <label for="gamePlatforms">
        <h6>Platforms</h6>
    </label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button class="btn btnAdminProduct btn-blue dropdown-toggle" type="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Platforms</button>
            <div class="dropdown-menu">

            </div>
        </div>
        @php
        if(isset($data)){
        @endphp
        <input id="gamePlatforms" type="text" class="form-control" aria-label="Text input with dropdown button"
            value="Any Platform Selected Yet">
        @php
        }else{
        @endphp
        <input id="gamePlatforms" type="text" class="form-control" aria-label="Text input with dropdown button"
            placeholder="Any Platform Selected Yet">
        @php
        }

        @endphp

    </div>
</div>