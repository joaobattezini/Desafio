<?php
   
namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\OrdersFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Order as OrderResource;
use App\Models\Order;
use Validator;

class OrdersController extends BaseController
{


    public function index(Request $request)
    {      
        $filter = new OrdersFilter();
        $queryParams = $filter->transform($request);
        
        if(count($queryParams) > 0) {
            $orders = Order::where($queryParams)->paginate();
        } else {
            $orders = Order::paginate();
        }

        return $this->handleResponse(OrderResource::collection($orders)->response()->getData(true), 'Orders have been retrieved!');
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'id_client' => 'required',
            'id_table' => 'required',
            'id_user' => 'required'
        ]);
        
        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }

        $order = Order::create($input);
        return $this->handleResponse(new OrderResource($order), 'Order has been created!');
    }

}