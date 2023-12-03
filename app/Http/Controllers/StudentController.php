<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

         foreach ($students as $student) {
            $response .=
               "<tr>
                            <td>" . $student->id . "</td>
                            <td><img src='storage/images/" . $student->avatar . "'width='50px' height='50px' class='img-thumbnail rounded-circle'></td>
                            <td>" . $student->name . "</td>
                            <td>" . $student->email . "</td>
                            <td><a href='#' id='" . $student->id . "'  data-bs-toggle='modal'
                            data-bs-target='#EditStudentsModal' class='editUserButton'>Edit</a> | Delete</td>
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


   public function edit(Request $request)
   {

      $userId = $request->id;
      //find data of id using Student model
      $student = Student::find($userId);
      return response()->json($student);
   }

   public function update(Request $request)
   {
      $fileName='';
      $student = Student::find($request->user_Id_hidden);
      //   return response()->json($student);
      if ($request->hasFile('avatar')) {

         $file=$request->file('avatar');
         $fileName=time().'.'.$file->getClientOriginalExtension();
         $file->storeAs('public/images', $fileName);
         //if want to delete the old picture
         if($student->avatar){
            Storage::delete('public/images'. $student->avatar);
         }

      } else {
         //if the existing file name
         $fileName=$student->avatar;
      }

      $student->update([
         'avatar' => $fileName,
         'name' => $request->name,
         'email' => $request->email,
      ]);

   }
}
