<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
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
        $recepient = Offer::all();

        return response()->json($recepient);
    }

    public function get($id=0)
    {
        if($id > 0)
        {
            $recepient = Offer::find($id)->first();

            if(isset($recepient->id))
            {
                return response()->json($recepient);
            }else{
                return response()->json(array('error'=>'Offer not identifiable'));
            }
        }else{
            return response()->json(array('error'=>'Offer not identifiable'));
        }
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'discount' => 'required'
        ]);

        $recepient = new Offer();

        $recepient->name = $request->input('name');
        $recepient->discount = (float) $request->input('discount');

        if($recepient->save()){
            return response()->json($recepient);
        }else{
            return response()->json(array('error'=>'Offer creation failed'));
        }
    }

    public function update(Request $request,$id=0)
    {
        $this->validate($request, [
            'name' => 'required',
            'discount' => 'required'
        ]);

        if($id > 0){
            $recepient = Offer::find($id);

            if(isset($recepient->id)){
                $recepient->name = $request->input('name');
                $recepient->discount = (float) $request->input('discount');

                if($recepient->save()){
                    return response()->json($recepient);
                }else{
                    return response()->json(array('error'=>'Offer update failed'));
                }
            }
        }else{
            return response()->json(array('error'=>'Offer not identifiable'));
        }
    }

    public function delete($id=0)
    {
        if($id > 0)
        {
            $recepient = Offer::find($id);
            if(isset($recepient->id)){
                if($recepient->delete()){
                    return response()->json(array('success'=>'Offer deleted successfully'));
                }else{
                    return response()->json(array('error'=>'Offer deletion failed'));
                }
            }
        }else{
            return response()->json(array('error'=>'Offer not identifiable'));
        }
    }
}
