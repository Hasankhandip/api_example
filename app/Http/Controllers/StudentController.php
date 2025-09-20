<?php
namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class StudentController extends Controller {
    function list() {
        return Students::all();
    }
    function addStudent(Request $request) {
        $student        = new Students();
        $student->name  = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        if ($student->save()) {
            return ["result" => "new student added"];
        } else {
            return ["result" => "new student not added"];
        }
    }

    function updateStudent(Request $request) {
        $student        = Students::find($request->id);
        $student->name  = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        if ($student->save()) {
            return ["result" => "student updated"];
        } else {
            return ["result" => "student not updated"];
        }
    }

    function deleteStudent($id){
       $student=Students::destroy($id);
        if ($student) {
            return ["result" => "student record deleted"];
        } else {
            return ["result" => "student record not deleted"];
        }
    }
}
