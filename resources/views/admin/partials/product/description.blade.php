<div class="row mt-4">
    <div class="form-group col">
        <label for="gameDescription">Game Description</label>
        @php
        if(isset($data)){
        @endphp
        <textarea class="form-control" id="gameDescription" rows="5"
            placeholder="Insert here the game description">$data->description</textarea>
        <textarea class="form-control" id="gameDescription" rows="5"></textarea>
        @php
        }else {
        @endphp
        <textarea class="form-control" id="gameDescription" rows="5"></textarea>
        @php
        }
        @endphp

    </div>
</div>