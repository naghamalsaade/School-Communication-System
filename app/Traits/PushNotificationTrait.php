<?php

namespace App\Traits;


Trait PushNotificationTrait
{
    public function sendNotification($users, $title, $body)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        //array of token
        $FcmToken = $users;

       // $token_device="fK7l5qZSQp2K7IIMgkCj0M:APA91bFi_MBUw7qg_TL3uDhn_acV2PY_KxxJU1SrJEJBTSnkjzTYD_UX7cyiNjuqzKH-5NQNM2QSCZQnhDrUDMPVeaafaX_cCrNcOoqVvpnuXHXaD_9vjAK3FVf1YLtQwLnheV-_PU-H";
        $serverKey ='AAAA3VaZBTw:APA91bHC5NCnyXpSPKUnOxi-WkFcZdT68VPtzp6GjiRr3Q0TqkDanZzGxrWtwIQOOSsTDSn6tS0yP5myo-K0h-w1U5fzbWiEQLFbFkhUMGC5MZWtq-_rtG6WI1Ym-f4cV-gbrouzKfBf';
       
        $data = [
            //tokens
            "registration_ids" => $FcmToken,
            //"registration_ids" => [$token_device ,],

            "notification" => [
                "title" => $title,
                "body" => $body,
            ]
        ];

        $encodedData = json_encode($data);
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
    //    dd($result);
    }
    
}
