<div class="form-group col mb-auto mr-auto">
    <label for="gameName">Game Name</label>
    @php
    if(isset($data)){
    @endphp
    <input type="text" class="form-control" id="gameName" name="gameName" value="{{$data->name}}">

    @php

    }else{
    @endphp

    <input type=" text" class="form-control" id="gameName" name="gameName" placeholder="Type Game Name">

    @php
    }
    @endphp
</div>