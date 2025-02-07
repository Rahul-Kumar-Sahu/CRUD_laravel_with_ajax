<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function () {

            //    when click the submit button
            $('#addEmp').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{route('emp.data.store')}}",
                    type: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        emp_id: $('#emp_id').val(),
                        emp_name: $('#name').val(),
                        emp_email: $('#email').val(),
                        emp_phone: $('#phone').val(),
                        emp_address: $('#address').val(),
                        emp_designation: $('#designation').val(),
                        emp_department: $('#department').val(),
                        emp_joining_date: $('#dateOfJoining').val()

                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            $('#addEmp').trigger('reset');

                        }
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                        alert("Error: " + error);
                    }
                });
            })
        })
    </script>

    <style>
        .w-45 {
            width: 45%;
        }
    </style>
</head>

<body>

    <div class="container w-50 border p-4 mt-5 shadow-lg">
        <form id="addEmp">
            @csrf
            <h2 class="pb-3">Employee Details Form</h2>
            <div class="d-flex flex-wrap justify-content-between">
                <input id="emp_id" type="hidden" name="emp_id" value="{{@$details->emp_id}}">
                <div class="mb-3 w-45">
                    <label for="disabledTextInput" class="form-label">Employee Name</label>
                    <input type="text" id="name" class="form-control" placeholder="Name.."
                        value="{{ @$details->emp_name }}">
                </div>

                <div class="mb-3 w-45">
                    <label for="disabledTextInput" class="form-label">Employee Email</label>
                    <input type="email" id="email" value="{{ @$details->emp_email}}" class="form-control"
                        placeholder="example@gmail.com">
                </div>

                <div class="mb-3 w-45">
                    <label for="disabledTextInput" class="form-label">Employee Phone</label>
                    <input type="text" pattern="[0-9]+" minlength="10" maxlength="10" id="phone" class="form-control"
                        placeholder="**********" value="{{ @$details->emp_phone }}">
                </div>

                <div class="mb-3 w-45">
                    <label for="disabledTextInput" class="form-label">Employee Desigation</label>
                    <input type="text" id="designation" class="form-control" placeholder="Job title.."
                        value="{{ @$details->emp_designation }}">
                </div>

                <div class="mb-3 w-45">
                    <label for="disabledTextInput" class="form-label">Employee Department</label>
                    <input type="text" id="department" class="form-control" placeholder="Dept.."
                        value="{{ @$details->emp_department }}">
                </div>

                <div class="mb-3 w-45">
                    <label for="disabledTextInput" class="form-label">Date of Joinning</label>
                    <input type="date" id="dateOfJoining" class="form-control"
                        value="{{ @$details->emp_joining_date }}">
                </div>

                <div class="mb-3 w-100">
                    <label for="disabledTextInput" class="form-label">Employee Address</label>
                    <textarea type="text" id="address" class="form-control" style=""
                        placeholder="Your Address..">{{ @$details->emp_address }}"</textarea>
                </div>
            </div>
            @if(@$details->emp_id)
                <button type="submit" class="btn btn-primary w-100">Update</button>
            @else
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            @endif

        </form>
    </div>

</body>

</html>