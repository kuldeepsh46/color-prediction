<?php

namespace App\Http\Controllers;

use App\Models\Bankdetail;
use App\Models\Bank_detail;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Ads;
use App\Models\Ticket;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;

class Adminapi extends Controller
{
    public function changepassword(Request $r)
    {
        $response = array('status' => 0, 'title' => "Oops!!", 'message' => "Invalid Credential!");
        $validated = $r->validate([
            'userid' => 'required',
            'newpassword' => 'required',
            'renewpassword' => 'required',
        ]);
        if ($r->newpassword == $r->renewpassword) {
            User::where('id', $r->userid)->where('isadmin', '1')->update([
                "password" => Hash::make($r->newpassword),
            ]);
            $response = array('status' => 1, 'title' => "Success!!", 'message' => "Password successfully updated!");
        } else {
            $response = array('status' => 0, 'title' => "Oops!!", 'message' => "Password not match!");
        }
        return response()->json($response);
    }
    public function edituser(Request $r)
    {
        $response = array('status' => 0, 'title' => "Oops!!", 'message' => "Invalid Credential!");
        $validated = $r->validate([
            'userid' => 'required',
            'newpassword' => 'required',
            'renewpassword' => 'required',
        ]);
        if ($r->newpassword == $r->renewpassword) {
            User::where('id', $r->userid)->where('isadmin', '1')->update([
                "password" => Hash::make($r->newpassword),
            ]);
            $response = array('status' => 1, 'title' => "Success!!", 'message' => "Password successfully updated!");
        } else {
            $response = array('status' => 0, 'title' => "Oops!!", 'message' => "Password not match!");
        }
        return response()->json($response);
    }
    public function rechargeapproval($event, Request $r)
    {
        // dd($r);
        $response = array('status' => 0, 'title' => "Oops!!", 'message' => "Invalid Action!");
        $id = $r->id;
        $userid = $r->userid;
        $amount = $r->amount;
        if ($event == 'success') {
            $bonusAmt = Wallet::where('userid', $userid)->get();
            $bonusAmt = json_decode(json_encode ( $bonusAmt ) , true);
            // dd($bonusAmt);
            $bonusAmt = $bonusAmt[0]['bonus_amt'];
            $bonusAmt += $r->bonusAmt;
            Wallet::where('userid', $userid)->update([
                'bonus_amt' => $bonusAmt,
                ]);
            $firstrecharge = Transaction::where('id', $userid)->where('category', 'recharge')->where('status','0')->get();
            if (count($firstrecharge) == 0) {
                $level1 = User::where('id', user('promocode', $userid))->first();
                if ($level1) {
                    $level1amount = ($amount / 100 ) * setting('level1commission');
                    // return $level1amount;
                    addwallet($level1->id, $level1amount);
                    addtransaction($level1->id, 'Level', date("ydmhsi"), 'credit', $level1amount, 'Level_bonus', 'Success', '1');

                    $level2 = User::where('id', $level1->promocode)->first();
                    if ($level2) {
                        $level2amount = ($amount / setting('level2commission')) * 100;
                        addwallet($level2->id, $level2amount);
                        addtransaction($level2->id, 'Level', date("ydmhsi"), 'credit', $level2amount, 'Level_bonus', 'Success', '1');

                        $level3 = User::where('id', $level2->promocode)->first();
                        if ($level3) {
                            $level3amount = ($amount / setting('level3commission')) * 100;
                            addwallet($level3->id, $level3amount);
                            addtransaction($level3->id, 'Level', date("ydmhsi"), 'credit', $level3amount, 'Level_bonus', 'Success', '1');
                        }
                    }
                }
            }
            $data = Transaction::where('id', $id)->update([
                "remark" => 'Success',
                "status" => '1',
                "updatedBy" => $r->updatedBy,
            ]);
            addwallet($userid, $amount);
            $response = array('status' => 1, 'title' => "Success!!", 'message' => "Recharge successfully updated!");

        } elseif ($event == 'cancel') {
            $data = Transaction::where('id', $id)->update([
                "remark" => 'Cancel payment due to some issue',
                "status" => '2',
                "updatedBy" => $r->updatedBy,
            ]);
            $response = array('status' => 1, 'title' => "Success!!", 'message' => "Recharge successfully updated!");
        }
        return response()->json($response);
    }
    public function withdrawalapproval($event, Request $r)
    {
        // dd($r);
        $adminLoginDetails = session('adminlogin');
        // dd($adminLoginDetails->id);
        $response = array('status' => 0, 'title' => "Oops!!", 'message' => "Invalid Action!");
        $id = $r->id;
        $userid = $r->userid;
        $amount = $r->amount;
        if ($event == 'success') {
            $data = Transaction::where('id', $id)->update([
                "transactionno" => $r->withdrawTransactionNo,
                "remark" => 'Success',
                "status" => '1',
                'updatedBy' => $adminLoginDetails->id
            ]);
            $response = array('status' => 1, 'title' => "Success!!", 'message' => "Withdrawal successfully updated!");
        } elseif ($event == 'cancel') {
            $data = Transaction::where('id', $id)->update([
                "remark" => 'Cancle payment due to some issue',
                "status" => '2',
                'updatedBy' => $adminLoginDetails->id
            ]);
            addwallet($userid, $amount);
            $response = array('status' => 1, 'title' => "Success!!", 'message' => "Withdrawal successfully updated!");
        }
        return response()->json($response);
    }
    public function userdelete(Request $r)
    {
        $response = array('status' => 0, 'title' => "Oops!!", 'message' => "Invalid Action!");
        $id = $r->id;
        User::where('id', $id)->delete();
        Wallet::where('userid', $id)->delete();
        Transaction::where('userid', $id)->delete();
        $response = array('status' => 1, 'title' => "Success!!", 'message' => "User successfully Deleted!");
        return response()->json($response);
    }
    public function payment_gateway(Request $r)
    {
        $status = false;
        $message = "Something went wrong!";
        $detail = Bankdetail::where('id', '1')->first();
        if ($detail) {
            $status = true;
            $data = array(
                'user_name' => $detail->account_holder_name,
                'mobile_no' => $detail->mobile_no,
                'upi_id' => $detail->upi_id,
                'account_number' => $detail->account_no,
                'ifsc_code' => $detail->ifsc_code,
                'bank_name' => $detail->bank_name,
                'barcode' => $detail->barcode,
            );
            $message = "";

        } else {
            $status = false;
            $data = array();
            $message = "Something wents wrong!";
        }
        $response = array("isSuccess" => $status, "data" => $data, "message" => $message);
        return response()->json($response);
    }

    public function editamountsetup(Request $r)
    {
        $response = array('status' => 0, 'title' => "Error!!", 'message' => "Something wents wrong!");
        $update = Setting::where('id', $r->id)->update([
            "name" => $r->settingname,
            "value" => $r->value,
        ]);
        if ($update) {
            $response = array('status' => 1, 'title' => "Success!!", 'message' => "User successfully Deleted!");
        }
        return response()->json($response);
    }

    public function editbankdetail(Request $r)
    {
        // dd($r->file('barcode'));
        
        $exist = Bankdetail::where('id', '1')->first();
        if ($exist) {
            $file = $r->file('barcode');
            if ($file != '') {
                // $barcode = imageupload($r->file('barcode'), 'barcode', 'images/')['filePath'];
                $originalName = $file->getClientOriginalName();
                $barcode = $file->storeAs('', $originalName, 'custom');
            } else {
                $barcode = $exist->barcode;
            }
             $update = Bankdetail::where('id', '1')->update([
            "account_holder_name" => $r->holdername,
            "mobile_no" => $r->mobile_no,
            "upi_id" => $r->upi_id,
            "account_no" => $r->account_no,
            "ifsc_code" => $r->ifsccode,
            "bank_name" => $r->bank_name,
            "barcode" => $barcode,
        ]);
        if ($update) {
            $response = array('status' => 1, 'title' => "Success!!", 'message' => "User Details Updated successfully!");
        }
        } else {
            $addBankDetails = new Bankdetail;
            $file = $r->file('barcode');
            if($file != '') {
                $originalName = $file->getClientOriginalName();
                $barcode = $file->storeAs('', $originalName, 'custom');
                $addBankDetails->id = 1;
                $addBankDetails->account_holder_name = $r->holdername;
                $addBankDetails->mobile_no = $r->mobile_no;
                $addBankDetails->upi_id = $r->upi_id;
                $addBankDetails->account_no = $r->account_no;
                $addBankDetails->ifsc_code = $r->ifsccode;
                $addBankDetails->bank_name = $r->bank_name;
                $addBankDetails->barcode = $barcode;
                if($addBankDetails->save()) {
                    $response = array('status' => 1, 'title' => "Success!!", 'message' => "User Details Added successfully!");
                }
            } else {
                $response = array('status' => 0, 'title' => "Failed!!", 'message' => "Please upload qr code!");
            }
        }
        return response()->json($response);
    }
    public function updatewallet(Request $r)
    {
        $userid = $r->userid;
        $amount = $r->amount;
        $response = array('status' => 0, 'title' => "Error!!", 'message' => "Something wents wrong!");
        $update = Wallet::where('userid', $userid)->update([
            "amount" => $amount,
        ]);
        if ($update) {
            $response = array('status' => 1, 'title' => "Success!!", 'message' => "User Wallet successfully Updated!");
        }
        return response()->json($response);
    }

    public function depositNow(Request $r)
    {
        // dd($r);
        $trn = new Transaction;
        $trn->userid = user('id');
        // $trn->platform = platform($r->payment_gateway_type);
        $trn->platform = $r->payment_gateway_type;
        $trn->transactionno = $r->trn;
        $trn->type = 'credit';
        $trn->amount = $r->amount;
        $trn->category = 'recharge';
        $trn->remark = 'Processing';
        $trn->status = '0';
        $trn->bonus_amt = $r->bonusAmt;
        if ($trn->save()) {
            return redirect('/deposit?msg=Success');
        }
    }
    public function withdrawal_query(Request $r)
    {
        // dd($r);
        // return $r->all();
        $trn = new Transaction;
        $trn->userid = user('id');
        $trn->platform = $r->payment_gateway_type;
        $trn->transactionno = '';
        $trn->type = 'debit';
        $trn->amount = $r->amount;
        $trn->category = 'withdraw';
        $trn->remark = 'Processing';
        $trn->status = '0';
        if ($trn->save()) {
            // $bonusAmt = getBonusAmt(user('id'));
            // $walletAmt = wallet(user('id'), 'num') - $bonusAmt;
            if (wallet(user('id'), 'num') > $r->amount) {
                addwallet(user('id'), $r->amount, '-');
            }
            $existbank = Bank_detail::where('userid', user('id'))->orderBy('id', 'desc')->first();
            if ($existbank) {
                Bank_detail::where('userid', user('id'))->update([
                    "bankname" => $r->bank_name,
                    "branchname" => $r->branchname,
                    "accountno" => $r->account_no,
                    "ifsccode" => $r->ifsc_code,
                    "upi_id" => $r->upi_id,
                    "mobile_no" => $r->mobile_no,
                ]);
                return redirect('/withdraw?msg=Success');
            } else {
                $bank = new Bank_detail;
                $bank->userid = user('id');
                $bank->bankname = $r->bank_name;
                $bank->branchname = $r->branchname;
                $bank->accountno = $r->account_no;
                $bank->ifsccode = $r->ifsc_code;
                $bank->upi_id = $r->upi_id;
                $bank->mobile_no = $r->mobile_no;
                if ($bank->save()) {
                    return redirect('/withdraw?msg=Success');
                }
                return redirect('/withdraw?msg=error');
            }
        }
    }
    public function showUploadAd(Request $r) {
        return view('admin.uploadAd');
    }
    public function uploaNewdAd(Request $r) {
        // dd($r);
        $createdBy = user('id');
        // $adminDetails = session('adminlogin');
        // dd($adminDetails);
        $newAd = new Ads;
            $allAds = Ads::all();
            $file = $r->file('uploadAd');
            $originalName = $file->getClientOriginalName();
            $adUploaded = false;
            $statusCode = 0;
            $msg = "";
            $currentDateTime = Carbon::now();
            $currentDateTime->addDays($r->adDuration);
            $validTill = $currentDateTime->format('Y-m-d H:i:s');
            foreach($allAds as $item) {
                if($item->image == $originalName) {
                    $adUploaded = true;
                    if($item->status == 0) {
                            $adUpload = Ads::where('image', $originalName)->where('createdBy', $createdBy)->update(['status' => 1, 'validTill' => $validTill]);
                            if($adUpload) {
                                $statusCode = 1;
                                $msg = "Ad Status Uploaded Successfully!";
                            }
                    } else {
                        $statusCode = 1;
                        $msg = "Ad already uploaded!";
                    }
                    break;
                }
            }
            if($adUploaded == false) {
                    $filePath = $file->storeAs('Adds', $originalName, 'custom');
                    $newAd->image = $originalName;
                    $newAd->status = 0;
                    $newAd->type = 1;
                    $newAd->adLink = $r->videoLink;
                    $newAd->adDuration = $r->adDuration;
                    $newAd->adAmount = $r->adAmount;
                    $newAd->adStartDate = $r->adStartDate;
                    $newAd->paymentType = $r->paymentType;
                    $newAd->transactionNo = $r->transactionNo;
                    // $newAd->paymentReceivedBy = $r->paymentReceivedBy;
                    $newAd->createdBy = $createdBy;
                    $newAd->validTill = $validTill;
                    if($newAd->save()) {
                        $statusCode = 1;
                        $msg = "Success: Ad Created Successfully!";
                    } else {
                        $statusCode = 4;
                        $msg = "Something Went Wrong!";
                    }
            }
            $response = array('status' => $statusCode, 'message' => $msg, 'title' => 'Success');
            return response()->json($response);
    }
    public function showPendingAds() {
        $adminDetails = session('adminlogin');
        $allAds = Ads::where('status', 0)->get();
        return view('admin.showAllAds', compact('allAds', 'adminDetails'));
    }
    public function showApprovedAds() {
        $allAds = Ads::where('ads.status', 1)->join('users', 'users.id', '=', 'ads.updatedBy')->get();
        return view('admin.showAllAds', compact('allAds'));
    }
    public function showRejectedAds() {
        $allAds = Ads::where('ads.status', 2)->join('users', 'users.id', '=', 'ads.updatedBy')->get();
        return view('admin.showAllAds', compact('allAds'));
    }
    public function adEvent($event, Request $r) {
        // dd($r);
        $adId = $r->id;
        $updatedBy = $r->updatedBy;
        if($event == 'success') {
            Ads::where('id', $adId)->update([
                'status' => 1,
                'updatedBy' => $updatedBy,
                'paymentReceivedBy' => $r->paymentReceivedBy,
            ]);
        } elseif($event == 'cancel') {
            Ads::where('id', $adId)->update([
                'status' => 2,
                'updatedBy' => $updatedBy,
            ]);
        }
    }
    public function replyTicket(Request $r) {
        $existingTicket = Ticket::where('ticketId', $r->ticketId)->get();
        $groupedBy = $existingTicket->groupBy('ticketId');
        $existingTicket = $groupedBy->toArray();
        $existingTicketData = $existingTicket[$r->ticketId][0];
        if($existingTicketData['status'] != 1) {
            // Ticket::where('ticketId', $r->ticketId)->update([
            //     'status' => 0
            // ]);
            $newTicket = new Ticket;
            $newTicket->ticketId = $r->ticketId;
            $newTicket->userId = $existingTicketData['userId'];
            $newTicket->subject = $existingTicketData['subject'];
            // $newTicket->userMessage = $existingTicket['userMessage'];
            $newTicket->message = $r->ticketReply;
            $newTicket->userType = 1;
            $newTicket->status = 0;
            $status = 0;
            $msg = "";
            if($newTicket->save()) {
                $status = 1;
                $msg = "Success!";
            } else {
                $msg = "Failed!";
            }
            $existingTicket = Ticket::where('ticketId', $r->ticketId)->get();
            $groupedBy = $existingTicket->groupBy('ticketId');
            $existingTicket = $groupedBy->toArray();
            $response = array('status' => $status, 'msg' => $msg, 'data' => $existingTicket);
        } else {
            $response = array('status' => 0, 'msg' => 'Ticket already closed!', 'data' => $existingTicket);
        }
        return response()->json($response);
    }
    public function closeTicket(Request $r) {
        // dd($r);
        $closeTicket = Ticket::where('ticketId', $r->ticketId)->update([
            'status' => 1
        ]);
        if($closeTicket) {
            $response = array('status' => 1, 'msg' => 'Success!');
        } else {
            $response = array('status' => 0, 'msg' => 'Failed!');
        }
        return response()->json($response);
    }
}
