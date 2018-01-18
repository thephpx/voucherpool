<?php

namespace App\Http\Controllers;

use App\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $voucher = Voucher::all();

        return response()->json($voucher);
    }

    public function get($id=0)
    {
        if($id > 0)
        {
            $voucher = Voucher::where('recepient_id','=',$id)->with(['Recepient','Offer'])->get();

            if($voucher->count() > 0)
            {
                $rows = $voucher->all();
                return response()->json($rows);
            }else{
                return response()->json(array());
            }
        }else{
            return response()->json(array('error'=>'Voucher not identifiable'));
        }
    }

    public function create(Request $request,$id = 0)
    {
        $this->validate($request, [
            'recepient_id' => 'required',
            'offer_id' => 'required'
        ]);

        if(Voucher::where('recepient_id','=',$request->input('recepient_id'))->where('offer_id','=',$request->input('offer_id'))->count() == 0){

            $voucher = new Voucher();

            $voucher->recepient_id = $request->input('recepient_id');
            $voucher->offer_id = $request->input('offer_id');

            $voucher->expiry_date = date("Y-m-d H:i:s", strtotime("+7 days"));

            $random_string = str_random(8);
            
            while(Voucher::where('code','=',$random_string)->count() > 0)
            {
                $random_string = str_random(8);
            }

            $voucher->code = $random_string;

            if($voucher->save()){
                return response()->json($voucher);
            }else{
                return response()->json(array('error'=>'Voucher creation failed'));
            }

        }else{
            return response()->json(array('error'=>'Voucher already exists!'));
        }
    }

    public function redeem(Request $request,$id = 0){
        $this->validate($request, [
            'email' => 'required|email',
            'code' => 'required'
        ]);

        $current_date = date("Y-m-d H:i:s");

        $voucher = Voucher::with(['Recepient','Offer'])->where('code','=',$request->input('code'))->whereNull('usage_date')->where('expiry_date','>=',$current_date)->first();

        if(isset($voucher->id) AND $voucher->recepient->email === $request->input('email'))
        {
            $voucher->usage_date = date("Y-m-d H:i:s");
            if($voucher->save())
            {
                return response()->json($voucher);
            }else{
                return response()->json(array('error'=>'Voucher redeem failed'));
            }

        }else{
            return response()->json(array('error'=>'Voucher not identifiable / expired / already used.'));
        }

    }


}
