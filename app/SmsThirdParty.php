<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsThirdParty extends Model {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sms_third_parties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
        'email',
        'website',
        'description'
    ];

    public static function getCurrentActiveThirdParty() {
        return self::all()->first();
    }
}
