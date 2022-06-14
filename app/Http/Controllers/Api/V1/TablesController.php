<?php
   
namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\TablesFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Client as ClientResource;
use App\Models\Table;
use Validator;

class TablesController extends BaseController
{

    public function index(Request $request)
    {      
        $filter = new TablesFilter();
        $queryParams = $filter->transform($request);
        
        if(count($queryParams) > 0) {
            $tables = Table::where($queryParams)->paginate(10);
        } else {
            $tables = Table::paginate(100);
        }

        return $this->handleResponse(new ClientResource($tables), 'Tables have been retrieved!');
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'number' => 'required|numeric|unique:tables',
        ]);
        
        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }

        $table = Table::create($input);
        return $this->handleResponse(new ClientResource($table), 'Table created!');
    }

}