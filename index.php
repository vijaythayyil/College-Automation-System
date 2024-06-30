<?php 
  session_start();
  include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collage Automation</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center">Login Now</h2>
<form class="login-form" action="" method="post">
    <div class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">Role</label>
    <select class="form-control" name="role">
        <option value="Admin">Admin</option>
        <option value="HOD">HOD</option>
        <option value="Grievance Cell">Grievance Cell</option>
        <option value="Placement">Placement Cell</option>
        <option value="Staff">Staff</option>
        <option value="Student">Student</option>
    </select>
    </div>
  <div class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">Username</label>
    <input type="text" class="form-control" placeholder="Username" name="username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">Password</label>
    <input type="password" class="form-control" placeholder="Password" name="password">
  </div>
  
  
    <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" class="form-check-input">
      <small>Remember Me</small>
    </label>
    <button type="submit" class="btn btn-login float-right" name="smt">Login</button>
  </div>
  
</form>
		</div>
		<div class="col-md-8 banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                 <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
            <div class="carousel-inner" role="listbox">
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>U.C.E</h2>
            <p>Managed by Centre for Professional and Advanced Studies (CPAS)
Established by Government of Kerala</p>
        </div>	
  </div>
    </div>
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>U.C.E</h2>
            <p>Managed by Centre for Professional and Advanced Studies (CPAS)
Established by Government of Kerala</p>
        </div>	
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>U.C.E</h2>
            <p>Managed by Centre for Professional and Advanced Studies (CPAS)
Established by Government of Kerala</p>
        </div>	
    </div>
  </div>
</div>	   	    
	</div>
</div>
</div>
</section>
</body>
</html>
<?php
if(isset($_POST['smt']))
{

  if($_POST['role']=='Admin' and $_POST['username']=='admin' and $_POST['password']=='admin')
  {
    $_SESSION['role']='Admin';
    ?>
    <script> alert('Admin logged');window.location.href='admin/department.php?fetch';</script>
    <?php
  }
  else if($_POST['role']=='HOD')
  {
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql = "SELECT * FROM department where username='$username' and password='$password'";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) 
    {
      $row=mysqli_fetch_array($result);
      $_SESSION['role']='HOD';
      $_SESSION['did']=$row['department_Id'];
      $_SESSION['unm']=$row['HOD'];
      ?>
      <script> alert('HOD logged');window.location.href='HOD/subject.php?fetch';</script>
      <?php

    }

  }
  else if($_POST['role']=='Grievance Cell')
  {
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql = "SELECT * FROM grievance where username='$username' and password='$password'";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) 
    {
      $row=mysqli_fetch_array($result);
      $_SESSION['role']='Grievance Cell';
      $_SESSION['unm']=$row['name'];
      ?>
      <script> alert('Grievance Cell logged');window.location.href='Grievance/complaint.php?fetch';</script>
      <?php

    }

  }
  else if($_POST['role']=='Placement')
  {
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql = "SELECT * FROM placement where username='$username' and password='$password'";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) 
    {
      $row=mysqli_fetch_array($result);
      $_SESSION['role']='Placement';
      $_SESSION['unm']=$row['name'];

      ?>
      <script> alert('Placement logged');window.location.href='Placement/company.php?fetch';</script>
      <?php

    }

  }
  else if($_POST['role']=='Staff')
  {
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql = "SELECT * FROM staff where username='$username' and password='$password'";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) 
    {
      $row=mysqli_fetch_array($result);
      $_SESSION['role']='Staff';
      $_SESSION['Emp_Id']=$row['Emp_Id'];
      $_SESSION['d_id']=$row['department_Id'];
      $_SESSION['unm']=$row['name'];

      ?>
      <script> alert('Staff logged');window.location.href='Staff/student.php?fetch';</script>
      <?php

    }
  }
  else if($_POST['role']=='Student')
  {
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql = "SELECT * FROM student where username='$username' and password='$password'";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) 
    {
      $row=mysqli_fetch_array($result);
      $_SESSION['role']='Student';
      $_SESSION['student_id']=$row['student_id'];
      $_SESSION['unm']=$row['name'];
      ?>
      <script> alert('Student logged');window.location.href='student/marklist.php?fetch';</script>
      <?php

    }

  }
  else
  {
    ?>
    <script> alert('Username or Password Incorrect');window.location.href='index.php';</script>
    <?php
  }


}
?>