<?php 

namespace App\Http\Controllers\User;

use App\Models\Event;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Traits\PushNotificationTrait;

class EventController extends Controller 
{

  use GeneralTrait;
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
    $event = Event::create([
      'date'=> $request->date,
      'title'=> $request->title,
      'description'=> $request->description,
  ]);

    $event -> schoolClasses() -> syncWithoutDetaching($request->class_ids);

    /*-------------------------- notificatio --------------------------*/
    $ids = $request->class_ids;
    $students = Student::with(['classGroup' => function($query) use ($ids) { $query->whereIn('school_class_id', $ids);}])->select('fcm_token')->get();
    $body = "administrator ".auth()->user()->user_name." add new event";
    $this->sendNotification($students, 'New Event', $body);

    return $this->returnSuccessMessage('Event Add Successfully');
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

  public function all()
  { 
    $class_id = auth()->user()->classGroup->school_class_id;
    $events = Event::join('class_event', 'events.id', '=', 'class_event.event_id')->where('school_class_id', $class_id)->select('title', 'date', 'description')->get();

    if(!$events)
      return $this->returnError('E000', 'No Event Found');

    return $this->returnData('Events', $events);
  }

  public function admineEvents()
  { 
    $administrator_id = auth()->user()->id;
  
    $events = Event::join('class_event', 'class_event.event_id', '=', 'events.id')
    ->join('school_classes', 'school_classes.id', '=', 'class_event.school_class_id')
    ->join('class_group', 'class_group.school_class_id', 'school_classes.id')
    ->where('class_group.administrator_id', $administrator_id)
    ->select('title', 'date', 'description', 'school_classes.name as class')->get();

    if(!$events)
      return $this->returnError('E000', 'No Event Found');

    return $this->returnData('Events', $events);
  }

}
?>