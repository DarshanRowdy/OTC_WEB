<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ScriptsRequest;
use App\Scripts;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;

class ScriptsController extends BaseApiController
{
    public function index(ScriptsRequest $request)
    {
        try{

            $search = $request->has('search') ? $request->search : '';
            $tbl_scripts = Scripts::query();
            $tbl_scripts->when(!empty($search), function ($query) use ($search) {
                $query->where(function ($que) use ($search) {
                    $string = explode(' ', $search);
                    foreach ($string as $str){
                        $str = '%'.strtoupper($str).'%';
                        $que->orWhere('script_display_name', 'LIKE', $str);
                    }
                });
            });
            $scripts = $tbl_scripts->get();
            $response = ['scripts' => $scripts];
            $this->_sendResponse($response, 'Scripts listing Success');
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
    }

    /*public function store(ScriptsRequest $request)
    {
        try{
            $tbl_scripts = Scripts::create($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['Scripts' => $tbl_scripts];
        $this->_sendResponse($response, 'Scripts created success');
    }*/

    public function show($id)
    {
        try{
            $tbl_scripts = Scripts::query();
            $tbl_scripts->with(['scriptFinancials','scriptNewsLinks', 'scriptReports']);
            $tbl_scripts->where('script_id','=',$id);
            $scriptObj = $tbl_scripts->first();
            if(!empty($scriptObj))
            {
                $response = ['script' => $scriptObj];
                $this->_sendResponse($response, 'scripts detail found success');
            } else {
                $this->_sendErrorResponse(404,'script not found');
            }

        } catch (\Exception $exception){
            dd($exception);
            $this->_sendErrorResponse(500);
        }
    }

   /* public function update(ScriptsRequest $request, $id)
    {
        try{
            $tbl_scripts = Scripts::findOrFail($id);
            $tbl_scripts->update($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['Scripts' => $tbl_scripts];
        $this->_sendResponse($response, 'Scripts update success');
    }

    public function destroy($id)
    {
        try{
            $tbl_scripts = Scripts::destroy($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(204);
        }
        $response = ['Scripts' => $tbl_scripts];
        $this->_sendResponse($response, 'Scripts delete successfully');
    }*/
}
