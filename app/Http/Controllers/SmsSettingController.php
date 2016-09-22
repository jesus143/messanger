<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SmsSetting;
use Illuminate\Http\Request;

use App\SmsThirdParty;
use App\User;
use Auth;




class SmsSettingController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$smsThirdParties = SmsThirdParty::all();







		return view('pages.sms-settings', compact('smsThirdParties', $smsThirdParties));
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
	public function store(Request $request)
	{


		$request->get('username');
		$request->get('password');



	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
	public function update(Requests\SmsSettingRequest $request)
	{

		// dd($request->all());

		$sms_third_party_id   = $request->get('sms_third_party_id');

		if(!$smsSetting = SmsSetting::Where(['user_id'=>Auth::user()->id, 'sms_third_party_id'=>$sms_third_party_id])->first()) {
			$smsSetting = new SmsSetting();
			$message = 'Successfully Added.';

			$smsSetting->user_id 			= Auth::user()->id;
			$smsSetting->sms_third_party_id = $sms_third_party_id;

		} else {
			$message = 'Successfully updated.';
		}

		$smsSetting->username = $request->get('username');
		$smsSetting->password = $request->get('password');

		$smsSetting->save();

		return redirect()
				->back()
				->with('status', $message);
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

}
