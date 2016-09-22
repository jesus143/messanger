

@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">



			@foreach ($smsThirdParties as $smsThirdParty)

 			  <?php   $settings = App\SmsSetting::Where(['user_id'=>Auth::user()->id, 'sms_third_party_id'=>$smsThirdParty->id])->first();  ?>

				<div class="panel panel-default">
					<div class="panel-heading">{{$smsThirdParty->company_name}}
						<div style="font-size:10px">{{$smsThirdParty->description}}</div>
						<div style="font-size:10px">Please go here <a target="_blank" href="{{$smsThirdParty->website}}">{{$smsThirdParty->website}}</a> and sign up for account that you need to add below.</div>
					</div>

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
									<input type="text" class="form-control" id="username" name="username" placeholder="name@yourdomain.com" value="{{$settings->username or NULL }}" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="password">Password:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="password" name="password" placeholder="xxxxxxxx" value="{{$settings->password or NULL}}">
								</div>
							</div>



							{{--hidden fields--}}


							<input type="hidden" name="sms_third_party_id" value="{{$smsThirdParty->id}}"  />

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
			@endforeach



			{{--<div class="panel panel-default">--}}
				{{--<div class="panel-heading">Comming soon..</div>--}}
				{{--<div class="panel-body">--}}
				{{--</div>--}}
			{{--</div>--}}
		</div>
	</div>
</div>
@endsection
