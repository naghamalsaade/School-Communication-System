<?php 

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\SchoolClass;

class ClassController extends Controller 
{
  use GeneralTrait;

  public function classesforadministrator()
  {
    $administrator_id = auth()->user()->id; 

     $classes = schoolClass::whereHas('groupes', function($q)use($administrator_id) {
      $q->where('administrator_id',$administrator_id); })->get();

    if(!$classes)
      return $this->returnError('E000', 'No Classes Found');

    return $this->returnData('Classes',$classes); 
  }

  public function all()
  {
    $classes = schoolClass::all();

    if(!$classes)
      return $this->returnError('E000', 'No Classes Found');

    return $this->returnData('Classes',$classes); 
  }

  public function add(Request $request)
  {
     $class = new SchoolClass;
   
     $class->name= $request->name;
     $class->save();

     return $this->returnSuccessMessage('Class Add Successfully');
  }
  
}

?>