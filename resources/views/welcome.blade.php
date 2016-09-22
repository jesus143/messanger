<html>
	<head>
		<title>SMS Messnager Application</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
			}
			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}
			.content {
				text-align: center;
				display: inline-block;
			}
			.title {
				font-size: 42px;
				margin-bottom: 40px;
			}
			.quote {
				font-size: 24px;
			}
		</style>
	</head>

	<body>
		<div class="container">
			<div class="content">

				<a href="{{url('auth/login')}}">
					<button style="padding: 3% 6% 3% 6%;font-size: 30px;" type="button" class="btn btn-default">
						<span class="glyphicon glyphicon-ok"></span>
						Login
					</button>
				</a>


				<div class="title title1">Welcome to employee messenger application portal.</div>
				<div class="quote">{{ Inspiring::quote() }}</div>
			</div>
		</div>
	</body>

</html>
