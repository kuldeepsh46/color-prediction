<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gameresult;
use App\Models\Userbit;
use App\Models\User;
use App\Models\Bank_detail;
use App\Models\Ads;
use App\Models\Setting;
use App\Models\Bankdetail;
use Carbon\Carbon;

class Pages extends Controller
{
    public function aviator() {
        $allresults = Gameresult::where('created_at', '>=', Carbon::today()->toDateString())->orderBy('id','desc')->take(22)->get();
        $mybets = Userbit::where('userid',user('id'))->where('created_at', '>=', Carbon::today()->toDateString())->orderBy('id','desc')->get();
        // return $allresults;
        $allAds = Ads::where('status', 1)->where('adStartDate', '<=', Carbon::now())->get();
        $imageAds = Ads::where('status', 1)->where('adStartDate', '<=', Carbon::now())->where('type', 0)->get();
        $videoAds = Ads::where('status', 1)->where('adStartDate', '<=', Carbon::now())->where('type', 1)->get();
        // $allAds = array('imageAds' => $imageAds, 'videoAds' => $videoAds);
        // dd($allAds);
        if($allAds) {
            $allAds = array("success" => true, "allAds" => $allAds, "imageAds" => $imageAds, "videoAds" => $videoAds);
        } else {
            $allAds = array("success" => false, "allAds" => "");
        }
        // return $view->with('persons', $persons)->with('ms', $ms);
        return view('crash', compact("allresults","mybets", "allAds"));
    }

    public function deposit() {
       $depositBankDetail = Bankdetail::where('id', '1')->first();
        // dd($depositBankDetail);
        $bank = Bank_detail::where('userid',user('id'))->first();
        
        if (!$bank) {
            $bank = array();
        }
        return view('deposite',compact('bank', 'depositBankDetail'));
    }
    
    public function withdrawal() {
        $bank = Bank_detail::where('userid',user('id'))->first();
        $minAmt = Setting::where('category', 'min_withdrawal')->get();
        $minAmt = json_decode(json_encode ( $minAmt ) , true);
        $minAmt = $minAmt[0]['value'];
        // dd($minAmt);
        if (!$bank) {
            $bank = array();
        }
        return view('withdraw',compact('bank', 'minAmt'));
    }

    public function amount_transfer()
    {
        $specificdata = null;
        $title = 'Amount Transfer';
        return view('amount_transfer', [
            'title' => $title,
        ]);
    }

    public function level_management() {
        $mypromocode = user('id');
        $level1users = User::where('promocode',$mypromocode)->get();
        $users = count($level1users);
        $level1 = $level1users;
        $level2 = array();
        $level3 = array();
        foreach ($level1users as $key2) {
            $level2users = User::where('promocode',$key2->id)->get();
            $users += count($level2users);
            if (count($level2users) > 0) {
                array_push($level2,$level2users);
            }
            foreach ($level2users as $key3) {
                $level3users = User::where('promocode',$key3->id)->get();
                $users += count($level3users);
                array_push($level3,$level3users);
            }
        }
        return view('level_management',compact('users','level1','level2','level3'));
    }
}
