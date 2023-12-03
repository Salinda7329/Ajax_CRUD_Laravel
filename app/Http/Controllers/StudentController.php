<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function store(Request $request)
    {

        $file = $request->file('avatar');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $student = Student::create([
            'avatar' => $fileName,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json([
            'status' => 200,
        ]);
    }

    public function fetchAllData()
    {

        $students = Student::all();

        // return response()->json([
        //     'status' => $students,
        // ]);

        //returning data inside the table
        $response = '';

        if ($students->count() > 0) {

            $response .=
                "<table id='studentDetailsTable' class='display'>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach($students as $student){
            $response .=
                         "<tr>
                            <td>".$student->id."</td>
                            <td><img src='storage/images/".$student->avatar."'width='50px' height='50px' class='img-thumbnail rounded-circle'></td>
                            <td>".$student->name."</td>
                            <td>".$student->email."</td>
                            <td>Edit | Delete</td>
                        </tr>";
                    }

            $response .=
                     "</tbody>
                </table>";

            echo $response;
        } else {
            echo "<h3 align='center'>No Records in Database</h3>";
        }
    }
}
