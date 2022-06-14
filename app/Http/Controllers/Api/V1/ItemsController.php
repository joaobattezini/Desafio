<?php
   
namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\MenusFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Item as ItemResource;
use App\Models\Item;
use Validator;

class ItemsController extends BaseController
{


    public function show(Request $request)
    {
        $item = Item::find($request->id);
        if (is_null($item)) {
            return $this->handleError('Item not found!');
        }
        return $this->handleResponse(new ItemResource($item), 'Item retrieved.');
    }

    public function index(Request $request)
    {      
        $filter = new MenusFilter();
        $queryParams = $filter->transform($request);
        
        if(count($queryParams) > 0) {
            $items = Item::where($queryParams)->paginate(10);
        } else {
            $items = Item::paginate();
        }

        return $this->handleResponse(ItemResource::collection($items)->response()->getData(true), 'Items have been retrieved!');
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|unique:menus',
            'description' => 'required',
            'unit_price' => 'required|integer'
        ]);
        
        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }

        $item = Item::create($input);

        return $this->handleResponse(new ItemResource($item), 'Item created!');
    }

    public function update(Request $request)
    {   
        $item = Item::findOrFail($request->id);
        $input = $request->all();

        $item->fill($input)->save();

        return $this->handleResponse(new ItemResource($item), 'Item created!');
    }

    public function delete(Request $request)
    {   
        $item = Item::findOrFail($request->id);
        $item->delete();
        return $this->handleResponse([], 'Item deleted!');
    }

}