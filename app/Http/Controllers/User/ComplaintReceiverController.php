<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\ComplaintReceiver;

class ComplaintReceiverController extends Controller
{
  use GeneralTrait;

  public function StudentReceivedComplaints()
  {
    $user_id = auth()->user()->user_id;

    $compaints = ComplaintReceiver::where('receiver_id',$user_id)
    ->join('complaints','complaint_receivers.complaint_id','=','complaints.id')
    ->select('complaints.*','complaint_receivers.receiver_id')->get();

    $cipher = "AES-256-ECB";
    $secret = "1234567890123456";
    foreach ($compaints as $compaint) {
     $compaint->text = openssl_decrypt($compaint->text, $cipher, $secret);
    }

    if(!$compaints)
      return $this->returnError('E000', 'No Received Compaints Found');

    return $this->returnData('Compaints',$compaints); 
  }

  public function AdministratorReceivedComplaints()
  {
    $user_id = auth()->user()->user_id;

    $compaints = ComplaintReceiver::where('receiver_id',$user_id)
    ->join('complaints','complaint_receivers.complaint_id','=','complaints.id')
    ->join('users','complaints.sender_id','=','users.id')
    ->select('complaints.*','complaint_receivers.receiver_id','first_name','last_name')
     ->get();

    $cipher = "AES-256-ECB";
    $secret = "1234567890123456";
    foreach ($compaints as $compaint) {
     $compaint->text = openssl_decrypt($compaint->text, $cipher, $secret);
    }

    if(!$compaints)
      return $this->returnError('E000', 'No Received Compaints Found');
 
    return $this->returnData('Compaints',$compaints); 
  }

}

?>
