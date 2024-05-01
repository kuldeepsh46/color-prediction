<?php

namespace App\Http\Controllers;

use App\Models\Bankdetail;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Userbit;
use App\Models\Ticket;
use Carbon\Carbon;


class Admin extends Controller
{
    public function login()
    {
        return view("admin.login");
    }
    public function dashboard()
    {
        $user = User::where('isadmin', null)->get();
        $today_active = User::where('active_today', '>=', Carbon::today()->toDateString())->get();
        $total_business = Transaction::where('category', 'recharge')->where('remark', 'Success')->sum('amount');
        $total_withdrawal = Transaction::where('category', 'withdraw')->where('remark', 'Success')->sum('amount');
        $today_business = Transaction::where('category', 'recharge')->where('remark', 'Success')->where('created_at', '>=', Carbon::today()->toDateString())->sum('amount');
        $today_withdrawal = Transaction::where('category', 'withdraw')->where('remark', 'Success')->where('created_at', '>=', Carbon::today()->toDateString())->sum('amount');
        $tbet = Userbit::where('status', 1)->sum('amount');
        $win = Userbit::where('cashout_multiplier', '>=', 1)->sum('amount');
        $loss = Userbit::where('cashout_multiplier', 0)->sum('amount');
        $today_tbet = Userbit::where('status', 1)->where('created_at', '>=', Carbon::today()->toDateString())->sum('amount');
        $today_win = Userbit::where('cashout_multiplier', '>=', 1.05)->where('created_at', '>=', Carbon::today()->toDateString())->sum('give_amount');
        // $today_loss = Userbit::where('cashout_multiplier', '<', 1.05)->where('created_at', '>=', Carbon::today()->toDateString())->sum('amount');
        $today_loss = $today_tbet - $today_win;
        if($today_loss < 0) {
            $today_loss = Userbit::where('cashout_multiplier', '<', 1.05)->where('created_at', '>=', Carbon::today()->toDateString())->sum('amount');
        }
        $recharge = Transaction::where('category', 'recharge')->sum('amount');
        $withdrawal = Transaction::where('category', 'withdraw')->sum('amount');
        $today_tbet_15min = Userbit::where('status', 1)->where('created_at', '>=', now()->subMinutes(15))->sum('amount');
        $today_win_15min = Userbit::where('cashout_multiplier', '>=', 1.05)->where('created_at', '>=', now()->subMinutes(15))->sum('give_amount');
        // $today_loss_15min = Userbit::where('cashout_multiplier', '<', 1.05)->where('created_at', '>=', now()->subMinutes(15))->sum('amount');
        $today_loss_15min = $today_tbet_15min - $today_win_15min;
        if($today_loss_15min < 0) {
            $today_loss_15min = Userbit::where('cashout_multiplier', '<', 1.05)->where('created_at', '>=', now()->subMinutes(15))->sum('amount');
        }
        return view("admin.dashboard", [
            "user" => $user,
            "recharge" => $recharge,
            "withdrawal" => $withdrawal,
            "total_business" => $total_business,
            "total_withdrawal" => $total_withdrawal,
            "today_business" => $today_business,
            "today_withdrawal" => $today_withdrawal,
            "today_active" => $today_active,
            "tbet" => $tbet,
            "win" => $win,
            "loss" => $loss,
            "today_tbet" => $today_tbet,
            "today_win" => $today_win,
            "today_loss" => $today_loss,
            "today_tbet_15min" => $today_tbet_15min,
            "today_win_15min" => $today_win_15min,
            "today_loss_15min" => $today_loss_15min,
        ]);
    }
    public function active()
    {
        $userlist = User::where('isadmin', null)->orderBy('id','desc')->get();
        return view("admin.userlist", compact("userlist"));
    }
    public function deactive()
    {
        $userlist = User::where('isadmin', null)->orderBy('id','desc')->get();
        return view("admin.userlist", compact("userlist"));
    }
    public function userAll()
    {
        $userlist = User::where('isadmin', null)->orderBy('id','desc')->get();
        return view("admin.userlist", compact("userlist"));
    }
    public function userToday()
    {
        $userlist = User::where('isadmin', null)->where('active_today', '>=', Carbon::today()->toDateString())->orderBy('id','desc')->get();
        return view("admin.userlist", compact("userlist"));
    }
    public function useredit($id)
    {
        $user = User::where('isadmin', null)->where('id', $id)->first();
        return view("admin.useredit", compact("user"));
    }
    public function chagepassword()
    {
        return view('admin.changepassword');
    }
    public function depositPending()
    {
        $adminDetails = session('adminlogin');
        $history = Transaction::where('category', 'recharge')->where('type', 'credit')->where('status', 0)->orderBy('id','desc')->get();
        $title = 'Recharge Hitory';
        return view('admin.rechargehistory', [
            'history' => $history,
            'title' => $title,
            'updatedBy' => $adminDetails,
        ]);
    }
    public function depositApporved()
    {
        $history = Transaction::join('users', 'transactions.updatedBy', '=', 'users.id')->select('transactions.*', 'users.name as updatedBy')->where('transactions.category', 'recharge')->where('transactions.type', 'credit')->where('transactions.status', 1)->orderBy('transactions.id', 'desc')->get();
        // $history = Transaction::where('category', 'recharge')->where('type', 'credit')->where('status', 1)->orderBy('id','desc')->get();
        $title = 'Recharge Hitory';
        return view('admin.rechargehistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    public function depositRejected()
    {
        // $history = Transaction::where('category', 'recharge')->where('type', 'credit')->where('status', 2)->orderBy('id','desc')->get();
        $history = Transaction::join('users', 'transactions.updatedBy', '=', 'users.id')->select('transactions.*', 'users.name as updatedBy')->where('transactions.category', 'recharge')->where('transactions.type', 'credit')->where('transactions.status', 2)->orderBy('transactions.id', 'desc')->get();
        $title = 'Recharge Hitory';
        return view('admin.rechargehistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    public function depositToday()
    {
        $history = Transaction::where('category', 'recharge')->where('type', 'credit')->where('status', 1)->where('created_at', '>=', Carbon::today()->toDateString())->orderBy('id','desc')->get();
        $title = 'Recharge Hitory';
        return view('admin.rechargehistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    public function withdrawalPending()
    {
        $history = Transaction::where('category', 'withdraw')->where('type', 'debit')->where('status', 0)->join('bank_details', 'transactions.userid', '=', 'bank_details.userid')->select('transactions.*','bank_details.accountno','bank_details.ifsccode','bank_details.branchname','bank_details.upi_id','bank_details.mobile_no','bank_details.bankname')->orderBy('transactions.id','desc')->get();
        $title = 'Withdrawal Hitory';
        // dd($history);
        return view('admin.withdrawhistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    public function withdrawalApporved()
    {
        $history = Transaction::join('users', 'transactions.updatedBy', '=', 'users.id')->join('bank_details', 'transactions.userid', '=', 'bank_details.userid')->select('transactions.*','users.name as updatedBy','bank_details.accountno','bank_details.ifsccode','bank_details.branchname','bank_details.upi_id','bank_details.mobile_no')->where('transactions.category', 'withdraw')->where('transactions.type', 'debit')->where('transactions.status', 1)->orderBy('transactions.id', 'desc')->get();
        // dd(Transaction::where('type', 'debit')->get());
        // $history = Transaction::where('category', 'withdraw')->where('type', 'debit')->where('status', 1)->join('bank_details', 'transactions.userid', '=', 'bank_details.userid')->select('transactions.*','bank_details.accountno','bank_details.ifsccode','bank_details.branchname','bank_details.upi_id','bank_details.mobile_no')->orderBy('transactions.id','desc')->get();
        $title = 'Withdrawal Hitory';
        return view('admin.withdrawhistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    public function withdrawalRejected()
    {
        // $history = Transaction::where('category', 'withdraw')->where('type', 'debit')->where('status', 2)->join('bank_details', 'transactions.userid', '=', 'bank_details.userid')->select('transactions.*','bank_details.accountno','bank_details.ifsccode','bank_details.branchname','bank_details.upi_id','bank_details.mobile_no')->orderBy('transactions.id','desc')->get();
        $history = Transaction::join('users', 'transactions.updatedBy', '=', 'users.id')->join('bank_details', 'transactions.userid', '=', 'bank_details.userid')->select('transactions.*','users.name as updatedBy','bank_details.accountno','bank_details.ifsccode','bank_details.branchname','bank_details.upi_id','bank_details.mobile_no')->where('transactions.category', 'withdraw')->where('transactions.type', 'debit')->where('transactions.status', 2)->orderBy('transactions.id', 'desc')->get();
        $title = 'Withdrawal Hitory';
        return view('admin.withdrawhistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    public function withdrawalToday()
    {
        $history = Transaction::where('category', 'withdraw')->where('type', 'debit')->where('status', 1)->where('transactions.created_at', '>=', Carbon::today()->toDateString())->join('bank_details', 'transactions.userid', '=', 'bank_details.userid')->select('transactions.*','bank_details.accountno','bank_details.ifsccode','bank_details.branchname','bank_details.upi_id','bank_details.mobile_no')->orderBy('transactions.id','desc')->get();
        $title = 'Withdrawal Hitory';
        return view('admin.withdrawhistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    
    public function betTotal()
    {
        $history = Userbit::where('status', 1)->orderBy('id','desc')->get();
        $title = 'Total Bet';
        return view('admin.bethistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    
    public function winTotal()
    {
        $history = Userbit::where('status', 1)->where('cashout_multiplier', '>=', 1.05)->orderBy('id','desc')->get();
        $title = 'Total Winner';
        return view('admin.bethistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    
    public function lossTotal()
    {
        $history = Userbit::where('status', 1)->where('cashout_multiplier', 0)->orderBy('id','desc')->get();
        $title = 'Total Loss';
        return view('admin.bethistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    
    public function betToday()
    {
        $history = Userbit::where('status', 1)->where('created_at', '>=', Carbon::today()->toDateString())->orderBy('id','desc')->get();
        $title = 'Today Bet';
        return view('admin.bethistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    
    public function winToday()
    {
        $history = Userbit::where('status', 1)->where('cashout_multiplier', '>=', 1.05)->where('created_at', '>=', Carbon::today()->toDateString())->orderBy('id','desc')->get();
        $title = 'Today Winning';
        return view('admin.bethistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    
    public function lossToday()
    {
        $history = Userbit::where('status', 1)->where('cashout_multiplier', 0)->where('created_at', '>=', Carbon::today()->toDateString())->orderBy('id','desc')->get();
        $title = 'Today Loss';
        return view('admin.bethistory', [
            'history' => $history,
            'title' => $title,
        ]);
    }
    
    public function amountsetup($id = null)
    {
        $specificdata = null;
        $settings = Setting::where('new_status', 1)->get();
        $title = 'Withdrawal Hitory';
        if ($id != null) {
            $specificdata = Setting::where('id', $id)->first();
            // dd($specificdata);
        }
        return view('admin.amountsetup', [
            'setting' => $settings,
            'id' => $id,
            'specificdata' => $specificdata,
        ]);
    }
    public function bankdetail()
    {
        // die();
        $specificdata = null;
        $title = 'Bank Detail';
        $specificdata = Bankdetail::where('id', '1')->first();
        if($specificdata) {
            $status = true;
        } else {
            $status = false;
        }
        $bankData = array("status" => $status, "data" => $specificdata);
        // dd($bankData);
        return view('admin.bankdetail', [
            'bank' => $bankData,
        ]);
    }
    public function logout()
    {
        if (session()->has('adminlogin')) {
            session()->forget('adminlogin');
        }
        return redirect('/admin');
    }
    public function showAllTickets() {
        $adminDetails = session('adminlogin');
        // $allTickets = Ticket::join('users', 'users.id', '=', 'tickets.userId')->get();
        $allTickets = User::join('tickets', 'tickets.userId', '=', 'users.id')->select('users.id', 'users.name', 'tickets.*')->get();
        // dd($allTickets);
        $groupedBy = $allTickets->groupBy('ticketId');
        $groupedByTickets = $groupedBy->toArray();
        return view('admin.allTickets', [
            'allTickets' => $groupedByTickets,
            'adminDetails' => $adminDetails,
        ]);
    }
    public function showOpenTickets() {
        $adminDetails = session('adminlogin');
        $allTickets = User::join('tickets', 'tickets.userId', '=', 'users.id')->where('tickets.status', 0)->get();
        $groupedBy = $allTickets->groupBy('ticketId');
        $groupedByTickets = $groupedBy->toArray();
        return view('admin.allTickets', [
            'allTickets' => $groupedByTickets,
            'adminDetails' => $adminDetails,
        ]);
    }
    public function showClosedTickets() {
        $adminDetails = session('adminlogin');
        $allTickets = User::join('tickets', 'tickets.userId', '=', 'users.id')->where('tickets.status', 1)->get();
        $groupedBy = $allTickets->groupBy('ticketId');
        $groupedByTickets = $groupedBy->toArray();
        return view('admin.allTickets', [
            'allTickets' => $groupedByTickets,
            'adminDetails' => $adminDetails,
        ]);
    }
}
