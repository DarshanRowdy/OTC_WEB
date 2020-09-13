<?php

namespace App\Helper;

use Illuminate\Support\Facades\Mail;

class Helpers {

    public static function Mail_send_common($email_file_stucture, $mail_values = [], $sender_email_id, $email_subject, $obj = [], $specific_from_mail = NULL)
    {
        Mail::send($email_file_stucture, ['mail_values' => $mail_values, 'data' => $obj], function ($request) use ($sender_email_id, $email_subject, $specific_from_mail) {
            if(!empty($specific_from_mail) || $specific_from_mail == 'noReply') {
                $request->from(config('app.mail_from'), config('app.mail_from_name'));
            }
            $request->to($sender_email_id)->subject($email_subject);
        });

        if (Mail::failures()) {
            return 'false';
        }
        return 'true';
    }

}
