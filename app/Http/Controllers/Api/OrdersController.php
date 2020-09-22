<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrdersRequest;
use App\Orders;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;

class OrdersController extends AppController
{
    /*public function index(OrdersRequest $request)
    {
        $limit = isset($request->limit) ? $request->limit : config('app.default_limit');
        try{
            $tbl_orders = Orders::latest();
            $arrTbl_Orders = $tbl_orders->paginate($limit);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_orders' => $arrTbl_Orders];
        $this->_sendResponse($response, 'tbl_orders listing Success');
    }*/

    public function store(OrdersRequest $request)
    {
        try{

            $validation = [
                'script_id' => 'required',
                'order_type' => 'required',
                'order_price' => 'required',
                'order_qty' => 'required',
                'lot_size' => 'required',
            ];

            $this->checkValidate($request, $validation);

            $script_id = $request->has('script_id') ? $request->script_id : '';
            $order_type = $request->has('order_type') ? $request->order_type : '';
            $order_price = $request->has('order_price') ? $request->order_price : '';
            $order_qty = $request->has('order_qty') ? $request->order_qty : '';
            $lot_size = $request->has('lot_size') ? $request->lot_size : '';

            $orderObj = New Orders;
            $orderObj->script_id = $script_id;
            $orderObj->order_type = $order_type;
            $orderObj->order_price = $order_price;
            $orderObj->order_qty_original = $order_qty;
            $orderObj->lot_size = $lot_size;
            $orderObj->placed_by = 'self';
            $orderObj->last_updated_by = 'self';
            $orderObj->cust_id = 1;
            $orderObj->assigned_to = 'self';
            if($orderObj->save()){
                $response = [];
                $this->_sendResponse($response, 'Orders '. ucfirst($order_type) .' Success');
            } else {
                $this->_sendErrorResponse(417,'Order '. ucfirst($order_type) .'Fail');
            }
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
    }
/*
    public function show($id)
    {
        try{
            $tbl_orders = Orders::findOrFail($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_orders' => $tbl_orders];
        $this->_sendResponse($response, 'tbl_orders found success');
    }

    public function update(OrdersRequest $request, $id)
    {
        try{
            $tbl_orders = Orders::findOrFail($id);
            $tbl_orders->update($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_orders' => $tbl_orders];
        $this->_sendResponse($response, 'tbl_orders update success');
    }

    public function destroy($id)
    {
        try{
            $tbl_orders = Orders::destroy($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(204);
        }
        $response = ['tbl_orders' => $tbl_orders];
        $this->_sendResponse($response, 'tbl_orders delete successfully');
    }*/
}
