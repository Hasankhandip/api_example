<?php
namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller {
    function list() {
        return Students::all();
    }
    function addStudent(Request $request) {
        $rules = [
            'name' => 'required | min:2 | max:10',
            'email' => 'email | required',
            'phone' => 'required',
        ];
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $validation->errors();
        } else {

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

    function deleteStudent($id) {
        $student = Students::destroy($id);
        if ($student) {
            return ["result" => "student record deleted"];
        } else {
            return ["result" => "student record not deleted"];
        }
    }

    function searchStudent($name) {
        $student = Students::where('name', 'like', "%$name%")->get();
        if ($student) {
            return ["result" => $student];
        } else {
            return ["result" => "No record found"];
        }
    }
}
