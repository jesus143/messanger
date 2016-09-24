<?php namespace App;

use Illuminate\Database\Eloquent\Model;


use App\SmsThirdParty;
use Auth;

class SmsSetting extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sms_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'sms_third_party_id',
        'username',
        'password',
        'app_key',
        'secret_key',
        'device_id'
    ];

    public static function getUserSettings() {
        $thirdPartCurrentActive = SmsThirdParty::getCurrentActiveThirdParty();

        // get current active third party
        //        print "id = " . $thirdPartCurrentActive->id;
        //        print "current auth id " . Auth::user()->id;

        $sms_third_party_id = $thirdPartCurrentActive->id;
        $user_id =  Auth::user()->id;

        $smsSettings = self::Where(['user_id'=>$user_id, 'sms_third_party_id'=>$sms_third_party_id])->first();

        return (!empty($smsSettings))? $smsSettings : false;
    }

}
