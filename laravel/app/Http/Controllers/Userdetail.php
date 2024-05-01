<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank_detail;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\Withdarwal;
use App\Models\User;
use App\Models\Setting;

class Userdetail extends Controller
{
    public function deposit_withdrawal() {
        $deposit = Transaction::where('userid',user('id'))->orderBy('id','desc')->get();
    //    print_r($deposit); die;
        return view('deposit_withdrawals',compact("deposit"));
    }
    public function profile () {
        $bank = Bank_detail::where('userid',user('id'))->first();
        return view('profile',compact("bank"));
        
    }

    // Api Data Transfer
    public function withdrawal_list(){
        $data = "";
        $isSuccess = false;
        $message = "Something went wrong!";
        $bank = Bank_detail::where('userid',user('id'))->first();
        //    print_r($bank); die;
        $transaction = Transaction::select("id","platform","amount","remark","status","created_at")->where('type','debit')->where('category','withdraw')->get();
        // return $transaction;
        $draw = "draw";
        $aaData = $transaction;
        $iTotalDisplayRecords = 0;
        $iTotalRecords = 0;

        $data = array("aaData"=>$aaData,"iTotalDisplayRecords"=>$iTotalDisplayRecords,"iTotalRecords"=>$iTotalRecords,"draw"=>$draw);
        $isSuccess = true;
        $res = array("data" => $data, "isSuccess" => $isSuccess, "message" => $message);
        return response()->json($res);
    }
    public function insertwithdrawal(Request $r){
        $validated = $r->validate([
            'account_no' => 'required',
            'account_holder_name' => 'required',
            'name' => 'required',
            'ifsc_code' => 'required',
            'upi_id' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        $withdraw = new Withdarwal;
        $withdraw->account_no = $r->account_no;
        $withdraw->account_holder_name = $r->account_holder_name;
        $withdraw->name = $r->name;
        $withdraw->ifsc_code = $r->ifsc_code;
        $withdraw->upi_id = $r->upi_id;
        $withdraw->mobile_no = $r->mobile_no;
        $withdraw->email = $r->email;
        $withdraw->address = $r->address;
        $withdraw->save();
        
        $transaction = new Transaction;
        $transaction->userid = user('id');
        $transaction->type = user('id');
        $transaction->platform = user('id');
        $transaction->amount = user('id');
        $transaction->category = user('id');
        $transaction->remark = user('id');
        $transaction->status = user('id');
        $transaction->save();
        
        return redirect("/dashboard");
        
    }
    public function get_user_detail() {
        $data = "";
        $isSuccess = false;
        $message = "Something went wrong!";
        $notification = "";
        $avatar = User::where('id', user('id'))->pluck('image');
        if($avatar) {
            $avatar = json_decode(json_encode ( $avatar ) , true);
        } else {
            $avatar = "images/avtar/av-1.png";
        }
        $getDepostTransactions = Transaction::where('userid',user('id'))->where('category', 'recharge')->where('status', 1)->count();
        // $getDepostTransactions = Transaction::where('userid',user('id'))->where('category', 'recharge')->count();
        $isFirstDeposit = false;
        $initialBonus = 0;
        if($getDepostTransactions == 0) {
            $isFirstDeposit = true;
            $initialBonus = Setting::where('category', 'deposit_bonus')->get();
            $initialBonus = $initialBonus[0]['value'];
        }
        $data = array("username"=>user('id'),"avatar"=>$avatar,"notification"=>$notification, "isFirstDeposit" => $isFirstDeposit, "initialBonus" => $initialBonus);
        $message = "Success";
        $isSuccess = true;
        $res = array("data" => $data, "isSuccess" => $isSuccess, "message" => $message);
        return response()->json($res);
    }
    public function is_login() {
        $data = "";
        $isSuccess = false;
        $message = "Something went wrong!";
        if (session()->has('userlogin')) {
            $message = "Success";
            $isSuccess = true;
        }
        $res = array("data" => $data, "isSuccess" => $isSuccess, "message" => $message);
        return response()->json($res);
    }

    public function wallet_transfer(Request $r){
        $userid = $r->userid;
        $amount = $r->amount;
        $message = "";
        $isSuccess = false;
        $exist = User::where('id',$userid)->where('isadmin' , null)->first();
        if ($exist) {
            if (wallet(user('id'),'num') > 0 && wallet(user('id'),'num') >= $amount) {
                addwallet($userid,$amount);
                addtransaction($userid, 'Transfer By ~'.user('id'), date("ydmhsi"), 'credit', $amount, 'transfer', 'Success', '1');
                addwallet(user('id'),$amount,'-');
                addtransaction(user('id'), 'Transfer To~'.$userid, date("ydmhsi"), 'debit', $amount, 'transfer', 'Success', '1');
                $message = "Success";
                $isSuccess = true;
            }else {
                $message = "Amount not enough!!";
            }
        }else{
            $message = "User Id not found!!";
        }
        $res = array("isSuccess" => $isSuccess, "message" => $message);
        return response()->json($res);
    }
}