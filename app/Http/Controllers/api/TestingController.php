<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;

class TestingController extends Controller
{


    public function index()
    {
        $respon = $this->get_dummy_data();

        $data = json_decode($respon, true); 

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
    public function get_dummy_data()
    {
        try {
            $client = new Client();
            
            $res = $client->request('GET', 'https://dummyjson.com/users', [
                'auth' => ['user', 'pass'] 
            ])->getBody();
    
            $body = json_decode($res, true);
    
            return response()->json($body, 200);
    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
