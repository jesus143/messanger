<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;

use SMS_API\SmsGateway;

use SMS_API\TextLocalMessages;

use App\SmsSetting;

use App\SmsThirdParty;

use Auth;

class SmsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);


		$selectedProviderName = User::getCurrentSmsProviderCompanyName();


//		print $selectedProviderName;
//		exit;

//		if($selectedProviderName == null) {
//			print "null is this";
//		} else {
//			print "not null";
//		}
//		dd($selectedProviderName);
//		exit;
//		if(empty($selectedProviderName))
//		{
//			$selectedProviderName = 'Please select your sms provider, click <a href="'. route('user.sms.settings.view'). '"> here </a> to visit settings.';
//		}







		return view('pages.sms-compose', ['user'=> $user, 'selectedProviderName'=>$selectedProviderName]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function sendSms(Request $requests) {


		$settingsInstance       = User::getCurrentSelectedSettings();


		if (empty($settingsInstance)) {
			$statusMessage = '<span style="color:red">Message sending failed Please setup your settings for sms api integration, click <a href="' . route('user.sms.settings.view') . '"> here </a> to visit your settings.  </span>';

			return redirect()
					->back()
					->with('statusMessage', $statusMessage);

		}


		$settingsDeviceId       = User::getCurrentSelectedSettings()->device_id;
		$settingsPassword       = User::getCurrentSelectedSettings()->password;
		$settingsUsername       = User::getCurrentSelectedSettings()->username;
		$settingsSmsThirdPartId = User::getCurrentSelectedSettings()->sms_third_party_id;





		//				print " settings $settingsDeviceId |
		//		$settingsPassword |
		//		$settingsUsername |
		//		$settingsSmsThirdPartId |";
		//				dd($requests->all());
		//



		if($settingsSmsThirdPartId == 1)
		{

			// $smsSetting = SmsSetting::getUserSettings();

			$receiver = User::find($requests->get('receiver'));
			$receiver_number = $receiver->contact;
			$receiver_name = $receiver->name;

			$message = $requests->get('message');
			$statusMessage = '';
			$isSent = false;
			$thirdPartyTool = 'Text Local';

			// Text Local API Provider
			$textLocal = new TextLocalMessages($settingsUsername, $settingsPassword, Auth::user()->name, $receiver_number, $message, 0);
			$result = $textLocal->sedMessage();
			print "<pre>";
			$result = explode('<br>', $result);
			$newBalance = '';

			foreach ($result as $key => $str) {
				if (strpos($str, 'reditsRemaining')) {
					// print " remaining " . $str;
					// print " remaining " . $str;
					$newBalance = str_replace('CreditsRemaining=', '', $str);
					$newBalance = str_replace('Success', '', $newBalance);
					$newBalance = str_replace('<br />', '', $newBalance);
					$newBalance = str_replace('<br/>', '', $newBalance);
					$newBalance = str_replace('<br >', '', $newBalance);
					$newBalance = str_replace('<br>', '', $newBalance);
				}
				if ((strpos($str, 'uccess') > -1) || (strpos($str, 'uccess') > -1)) {
					$isSent = true;
				}
			}

			if ($isSent) {
				$statusMessage .= '<b>Status:</b> Message sent!';
			} else {
				$statusMessage .= 'Status: <span style="color:red">Message not sent! please check your settings or you don\'t have text credit anymore.</span>';
			}


			$statusMessage .= '<br><b>Receiver:</b> ' . $receiver_name . ' | ' . $receiver_number;
			$statusMessage .= '<br><b>Message:</b> ' . $message;
			$statusMessage .= '<br><b>Remaining Text Credit:</b> ' . $newBalance;
			$statusMessage .= '<br><b>Third Party Tool:</b> ' . $thirdPartyTool;

			//				print $statusMessage;
			//				dd($result);
			//				print "</pre><br><br>";
			//				dd($requests->all());

			return redirect()
					->back()
					->with('statusMessage', $statusMessage);
		}
		else if ($settingsSmsThirdPartId == 2)
		{




			//	return "updating.. sms sending";
			////////////////////////////////////SMS GATEWAY CODE//////////////////////////////////////////
			$smsSetting = SmsSetting::find(2);
			$email = $settingsUsername; //'mrjesuserwinsuarez@gmail.com';
			$password = $settingsPassword; //'replacement1';
			$deviceID = $settingsDeviceId; //29743;
			$message = $requests->get('message');
			$number = User::find($requests->get('receiver'))->contact;
			//      print " message: $message, number: $number <br> ";
			//		exit;
			//		print "contact to recieve message " . $contact;
			//		exit;
			$smsGateway = new SmsGateway($email, $password);
			//		$message = 'Hello World!';
			//		$options = [
			//				'send_at' => strtotime('+10 minutes'), // Send the message in 10 minutes
			//				'expires_at' => strtotime('+1 hour') // Cancel the message in 1 hour if the message is not yet sent
			//		];
			//Please note options is no required and can be left out
			$result = $smsGateway->sendMessageToNumber($number, $message, $deviceID);



			//
						print "<pre>";
						print_r($result);
			//
						print "</pre>";
						$sendStatus = '';


 			if(!empty($result['response']['result']['fails']) or !empty($result['response']['errors'])) {
				$sendStatus .= "<span style='color:red'>Failed to send sms for some reason or check your username, password and device id.</span>";
			} else {
				$isSent = (!empty($result['response']['result']['success']) ? true : false);
				$process = $result['response']['result']['success'][0]['status'];
				$mobileNumber = $result['response']['result']['success'][0]['contact']['number'];
				if ($isSent) {
					$sendStatus = "Your sms is now ready to send to mobile number " . $mobileNumber . ' this will take few min.'; // . ' and process.. ' . $process . ' wait in few min, mobile server deliver the message';
				} else {
					$sendStatus = "failed to sent";
				}
				$sendStatus .= "<br> <br> <b>Message:</b> $message ";
				$sendStatus .= "<br> <br> <b>Status:</b> $process ";
				$result1 = $smsGateway->getDevice(User::getCurrentSelectedSettings()->device_id);
				print "<pre> ";
				print_r($result1);
				print "</pre>";
				//dd($result);
			}



			return redirect()
					->back()
					->with('statusMessage', $sendStatus);
		}
	}

	public function getSettings() {

		//		$smsSettings = SmsSetting::find(1);
		//		return view('pages.sms-settings', compact('smsSettings',$smsSettings));

		return "updating....";
	}

	public function updateSmsSettings(Requests\SmsSettingRequest $request) {


		return "updating....";
		//		$smsSettings = SmsSetting::find(1);
		//		$smsSettings->username  = $request->get('username');
		//		$smsSettings->password  = $request->get('password');
		//		$smsSettings->device_id = $request->get('device_id');
		//		$smsSettings->save();
		//
		//		return redirect()
		//				->back()
		//				->withInput()
		//				->with('status', 'SMS API Successfully update.');
	}
}