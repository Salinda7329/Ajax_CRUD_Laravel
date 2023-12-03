<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function store(Request $request){
        
        $file = $request->file('avatar');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images',$fileName);

        $student = Student::create([
            'avatar'=>$fileName,
            'name'=>$request->name,
            'email'=>$request->email,
        ]);

        return response()->json([
            'status' => 200,
        ]);



    }
}
