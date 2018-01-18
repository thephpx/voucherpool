<?php

namespace App\Http\Controllers;

use App\Recepient;
use Illuminate\Http\Request;

class RecepientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index()
    {
        $recepient = Recepient::all();

        return response()->json($recepient);
    }

    public function get($id=0)
    {
        if($id > 0)
        {
            $recepient = Recepient::find($id)->first();

            if(isset($recepient->id))
            {
                return response()->json($recepient);
            }else{
                return response()->json(array('error'=>'Recepient not identifiable'));
            }
        }else{
            return response()->json(array('error'=>'Recepient not identifiable'));
        }
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $recepient = new Recepient();

        $recepient->name = $request->input('name');
        $recepient->email = $request->input('email');

        if($recepient->save()){
            return response()->json($recepient);
        }else{
            return response()->json(array('error'=>'Recepient creation failed'));
        }
    }

    public function update(Request $request,$id=0)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);
        
        if($id > 0){
            $recepient = Recepient::find($id);

            if(isset($recepient->id)){
                $recepient->name = $request->input('name');
                $recepient->email = $request->input('email');

                if($recepient->save()){
                    return response()->json($recepient);
                }else{
                    return response()->json(array('error'=>'Recepient update failed'));
                }
            }
        }else{
            return response()->json(array('error'=>'Recepient not identifiable'));
        }
    }

    public function delete($id=0)
    {
        if($id > 0)
        {
            $recepient = Recepient::find($id);
            if(isset($recepient->id)){
                if($recepient->delete()){
                    return response()->json(array('success'=>'Recepient deleted successfully'));
                }else{
                    return response()->json(array('error'=>'Recepient deletion failed'));
                }
            }
        }else{
            return response()->json(array('error'=>'Recepient not identifiable'));
        }
    }
}
