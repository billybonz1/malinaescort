<?php
/**
 * Created by PhpStorm.
 * User: alexeynekrasov
 * Date: 6/21/15
 * Time: 13:05
 */

class SMS {
    static function s($to, $message)
    {
        $src = "<?xml version='1.0' encoding='UTF-8'?>
        <SMS>
            <operations>
                <operation>SEND</operation>
            </operations>
            <authentification>
                <username>natashaescort.com@gmail.com</username>
                <password>12345678</password>
            </authentification>
            <message>
                <sender>ESCORTSMS</sender>
                <text>{$message}</text>
            </message>
            <numbers>
                <number messageID='msg11'>{$to}</number>
            </numbers>
        </SMS>";
        $Curl = curl_init();
        $CurlOptions = array(
            CURLOPT_URL => 'http://atompark.com/members/sms/xml.php',
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_POST => true,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT => 100,
            CURLOPT_POSTFIELDS => array('XML' => $src),
        );
        curl_setopt_array($Curl, $CurlOptions);
        if (false === ($Result = curl_exec($Curl))) {
            throw new Exception('Http request failed');
        }
        curl_close($Curl);
        return $Result;
    }
}