<?php

use App\Offer;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class OfferTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListOffers()
    {
        $offers = Offer::all();

        $response = $this->call('GET', '/api/offers');

        $this->assertEquals(200,$response->status());
        $this->assertEquals($response->content(),$offers->toJson());
    }

    public function testCreateOffer()
    {
        $input = ["name"=>rand(),"discount"=>rand(10,50)];
        $response = $this->call('PUT', '/api/offers',$input);

        $outcome = json_decode($response->content());
        
        $this->assertEquals(200,$response->status());
        $this->assertEquals($input['name'], $outcome->name);
    }

    public function testValidateCreateOffer()
    {
        $input = ["name"=>"","discount"=>rand(10,50)];
        $response = $this->call('PUT', '/api/offers',$input);

        $this->assertContains("required",$response->content());

        $input = ["name"=>rand(),"discount"=>""];
        $response = $this->call('PUT', '/api/offers',$input);

        $this->assertContains("required",$response->content());

    }

    public function testUpdateRecepient()
    {
        for($i=0;$i < rand(5,10); $i++){
            $input = ["name"=>rand(),"discount"=>rand(10,50)];
            $response = $this->call('PUT', '/api/offers',$input);
        }

        $offer = Offer::inRandomOrder()->get()->first();

        $input = ["name"=>rand(),"discount"=>rand(10,50)];

        $response = $this->call('POST', '/api/offers/'.$offer->id,$input);
        $outcome = json_decode($response->content());

        $this->assertEquals(200,$response->status());
        $this->assertEquals($input['name'],$outcome->name);

    }

    public function testValidateUpdateOffer()
    {
        $input = ["name"=>rand(),"discount"=>rand(10,50)];
        $response = $this->call('PUT', '/api/offers',$input);

        $offer = Offer::all()->first();

        $input = ["name"=>"","discount"=>rand(10,50)];
        $response = $this->call('POST', '/api/offers/'.$offer->id,$input);
        $this->assertContains("required",$response->content());

        $input = ["name"=>rand(),"discount"=>""];
        $response = $this->call('POST', '/api/offers/'.$offer->id,$input);
        $this->assertContains("required",$response->content());

    }

    public function testDeleteOffer()
    {   
        for($i=0;$i < rand(5,10); $i++){
            $input = ["name"=>rand(),"discount"=>rand(10,50)];
            $response = $this->call('PUT', '/api/offers',$input);
        }

        $offer = Offer::inRandomOrder()->get()->first();
        $response = $this->call('DELETE', '/api/offers/'.$offer->id);

        $this->assertEquals(200,$response->status());
        $this->assertEquals(0,Offer::where('id','=',$offer->id)->count());
    }
}