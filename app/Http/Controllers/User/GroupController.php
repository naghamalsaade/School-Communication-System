<?php 

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Group;

class GroupController extends Controller 
{
  use GeneralTrait; 
  
  public function groupsforadministrator($class_id)
  {
    $administrator_id = auth()->user()->id; 
    
    $groups = Group::whereHas('classGroup', function($q)use($administrator_id,$class_id){
      $q->where('administrator_id',$administrator_id)->where('school_class_id',$class_id);
    })->get();

    if(!$groups)
      return $this->returnError('E000', 'No Groups Found');

    return $this->returnData('Groups',$groups); 
  }

}
