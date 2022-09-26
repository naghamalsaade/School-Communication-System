<?php

namespace App\Http\Controllers\User;

use App\Models\ClassSubject;
use App\Models\EducationalContent;
use App\Models\Student;
use Illuminate\Http\Request;

use App\Traits\GeneralTrait;
use App\Traits\FileTrait;
use App\Traits\PushNotificationTrait;

class EducationalContentController extends Controller
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
    $file = $this -> saveFile($request -> file , 'educational-content');

    $class_subject_id = ClassSubject::where('school_class_id', $request->class_id)->where('subject_id', $request->subject_id)->select('id')->first();


    $schedules = EducationalContent::create([
         'title'=> $request->title,
         'semester'=> $request->semester,
         'file'=> $file,
         'class_subject_id'=> $class_subject_id->id,
     ]);


    /*-------------------------- notificatio --------------------------*/
    $class_id = $request->class_id;
    $students = Student::with(['classGroup' => function($query) use ($class_id) { $query->where('school_class_id', $class_id);}])->select('fcm_token')->get();
    $body = "the administrator add new content";
    $this->sendNotification($students, 'Educatinam Content', $body);

    return $this->returnSuccessMessage('Content Add Successfully');
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

  public function all($subject_id)
  {
    $class_id = auth()->user()->classGroup->school_class_id;

    $files = EducationalContent::join('class_subject', 'educational_contents.class_subject_id', '=', 'class_subject.id')
    ->select('title', 'file')->where('class_subject.school_class_id', $class_id)->where('class_subject.subject_id' ,$subject_id)->get();

    if(!$files)
      return $this->returnError('E000', 'No Educational Content Found');

     return $this->returnData('Educational Content', $files); 
  }

}
