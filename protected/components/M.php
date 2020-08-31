<?php

class M {
    // Send mail method
    static function s($email,$subject,$message,$from=null) {
        if(!$from)
            $from=Yii::app()->params['adminEmail'];

        $headers = "Reply-To: Natasha Escort <{$from}>\r\n"
        . "Return-Path: Natasha Escort <{$from}>\r\n"
        . "From: Natasha Escort <{$from}>\r\n"
        . "Organization: Natasha Escrot\r\n"
        . "Content-type: text/html; charset=utf-8\r\n";

        $message = wordwrap($message, 70);
        $message = str_replace("\n.", "\n..", $message);
        return mail($email,'=?UTF-8?B?'.base64_encode($subject).'?=',$message,$headers);
    }
}