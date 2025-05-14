<?php

namespace App\Http\Controllers\api;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index()
    {
        $respon = $this->get_dummy_data();

        $data = json_decode($respon, true); 

        return response()->json($data);
    }
    public function get_dummy_data()
    {
        try {
            $client = new Client();
    
            $res = $client->request('GET', 'https://dummyjson.com/products');
    
            $body = json_decode($res->getBody(), true);

            echo  $res->getBody();
    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
