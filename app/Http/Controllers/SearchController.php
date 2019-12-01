<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use App\Http\Requests\FlightRequest;
use App\Http\Requests\SearchRequest;


class SearchController extends Controller
{
    public function city(){

        return view('search.search');

    }

    public function find(SearchRequest $request){
        $input = $request->validated();
        $input = array(

          'departure_city'=>'london',
          'destination_city'=>'london',
        );
        $client = new Client([
            'base_uri' => 'http://www.ije-api.tcore.xyz',
          ]);
          /*$data = [
            'created' => 2
          ];*/
    
          $response = $client->request('GET','/v1/plugins/airports-type-ahead/london', [
            'query' => ['destination'=>$input['departure_city']], 
            'auth' => ['', ''],
            'headers' => [
              'Content-Type' => 'application/json',
              'X-Application' => '4tergdrfsfwrfesf3453rfg'
            ],
            //'debug' => TRUE,
            #'body' => json_encode($data)
          ]);
          
          $departure = json_decode($response->getBody()->getContents(), true);
          #dd($departure)."<br>";
          
          $response = $client->request('GET','/v1/plugins/airports-type-ahead/berlin',[
            'query' => ['destination'=>$input['destination_city']],
            'auth' => ['', ''],
            'headers' => [
              'Content-Type' => 'application/json',
              'X-Application' => '4tergdrfsfwrfesf3453rfg'
            ],
            //'debug' => TRUE,
            'body' => json_encode($data)
          ]);
    
          $city_destination = $response->getBody()->getContents();
          #dd($city_destination);
          $destination = json_decode($city_destination,true);
          #dd($destination);
          return view('search.index')->with('departure',$departure);
          

    }

    public function flight(FlightRequest $request){

          $input = $request->validated();
          $client = new Client([
            'base_uri' => 'http://www.ije-api.tcore.xyz',
          ]);
          $data = [
            'created' => 2
          ];
          $response = $client->request('POST','/v1/flight/search-flight', [
            'auth' => ['', ''],
            'headers' => [
              'Content-Type' => 'application/json',
              'X-Application' => '4tergdrfsfwrfesf3453rfg'
            ],
              'form_params' => [
                  'cookie' =>'dkdkddddldldldk',
                  'departure_city' => $input['departure_city'],
                  'destination_city' => $input['destination_city'],
                  'departure_date	' => $input['departure_date'],
                  'return_date	' => $input['return_date'],
                  'no_of_adult' => $input['adult'],
                  'no_of_child' => $input['children'],
                  'cabin' => $input['cabin'],
                  'calendar' => 1,	
              ],
              'body' => json_encode($data)
          ]);
          $body = $E->getResponse()->getBody();
          $response = $body->getContents();
          #$response = $response->getBody()->getContents();
          dd($response);
  
               
    }

}
