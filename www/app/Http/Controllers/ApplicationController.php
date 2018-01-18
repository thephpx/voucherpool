<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Voucher;
class ApplicationController extends Controller
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
        $data = array();

        $data['total'] = Voucher::count();
        $data['used'] = Voucher::whereNotNull('usage_date')->count();
        $data['unused'] = Voucher::whereNull('usage_date')->count();

        return view('index',$data);
    }

    public function voucher($id=0)
    {
        $data = array();
        $data['id'] = $id;

        $data['offers'] = Offer::all();

        return view('vouchers',$data);
    }

    public function redeem($id=0)
    {
        $data = array();
        $data['id'] = $id;

        return view('redeem',$data);
    }
}
