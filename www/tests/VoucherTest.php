<?php

use App\Recepient;
use App\Offer;
use App\Voucher;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class VoucherTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListVouchers()
    {
        $vouchers = Voucher::all();

        $response = $this->call('GET', '/api/vouchers');
        
        $this->assertEquals(200,$response->status());
        $this->assertEquals($response->content(),$vouchers->toJson());
    }

    public function testCreateVoucher()
    {
        $input = ["name"=>rand(),"email"=>rand()."@gmail.com"];
        $response = $this->call('PUT', '/api/recepients',$input);
        $recepient = json_decode($response->content());


        $input = ["name"=>rand(),"discount"=>rand(10,50)];
        $response = $this->call('PUT', '/api/offers',$input);
        $offer = json_decode($response->content());

        $input = ["recepient_id"=>$recepient->id,"offer_id"=>$offer->id];
        $response = $this->call('PUT', '/api/vouchers/'.$recepient->id,$input);

        $outcome = json_decode($response->content());

        $this->assertEquals(200,$response->status());
        $this->assertEquals($input['recepient_id'], $outcome->recepient_id);
        $this->assertEquals($input['offer_id'], $outcome->offer_id);
        //$this->assertNull($outcome->usage_date);
    }

    public function testRedeemVoucher()
    {
        $input = ["name"=>rand(),"email"=>rand()."@gmail.com"];
        $response = $this->call('PUT', '/api/recepients',$input);
        $recepient = json_decode($response->content());

        $input1 = ["name"=>rand(),"discount"=>rand(10,50)];
        $response = $this->call('PUT', '/api/offers',$input1);
        $offer = json_decode($response->content());


        $input2 = ["recepient_id"=>$recepient->id,"offer_id"=>$offer->id];
        $response = $this->call('PUT', '/api/vouchers/'.$recepient->id,$input2);
        $voucher = json_decode($response->content());

        $input3 = ["email"=>$recepient->email,"code"=>$voucher->code];
        $response = $this->call('POST', '/api/vouchers/redeem/'.$recepient->id,$input3);
        $outcome = json_decode($response->content());

        $this->assertEquals(200,$response->status());
        $this->assertEquals($recepient->id, $outcome->recepient->id);
        $this->assertEquals($offer->id, $outcome->offer->id);
        $this->assertEquals($input3['code'], $outcome->code);
        $this->assertNotNull($outcome->usage_date);
    }

}