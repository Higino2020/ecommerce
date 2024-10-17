<div class="form-group col-12 col-md-6 col-lg-6">
    <label for="">{{$titulo}}</label>
    <select name="{{$name}}" id="{{$id}}" class="form-control">
        <option value="" disabled>{{$rotulo}}</option>
        {{$slot}}
    </select>
</div>