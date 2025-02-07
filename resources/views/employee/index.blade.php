<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://kit.fontawesome.com/86bd885781.js" crossorigin="anonymous"></script>
</head>

<body>

  <!-- navbar -->

  <nav class="navbar navbar-expand-lg bg-success-subtle shadow-lg border border-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <form class="d-flex" role="search">
        <a href="{{route('loadView.emp.add')}}" class="btn btn-success" type="submit">Create</a>
      </form>
      </td>
    </div>
  </nav>

  <!-- list data -->

  <div class="container my-4">
    <table class="table table-success table-striped-columns">
      <thead>
        <tr>
          <th scope="col">Emp_ID</th>
          <th scope="col">Emp_Name</th>
          <th scope="col">Emp_Email</th>
          <th scope="col">Emp_Phone</th>
          <th scope="col">Emp_Designation</th>
          <th scope="col">Emp_Department</th>
          <th scope="col">Emp_Joining_Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="employeeTable">

      </tbody>
    </table>
  </div>
  <script>
    $(document).ready(function () {
      loadEmpList();

      // update the employee details functions
      $(document).on('click', '.updateBtn', function () {

        var employeeId = $(this).data('id'); //take data from data-idattribute

        $.ajax({
          url: "{{route('update_emps', ':id')}}".replace(':id', employeeId),
          type: 'GET',
          dataType: 'json',
          success: function (response) {
            console.log(response.data[0].emp_id);
            if (response.redirect_url) {
              window.location.href = response.redirect_url;
            }
          }

        });

      })

    });

    // load all the employee from database.table
    function loadEmpList() {
      $('#employeeTable').html('<tr><td colspan="8">Loading...</td></tr>'); // Show loading message
      $.ajax({
        url: "{{route('fetch_emps')}}",
        type: 'GET',
        dataType: 'json',
        success: function (data) {

          if (data.statsu = true) {

          } else {
            $('#employeeTable').html(data.msg); // Clear table
          }
          var rows = '';
          $.each(data, function (index, employee) {
            rows += `
              <tr>
                <td>${employee.emp_id}</td>
                <td>${employee.emp_name}</td>
                <td>${employee.emp_email}</td>
                <td>${employee.emp_phone}</td>
                <td>${employee.emp_designation}</td>
                <td>${employee.emp_department}</td>
                <td>${employee.emp_joining_date}</td>
                <td>
                  <a href="employee/update/${employee.emp_id}" class="update_Btn mx-2"><i class="fa-duotone fa-solid fa-user-pen "></i></a>
                  <a href="employee/${employee.emp_id}" class="deleteBtn"><i class="fa-duotone fa-solid fa-trash"></i></a>
                </td>
              </tr> `
          });
          $('#employeeTable').html(rows);
        },
        error: function (xhr, status, error) {
          alert("failed to load employees data");
        }

      });
    }



  </script>
</body>

</html>

<script>

</script>