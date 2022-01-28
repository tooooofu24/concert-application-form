<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function getAddress(Request $request)
    {
        $response = Http::get("https://zipcloud.ibsnet.co.jp/api/search", [
            'zipcode' => $request->zip
        ]);
        if ($response->json()['status'] != 200) {
            return response("", 200)->header('Content-Type', 'text/plain');
        }
        $address = $response->json()['results'][0]['address1'] . $response->json()['results'][0]['address2'] . $response->json()['results'][0]['address3'];
        return response($address, 200)->header('Content-Type', 'text/plain');
    }

    /**
     * メールアドレスが重複していなければtrueを返す
     * 
     * @param Request $request
     * 
     * @return bool
     */
    public function checkEmail(Request $request): bool
    {
        if (Ticket::where('email', $request->email)
            ->where('name', $request->name)
            ->exists()
        ) {
            return true;
        }
        return false;
    }
}
