<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Gameresult;
use App\Models\Setting;
use App\Models\User;
use App\Models\Ads;
use App\Models\Userbit;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Gamesetting extends Controller
{
    public function crash_plane()
    {
        return 1;
    }
    public function game_existence(Request $r)
    {
        $event = $r->event;
        if ($event == "check") {
            if ((session()->has('gamegenerate') && session()->get('gamegenerate') == 1)) {
                return array('data'=>true);
            }else{
                return array('data'=>false);
            }
        }
        return array('data'=>false);
    }
    public function new_game_generated(Request $r)
    {
        $new = Setting::where('category', 'game_status')->update(['value' => '0']);
        $r->session()->put('gamegenerate','1');
        //for getting current bets
        $getGameStatus= Setting::where('category', 'game_status')->get();
        $getGameStatus = json_decode(json_encode ( $getGameStatus ) , true);
            $allbets = Userbit::where("gameid", currentid())->join ('users','users.id','=','userbits.userid')->get();
            $currentGameBet = $allbets;
            if($getGameStatus[0]['value'] == 1) {
                    $min_bet = setting('bot_min_bet');
                    $max_bet = setting('bot_max_bet');
                    $min_amount = setting('bot_min_amount');
                    $max_amount = setting('max_bet_amount');
                    for ($i=0; $i <rand($min_bet, $max_bet); $i++) {
                //         $currentGameBet[]=array(
                //             "userid" => rand(10000,50000),
                //             "amount" => rand($min_amount,$max_amount),
            				// "image"  => "/images/avtar/av-".rand(1,72).".png",
            				// "cashout_multiplier" => number_format(rand(100, 200) / 100, 2)
                //         );
                $amount = rand($min_amount,$max_amount);
            $cashOutMultiplier = number_format(rand(120, 300) / 100, 2);
            $currentGameBet[]=array(
                "userid" => rand(10000,50000),
                "amount" => $amount,
				"image"  => "/images/avtar/av-".rand(1,72).".png",
				"cashout_multiplier" => $cashOutMultiplier,
				"cashOutAmount" => round($amount * $cashOutMultiplier),
            );
                }
            }
            $currentGame = array("id"=>currentid());
            $currentGameBetCount = count($currentGameBet);
            $currentBetResponse = array("currentGame" => $currentGame, "currentGameBet" => $currentGameBet, "currentGameBetCount" => $currentGameBetCount, "currentGameStatus" => $getGameStatus);
            return response()->json(array("id" => currentid(), "currentBetResponse" => $currentBetResponse));
    }
    public function increamentor(Request $r)
    {
        $gamestatusdata = Setting::where('category', 'game_status')->first();
        $res = 0;
        if($gamestatusdata) {
            $totalbet   = Userbit::where('gameid',currentid())->count();
            
            $totalBusi = Userbit::where('status', 1)->where('created_at', '>=', now()->subMinutes(15))->sum('amount');
            $totalDist = Userbit::where('status', 1)->where('created_at', '>=', now()->subMinutes(15))->sum('give_amount');
            
            $total_busi = Userbit::where('status', 1)->where('created_at', '>=', Carbon::today()->toDateString())->sum('amount');
            $total_dist = Userbit::where('status', 1)->where('created_at', '>=', Carbon::today()->toDateString())->sum('give_amount');
            $new_bet    = Userbit::where('gameid',currentid())->where('status', 0)->where('created_at', '>=', Carbon::today()->toDateString())->sum('amount');
            $net_dis = $totalBusi-$totalDist;
            $max = setting('max_distribution')/100;
            $incSpeed = Setting::where('category', 'inc_speed')->get();
            $incSpeed = json_decode(json_encode ( $incSpeed ) , true);
            $incSpeed = $incSpeed[0]['value'];
                if ($totalbet == 0) {
                        $res =  number_format(rand(100, setting('end_range_game_timer')*100) / 100, 2);
                } else {
                    // $res =   number_format(rand(100, 200) / 100, 2);
                    
                    if ($net_dis*$max > $new_bet) {
                        $res =   number_format(rand(100, 500) / 100, 2);
                    }else{
                        $res =   number_format(rand(100, 111) / 100, 2);
                    }
                }
                $status = true;
                $result = $res;
                $response = array('status'=>$status,'result'=>$result, 'incSpeed' => $incSpeed);
                // Setting::where('category', 'game_status')->update(["incNo"  => $result]);
                return response()->json($response);
        }
    }
    public function increamentor121212(Request $r)
    {
        // return 1.7;
        $totalbet = Userbit::where('gameid',currentid())->count();
        $totalamount = Userbit::where('gameid',currentid())->sum('amount');
        if ($totalbet == 0) {
            return rand(8,11);
        }else{
            $randomresult = array(1.1,1.1,1.2,1.3,1.4,1.5,1.6,1.7,1.8,1.9);
            $res = $randomresult[rand(0,8)];
            if (session()->has('result')) {
                return session()->get('result');
            }
            $r->session()->put('result',$res);
            return $res;
        }
        return rand(setting('start_range_game_timer')*10, setting('end_range_game_timer')*10) / 10;
    }
    
    public function game_over(Request $r)
    {
        
        $r->session()->forget('result');
        $result = Gameresult::where('id', currentid())->update([
            "result" => number_format($r->last_time, 2),
        ]);
        $alluserbit = Userbit::where('gameid', currentid())->where('status', 0)->get();
        foreach ($alluserbit as $key) {
			if(floatval($r->last_time) <= 1.20){
			$result = 0;
		    }else{
			$result = $r->last_time;
			}
            $finalamount = floatval($key->amount) * floatval($result);
            Userbit::where('id', $key->id)->update(["status"=> 1]);
            // addwallet($key->userid,$finalamount);
        }
        $new = Setting::where('category', 'game_status')->update(['value' => '0']);
        Setting::where('category', 'game_status')->update(["incNo"  => 0]);
        $r->session()->put('gamegenerate','0');
        $result = new Gameresult;
        $result->result = "pending";
        $result->save();
        $walletAmt = wallet(user('id'), 'num');
        $walletAmt = (float)str_replace([',', '.'], ['', '.'], $walletAmt);
        $bonusAmt = getBonusAmt(user('id'));
        $totalAmt = $walletAmt + $bonusAmt;
        return $totalAmt;
    }

    public function betNow(Request $r)
    {
        $status = false;
        $message = "Something went wrong!";
        $returnbets = array();
        for($i=0; $i < count($r->all_bets); $i++){
		$result = new Userbit;
        $result->userid = user('id');
        $result->amount = $r->all_bets[$i]['bet_amount'];
        $result->type = $r->all_bets[$i]['bet_type'];
        $result->gameid = currentid();
        $result->give_amount = 0;
        $result->section_no = $r->all_bets[$i]['section_no'];
        // $totalBal = 
        $walletAmt = wallet(user('id'), 'num');
        $walletAmt = (float)str_replace([',', '.'], ['', '.'], $walletAmt);
        $bonusAmt = getBonusAmt(user('id'));
        $totalAmt = $walletAmt + $bonusAmt;
        if ($r->all_bets[$i]['bet_amount'] < $totalAmt) {
            if ($result->save()) {
                $status = true;
                array_push($returnbets, [
                    "bet_id" => $result->id,
                ]);
				/*array_push($returnbets, [
                    "bet_id" => currentid(),
                ]);*/
                if($r->all_bets[$i]['bet_amount'] < wallet(user('id'), 'num')) {
                    addwallet(user('id'), floatval($r->all_bets[$i]['bet_amount']), "-");
                } elseif($r->all_bets[$i]['bet_amount'] < getBonusAmt(user('id'))) {
                    updateBonusAmt(user('id'), floatval($r->all_bets[$i]['bet_amount']), "-");
                } else {
                    $remainingAmt = $r->all_bets[$i]['bet_amount'] - wallet(user('id'), 'num');
                    addwallet(user('id'), floatval(wallet(user('id'), 'num')), "-");
                    updateBonusAmt(user('id'), floatval($remainingAmt), "-");
                }
                $exact_wallet_balance = wallet(user('id'), 'num');
                $exact_wallet_balance = (float)str_replace([',', '.'], ['', '.'], $exact_wallet_balance);
                $bonusAmt = getBonusAmt(user('id'));
                $totalAmt = $exact_wallet_balance + $bonusAmt;
                $data = array(
                    "wallet_balance" => $totalAmt,
                    "return_bets" => $returnbets
                );
                $message = "";
            }
        } else {
            $status = false;
            $data = array();
            $message = "Insufficient fund!!";
        }
		}
        $response = array("isSuccess" => $status, "data" => $data, "message" => $message);
        return response()->json($response);
    }
    public function currentlybet()
    {
        $userid = user('id');
        $getGameStatus= Setting::where('category', 'game_status')->get();
        $getGameStatus = json_decode(json_encode ( $getGameStatus ) , true);
            $allbets = Userbit::where("gameid", currentid())->where('userbits.status', '!=', 2)->where('userid', $userid)->join ('users','users.id','=','userbits.userid')->get();
            $currentGameBet = $allbets;
            // if($getGameStatus[0]['value'] == 1) {
            //         $min_bet = setting('bot_min_bet');
            //         $max_bet = setting('bot_max_bet');
            //         $min_amount = setting('bot_min_amount');
            //         $max_amount = setting('max_bet_amount');
            //         for ($i=0; $i <rand($min_bet, $max_bet); $i++) {
            //             $currentGameBet[]=array(
            //                 "userid" => rand(10000,50000),
            //                 "amount" => rand($min_amount,$max_amount),
            // 				"image"  => "/images/avtar/av-".rand(1,72).".png",
            // 				"cashout_multiplier" => number_format(rand(100, 200) / 100, 2)
            //             );
            //     }
            // }
            $currentGame = array("id"=>currentid());
            $currentGameBetCount = count($currentGameBet);
            $response = array("currentGame" => $currentGame, "currentGameBet" => $currentGameBet, "currentGameBetCount" => $currentGameBetCount, "currentGameStatus" => $getGameStatus);
            return response()->json($response);
        // }
    }
    public function currentlybetnew()
    {
        $userid = user('id');
        $allbets = Userbit::where("gameid", currentid())->where('userbits.status', '!=', 2)->where('userid', $userid)->join ('users','users.id','=','userbits.userid')->get();
        $currentGameBet = $allbets;
        $min_bet = setting('bot_min_bet');
        $max_bet = setting('bot_max_bet');
        $min_amount = setting('bot_min_amount');
        $max_amount = setting('max_bet_amount');
        for ($i=0; $i < rand($min_bet, $max_bet); $i++) {
            $amount = rand($min_amount,$max_amount);
            $cashOutMultiplier = number_format(rand(120, 300) / 100, 2);
            $currentGameBet[]=array(
                "userid" => rand(10000,50000),
                "amount" => $amount,
				"image"  => "/images/avtar/av-".rand(1,72).".png",
				"cashout_multiplier" => $cashOutMultiplier,
				"cashOutAmount" => round($amount * $cashOutMultiplier),
            );
        }
        // $currentGameBet = $currentGameBet->sortByDesc('amount');
        // $sortedGameBet = [];
        // foreach($currentGameBet as $currentBet) {
        //         $sortedGameBet[] = $currentBet;
        // }
        $currentUserBetId = 0;
        $currentUserId = json_decode(json_encode ( $allbets ) , true);
        if(array_key_exists('id', $currentUserId[0])) {
            $currentUserBetId = $currentUserId[0]['id'];
        }
        $currentGame = array("id"=>currentid());
        $currentGameBetCount = count($currentGameBet);
         $response = array("currentGame" => $currentGame, "currentGameBet" => $currentGameBet, "currentGameBetCount" => $currentGameBetCount, "currentUserId" => $currentUserBetId);
        return response()->json($response);
    }
    
    public function my_bets_history() {
        $userid = user('id');
        $userbets = Userbit::where("userid", $userid)->where('status',1)->where('created_at', '>=', Carbon::today()->toDateString())->orderBy('id','desc')->get();
        return response()->json($userbets);
    }
	public function cashout(Request $r){
		$game_id = $r->game_id;
		$bet_id = $r->bet_id;
		$win_multiplier = $r->win_multiplier;
		$betAmt = $r->betAmt;
		$cash_out_amount = 0;
		$status = false;
        $message = "";
        $data = array();
		$result = resultbyid($game_id) == 0 ? $win_multiplier : resultbyid($game_id);
		if(floatval($result) <= 1.05){
			$result = 0;
		}
		$cash_out_amount = floatval($betAmt)*floatval($result);
		addwallet(user('id'),$cash_out_amount); 
		$walletAmt = wallet(user('id'), 'num');
        $walletAmt = (float)str_replace([',', '.'], ['', '.'], $walletAmt);
        $bonusAmt = getBonusAmt(user('id'));
        $totalAmt = $walletAmt + $bonusAmt;
		
		$data = array(
                    "wallet_balance" => $totalAmt,
                    "cash_out_amount" => $cash_out_amount
                );
        Userbit::where('id', $bet_id)->update(["status"=> 1,"cashout_multiplier"=>$win_multiplier, "give_amount"=>$cash_out_amount ]);
        Userbit::where('id', $game_id)->update(["status"=> 1,"cashout_multiplier"=>$win_multiplier, "give_amount"=>$cash_out_amount ]);
        $status = true;
		$response = array("isSuccess" => $status, "data" => $data, "message" => $message);
        return response()->json($response);
	}
	
	public function cronjob(){
	    //0 = Game end & statrting soon
	    //1 = Game start & and is in proccess
	    $gamestatusdata = Setting::where('category', 'game_status')->first();
	    $game_status = 0;
	    if($gamestatusdata){
	       // dd($gamestatusdata);
	        $game_status = $gamestatusdata->value;
	    }
	    if($game_status == 1){
	    $last_start_time = Setting::where('category', 'game_start_time')->first()->value;
	    $last_till_time = Setting::where('category', 'game_between_time')->first()->value;
	    $bothdifference = datealgebra($last_start_time, '+', ($last_till_time/1000).' seconds', $format = "Y-m-d h:i:s");
	    if(strtotime(date('Y-m-d h:i:s')) >= strtotime($bothdifference)){
	        $gamestatusdata = Setting::where('category', 'game_status')->update([
	             "value"  => 0
	             ]);
	    }
	    }elseif($game_status == 0){
	        $gamestatusdata = Setting::where('category', 'game_status')->update(["value"  => 1]);
	        $gamestatusdata = Setting::where('category', 'game_start_time')->update(["value"  => date('Y-m-d h:i:s')]);
	        $gamestatusdata = Setting::where('category', 'game_between_time')->update(["value"  => 5000]);
	    }
	}
	public function updateGameStatus(request $r) {
	    if($r->status == 0) {
	        Setting::where('category', 'game_status')->update(["incNo"  => 0]);
	    }
	    $updateGameStatus = Setting::where('category', 'game_status')->update(["value"  => $r->status]);
	    $updateGameStatusTime = Setting::where('category', 'game_start_time')->update(["value"  => $r->updatedAt]);
	    if($updateGameStatus && $updateGameStatusTime) {
	        $response = array("isSuccess" => "Success!");
	    } else {
	        $response = array("isSuccess" => "Failed!");
	    }
	    return response()->json($response);
	}
	public function getGameStatus() {
	   $getGameStatus= Setting::where('category', 'game_status')->get();
	   $incNo = json_decode(json_encode ( $getGameStatus ) , true);
	   $incNo = (float) $incNo[0]['incNo'];
	   $gameStatusChangedTime = Setting::where('category', 'game_start_time')->get();
	   if($getGameStatus) {
	       $response = array("isSuccess" => "Success", "gameStatus" => $getGameStatus, "gameStatusChangedTime" => $gameStatusChangedTime, "gameIncNo" => $incNo);
	   } else {
	       $response = array("isSuccess" => "Failed!");
	   }
	   return response()->json($response);
	}
	public function updateIncrementor(Request $r) {
	   // $updateIncNo = Setting::where('category', 'incNo')->update(["value" => $r->incNo]);
	   $incNo = (float) $r->incNo;
	   //echo $incNo;
	    $updateIncNo = Setting::where('category', 'game_status')->update(["incNo"  => $incNo]);
	    if($updateIncNo) {
	        $response = array("isSuccess" => "Success!");
	    } else {
	        $response = array("isSuccess" => "Failed!");
	    }
	    return response()->json($response);
	}
	public function updateBets(Request $r) {
	   // dd($r->gameId);
	   $userid = user('id');
	   $gameId = $r->gameId;
	   $allUsers = Userbit::where('gameid', currentid())->where('userid', $userid)->update([
	       'status' => 2,
	       ]);
	   if($allUsers) {
	       $response = array("isSuccess" => "Success!", "status" => 1, "data" => $allUsers);
	   } else {
	       $response = array("isSuccess" => "Failed!", "status" => 0);
	   }
	   return response()->json($response);
	}
	function playads() {
	    return view('playads');
	}
}