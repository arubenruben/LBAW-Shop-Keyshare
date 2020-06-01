<div class="form-group col mb-auto mr-auto mt-4">
    <label for="gameCategories">
        <h6>Categories</h6>
    </label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button class="btn btnAdminProduct btn-blue dropdown-toggle" type="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Dropdown</button>
            <div class="dropdown-menu">

            </div>
        </div>
        @php
        if(isset($data)){
        @endphp
        <input id="gameCategories" type="text" class="form-control" aria-label="Text input with dropdown button"
            value="COLOCAR AQUI OS ELEMENTOS SELECIONADOS">
        @php
        }else {
        @endphp
        <input id="gameCategories" type="text" class="form-control" aria-label="Text input with dropdown button"
            placeholder="Any Category selected yet">
        @php
        }

        @endphp
    </div>
</div>