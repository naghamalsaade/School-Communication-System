<?php 

namespace App\Http\Controllers\User;

use App\Models\ClassGroup;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Student;
use App\Traits\GeneralTrait;
use App\Traits\FileTrait;
use App\Traits\PushNotificationTrait;

class ScheduleController extends Controller 
{
  use GeneralTrait;
  use FileTrait;
  use PushNotificationTrait;

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    //save file in folder.
    $file = $this -> saveFile($request -> file , 'schedules');

     $class_group_id = ClassGroup::where('school_class_id', $request->class_id)->where('group_id', $request->group_id)->select('id')->first();

    $schedules = Schedule::create([
         'type'=> $request->type,
         'semester'=> $request->semester,
         'file'=> $file,
         'class_group_id'=> $class_group_id->id,
     ]);

    /*-------------------------- notificatio --------------------------*/
    $students = Student::where('class_group_id', $class_group_id);
    $body = "the administrator add new scheduale";
    $this->sendNotification($students, 'New Scheduale', $body);

    return $this->returnSuccessMessage('Schedule Add Successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }

  public function allExamScheduales($semester_id)
  {
    $student_class_group_id = auth()->user()->class_group_id;

    $scheduales = Schedule::where('class_group_id', $student_class_group_id)
    ->where('semester', $semester_id)
    ->where('type', 1)->select('type', 'file', 'semester')->get();

    if(!$scheduales)
      return $this->returnError('E000', 'No Scheduals Found');

    return $this->returnData('Exam-Scheduales', $scheduales); 
  }

  public function allWorkScheduales($semester_id)
  {
    $student_class_group_id = auth()->user()->class_group_id;

    $scheduales = Schedule::where('class_group_id', $student_class_group_id)
    ->where('semester', $semester_id)
    ->where('type', 2)->select('type', 'file')->get();

    if(!$scheduales)
      return $this->returnError('E000', 'No Scheduals Found');

    return $this->returnData('Work-Scheduales', $scheduales); 
  }

  public function admineSchedules($semester_id)
  {
    $administrator_id = auth()->user()->id;

    $scheduales = Schedule::join('class_group', 'schedules.class_group_id', '=', 'class_group.id')
    ->join('school_classes', 'class_group.school_class_id', '=', 'school_classes.id')
    ->join('groups', 'class_group.group_id', '=', 'groups.id')
    ->where('class_group.administrator_id', $administrator_id)->where('schedules.semester', $semester_id)
    ->select('school_classes.name as class', 'groups.name as group', 'type', 'file', 'semester')->get();

    if(!$scheduales)
      return $this->returnError('E000', 'No Scheduals Found');

    return $this->returnData('Scheduals', $scheduales); 
  }
}

?>