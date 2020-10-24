<?php

namespace App\Http\Controllers\Api;

use App\Helper\Helpers;
use App\Http\Requests\UsersRequest;
use App\Users;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;
use Illuminate\Support\Facades\Hash;

class UsersController extends AppController
{
    /*public function index(UsersRequest $request)
    {
        $limit = isset($request->limit) ? $request->limit : config('app.default_limit');
        try{
            $Users = Users::latest();
            $arrUsers = $Users->paginate($limit);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['Users' => $arrUsers];
        $this->_sendResponse($response, 'Users listing Success');
    }*/

    public function store(UsersRequest $request)
    {
        try{
            $validFields = [
                'name' => 'required',
                'mobile' => 'required|numeric|unique:users,user_mobile',
                'email' => 'required|email',
                'password' => 'required',
                'is_accepted' => 'required'
            ];
            $messages = [
                'is_accepted.required' => 'Kindly read and accept the Terms and Conditions.',
                'mobile.unique' => 'Mobile already registered, kindly try to Login with OTP.'
            ];
            $this->checkValidate($request,$validFields,$messages);

            $userObj = New Users();
            $userObj->user_name = $request->name;
            $userObj->user_mobile = $request->mobile;
            $userObj->user_email = $request->email;
            $userObj->password = Hash::make($request->password);
            $userObj->auth_token = $this->_generateToken();
            $userObj->user_status = 'inactive';
            $userObj->created_by = 'self';
            $userObj->user_attribute_1 = $request->is_accepted == true ? 'YES' : 'NO';
            $userObj->last_updated_by = $userObj->created_by;
            if(!$userObj->save()){
                $this->_sendErrorResponse(417,'user registration un-successfully');
            }
            $mail_val['name'] = $request->name;
            Helpers::Mail_send_common('email.welcomeEmail', $mail_val, $request->email,'Welcome to OTC Capital');
            $response = ['user' => $userObj];
            $this->_sendResponse($response, 'user registration successfully');
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
    }

/*
    public function show($id)
    {
        try{
            $Users = Users::findOrFail($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['Users' => $Users];
        $this->_sendResponse($response, 'Users found success');
    }

    public function update(UsersRequest $request, $id)
    {
        try{
            $Users = Users::findOrFail($id);
            $Users->update($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['Users' => $Users];
        $this->_sendResponse($response, 'Users update success');
    }

    public function destroy($id)
    {
        try{
            $Users = Users::destroy($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(204);
        }
        $response = ['Users' => $Users];
        $this->_sendResponse($response, 'Users delete successfully');
    }*/
}
