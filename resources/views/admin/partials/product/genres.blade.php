<div class="form-group col mb-auto mr-auto">
    <label for="gameGenres">
        <h6>Genres</h6>
    </label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button class="btn btnAdminProduct btn-blue dropdown-toggle" type="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Genres</button>
            <div class="dropdown-menu">

            </div>
        </div>

        @php
        if(isset($data)){
        @endphp
        <input id="gameGenres" type="text" class="form-control" aria-label="Text input with dropdown button"
            value="PREENCHER COM OS VALORES">
        @php
        }else {
        @endphp
        <input id="gameGenres" type="text" class="form-control" aria-label="Text input with dropdown button"
            placeholder="Any Genre Selected Yet">
        @php
        }


        @endphp
    </div>
</div>