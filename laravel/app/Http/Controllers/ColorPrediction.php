<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use App\Models\User;
use App\Models\GameResult;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ColorPrediction extends Controller
{
    public function showColors() {
        return view('colorPrediction.index');
    }
    public function getGameResult() {
        $gameResult = GameResult::latest()->take(10)->get();
        return response()->json($gameResult);
    }
}