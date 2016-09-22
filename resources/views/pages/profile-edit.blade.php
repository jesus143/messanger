@extends('app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">





					<div class="panel-heading">Account Profile</div>
					<div class="panel-body">

						@if (session('statusProfile'))
							<div class="alert alert-success">
								{{session('statusProfile')}}
							</div>
						@endif

						@if (count($errors->profile) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors->profile->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif



						<form class="form-horizontal" role="form" method="POST" action="{{ route('user.profile.update', ['id'=>$user->id]) }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label class="col-md-4 control-label">Name</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="John Doe" >
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Update
									</button>
								</div>
							</div>
						</form>

						<hr>

						<form class="form-horizontal" role="form" method="POST" action="{{ route('user.profile.update', ['id'=>$user->id])}}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label class="col-md-4 control-label">E-Mail Address</label>
								<div class="col-md-6">
									<input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="johndoe@gmial.com">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Update
									</button>
								</div>
							</div>
						</form>

						<hr>
						<form class="form-horizontal" role="form" method="POST" action="{{ route('user.profile.update',  ['id'=>$user->id]) }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label class="col-md-4 control-label">Contact Number</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="contact" value="{{ $user->contact }}" placeholder="+639xxxxxxxxx" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Update
									</button>
								</div>
							</div>
						</form>





					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">Account Password</div>
					<div class="panel-body">

						@if (session('statusAccount'))
							<div class="alert alert-success">
								{{session('statusAccount')}}
							</div>
						@endif

						@if (count($errors->password) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors->password->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif




						<form class="form-horizontal" role="form" method="POST" action="{{ route('user.password.update', ['id'=>$user->id]) }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">


							<div class="form-group">
								<label class="col-md-4 control-label">Current Password</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="old_password"  placeholder="xxxxxx" value="{{ old('old_password') }}" />
								</div>
							</div>


							<div class="form-group">
								<label class="col-md-4 control-label">New Password</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="password"  placeholder="xxxxxx" value="{{ old('password') }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Confirm New Password</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="password_confirmation"  placeholder="xxxxxx" value="{{ old('password_confirmation') }}" >
								</div>
							</div>



							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Update
									</button>
								</div>
							</div>
						</form>



					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
