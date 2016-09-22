@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">



				<div class="panel-heading">SMS API Settings <div style="font-size:10px">This will be the api needed to authenticate to the smsgateway api.</div> </div>
				<div class="panel-body">

					@if (session('status'))
						<div class="alert alert-success">
							{{session('status')}}
						</div>
					@endif


					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif



					<form class="form-horizontal" role="form" method="POST" action="{{ route('user.sms.settings.update') }}">

						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="control-label col-sm-2" for="username">Username/Email:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="username" name="username" placeholder="name@yourdomain.com" value="{{$smsSettings->username}}" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="password">Password:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="password" name="password" placeholder="xxxxxxxx" value="{{$smsSettings->password}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="device_id">Device Id:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="device_id" name="device_id" placeholder="123xxxx" value="{{$smsSettings->device_id}}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary">
									Update
								</button>
							</div>
						</div>
					</form>

				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Comming soon..</div>
				<div class="panel-body">


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
