<div class="row mt-4">
    <div class="form-group col">
        <label for="gameDescription">Game Description</label>
        @php
        if(isset($data)){
        @endphp
        <textarea class="form-control" id="gameDescription" name="gameDescription"
            rows="5">{{$data->description}}</textarea>
        @php
        }else {
        @endphp
        <textarea class="form-control" id="gameDescription" name="gameDescription" rows="5"
            placeholder="Insert here the game description"></textarea>
        @php
        }
        @endphp

    </div>
</div>