<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    public function getTransactionData(Request $request)
    {
        if (Session::has('transaction_data')) {
            return response()->json([
                'status' => (bool)true,
                'data' => Session::get('transaction_data'),
            ], 200);
        } else {
            return response()->json([
                'status' => (bool)false,
                'message' => 'You have no pending transaction data',
            ], 404);
        }
    }
}
