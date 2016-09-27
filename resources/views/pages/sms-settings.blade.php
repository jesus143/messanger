

@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<?php $counter =0; ?>
			@foreach ($smsThirdParties as $smsThirdParty)

 			  <?php $settings = App\SmsSetting::Where(['user_id'=>Auth::user()->id, 'sms_third_party_id'=>$smsThirdParty->id])->first(); ?>



				<div class="panel panel-default">
					<div class="panel-heading">{{$smsThirdParty->company_name}}
						<div style="font-size:10px">{{$smsThirdParty->description}}</div>
						<div style="font-size:10px">Please go here <a target="_blank" href="{{$smsThirdParty->website}}">{{$smsThirdParty->website}}</a> and sign up for account that you need to add below.</div>
					</div>

					<div class="panel-body">

						@if (session("status_$smsThirdParty->id"))
							<div class="alert alert-success">
								{{session("status_$smsThirdParty->id")}}
							</div>
						@endif
						@if (count($errors->status_2) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors->error_2->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif



                   			<form class="form-horizontal" name="form_settings_{{$smsThirdParty->id}}" role="form" method="POST" action="{{ route('user.sms.settings.update') }}">

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

							@if($smsThirdParty->id == 2)
								<div class="form-group">
									<label class="control-label col-sm-2" for="password">Device Id:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="device_id" name="device_id" placeholder="xxxxxxxx" value="{{$settings->device_id or NULL}}">
									</div>
								</div>
							@endif

							<div class="form-group">
								<label class="control-label col-sm-2" for="selected">Select this as sms provider:</label>
								<div class="radio">
									&nbsp; &nbsp;  <label><input type="radio" name="selected" value="1"  <?php print (empty($settings->selected))? null: 'checked'; ?> ></label>
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
		</div>
	</div>
</div>
@endsection
