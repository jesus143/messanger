@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Team Members / Phone Book
					@if(Auth::user()->user_type == 1)
						| <a href="{{route('user.create')}}" >Add New Contact </a>
					@endif
				</div>
				<div class="panel-body">

					@if (session('status'))
						<div class="alert alert-success">
							{{session('status')}}
						</div>
					@endif

					<table class="table table-hover">
						<thead>
						<tr>
							<th>Full Name</th>
							<th>Send Message</th>
							<th>Possition</th>
							@if(Auth::user()->user_type == 1)
								<th>Update</th>
								<th>Delete</th>
						 	@endif
						</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
								<tr>
									<td>{{$user->name}}</td>
									<td> {{$user->contact}} <a href="{{route('user.sms.compose', ['id'=>$user->id] )}}"> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a></td>
									<td>
										@if($user->user_type == 1)
											{{'Admin / Team Leader'}}
 										@else
											{{ 'Member' }}
										@endif
									</td>
									@if(Auth::user()->user_type == 1)
										<td><a href="{{route('user.edit', ['id'=>$user->id])}}"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a></td>
										<td><a href="{{route('user.delete', ['id'=>$user->id])}}"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
									@endif
								</tr>
							@endforeach
						</tbody>
					</table>


					{!! $users->render() !!}


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
