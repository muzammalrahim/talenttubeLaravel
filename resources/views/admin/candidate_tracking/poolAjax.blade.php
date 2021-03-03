

<select class="form-control" name ="pool_id">
	
	@foreach ($UserPool as $pool)
		<option  value="{{$pool->id}}"> {{$pool->name}} </option>
	@endforeach
	
</select>