<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use App\Student;

class StudentController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function showStudents()
    {
        return view('students', array("students" => Student::all()));
    }

    public function showScourses($id)
    {
        $courses = DB::select(DB::raw('SELECT scourses.student_id, scourses.course_id as id, courses.name FROM scourses, courses where student_id =' . $id . '  and courses.id = scourses.course_id  '));
        return view('scourses', array('courses' =>json_decode(json_encode($courses), True), 'stud_id' => $id));
    }

    public function modifyStudents($id, $data)
    {
        $arr = explode('wyrtoe12322', $data);
        DB::table('students')->where('id', $id)->update(['first_name' => $arr[0],'second_name' => $arr[1], 'birth_date' => $arr[2],
            'phone_number' =>$arr[3], 'address' => $arr[4], 'email' => $arr[5]]);
        return response()->json(array('msg' => 1), 200);
    }

    public function addStudents($data)
    {
        $arr = explode('wyrtoe12322', $data);
        DB::table('students')->insert(['first_name' => $arr[0],'second_name' => $arr[1], 'birth_date' => $arr[2],
            'phone_number' =>$arr[3], 'address' => $arr[4], 'email' => $arr[5]]);
        return response()->json(array('msg' => 1), 200);
    }

    public function delStudents($id)
    {
        $stud = Student::destroy($id);
        return response()->json(array('msg' => 'hello'), 200);
    }

    public function delCourse($stud_id, $course_id)
    {
        DB::table('scourses')->where('student_id', '=', $stud_id)->where('course_id', '=', $course_id)->delete();
        return response()->json(array('msg' => 'ee'), 200);
    }

    public function getCourses($stud_id)
    {
        $courses = DB::select(DB::raw('SELECT a.id, a.name from courses a WHERE a.id not in (select b.course_id from scourses b where b.student_id ='. $stud_id . ') ;'));
        return response()->json(array('msg' => json_decode(json_encode($courses), True)), 200);
    }

    public function addScourses($stud_id, $course_id)
    {
        DB::table('scourses')->insert(['student_id' => $stud_id, 'course_id' => $course_id]);
        return response()->json(array('msg' => 1), 200);
    }
}
