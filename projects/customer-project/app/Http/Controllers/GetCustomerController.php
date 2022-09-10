<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetCustomerController extends Controller
{
    public function index(Request $request){
        $response = getAPIData('customers', $request); // Veriler Helpers/ApiSelfHelper.php'den çekildi.
        return view('customer.list', [
            'message' => $response->message,
            'customers' => $response->data
        ]);
    }
}
