<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TicketController extends Controller
{
    public function openSupportTicket() {
        $userDetails = session('userlogin');
        return view('support.create', [
            'userDetails' => $userDetails,
        ]);
    }
    public function storeSupportTicket(Request $r) {
        $ticketId = uniqid();
        $newTicket = new Ticket;
        $newTicket->ticketId = $ticketId;
        $newTicket->userId = user('id');
        $newTicket->subject = $r->subject;
        $newTicket->message = $r->message;
        $newTicket->userType = 0;
        $newTicket->status = 0;
        $status = 0;
        $msg = "";
        if($newTicket->save()) {
            $status = 1;
            $msg = "Success!";
        } else {
            $msg = "Failed!";
        }
        $response = array('statusCode' => $status, 'msg' => $msg);
        return response()->json($response);
    }
    public function viewAllTickets() {
        $userAllTickets = User::join('tickets', 'tickets.userId', '=', 'users.id')->where('tickets.userId', user('id'))->get();
        // $userAllTickets = Ticket::where('userId', user('id'))->get();
        
        $groupedBy = $userAllTickets->groupBy('ticketId');
        $userAllTickets = $groupedBy->toArray();
        if($userAllTickets) {
            $status = 1;
            $msg = 'Success!';
            $data = $userAllTickets;
        } else {
            $status = 0;
            $msg = 'Failed!';
            $data = array();
        }
        $response = array('statusCode' => $status, 'msg' => $msg, 'userAllTickets' => $data);
        // $userAllTickets = response()->json($response);
        return view('viewTickets', compact('userAllTickets'));
    }
    public function replyTicket(Request $r) {
        // dd($r);
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
            $newTicket->userType = 0;
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
}
