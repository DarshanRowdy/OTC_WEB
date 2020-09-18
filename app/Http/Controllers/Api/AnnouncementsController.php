<?php

namespace App\Http\Controllers\Api;

use App\Announcements;
use App\Http\Requests\AnnouncementsRequest;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;

class AnnouncementsController extends BaseApiController
{
    public function index(AnnouncementsRequest $request)
    {
        try{
            $tbl_announcements = Announcements::query();
            $arrTbl_announcements = $tbl_announcements->get();
            $response = ['announcements' => $arrTbl_announcements];
            $this->_sendResponse($response, 'announcements listing Success');
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
    }
}
