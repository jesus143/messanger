<?php namespace App;

use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['device_id', 'username', 'email'];




}
