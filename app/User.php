<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\SmsSetting;
use Auth;
use App\SmsThirdParty;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;
	//use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	//protected $dates = ['deleted_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'contact'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


	public function smsSettings(){
		return $this->hasMany('App\SmsSetting','user_id', 'id');
	}

	public static function clearUserSelectedSettings(){

		$smsSettings = self::find(Auth::user()->id)->smsSettings;
		foreach($smsSettings as $smsSetting) {
			$smsSettingsInstance = SmsSetting::find($smsSetting->id);
			$smsSettingsInstance->selected = 0;
			$smsSettingsInstance->save();
		}
	}

	public static function getCurrentSelectedSettings()
	{
		$smsSettings = self::find(Auth::user()->id)->smsSettings;

		if($smsSettings == null) {
			return false;
//			print "null is this";
		} else {
//			print "not null";
		}
//		dd($smsSettings);
//		dd($smsSettings);
//
//		if(empty($smsSettings)) {
//			print "empty";
//		} else {
//			print 'not empty';
//		}
//		if(count($smsSettings)<1) {
//			return false;
//		}
		foreach($smsSettings as $smsSetting) {

//			print " selected  " . $smsSetting->selected;
			if($smsSetting->selected == 1){
				return $smsSetting;
			}
		}
	}

	public static function getCurrentSmsProviderCompanyName()
	{


		if(self::getCurrentSelectedSettings() != false) {


//			print "with instance";
			return   SmsThirdParty::find(self::getCurrentSelectedSettings()->sms_third_party_id)->company_name;
		} else {
//			print "no instance";
			return 'Please select your sms provider, click <a href="'. route('user.sms.settings.view'). '"> here </a> to visit settings.';
		}

	}

}
