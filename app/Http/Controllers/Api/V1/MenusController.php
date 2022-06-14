<?php
   
namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\MenusFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Menu as MenuResource;
use App\Models\Menu;
use Validator;

class MenusController extends BaseController
{


    public function show(Request $request)
    {
        $menu = Menu::find($request->id);
        if (is_null($menu)) {
            return $this->handleError('Menu not found!');
        }
        return $this->handleResponse(new MenuResource($menu), 'Menu retrieved.');
    }

    public function index(Request $request)
    {      
        $filter = new MenusFilter();
        $queryParams = $filter->transform($request);
        
        if(count($queryParams) > 0) {
            $menus = Menu::where($queryParams)->paginate(10);
        } else {
            $menus = Menu::paginate();
        }

        return $this->handleResponse(MenuResource::collection($menus)->response()->getData(true), 'Menus have been retrieved!');
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|unique:menus',
            'description' => 'required',
            'items' => 'required|array'
        ]);
        
        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }

        $menu = Menu::create($input);
        $menu->items()->sync($input['items']);

        return $this->handleResponse(new MenuResource($menu), 'Menu created!');
    }

    public function update(Request $request)
    {   
        $menu = Menu::findOrFail($request->id);
        $input = $request->all();

        $menu->fill($input)->save();
        $menu->items()->sync($input['items']);

        return $this->handleResponse(new MenuResource($menu), 'Menu created!');
    }

    public function delete(Request $request)
    {   
        $menu = Menu::findOrFail($request->id);
        $menu->delete();
        return $this->handleResponse([], 'Menu deleted!');
    }

}