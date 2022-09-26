<?php 

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Administrator;
use App\Models\Complaint;
use App\Models\ClassGroup;
use App\Models\ComplaintReceiver;
use App\Models\Student;
use App\Traits\PushNotificationTrait;

class ComplaintController extends Controller 
{
  use GeneralTrait;
  use PushNotificationTrait;

  public function StudentSentComplaints()
  {
    $user_id = auth()->user()->user_id;
    $complaints = Complaint::where('sender_id',$user_id)->get();

    $cipher = "AES-256-ECB";
    $secret = "1234567890123456";
    foreach ($complaints as $compaint) {
      $compaint->text = openssl_decrypt($compaint->text, $cipher, $secret);
    }

    if(!$complaints)
      return $this->returnError('E000', 'No Sent Complaints Found');

    return $this->returnData('Compaints',$complaints); 
  }
 
  public function AdministratorSentComplaints()
  {
    $user_id = auth()->user()->user_id;
    
    $complaints = Complaint::where('sender_id', $user_id)
    ->join('complaint_receivers','complaints.id','=','complaint_id')
    ->join('users','complaint_receivers.receiver_id','=','users.id')
    ->select('complaints.*', 'complaint_receivers.receiver_id','first_name','last_name')
    ->get();

    $cipher = "AES-256-ECB";
    $secret = "1234567890123456";
    foreach ($complaints as $compaint) {
     $compaint->text = openssl_decrypt($compaint->text, $cipher, $secret);
    }

    if(!$complaints)
      return $this->returnError('E000', 'No Sent Complaints Found');
 
    return $this->returnData('Compaints',$compaints); 
  }

  public function AddAdministratorComplaint(Request $request)
  {
      $sender_id = auth()->user()->user_id;

      $information = $request->text;
      $cipher = "AES-256-ECB";
      $secret = "1234567890123456";
      $complaint = openssl_encrypt($information, $cipher, $secret);

      $compaint = Complaint::create([
      'title' => $request->title,
      'text' =>  $complaint,
      'date' => $request->date,
      'sender_id' => $sender_id,
    ]);
  

      $receive = ComplaintReceiver::create([
      'complaint_id'=> $compaint->id,
      'receiver_id' => $request->receiver_id,
    ]);

    /*-------------------------- notificatio --------------------------*/
    $student = Student::where('id',  $request->receiver_id)->select('fcm_token')->get();
    $body = auth()->user()->user_name." send new complaint";
    
    $this->sendNotification($student, "Complaint", $body);

    return $this->returnSuccessMessage('Complaint Add Successfully');
  }

  public function AddStudentComplaint(Request $request)
  {
    $sender_id = auth()->user()->user_id;

    $information = $request->text;
    $cipher = "AES-256-ECB";
    $secret = "1234567890123456";
    $complaint = openssl_encrypt($information, $cipher, $secret);

    $compaint = Complaint::create([
      'title' => $request->title,
      'text' =>  $complaint,
      'date' => $request->date,
      'sender_id' => $sender_id,
    ]);

    $administrator_id= auth()->user()->classGroup->administrator_id;

    $receiver_id = Administrator::where('id', $administrator_id)->pluck('user_id')[0];
    
    $receive = ComplaintReceiver::create([
      'complaint_id' => $compaint->id,
      'receiver_id' => $receiver_id ,
    ]);

    /*-------------------------- notificatio --------------------------*/
    $classGoup = auth()->user()->class_group_id;
    $adminstrator_id = ClassGroup::where('id', $classGoup)->select('administrator_id')->get();

    $administrator = Administrator::where('id', $adminstrator_id)->select('fcm_token')->get();
    $body = auth()->user()->user_name." send new complaint";
    
    $this->sendNotification($administrator, "Complaint", $body);
  
    return $this->returnSuccessMessage('Complaint Add Successfully');
  }
  
}

?>