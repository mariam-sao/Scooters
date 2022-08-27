<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Scoter;
use Validator;
use App\Http\Resources\ScoterResource;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
class APIScoterController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('scoter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scoters = Scoter::all();
    
        return $this->sendResponse(ScoterResource::collection($scoters), 'Scoters retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $scoter = Scoter::create($input);
   
        return $this->sendResponse(new ScoterResource($scoter), 'Scoter created successfully.');
    } 
   
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $scoter = Scoter::find($id);
  
        if (is_null($scoter)) {
            return $this->sendError('Scoter not found.');
        }
   
        return $this->sendResponse(new ScoterResource($scoter), 'Scoter retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scoter $scoter)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $scoter->name = $input['name'];
        $scoter->detail = $input['detail'];
        $scoter->save();
   
        return $this->sendResponse(new ScoterResource($scoter), 'Scoter updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scoter $scoter)
    {
        $scoter->delete();
        return $this->sendResponse([
            
        ], 'Scoter deleted successfully.');
    }
}