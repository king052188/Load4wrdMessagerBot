<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalController extends Controller
{
    //
    public function Reg(Request $request) {
      return view('reg');
    }

    public function Dashboard(Request $request) {
      $type = 1;
      if(IsSet($request->type)) {
        $type = $request->type;
      }

      $data = array(
        "type" => $type
      );

      return view('portal.dashboard', compact('data'));
    }

    public function Wallet_Buy(Request $request) {
      return view('portal.wallet.buy');
    }

    public function Wallet_Sell(Request $request) {
      return view('portal.wallet.sell');
    }

    public function Wallet_Transaction(Request $request) {
      return view('portal.wallet.transaction');
    }
}
