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


    public function LoginSimat(Request $request){
        try {
            $client = new Client();
            $username = $request->username;
            $password = $request->password;
            $res = $client->request('POST', 'https://api.unira.ac.id/v1/token',[
                'form_params' => [
                    'username' => $username,
                    'password' => $password,
                ],
            ]);
    
            $body = json_decode($res->getBody(), true);

            return response()->json($body   );
    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function GetDataSimat(Request $request){
      
        $token = $request->bearerToken();
        $client = new Client();
        $res = $client->request('GET', 'https://api.unira.ac.id/v1/saya', [ // Change to GET and correct the URL
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ])->getBody();
// 
        // $body = json_decode($res->getBody(), true);
        return json_decode($res);
    }
}
