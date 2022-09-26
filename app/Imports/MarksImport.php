<?php

namespace App\Imports;

use App\Models\Mark;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MarksImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $class_group_id;
    private $subject_id;
    private $type;
    private $semester;

    public function __construct($class_group_id,$subject_id,$type,$semester) 
    {
        $this->class_group_id = $class_group_id;
        $this->subject_id = $subject_id;
        $this->type = $type;
        $this->semester = $semester;
    }

    

    public function model(array $row)
    {

       $student = Student::where('class_group_id',$this->class_group_id)
       ->where('father_name',$row['father'])
       ->join('users','students.user_id','=','users.id')
       ->where('first_name',$row['name'])
       ->where('last_name',$row['last'])->first();

       $student_id= $student->id;
    

        return new Mark([
            'type'  => $this->type,
            'semester'  => $this->semester,
            'value'   =>  $row['mark'],
            'subject_id'  =>   $this->subject_id ,
            'student_id'  =>   $student_id ,
        ]);
    }
}
