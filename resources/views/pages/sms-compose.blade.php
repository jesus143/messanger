@extends('app')

@section('content')
<style>
	.panel-body {
		padding-left:36px;
		padding-right:36px;
	}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">

				<div class="panel-heading">Team Members</div>
				<div class="panel-body">

					@if (session('statusMessage'))
						<div class="alert alert-success">
							{!! session('statusMessage') !!}
						</div>
					@endif

					<form  class="form-horizontal" role="form" method="POST" action="{{route('user.sms.send')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label for="usr">Send To:</label>
							<input type="text" class="form-control" value="{{$user->name}} | {{$user->contact}}" disabled>
						</div>

						<div class="form-group">
							<label for="usr">Selected sms provider:</label>
							<span> {!! $selectedProviderName !!} </span>
						</div>

						<div class="form-group">
							<label for="comment">Message:</label>
							<textarea class="form-control" rows="5" id="comment" name="message"></textarea>
						</div>

						<div class="form-group">
							<input type="hidden" class="form-control" name="receiver" value="{{$user->id}}" >
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-default">Submit</button>
						</div>
					</form>


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
