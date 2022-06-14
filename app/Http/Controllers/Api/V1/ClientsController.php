<?php
   
namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\ClientsFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Client as ClientResource;
use App\Models\Client;
use Validator;

class ClientsController extends BaseController
{

    public function index(Request $request)
    {      
        $filter = new ClientsFilter();
        $queryParams = $filter->transform($request);
        
        if(count($queryParams) > 0) {
            $clients = Client::where($queryParams)->paginate(10);
        } else {
            $clients = Client::paginate(100);
        }

        return $this->handleResponse(new ClientResource($clients), 'Clients have been retrieved!');
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'cpf' => 'required|cpf'
        ]);
        
        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }

        $client = Client::create($input);
        return $this->handleResponse(new ClientResource($client), 'Client created!');
    }

}