<?php

use App\Recepient;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RecepientTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListRecepients()
    {
        $recepients = Recepient::all();

        $response = $this->call('GET', '/api/recepients');

        $this->assertEquals(200,$response->status());
        $this->assertEquals($response->content(),$recepients->toJson());
    }

    public function testCreateRecepient()
    {
        $input = ["name"=>rand(),"email"=>rand()."@gmail.com"];
        $response = $this->call('PUT', '/api/recepients',$input);

        $outcome = json_decode($response->content());
        
        $this->assertEquals(200,$response->status());
        $this->assertEquals($input['email'], $outcome->email);
    }

    public function testValidateCreateRecepient()
    {
        $input = ["name"=>rand(),"email"=>rand()];
        $response = $this->call('PUT', '/api/recepients',$input);

        $this->assertContains("email must be a valid email",$response->content());

        $input = ["name"=>rand(),"email"=>""];
        $response = $this->call('PUT', '/api/recepients',$input);

        $this->assertContains("required",$response->content());

        $input = ["name"=>""];
        $response = $this->call('PUT', '/api/recepients',$input);

        $this->assertContains("required",$response->content());

    }

    public function testUpdateRecepient()
    {
        for($i=0;$i < rand(5,10); $i++){
            $input = ["name"=>rand(),"email"=>rand()."@gmail.com"];
            $response = $this->call('PUT', '/api/recepients',$input);
        }

        $recepient = Recepient::inRandomOrder()->get()->first();

        $input = ["name"=>rand(),"email"=>rand()."@gmail.com"];

        $response = $this->call('POST', '/api/recepients/'.$recepient->id,$input);
        $outcome = json_decode($response->content());

        $this->assertEquals(200,$response->status());
        $this->assertEquals($input['email'],$outcome->email);

    }

    public function testValidateUpdateRecepient()
    {
        $input = ["name"=>rand(),"email"=>rand()."@gmail.com"];
        $response = $this->call('PUT', '/api/recepients',$input);
        
        $recepient = Recepient::all()->first();

        $input = ["name"=>rand(),"email"=>rand()];
        $response = $this->call('POST', '/api/recepients/'.$recepient->id, $input);

        $this->assertContains("email must be a valid email",$response->content());

        $input = ["name"=>rand(),"email"=>""];
        $response = $this->call('POST', '/api/recepients/'.$recepient->id, $input);

        $this->assertContains("required",$response->content());

        $input = ["name"=>""];
        $response = $this->call('POST', '/api/recepients/'.$recepient->id, $input);

        $this->assertContains("required",$response->content());

    }

    public function testDeleteRecepient()
    {   
        for($i=0;$i < rand(5,10); $i++){
            $input = ["name"=>rand(),"email"=>rand()."@gmail.com"];
            $response = $this->call('PUT', '/api/recepients',$input);
        }

        $recepient = Recepient::inRandomOrder()->get()->first();
        $response = $this->call('DELETE', '/api/recepients/'.$recepient->id);

        $this->assertEquals(200,$response->status());
        $this->assertEquals(0,Recepient::where('id','=',$recepient->id)->count());
    }
}
