<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrdersRequest;
use App\Orders;
use App\Scripts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends AppController
{
    public function index(OrdersRequest $request)
    {
        $queryParams = $request->has('queryParams') ? $request->queryParams : [];
        $limit = !empty($queryParams) ? $queryParams['per_page'] : 5;
        $sorts = !empty($queryParams) ? $queryParams['sort'] : [];
        $global_search = !empty($queryParams) ? '%' . $queryParams['global_search'] . '%' : '';
        $cust_id = $request->has('cust_id') ? $request->cust_id : 1;
        try {
            $tbl_orders = Orders::query();

            $tbl_orders->select(['tbl_orders.order_id', 'tbl_orders.cust_id', 'tbl_scripts.script_display_name',
                'tbl_orders.order_type', 'tbl_orders.order_price', 'tbl_orders.order_qty_original as total_qty', 'tbl_orders.lot_size',
                'tbl_orders.order_num']);

            $tbl_orders->selectRaw('tbl_orders.order_date time,
fun_check_order_status(tbl_orders.order_num) order_status');

            $tbl_orders->selectSub(function ($query) {
                $query->selectRaw('sum(match_qty)')
                    ->from('tbl_assignments')
                    ->whereColumn('tbl_assignments.order_number', '=', 'tbl_orders.order_num');
            }, 'match_qty');

            $tbl_orders->selectRaw("concat_ws('/',(select IFNULL(sum(match_qty),0) from tbl_assignments where tbl_assignments.order_number = tbl_orders.order_num), tbl_orders.order_qty_original) qty");

            $tbl_orders->selectSub(function ($query) {
                $query->selectRaw('IFNULL(sum(closed_qty * deal_price) / sum(closed_qty),0)')
                    ->from('tbl_assignments')
                    ->where('closed_qty', '>', 0)
                    ->whereColumn('order_number', '=', 'tbl_orders.order_num');
            }, 'average_price');

            $tbl_orders->selectSub(function ($query) {
                $query->selectRaw('IFNULL(sum(closed_qty),0)')
                    ->from('tbl_assignments')
                    ->whereColumn('order_number', '=', 'tbl_orders.order_num');
            }, 'delivered_qty');

            $tbl_orders->join('tbl_scripts', 'tbl_orders.script_id', '=', 'tbl_scripts.script_id');

            $tbl_orders->join('users', 'users.user_id', '=', 'tbl_orders.cust_id');

            $tbl_orders->whereRaw("fun_check_order_status(tbl_orders.order_num) in ('OPEN', 'DEALING')");

            $tbl_orders->where('tbl_orders.cust_id', '=', $cust_id);

            /*$tbl_orders->when(!empty($global_search), function ($query) use ($global_search){
               $searchFields = ['tbl_scripts.script_display_name','tbl_orders.order_type','tbl_orders.order_price', 'average_price','total_qty','tbl_orders.lot_size','tbl_orders.order_num','time'];
               $query->where(function ($que) use ($searchFields, $global_search){
                   foreach ($searchFields as $field){
                       $que->orWhere($field, 'LIKE', $global_search);
                   }
               });
            });
            $tbl_orders->when(!empty($sorts), function ($query) use ($sorts){
                $field = $sorts[0]['name'];
                $order = $sorts[0]['order'];
                $query->orderBy($field,$order);
            });
            $arrTbl_Orders = $tbl_orders->paginate($limit);*/

            $arrTbl_Orders = $tbl_orders->get();
            $response = ['orders' => $arrTbl_Orders];
            $this->_sendResponse($response, 'orders listing Success');
        } catch (\Exception $exception) {
            $this->_sendErrorResponse(500);
        }
    }

    public function indexPastList(OrdersRequest $request)
    {
        $queryParams = $request->has('queryParams') ? $request->queryParams : [];
        $limit = !empty($queryParams) ? $queryParams['per_page'] : 5;
        $sorts = !empty($queryParams) ? $queryParams['sort'] : [];
        $global_search = !empty($queryParams) ? '%' . $queryParams['global_search'] . '%' : '';
        $cust_id = $request->has('cust_id') ? $request->cust_id : 1;
        try {
            $tbl_orders = Orders::query();

            $tbl_orders->select(['tbl_orders.order_id', 'tbl_orders.cust_id', 'tbl_scripts.script_display_name',
                'tbl_orders.order_type', 'tbl_orders.order_num']);

            $tbl_orders->selectRaw('tbl_orders.order_date time, fun_check_order_status(tbl_orders.order_num) order_status');

            $tbl_orders->selectSub(function ($query) {
                $query->selectRaw('IFNULL(sum(closed_qty * deal_price) / sum(closed_qty),0)')
                    ->from('tbl_assignments')
                    ->where('closed_qty', '>', 0)
                    ->whereColumn('order_number', '=', 'tbl_orders.order_num');
            }, 'average_price');

            $tbl_orders->selectSub(function ($query) {
                $query->selectRaw('IFNULL(sum(closed_qty),0)')
                    ->from('tbl_assignments')
                    ->whereColumn('order_number', '=', 'tbl_orders.order_num');
            }, 'delivered_qty');

            $tbl_orders->join('tbl_scripts', 'tbl_orders.script_id', '=', 'tbl_scripts.script_id');

            $tbl_orders->join('users', 'users.user_id', '=', 'tbl_orders.cust_id');

            $tbl_orders->whereRaw("fun_check_order_status(tbl_orders.order_num) in ('CLOSED', 'CANCELLED')");

            $tbl_orders->where('tbl_orders.cust_id', '=', $cust_id);

            /*$tbl_orders->when(!empty($global_search), function ($query) use ($global_search){
               $searchFields = ['tbl_scripts.script_display_name','tbl_orders.order_type','tbl_orders.order_price', 'average_price','total_qty','tbl_orders.lot_size','tbl_orders.order_num','time'];
               $query->where(function ($que) use ($searchFields, $global_search){
                   foreach ($searchFields as $field){
                       $que->orWhere($field, 'LIKE', $global_search);
                   }
               });
            });
            $tbl_orders->when(!empty($sorts), function ($query) use ($sorts){
                $field = $sorts[0]['name'];
                $order = $sorts[0]['order'];
                $query->orderBy($field,$order);
            });
            $arrTbl_Orders = $tbl_orders->paginate($limit);*/

            $arrTbl_Orders = $tbl_orders->get();
            $response = ['orders' => $arrTbl_Orders];
            $this->_sendResponse($response, 'past orders listing Success');
        } catch (\Exception $exception) {
            $this->_sendErrorResponse(500);
        }
    }

    public function store(OrdersRequest $request)
    {
        try {

            $validation = [
                'cust_id' => 'required',
                'script_id' => 'required',
                'order_type' => 'required',
                'order_price' => 'required',
                'order_qty' => 'required',
                'lot_size' => 'required',
            ];

            $this->checkValidate($request, $validation);

            $order_id = $request->has('order_id') ? $request->order_id : '';
            $order_no = $request->has('order_no') ? $request->order_no : '';
            $cust_id = $request->has('cust_id') ? $request->cust_id : '';
            $script_id = $request->has('script_id') ? $request->script_id : '';
            $order_type = $request->has('order_type') ? $request->order_type : '';
            $order_price = $request->has('order_price') ? $request->order_price : '';
            $order_qty = $request->has('order_qty') ? $request->order_qty : '';
            $lot_size = $request->has('lot_size') ? $request->lot_size : '';
            $is_cancel_order = $request->has('is_cancel_order') ? $request->is_cancel_order : false;

            $isSuccess = true;

            if ($is_cancel_order == true) {
                $results = DB::select(DB::raw("SELECT fun_check_order_open_qty('$order_no') as qty"));
                $orderQuery = Orders::query();
                $orderQuery->where('order_id', '=', $order_id);
                $orderObj = $orderQuery->first();

                $order_qty = $orderObj->order_qty_original - $results[0]->qty;

                $isSuccess = Orders::where('order_id', '=', $order_id)
                    ->update(['order_qty_original' => $order_qty, 'order_date' => date('Y-m-d H:i:s')]);
            } else if (!empty($order_id)) {
                $isSuccess = Orders::where('order_id', '=', $order_id)
                    ->update(['order_price' => $order_price, 'order_qty_original' => $order_qty,
                        'lot_size' => $lot_size, 'order_date' => date('Y-m-d H:i:s')]);
            } else {
                $orderObj = new Orders;
                $orderObj->script_id = $script_id;
                $orderObj->order_type = strtoupper($order_type);
                $orderObj->placed_by = 'self';
                $orderObj->last_updated_by = 'self';
                $orderObj->cust_id = $cust_id;
                $orderObj->assigned_to = 'self';
                $orderObj->order_price = $order_price;
                $orderObj->order_qty_original = $order_qty;
                $orderObj->lot_size = $lot_size;
                $isSuccess = $orderObj->save();
            }

            if ($isSuccess) {
                $response = [];
                $this->_sendResponse($response, 'Orders ' . ucfirst($order_type) . ' Success');
            } else {
                $this->_sendErrorResponse(417, 'Order ' . ucfirst($order_type) . 'Fail');
            }
        } catch (\Exception $exception) {
            dd($exception);
            $this->_sendErrorResponse(500);
        }
    }

    public function getMarketDepth(Request $request)
    {
        try {
            $validation = [
                'script_id' => 'required'
            ];

            $this->checkValidate($request, $validation);

            $script_id = $request->has('script_id') ? $request->script_id : '';
            $scrip_name = strtoupper(str_replace('-',' ', $script_id));

            $scriptQuery = Scripts::query();
            $scriptQuery->where('script_display_name','=',$scrip_name);
            $scriptObj = $scriptQuery->first();
            if(empty($scriptObj)){
                $this->_sendErrorResponse(404);
            }
            $script_id = $scriptObj->script_id;

            $buyQuery = Orders::query();
            $buyQuery->select(['tbl_orders.*']);
            $buyQuery->selectRaw('fun_check_order_open_qty(tbl_orders.order_num) as qty');
            $buyQuery->where('script_id', '=', $script_id);
            $buyQuery->where('order_type', '=', 'BUY');
            $buyQuery->whereRaw("fun_check_order_status(tbl_orders.order_num) in ('OPEN', 'DEALING')");
            $buyQuery->orderByDesc('order_price');
            $buyQuery->orderBy('order_date');
            $buyQuery->limit(10);
            $buyObj = $buyQuery->get();

            $buySum = Orders::where('script_id', '=', $script_id)
                ->where('order_type', '=', 'BUY')->sum('order_qty_original');

            $sellQuery = Orders::query();
            $sellQuery->select(['tbl_orders.*']);
            $sellQuery->selectRaw('fun_check_order_open_qty(tbl_orders.order_num) as qty');
            $sellQuery->where('script_id', '=', $script_id);
            $sellQuery->where('order_type', '=', 'SELL');
            $sellQuery->whereRaw("fun_check_order_status(tbl_orders.order_num) in ('OPEN', 'DEALING')");
            $sellQuery->orderBy('order_price');
            $sellQuery->orderBy('order_date');
            $sellQuery->limit(10);
            $sellObj = $sellQuery->get();

            $sellSum = Orders::where('script_id', '=', $script_id)
                ->where('order_type', '=', 'SELL')->sum('order_qty_original');

            $response = ['buy' => $buyObj, 'buy_total' => $buySum, 'sell' => $sellObj, 'sell_total' => $sellSum, 'script' => $scriptObj];
            $this->_sendResponse($response, 'order listed successfully');
        } catch (\Exception $exception) {
            $this->_sendErrorResponse(500);
        }
    }

    public function show($id)
    {
        try {
            $tbl_orders = Orders::query();
            $tbl_orders->where('order_id', '=', $id);
            $tbl_orders->select(['tbl_orders.*']);
            $tbl_orders->selectRaw('fun_check_order_open_qty(tbl_orders.order_num) as qty');
            $tbl_orders->with(['script']);
            $orderObj = $tbl_orders->first();
            if (!empty($orderObj)) {
                $response = ['order' => $orderObj];
                $this->_sendResponse($response, 'Orders found success');
            }
            $this->_sendErrorResponse(404, 'No Order Found');
        } catch (\Exception $exception) {
            dd($exception);
            $this->_sendErrorResponse(500);
        }
    }

    /*


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
