<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrdersRequest;
use App\Orders;
use App\Scripts;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;
use Illuminate\Http\Request;

class OrdersController extends AppController
{
    public function index(OrdersRequest $request)
    {
        $queryParams = $request->has('queryParams') ? $request->queryParams : [];
        $limit = !empty($queryParams) ? $queryParams['per_page'] : 5;
        $sorts = !empty($queryParams) ? $queryParams['sort'] : [];
        $global_search = !empty($queryParams) ? '%'.$queryParams['global_search'].'%' : '';
        $cust_id = $request->has('cust_id') ? $request->cust_id : 1;
        try{
            $tbl_orders = Orders::query();

            $tbl_orders->select(['tbl_orders.order_id', 'tbl_orders.cust_id', 'tbl_scripts.script_display_name',
                'tbl_orders.order_type','tbl_orders.order_price', 'tbl_orders.order_qty_original as total_qty', 'tbl_orders.lot_size',
                'tbl_orders.order_num']);

            $tbl_orders->selectRaw('tbl_orders.order_date time,
fun_check_order_status(tbl_orders.order_num) order_status');

            $tbl_orders->selectSub(function ($query){
                $query->selectRaw('sum(match_qty)')
                    ->from('tbl_assignments')
                    ->whereColumn('tbl_assignments.order_number', '=' , 'tbl_orders.order_num');
            },'match_qty');

            $tbl_orders->selectRaw("concat_ws('/',(select sum(match_qty) as match_qty from tbl_assignments where tbl_assignments.order_number = tbl_orders.order_num), tbl_orders.order_qty_original) qty");

            $tbl_orders->selectSub(function ($query){
                $query->selectRaw('sum(closed_qty * deal_price) / sum(closed_qty)')
                    ->from('tbl_assignments')
                    ->where('closed_qty', '>' , 0)
                    ->whereColumn('order_number', '=' , 'tbl_orders.order_num');
            },'average_price');

            $tbl_orders->selectSub(function ($query){
                $query->selectRaw('sum(closed_qty)')
                    ->from('tbl_assignments')
                    ->whereColumn('order_number', '=' , 'tbl_orders.order_num');
            },'delivered_qty');

            $tbl_orders->join('tbl_scripts','tbl_orders.script_id','=','tbl_scripts.script_id');

            $tbl_orders->join('users','users.user_id','=','tbl_orders.cust_id');

            $tbl_orders->whereRaw("fun_check_order_status(tbl_orders.order_num) in ('OPEN', 'DEALING')");

            $tbl_orders->where('tbl_orders.cust_id','=',$cust_id);

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
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
    }

    public function indexPastList(OrdersRequest $request)
    {
        $queryParams = $request->has('queryParams') ? $request->queryParams : [];
        $limit = !empty($queryParams) ? $queryParams['per_page'] : 5;
        $sorts = !empty($queryParams) ? $queryParams['sort'] : [];
        $global_search = !empty($queryParams) ? '%'.$queryParams['global_search'].'%' : '';
        $cust_id = $request->has('cust_id') ? $request->cust_id : 1;
        try{
            $tbl_orders = Orders::query();

            $tbl_orders->select(['tbl_orders.order_id', 'tbl_orders.cust_id', 'tbl_scripts.script_display_name',
                'tbl_orders.order_type', 'tbl_orders.order_num']);

            $tbl_orders->selectRaw('tbl_orders.order_date time,
fun_check_order_status(tbl_orders.order_num) order_status');

            $tbl_orders->selectSub(function ($query){
                $query->selectRaw('sum(closed_qty * deal_price) / sum(closed_qty)')
                    ->from('tbl_assignments')
                    ->where('closed_qty', '>' , 0)
                    ->whereColumn('order_number', '=' , 'tbl_orders.order_num');
            },'average_price');

            $tbl_orders->selectSub(function ($query){
                $query->selectRaw('sum(closed_qty)')
                    ->from('tbl_assignments')
                    ->whereColumn('order_number', '=' , 'tbl_orders.order_num');
            },'delivered_qty');

            $tbl_orders->join('tbl_scripts','tbl_orders.script_id','=','tbl_scripts.script_id');

            $tbl_orders->join('users','users.user_id','=','tbl_orders.cust_id');

            $tbl_orders->whereRaw("fun_check_order_status(tbl_orders.order_num) in ('CLOSED', 'DEALING')");

            $tbl_orders->where('tbl_orders.cust_id','=',$cust_id);

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
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
    }

    public function store(OrdersRequest $request)
    {
        try{

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
            $cust_id = $request->has('cust_id') ? $request->cust_id : '';
            $script_id = $request->has('script_id') ? $request->script_id : '';
            $order_type = $request->has('order_type') ? $request->order_type : '';
            $order_price = $request->has('order_price') ? $request->order_price : '';
            $order_qty = $request->has('order_qty') ? $request->order_qty : '';
            $lot_size = $request->has('lot_size') ? $request->lot_size : '';

            $isSuccess = true;

            if(!empty($order_id)){
                $isSuccess = Orders::where('order_id', '=', $order_id)
                    ->update(['order_price' => $order_price, 'order_qty_original' => $order_qty, 'lot_size' => $lot_size]);
            } else {
                $orderObj = New Orders;
                $orderObj->script_id = $script_id;
                $orderObj->order_type = $order_type;
                $orderObj->placed_by = 'self';
                $orderObj->last_updated_by = 'self';
                $orderObj->cust_id = $cust_id;
                $orderObj->assigned_to = 'self';
                $orderObj->order_price = $order_price;
                $orderObj->order_qty_original = $order_qty;
                $orderObj->lot_size = $lot_size;
                $isSuccess = $orderObj->save();
            }

            if($isSuccess){
                $response = [];
                $this->_sendResponse($response, 'Orders '. ucfirst($order_type) .' Success');
            } else {
                $this->_sendErrorResponse(417,'Order '. ucfirst($order_type) .'Fail');
            }
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
    }

    public function getMarketDepth(Request $request){
        try {
            $validation = [
                'script_id' => 'required'
            ];

            $this->checkValidate($request, $validation);

            $script_id = $request->has('script_id') ? $request->script_id : '';

            $buyQuery = Orders::query();
            $buyQuery->where('script_id','=', $script_id);
            $buyQuery->where('order_type','=','Buy');
            $buyQuery->whereRaw("fun_check_order_status(tbl_orders.order_num) in ('OPEN', 'DEALING')");
            $buyQuery->orderByDesc('order_price');
            $buyQuery->orderByDesc('updated_at');
            $buyQuery->limit(10);
            $buyObj = $buyQuery->get();

            $buySum = Orders::where('script_id','=', $script_id)
                ->where('order_type','=','Buy')->sum('order_qty_original');

            $sellQuery = Orders::query();
            $sellQuery->where('script_id','=',$script_id);
            $sellQuery->where('order_type','=','Sell');
            $sellQuery->whereRaw("fun_check_order_status(tbl_orders.order_num) in ('OPEN', 'DEALING')");
            $sellQuery->orderByDesc('order_price');
            $sellQuery->orderByDesc('updated_at');
            $sellQuery->limit(10);
            $sellObj = $sellQuery->get();

            $sellSum = Orders::where('script_id','=', $script_id)
                ->where('order_type','=','Sell')->sum('order_qty_original');

            $scriptQuery = Scripts::query();
            $scriptQuery->where('script_id','=', $script_id);
            $scriptObj = $scriptQuery->first();

            $response = ['buy' => $buyObj, 'buy_total' => $buySum, 'sell' => $sellObj, 'sell_total' => $sellSum, 'script' => $scriptObj];
            $this->_sendResponse($response, 'order listed successfully');
        } catch (\Exception $exception) {
            $this->_sendErrorResponse(500);
        }
    }

    public function show($id)
    {
        try{
            $tbl_orders = Orders::query();
            $tbl_orders->where('order_id', '=', $id);
            $tbl_orders->with(['script']);
            $orderObj = $tbl_orders->first();
            if(!empty($orderObj)){
                $response = ['order' => $orderObj];
                $this->_sendResponse($response, 'Orders found success');
            }
            $this->_sendErrorResponse(404,'No Order Found');
        } catch (\Exception $exception){
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
