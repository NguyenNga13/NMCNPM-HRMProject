@if(count($errors) > 0)
<div class="alert alert-danger">
	@foreach($errors->all() as $error)
	{{$error}}<br>
	@endforeach
</div>
@endif

@if(session('notify'))
<div class="alert alert-success" id="notify">
	{{session('notify')}}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger" id="error">
	{{session('error')}}
</div>
@endif

