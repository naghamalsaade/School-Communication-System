<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Student;
use App\Models\User;
use App\Models\ClassGroup;

class StudentController extends Controller
{
  use GeneralTrait;

  public function groupstudents($class_id, $group_id)
  {
    $students = Student::whereHas('classGroup', function ($q) use ($class_id, $group_id) {
      $q->where('school_class_id', $class_id)->where('group_id', $group_id);
    })->join('users', 'students.user_id', '=', 'users.id')
      ->select('students.id', 'students.user_id', 'first_name', 'last_name', 'father_name', 'mother_name', 'students.phone')
      ->get();

    if (!$students)
      return $this->returnError('E000', 'No Students Found');

    return $this->returnData('Students', $students);
  }

  public function add(Request $request)
  {
    $user = new User;
    $student = new Student;

    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->email = $request->email;

    $user->save();

    $class_group_id = ClassGroup::where('school_class_id', $request->class_id)
      ->where('group_id', $request->group_id)->pluck('id');

    $student->father_name = $request->father_name;
    $student->mother_name = $request->mother_name;
    $student->phone = $request->phone;
    $student->user_id = $user->id;
    $student->user_name =  $user->first_name . "-" . $user->last_name . $user->id . mt_rand(0, 100);
    $student->password =  $student->user_name;
    $student->class_group_id = $class_group_id[0];

    $student->save();

    $response['data'] = $student;
    $response['message'] = "stor success";
    $response['status_code'] = 200;
    return response()->json($response, 200);
  }
}
