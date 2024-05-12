<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Gameresult;
use App\Models\Userbit;
use App\Models\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RouletController extends Controller
{
    public function showRoulet() {
        return view('roulet.index');
    }
    public function getGameResult() {
        $gameResult = Userbit::where('userid', user('id'))->latest()->take(10)->get()->unique('gameid');
        return response()->json($gameResult);
    }
    public function betNow(Request $r) {
        // dd($r);
        $status = false;
        $message = "Something went wrong!";
        $returnbets = array();
        $betAmt = $r->betAmt;
        $betArray= $r->betArray;
        foreach ($betArray as $key => $value) {
            $result = new Userbit;
            $result->userid = user('id');
            $gameType = $r->gameType;
            $gameId = currentid($gameType);
            $result->give_amount = 0;
            $result->section_no = 0;
            $walletAmt = wallet(user('id'), 'num');
            $walletAmt = (float)str_replace([',', '.'], ['', '.'], $walletAmt);
            $bonusAmt = getBonusAmt(user('id'));
            $totalAmt = $walletAmt + $bonusAmt;
            $betAmt = $value['amt'];
            $betNumbers = $value['numbers'];
            $result['amount'] = $betAmt;
            $result['type'] = $gameType;
            $result['gameid'] = $gameId;
            $result['rouletNo'] = $betNumbers;
            $result['cashout_multiplier'] = $value['odds'];
            // echo $betNumbers;
            if ($betAmt < $totalAmt) {
                // echo 4;
                if ($result->save()) {
                    // echo 43;
                    $status = true;
                    array_push($returnbets, [
                        "bet_id" => $result->id,
                    ]);
                    if($betAmt < wallet(user('id'), 'num')) {
                        addwallet(user('id'), floatval($betAmt), "-");
                    } elseif($betAmt < getBonusAmt(user('id'))) {
                        updateBonusAmt(user('id'), floatval($betAmt), "-");
                    } else {
                        $remainingAmt = $betAmt - wallet(user('id'), 'num');
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
    public function getResult(Request $r) {
        // dd($r);
        $gameType = $r->gameType;
        $allBets = Userbit::where('status', 0)->groupBy('gameid', 'rouletNo', 'cashout_multiplier', 'amount')->selectRaw('gameid, rouletNo, cashout_multiplier, amount, SUM(amount) as totalBetAmt')->orderBy('totalBetAmt', 'asc')->get();
        // dd($allBets);
        $data = array();
        $status = 0;
        $message = "Failed";
        $winner = 0;
        $userBetRouletNoArray = array();
        $totalBetAmt = Userbit::where('status', 0)->where('gameid', currentid($gameType))->sum('amount');
        // dd($totalBetAmt);
        // echo count($allBets);
        // die;
        foreach($allBets as $key => $value) {
            $giveAmt = $value['totalBetAmt'] * $value['cashout_multiplier'];
            // dd($value['totalBetAmt'], $value['cashout_multiplier'], $giveAmt);
            $allBets[$key]['giveAmt'] = $giveAmt;
            array_push($userBetRouletNoArray, $value['rouletNo']);
        }
        $minGiveAmt = PHP_INT_MAX;
            $minIndex = -1;
            foreach ($allBets as $index => $item) {
                if ($item["giveAmt"] < $minGiveAmt) {
                    $minGiveAmt = $item["giveAmt"];
                    $minIndex = $index;
                }
            }
            $data = $allBets[$minIndex];
            if(count($allBets) < 2 || (count($allBets) > 1 && $totalBetAmt < $data['giveAmt'])) {
                $data['giveAmt'] = 0;
                do {
                    $randomNumber = mt_rand(0, 36);
                } while (in_array($randomNumber, $userBetRouletNoArray));
                $data['rouletNo'] = $randomNumber;
            } else {
                $dataUpdated = Userbit::where('gameid', currentid($gameType))->where('rouletNo', $data['rouletNo'])->update([
                'give_amount' => $data['giveAmt']
            ]);
            }
                $message = "Success";
                $status = 1;
                if (in_array($data['rouletNo'], $userBetRouletNoArray)) {
                    $winner = 1;
                    $cash_out_amount = $data['giveAmt'];
                    addwallet(user('id'), $cash_out_amount);
                }
            $walletAmt = wallet(user('id'), 'num');
            $data['walletAmt'] = $walletAmt;
            $response = array("isSuccess" => $status, "data" => $data, "message" => $message, "winner" => $winner);
            return response()->json($response);
    }
    public function gameOver(Request $r) {
        $gameType = $r->gameType;
        $gameId = currentid($gameType);
        $gameStatusUpdated = Userbit::where('gameid', $gameId)->update([
           'status' => 1 
        ]);
        
        if($gameStatusUpdated) {
            $result = new Gameresult;
            Gameresult::where('id', $gameId)->where('gameType', $gameType)->update([
                'result' => 5
            ]);
            $response = array("isSuccess" => 'True', "message" => "Success");
            
            $result->result = "pending";
            $result->gameType = $gameType;
            $result->save();
        } else {
            $response = array("isSuccess" => 'False', "message" => "Failed");
        }
        return response()->json($response);
    }
}