<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\AttendanceCheck;

class AttendanceCheckController extends Controller
{
  use GeneralTrait;

  public function Attendances()
  {
    $student_id = auth()->user()->id;

    $attendances = AttendanceCheck::where('student_id',$student_id)->get();

    if(!$attendances)
      return $this->returnError('E000', 'No Attendances Found');

    return $this->returnData('Attendances',$attendances); 
  }

  public function AttendancesType($type)
  {
    $student_id = auth()->user()->id;
    
    $attendances = AttendanceCheck::where('student_id',$student_id )->where('type',$type)->get();
    
    if(!$attendances)
      return $this->returnError('E000', 'No Attendances for this type Found');

    return $this->returnData('Attendances',$attendances); 
  }

  public function studentAttendances($id)
  {
    $attendances = AttendanceCheck::where('student_id', $id)->get();

    if(!$attendances)
      return $this->returnError('E000', 'No Attendance Found');

    return $this->returnData('Attendance',$attendances); 
  }

  public function store(Request $request)
  {
    AttendanceCheck::create([
      'date' => $request->date,
      'type' => $request->type,
      'student_id' => $request->student_id,
    ]);

    return $this->returnSuccessMessage('Attendance Check Add Successfully');
  }

}

?>
