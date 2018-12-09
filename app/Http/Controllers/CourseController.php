<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Course;

class CourseController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function showCourses()
    {
        $courses = DB::select(DB::raw('SELECT a.id, a.name, (select COUNT(b.student_id) from scourses b where b.course_id = a.id) AS amount FROM courses a order by a.id  '));
        return view('courses', array('courses' =>json_decode(json_encode($courses), True)));
    }

    public function modifyCourses($id, $name)
    {
        DB::table('courses')->where('id',$id)->update(array(
            'name'=>$name,));
        return response()->json(array('msg' => $name), 200);
    }

    public function addCourses($name)
    {
        DB::table('courses')->insert(['name' => $name]);
    }

    public function delCourses($id)
    {
        Course::destroy($id);
    }
// Course members managment
    public function filterCourses($id)
    {
        $stud = DB::select(DB::raw('SELECT id, first_name, second_name, birth_date, email, scourses.course_id 
                                          from students, scourses where students.id = scourses.student_id and scourses.course_id = '. $id .' ;'));
        $stud = json_decode(json_encode($stud), True);
        return view('cmembers', array('stud' => $stud, 'course_id' => $id));
    }

    public function delMembers($stud_id, $course_id)
    {
        DB::table('scourses')->where('student_id', $stud_id)->where('course_id', $course_id)->delete();
    }

    public function addMembers($stud_id, $course_id)
    {
        DB::table('scourses')->insert(['student_id' => $stud_id, 'course_id' => $course_id]);
        return response()->json(array('msg' => 1), 200);
    }

    public function test()
    {
        return view('test');
    }

    public function courseStudents($id)
    {
        $stud = DB::select(DB::raw('SELECT a.id, a.first_name, a.second_name, a.birth_date, a.email from students a 
                                          WHERE a.id not in (select b.student_id from scourses b where b.course_id = '. $id . ') ;'));
        return response()->json(array('msg' => json_decode(json_encode($stud), True)), 200);
    }


}
