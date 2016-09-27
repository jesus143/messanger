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
				color: black;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
				font-weight: bold;
			}
			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}
			.content {
				text-align: center;
				display: inline-block;
				padding: 50px 0px;
			}
			.title {
				font-size: 42px;
				margin-bottom: 40px;
			}
			.quote {
				font-size: 24px;
			}

			.thumbnail {

				padding:20px;
			}
		</style>
	</head>

	<body>
		<div class="container">
			<div class="content container">


				<a href="{{url('auth/login')}}">
					<button style="padding: 3% 6% 3% 6%;font-size: 30px;" type="button" class="btn btn-default">
						<span class="glyphicon glyphicon-ok"></span>
						Login
					</button>
				</a>
				<br><br>
				<div class="title title1">Welcome to sms messenger portal.</div>





				<div class="bs-example" data-example-id="thumbnails-with-custom-content">
					<div class="row">

						<div class="col-sm-6 col-md-4">
							<div class="thumbnail">
								<img alt="100%x200" data-src="holder.js/100%x200" src="http://www.textlocal.com//img/logo.svg?v=13" data-holder-rendered="true" style="height: 200px; width: auto; display: block;">
								<div class="caption">
									<h3>The #1 SMS Text Message Marketing & Alerts Platform</h3>
									<p>
										Instantly reach everyone with texts, links, files, forms & ticket
										Multi-award-winning web software
										We price match/beat all providers
										No contracts, no commitment,
										<a target="_blank" href="http://www.textlocal.com/">more..</a>
									</p>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="thumbnail">
								<img alt="100%x200" data-src="holder.js/100%x200" src="https://smsgateway.me/assets/img/logo.svg" data-holder-rendered="true" style="height: 200px; width: auto; display: block;">
								<div class="caption">
									<h3>Your Android phone, Your SMS Gateway</h3>
									<p>
										Using our free service you can turn your Android phone into a free SMS Gateway. Allowing you to both send and receive SMS messages programmatically using our restful API
									 	<a target="_blank" href="https://smsgateway.me/">more..</a>
									</p>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="thumbnail">
								<img alt="100%x200" data-src="holder.js/100%x200" src="http://www.chikka.com/img/slide-new.png" data-holder-rendered="true" style="height: 200px; width: auto; display: block;">
								<div class="caption">
									<h3>Chikka Version 6</h3>
									<p>
										You have been supporting us for over 10 years and our life's purpose has always been about connecting you with your loved ones. We want to keep doing that, plus more. Yes, we heard you when you said you want more.
										<a target="_blank" href="http://chikka.com/">more..</a>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>



				<div class="quote">{{ Inspiring::quote() }}</div>


			</div>
		</div>
	</body>

</html>
