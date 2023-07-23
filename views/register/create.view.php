<?php

require base_path("/views/partials/head.php");

?>

<div class="container-fluid">
  <div class="mx-auto shadow rounded p-4" style="width: 100%; max-width: 340px; margin-top: 50px;">
    <h2 class="text-center">My School</h2>
    <img src="/assets/imgs/logo.png" alt="School Logo" class="border border-primary rounded-circle d-block mx-auto" style="width: 100px" />
    <h3 style="margin-block: 10px;">Add User</h3>
    <input type="text" name="first_name" placeholder="First Name" class="form-control my-2">
    <input type="text" name="last_name" placeholder="Last Name" class="form-control my-2">
    <input type="email" name="email" placeholder="Email" class="form-control my-2">
    <select name="gender" id="" class="form-control my-2">
      <option value="">--Select a Gender--</option>
      <option value="male">Male</option>
      <option value="female">Female</option>
    </select>
    <select name="gender" id="" class="form-control my-2">
      <option value="">--Select a Rank--</option>
      <option value="student">Student</option>
      <option value="reception">Reception</option>
      <option value="lecturer">Lecturer</option>
      <option value="admin">Admin</option>
      <option value="super_admin">Super Admin</option>
    </select>
    <input type="text" name="password" placeholder="Password" class="form-control my-2">
    <input type="text" name="cfPassword" placeholder="Retype Password" class="form-control my-2">
    <br>
    <button class="btn btn-primary float-end">Add User</button>
    <button class="btn btn-danger text-white">Cancel</button>
  </div>
</div>

<?php

require base_path("/views/partials/footer.php");

?>