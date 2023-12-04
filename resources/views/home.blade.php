<!doctype html>
<html lang="ar" dir="ltr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">

    {{-- data table style --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    {{-- bootstrap icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    {{-- sweet alert cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- jquery linking --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <title>Ajax Laravel</title>
</head>

<body>


    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Student Management System</h4>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#AddNewStudentsModal">
                            <i class="bi bi-plus-circle-fill"></i>
                            Add New Student
                        </button>
                    </div>
                    <div class="card-body">

                        {{-- <table id="studentDetailsTable" class="display">
                            <thead>
                                <tr>
                                    <th>Column 1</th>
                                    <th>Column 2</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Row 1 Data 1</td>
                                    <td>Row 1 Data 2</td>
                                </tr>
                                <tr>
                                    <td>Row 2 Data 1</td>
                                    <td>Row 2 Data 2</td>
                                </tr>
                            </tbody>
                        </table> --}}

                        <div id="show_all_student_data"></div>

                    </div>



                </div>
            </div>



        </div>
    </div>

    <!-- Add New Student Modal -->
    <div class="modal fade" id="AddNewStudentsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Student</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- student details <form action=""></form> --}}
                <form action="#" method="POST" id="addStudentDetailsForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <div class="row">
                            <div class="col-lg">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Avatar</label>
                                <div>
                                    <input type="file" class="form-control" id="colFormLabel"
                                        placeholder="col-form-label" name="avatar" required>
                                </div>
                            </div>
                            <div class="col-lg">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Name</label>
                                <div>
                                    <input type="text" class="form-control" id="colFormLabel"
                                        placeholder="col-form-label" name="name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">E-mail</label>
                            <div>
                                <input type="email" class="form-control" id="colFormLabel"
                                    placeholder="col-form-label" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="add_student_details_button">Add
                            Students</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- model/ --}}

    <!-- Edit Student Modal -->
    <div class="modal fade" id="EditStudentsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Student</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- student details <form action=""></form> --}}
                <form action="#" method="POST" id="UpdateStudentDetailsForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        {{-- hidden id input field --}}
                        <input type="hidden" id="user_Id" name="user_Id_hidden">

                        <div class="row">

                            {{-- load avatar image --}}
                            <div id="avatar1"></div>

                            <div class="col-lg">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Avatar</label>
                                <div>
                                    <input type="file" class="form-control" name="avatar">
                                </div>
                            </div>
                            <div class="col-lg">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Name</label>
                                <div>
                                    <input type="text" class="form-control" name="name" id="name1"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">E-mail</label>
                            <div>
                                <input type="email" class="form-control" name="email" id="email1" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="Update_student_details_button">Update
                            Student</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- edit student model/ --}}

    {{-- data table activation java script --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <!-- Option 1: Bootstrap Bundle with Popper js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    {{-- data table js --}}
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>



    <script>
        $(document).ready(function() {
            //Make table a data table
            // $('#studentDetailsTable').DataTable();

            //Add form
            $('#addStudentDetailsForm').submit(function(e) {
                e.preventDefault();
                //save form data to fd constant
                const fd = new FormData(this);
                //change submit button to adding
                $('#add_student_details_button').text('Adding..');


                $.ajax({
                    url: '{{ route('store') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 200) {
                            Swal.fire({
                                title: 'Added!',
                                text: 'Student Added Successfully',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            })
                            $('#add_student_details_button').text('Add Students');
                            $('#addStudentDetailsForm')[0].reset();
                            $('#AddNewStudentsModal').modal('hide');

                            fetchAllStudentData();

                        }
                    }
                });


            });

            //edit user button
            $(document).on('click', '.editUserButton', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                // alert(id);

                $.ajax({
                    url: '{{ route('edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {

                        // console.log(response.name);
                        // Set id value to the hidden field
                        $('#user_Id').val(response.id);
                        $('#name1').val(response.name);
                        $('#email1').val(response.email);
                        $('#avatar1').html(
                            `<img src="storage/images/${response.avatar}" width="100px" height="100px" class="img-fluid img-thumbnail">`
                        );

                    }


                });


            })

            //Update form
            $('#UpdateStudentDetailsForm').submit(function(e) {
                e.preventDefault();
                //save form data to fd constant
                const fd = new FormData(this);
                //change submit button to adding
                $('#Update_student_details_button').text('Updating..');


                $.ajax({
                    url: '{{ route('update') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 200) {
                            Swal.fire({
                                title: 'Updated!',
                                text: 'Student Updated Successfully',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            })
                            $('#Update_student_details_button').text(' Update Student');
                            $('#UpdateStudentDetailsForm')[0].reset();
                            $('#EditStudentsModal').modal('hide');

                            fetchAllStudentData();
                         }
                    }
               });


            });

            fetchAllStudentData();
            //fetch data from database function
            function fetchAllStudentData() {
                $.ajax({
                    url: '{{ route('fetchAll') }}',
                    method: 'get',
                    success: function(response) {
                        // console.log(response);
                        $('#show_all_student_data').html(response);
                        //Make table a data table
                        $('#studentDetailsTable').DataTable();
                    }


                });
            }

            //Delete student function
            $(document).on('click','.deleteUserButton',function(e){
                e.preventDefault();

                let id=$(this).attr('id');

                alert(id);
            })

        });
    </script>

</body>
