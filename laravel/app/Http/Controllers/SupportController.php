<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gameresult;
use App\Models\Userbit;
use App\Models\User;
use Carbon\Carbon;

class SupportController extends Controller
{
    public function support() {
        return view('support.index');
    }
}
