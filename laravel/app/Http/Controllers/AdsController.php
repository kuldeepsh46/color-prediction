<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Gameresult;
use App\Models\Setting;
use App\Models\User;
use App\Models\Ads;
use App\Models\Adspackage;
// use App\Models\Games;
use App\Models\Userbit;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdsController extends Controller
{
    public function showCreateAd()
    {
        $allAdPackages = Adspackage::get();
        return view('createAd', compact('allAdPackages'));
    }
    public function createNewAd(Request $r) {
        $userid = user('id');
        $newAd = new Ads;
            $allAds = Ads::all();
            $file = $r->file('uploaAdPic');
            $originalName = $file->getClientOriginalName();
            $adUploaded = false;
            $statusCode = 0;
            $msg = "";
            $currentDateTime = Carbon::now();
            $currentDateTime->addDays($r->addPostingDuration);
            $validTill = $currentDateTime->format('Y-m-d H:i:s');
            $walletAmt = wallet(user('id'), 'num');
            $walletAmt = (float)str_replace([',', '.'], ['', '.'], $walletAmt);
            $bonusAmt = getBonusAmt(user('id'));
            $totalAmt = $walletAmt + $bonusAmt;
            $currentDateTime = now()->format('Y-m-d H:i:s');
            foreach($allAds as $item) {
                if($item->image == $originalName) {
                    $adUploaded = true;
                    if($item->status == 0) {
                        if($totalAmt > $r->addPostingCost) {
                            $adUpload = Ads::where('image', $originalName)->where('createdBy', $userid)->update([
                                'status' => 1, 'validTill' => $validTill,
                                'adStartDate' => $currentDateTime
                                ]);
                            if($adUpload) {
                                $statusCode = 1;
                                $msg = "Ad Status Uploaded Successfully!";
                            }
                        } else {
                            $statusCode = 5;
                            $msg = "Insufficient Funds!";
                        }
                    } else {
                        $statusCode = 2;
                        $msg = "Ad already uploaded!";
                    }
                    break;
                }
            }
            if($adUploaded == false) {
                if($totalAmt > $r->addPostingCost) {
                    $filePath = $file->storeAs('Adds', $originalName, 'custom');
                    $newAd->image = $originalName;
                    $newAd->status = 1;
                    $newAd->type = 0;
                    $newAd->adAmount = $r->addPostingCost;
                    $newAd->adStartDate = $currentDateTime;
                    $newAd->adDuration = $r->addPostingDuration;
                    $newAd->paymentType = 3;
                    $newAd->createdBy = $userid;
                    $newAd->validTill = $validTill;
                    if($newAd->save()) {
                        $statusCode = 3;
                        $msg = "Success: Ad Created Successfully!";
                    } else {
                        $statusCode = 4;
                        $msg = "Something Went Wrong!";
                    }
                }
            }
            if($statusCode == 1 || $statusCode == 3) {
                if($r->addPostingCost < wallet(user('id'), 'num')) {
                    addwallet(user('id'), floatval($r->addPostingCost), "-");
                } elseif($r->addPostingCost < getBonusAmt(user('id'))) {
                    updateBonusAmt(user('id'), floatval($r->addPostingCost), "-");
                } else {
                    $remainingAmt = $r->addPostingCost - wallet(user('id'), 'num');
                    addwallet(user('id'), floatval(wallet(user('id'), 'num')), "-");
                    updateBonusAmt(user('id'), floatval($remainingAmt), "-");
                }
            }
            $walletAmt = wallet(user('id'), 'num');
            $walletAmt = (float)str_replace([',', '.'], ['', '.'], $walletAmt);
            $bonusAmt = getBonusAmt(user('id'));
            $totalAmt = $walletAmt + $bonusAmt;
        $response = array('statusCode' => $statusCode, 'msg' => $msg, 'walletBalance' => $totalAmt);
        return response()->json($response);
    }
    public function getAllAds()
    {
        // $createdBy = user('id');
        $allAds = Ads::where('status', 1)->get();
        if($allAds) {
            $response = array("success" => true, "data" => $allAds);
        } else {
            $response = array("success" => false, "data" => "");
        }
        return response()->json($response);
    }
    public function checkAdsExpiration() {
        // DB::statement("delete from ads");
	    $records = Ads::where('status', 1)->get();
        foreach($records as $record) {
            $currentTime = Carbon::now();
            $validTill = Carbon::parse($record->validTill);
            $timeDifference = $currentTime->greaterThanOrEqualTo($validTill);
            if($timeDifference == true) {
                Ads::where('status', 1)->where('id', $record->id)->update(['status' => 0]);
            }
        }
        $response = array("success" => true);
        return response()->json($response);
	}
	public function showUserAds() {
	    $createdBy = user('id');
	    $allAdPackages = Adspackage::get();
	    $allUserAds = Ads::where('createdBy', $createdBy)->get();
	    return view('showAds', compact('allUserAds', 'allAdPackages'));
	}
	public function adCostSetup() {
	    $allAdPackages = Adspackage::get();
	    return view('admin.adCostSetup', compact('allAdPackages'));
	}
	public function createAdPackage(Request $r) {
	    if($r->adCount > 0) {
	        Adspackage::where('Status', 1)->delete();
	   $status = 0;
	   for($i = 1; $i <= $r->adCount; $i++) {
	       $packageCost = "packageCost" . $i;
	       //dd($packageCost);
	       $packageDuration = "packageDuration" . $i;
	       $adCost = $r->$packageCost;
	       $adDuration = $r->$packageDuration;
	       $Adspackage = new Adspackage;
	       $Adspackage->Cost = $adCost;
	       $Adspackage->Duration = $adDuration;
	       $Adspackage->Status = 1;
	       if(!$Adspackage->save()) {
	           $status = 1;
	       }
	   }
	   if($status == 0) {
	       $response = array("success" => true);
    	   } else {
    	       $response = array("success" => false);
    	   }
	    } else {
	        $response = array("success" => false);
	    }
	   return response()->json($response);
	}
	public function activateAd(Request $r) {
	   // DB::statement("ALTER TABLE ads ADD COLUMN validTill TIMESTAMP DEFAULT CURRENT_TIMESTAMP;");
	   // die;
	   $userid = user('id');
	   //Ads::where('userId', 50037)->update(['status' => 0]);
	   if(wallet($userid,"num") > $r->adPostingCost) {
	       $currentDateTime = Carbon::now();
	       $currentDateTime->addDays($r->adPostingDuration);
	       $validTill = $currentDateTime->format('Y-m-d H:i:s');
	       //dd($validTill);
            $adUpload = Ads::where('image', $r->adPic)->where('userId', $userid)->update(['status' => 1, 'validTill' => $validTill]);
            if($adUpload) {
                $statusCode = 0;
                $msg = "Ad Activated Successfully!";
                addwallet($userid, floatval($r->adPostingCost), "-");
            } else {
                $statusCode = 1;
                $msg = "Something Went Wrong!";
            }
        } else {
            $statusCode = 2;
            $msg = "Insufficient Funds!";
        }
        $walletBalance = wallet($userid,"num");
        $response = array('statusCode' => $statusCode, 'msg' => $msg, 'walletBalance' => $walletBalance);
        return response()->json($response);
	}
}