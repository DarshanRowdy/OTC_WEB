<?php

namespace App\Http\Controllers\Api;

use App\Users;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ixudra\Curl\Facades\Curl;
use const http\Client\Curl\Versions\CURL;


class AppController extends BaseApiController
{
    public function init(){
        $user = Auth::user();

        $response = ['user' => $user];
        $this->_sendResponse($response, "User success.");
    }

    public function checkValidate($request, $validFields, $messages = [])
    {
        $validator = Validator::make($request->all(), $validFields, $messages);
        if ($validator->fails()) {
            foreach ($validator->getMessageBag()->toArray() as $key => $messages) {
                $this->_sendErrorResponse(400, $validator->getMessageBag()->first($key));
            }
        }
    }

    public function checkValidateArray($request, $validFields, $messages = [])
    {
        $validator = Validator::make($request, $validFields, $messages);
        $errorArray = [];
        if ($validator->fails()) {
            foreach ($validator->getMessageBag()->toArray() as $key => $messages) {
                array_push($errorArray, $validator->getMessageBag()->first($key));
            }
        }
        return $errorArray;
    }

    public function login(request $request)
    {
        $validator = [
            'mobile' => 'required',
            'password' => 'required'
        ];
        $this->checkValidate($request, $validator);
        try {
            if (!Auth::attempt(['user_mobile' => request('mobile'), 'password' => request('password')])) {
                $this->_sendErrorResponse(401, "Incorrect Mobile or Password.");
            }
            $userObj = Auth::user();
            if($userObj->user_status != 'active'){
                $this->_sendErrorResponse(401, 'Please Complete Verification');
            }
            $userId = $userObj->user_id;
            $currentDate = date('Y-m-d H:i:s');
            $token = $this->_generateToken();
            Users::where('user_id','=', $userId)->update(array('last_login' => $currentDate,'auth_token' => $token));
            $userObj = Users::where('user_id','=',$userId)->first();
            $response = ['user' => $userObj];
            $this->_sendResponse($response, "You are successfully login into system.");
        } catch (Exception $exception) {
            $this->_sendErrorResponse(500);
        }
    }

    public function sendOtp(Request $request){
        try {
            $validFields = [
                'mobile' => 'required|numeric'
            ];
            $this->checkValidate($request, $validFields);
            $mobile = $request->has('mobile') ? $request->mobile : '';
            $otp = mt_rand(1000,9999);
            $url = 'https://2factor.in/API/V1/ce9cad9f-f750-11ea-9fa5-0200cd936042/SMS/'.$mobile.'/'.$otp.'/OTC_CAP';
            $sendOtp = Curl::to($url)->get();
            $user = Users::where('user_mobile', $mobile)->update(array('otp' => $otp));
            if($user){
                $this->_sendResponse($otp,'OTP send successfully');
            }
            $this->_sendErrorResponse(404,'Mobile not registered');
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
    }

    public function resetPassword(Request $request){
        try{
            $validField = [
                'mobile' => 'required',
                'password' => 'required'
            ];
            $this->checkValidate($request, $validField);

            $mobile = $request->has('mobile') ? $request->mobile : '';
            $password = $request->has('password') ? Hash::make($request->password) : '';

            $user = Users::where('user_mobile', $mobile)->update(array('password' => $password));
            if(!$user){
                $this->_sendErrorResponse(500,'Please Try Again later');
            }
            $this->_sendResponse([],'Password reset successfully');
        } catch (Exception $exception){
            $this->_sendErrorResponse(500);
        }
    }

    public function verifyOtp(Request $request){
        try {
            $validFields = [
                'mobile' => 'required|numeric',
                'otp' => 'required|numeric'
            ];
            $this->checkValidate($request, $validFields);
            $mobile = $request->has('mobile') ? $request->mobile : '';
            $otp = $request->has('otp') ? $request->otp : '';
            $is_login_with_otp = $request->has('is_login_with_otp') ? $request->is_login_with_otp : 0;

            $user = Users::query();
            $user->where(['user_mobile' => $mobile]);
            $user->where(['otp' => $otp]);
            $userObj = $user->first();

            if(empty($userObj)){
                $this->_sendErrorResponse(400, 'OTP is wrong. Please enter correct OTP.');
            }
            $userUpdate = Users::where('user_id', $userObj->user_id)->update(array('user_status' => 'active', 'otp' => null));
            if($userUpdate){
                $response = [];
                $message = 'Mobile Verification complete successfully';
                if($is_login_with_otp == 1){
                    $user_id = $userObj->user_id;
                    $currentDate = date('Y-m-d H:i:s');
                    Users::where('user_id','=', $user_id)->update(array('last_login' => $currentDate));
                    $userQue = Users::query();
                    $userQue->where('user_id', '=', $user_id);
                    $userObj = $userQue->first();
                    $response = ['user' => $userObj];
                    $message = 'Login Successfully';
                }
                $this->_sendResponse($response,$message);
            }
            $this->_sendErrorResponse(500,'Please Try Again later');
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
    }

    public function logout(){
        Auth::logout();
    }

   /* public function change_password(request $request)
    {
        $users = $request->get('users');
        $is_app = $request->has('is_app') ? $request->is_app : 0;
        $validator = [
            'password' => 'required|min:6'
        ];
        if($is_app != 1){
            $validator = array_add($validator,'old_password','required|min:6');
        }

        $this->checkValidate($request,$validator);
        try {
            if($is_app == 1){
                $password = Hash::make($request->password);
                $users->update(['password' => $password, 'is_password_change' => 1]);
            } else {
                if (Hash::check($request->old_password, $users->password) == $users->password) {
                    $password = Hash::make($request->password);
                    $users->update(['password' => $password, 'is_password_change' => 1]);
                } else {
                    $this->_sendErrorResponse(400, "You'r old password is not match, please insert correct password");
                }
            }
        } catch (Exception $exception) {
            $this->_sendErrorResponse(500);
        }
        $this->_sendResponse([], 'Password successfully Changed');
    }

    public function forgot_password(request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            $this->_sendErrorResponse(400, "The email field is required, The email must be a valid email address");
        }
        try {
            $email = $request->has('email') ? $request->email : NULL;
            $role = $request->has('role') ? $request->role : NULL;
            if(!empty($role) && $role == "customer") {
                $role_ids = [7];
            } else if(!empty($role) && $role == "web") {
                $role_ids = [3,4];
            } else if(!empty($role) && $role == "delivery_agent") {
                $role_ids = [6,9];
            } else if(!empty($role) && $role == "admin") {
                $role_ids = [1,2];
            } else {
                $this->_sendErrorResponse(400);
            }
            $userObj = Users::where('user_name', $email)->whereIn('role_id',$role_ids)->first();
            if (!empty($userObj)) {
                $reset_password_token = $this->_generateToken();
                $userObj->reset_password_token = $reset_password_token;
                $userObj->save();

                // Mail sender code start
                $email_file_stucture = 'email.forgot_password';
                $mail_values = [];
                $sender_email_id = $request->email;
                $email_subject = 'Password Reset Link - reternX.com';
                Helpers::Mail_send_common($email_file_stucture, $mail_values, $sender_email_id, $email_subject, $userObj);
                // Mail sender code end
            } else {
                $this->_sendErrorResponse(404, 'This Email-ID is does not exist into database!');
            }
        } catch (Exception $exception) {
            $this->_sendErrorResponse(500);
        }
        $this->_sendResponse([], "A message to reset your password has been sent to your email address.");
    }

    public function resetpassword(request $request)
    {
        $validator = [
            'password' => 'required|min:6',
            'reset_password_token' => 'required'
        ];
        $this->checkValidate($request, $validator);
        try {
            $pass = $request->has('password') ? $request->password : "123456";
            $reset_password_token = $request->has('reset_password_token') ? $request->reset_password_token : NULL;
            $check_reset_token = Users::findUserBy('reset_password_token', $reset_password_token);
            if (!empty($check_reset_token)) {
                $password = Hash::make($pass);
                Users::updateUserBy(array('id' => $check_reset_token->id), array('password' => $password, 'reset_password_token' => NULL,'is_password_change' => 1));
            } else {
                $this->_sendErrorResponse(404, 'Your reset password token is mismatch');
            }
        } catch (Exception $exception) {
            $this->_sendErrorResponse(500);
        }
        $this->_sendResponse([], "You'r Password is successfully reset!");
    }*/

}
