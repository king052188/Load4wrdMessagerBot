<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\DealerType;
use App\Wallet;
use App\SMSQueue;
use App\ProductCode;
use Carbon\Carbon;
use DB;

class PortalController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
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
