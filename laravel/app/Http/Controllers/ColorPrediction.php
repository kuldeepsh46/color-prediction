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

class ColorPrediction extends Controller
{
    public function showColors() {
        return view('colorPrediction.index');
    }
    public function getGameResult() {
        $gameResult = Userbit::where('userid', user('id'))->latest()->take(10)->get()->unique('gameid');
        return response()->json($gameResult);
    }
    public function betNow(Request $r) {
        $status = false;
        $message = "Something went wrong!";
        $returnbets = array();
        $betAmt = $r->betAmt;
        $result = new Userbit;
        $result->userid = user('id');
        $result->amount = $r->betAmt;
        $result->type = $r->gameType;
        $result->gameid = currentid($r->gameType);
        $result->give_amount = 0;
        $result->section_no = 0;
        $result->colorId = $r->colorId;
        $walletAmt = wallet(user('id'), 'num');
        $walletAmt = (float)str_replace([',', '.'], ['', '.'], $walletAmt);
        $bonusAmt = getBonusAmt(user('id'));
        $totalAmt = $walletAmt + $bonusAmt;
        if ($betAmt < $totalAmt && $r->counter >= 10) {
            if ($result->save()) {
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
        $response = array("isSuccess" => $status, "data" => $data, "message" => $message);
        return response()->json($response);
    }
    public function getWinningColor(Request $r) {
        $gameType = $r->gameType;
        $allBets = Userbit::where('status', 0)->groupBy('gameid', 'colorId')->selectRaw('gameid, colorId, SUM(amount) as totalBetAmt')->orderBy('totalBetAmt', 'asc')->get();
        $allBets = $allBets->toArray();
        // dd($allBets);
        $data = array();
        $status = 0;
        $message = "Failed";
        $userBetCount = Userbit::where('userid', user('id'))->where('gameid', currentid($gameType))->where('status', 0)->count();
        // dd($userBetCount);
        if($userBetCount) {
            foreach($allBets as $key => $value) {
                $multiplier = 1;
                if ($value['colorId'] >= 3 && $value['colorId'] <= 12) {
                    $multiplier = 10;
                } elseif ($value['colorId'] == 0 || $value['colorId'] == 2) {
                    $multiplier = 2;
                } elseif ($value['colorId'] == 1) {
                    $multiplier = 5;
                }
                $giveAmt = $value['totalBetAmt'] * $multiplier;
                $allBets[$key]['giveAmt'] = $giveAmt;
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
            Userbit::where('gameid', currentid($gameType))->where('colorId', $data['colorId'])->update([
                'give_amount' => $data['give_amount']
            ]);
        } else {
            $data=array(
                "gameid" => currentid(1),
                "give_amount" => rand(1000, 10000),
				"colorId" => rand(0,12),
            );
        }
            if($data) {
                $status = 1;
                $message = "Success";
                Userbit::where('gameid', currentid($gameType))->update([
                'status' => 1,
            ]);
            }
        $response = array("isSuccess" => $status, "data" => $data, "message" => $message);
        return response()->json($response);
    }
    public function gameOver(Request $r) {
        $gameType = $r->gameType;
        $gameId = currentid($gameType);
        $gameStatusUpdated = Userbit::where('gameid', $gameId)->update([
           'status' => 1 
        ]);
        if($gameStatusUpdated) {
            $response = array("isSuccess" => 'True', "message" => "Success");
        } else {
            $response = array("isSuccess" => 'False', "message" => "Failed");
        }
        return response()->json($response);
    }
}