<?php


namespace SMS_API;

class TextLocalMessages{

    private $username = '';
    private $password = '';
    private $senderName = '';
    private $receiverNumber = '';
    private $message = '';
    private $testMode = 0;

    function __construct($username, $password, $senderName, $receiverNumber, $message, $testMode=0)
    {
        $this->username = $username;
        $this->password = $password;
        $this->senderName = $senderName;
        $this->receiverNumber = $receiverNumber;
        $this->message = $message;
        $this->testMode = $testMode;
//        print "$username, $password, $senderName, $receiverNumber, $message";
    }

    public function sedMessage() {
        $uname=$this->username; //'mrjesuserwinsuarez@gmail.com';
        $pword=$this->password; //'replacement1A';
        $info = "1";
        $test = $this->testMode;
        $from = $this->senderName;
        $selectednums = $this->receiverNumber; //"+639759368743";
        $message = $this->message; //"This is my new message";
        $message = urlencode($message);

        //prepare data for post request

        $data = "uname=".$uname."&pword=".$pword."&message=".$message."&from=".$from.
            "&selectednums=".$selectednums."&info=".$info."&test=".$test;


        $ch = curl_init('http://www.textlocal.com/sendsmspost.php');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;

    }
}