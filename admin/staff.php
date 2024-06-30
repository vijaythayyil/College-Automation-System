<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Automation</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="topmenu">
<h3>c-Automation</h3>
<li onclick="window.location.href='../index.php'">Welcome Admin <i class="fa fa-sign-out" aria-hidden="true" style="padding-left: 15px;"></i> Logout</li>
</div>
<div class="leftmenu">
<l style="width: 90%; float: left; margin-bottom: 20px; font-weight: 700; font-size: 20px; margin-left: 20px; background-color: whitesmoke; border-radius: 5px; padding: 5px; padding-left: 10px; padding-right: 35px;"><i class="fa fa-home" aria-hidden="true"></i> Dashbord</l>
<li onclick="window.location.href='department.php?fetch'"><i class="fa fa-th" aria-hidden="true"></i> Department</li>
<li onclick="window.location.href='staff.php?fetch'"><i class="fa fa-id-card" aria-hidden="true"></i> Staff</li>
<li onclick="window.location.href='placement.php?fetch'"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Placement</li>
<li onclick="window.location.href='grievance.php?fetch'"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Grievance Cell</li>
<li onclick="window.location.href='complaint.php?fetch'"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Complaints</li>
</div>
<div class="rightsec">
<div class="subsec">
    <div class="bar">
        <li>Staff</li>
        <input type="submit" value="Add New" class="btn btn-info btn-sm mt-3 mr-4 pull-right" onclick="window.location.href='staff.php?addnew'">
    </div>
    <?php 
      include('../connection.php');
      if(isset($_GET['fetch']))
      {
    ?>
    <div class="tbl">
    <table class="table table-hover" style="float: left;">
        <thead>
          <tr>
            <th>Emp-Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th width="15%">Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
           $sql = "SELECT * FROM department d inner join staff s on s.department_Id=d.department_Id";
           $result = mysqli_query($conn, $sql);
            
           if (mysqli_num_rows($result) > 0) 
           {
            while($row = mysqli_fetch_assoc($result)) 
            {
        ?>
          <tr>
            <td><?php echo $row["Emp_Id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["department"]; ?></td>
            <td>
            <input type="submit" value="Delete" class="btn btn-danger btn-sm mr-2 pull-right" onclick="window.location.href='staff.php?delete=<?php echo $row['Emp_Id']; ?>'">
            <input type="submit" value="Edit" class="btn btn-info btn-sm  mr-2 pull-right" onclick="window.location.href='staff.php?edit=<?php echo $row['Emp_Id']; ?>'">
            </td>
          </tr>
          <?php
            }
          }
          else 
          {?>

            <td colspan="5"><?php echo "0 results"; ?></td>

          <?php
          }
          ?>
        </tbody>
      </table>
    </div>

    <?php
      }
      if(isset($_GET['addnew']))
      {
    ?>
        <div class="container" style="padding-top:15px; float:left;">
         <form action="" method="post" enctype="multipart/form-data">
           <div class="form-group" style="width:35%;">
             <label for="">Please Choose your file</label>
             <input type="file" name="files" class="form-control"/>
             <input type="submit" value="Submit" class="btn btn-success mt-3 pull-left">
             <input type="button" value="Cancel" class="btn btn-danger mt-3 ml-3 pull-left" onclick="window.location.href='staff.php?fetch'">
           </div>
         </form>
        </div>
   <?php 
      }
      
    if(isset($_GET['edit']))
      {
        $dptid=$_GET['edit'];

        $sql="SELECT * FROM department d inner join staff s on s.department_Id=d.department_Id where s.Emp_id='$dptid'";
        $emp = mysqli_query($conn, $sql);

        $sql1="select * from department";
        $dpt_list = mysqli_query($conn, $sql1);
    ?>
      <div class="container pb-4" style="padding-top:15px; float:left;">
      <?php
        while($row = mysqli_fetch_assoc($emp)) 
        {

      ?>
         <form action="" method="post">
         <div class="container">
          <div class="row">

            <div class="col-sm-2">
              <div class="form-group">
                <label for="">Name</label>
                <input type="hidden" value="<?php echo $_GET['edit']; ?>" name="id"/>
                <input type="" placeholder="Name" class="form-control" name="name" value="<?php echo $row["name"]; ?>"/>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="">Email</label>
                <input type="" placeholder="Email" class="form-control" name="email" value="<?php echo $row["email"]; ?>"/>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="">Department</label>
                <select class="form-control" name="department">
                <option value="">Department</option>
                <?php
                while($row_dpt = mysqli_fetch_assoc($dpt_list)) 
                {
                ?>
                  <option  <?php if($row['department_Id']==$row_dpt['department_Id']){ echo 'selected';} ?> value="<?php echo $row_dpt['department_Id']; ?>"><?php echo $row_dpt['department']; ?></option>
                <?php
                }
                ?>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <label for="">Username</label>
                <input type="" placeholder="Username" class="form-control" name="username" value="<?php echo $row["username"]; ?>"/>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <label for="">Password</label>
                <input type="" placeholder="Password" class="form-control" name="password" value="<?php echo $row["password"]; ?>"/>
              </div>
            </div>
           
            <div class="col-sm-12">
             <input type="submit" value="Update" class="btn btn-success mt-3 pull-left" name="update">
             <input type="button" value="Cancel" class="btn btn-danger mt-3 ml-3 pull-left" onclick="window.location.href='staff.php?fetch'">
            </div>
          </div>
        </div>
        </form>
        <?php
        }
        ?>
        </div>
    <?php 
        }
      ?>
</div>
</div>
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery-3.2.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html> 
<?php

if(isset($_FILES['files']))
{

  $file = $_FILES['files']['tmp_name'];
  $handle = fopen($file, "r");
  $c = 0;
  while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
  {
      $Emp_Id = $filesop[0];
      $name = $filesop[1];
      $email = $filesop[2];
      $department_Id = $filesop[3];
      $username = $filesop[4];
      $password = $filesop[5];
      
      $sql = "insert into staff(Emp_Id,name,email,department_Id,username,password) values ('$Emp_Id','$name','$email','$department_Id','$username','$password')";
      $stmt = mysqli_query($conn,$sql);
      $c = $c + 1;
  }

  if($stmt)
  {
    ?>  
    <script> alert('staffs added to Database');window.location.href='staff.php?fetch';</script>
    <?php
  } 
  else
  {
    ?>  
    <script> alert('Sorry! Unable to import');window.location.href='staff.php?addnew';</script>
    <?php
  }
}



if(isset($_POST['update']))
{

    $id=$_POST['id'];
    $nama=$_POST['name'];
    $email=$_POST['email'];
    $department=$_POST['department'];
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql="UPDATE `staff` SET `name`='$nama',`email`='$email',`department_Id`='$department',`username`='$username',`password`='$password' WHERE `Emp_Id`='$id'";
    if (mysqli_query($conn, $sql)) 
    {
     ?>
     <script> alert('Staff Updated');window.location.href='staff.php?fetch';</script>
     <?php
    }

}
if(isset($_GET['delete']))
{

    $id=$_GET['delete'];

    $sql="DELETE FROM `staff` WHERE `Emp_Id`='$id'";
    if (mysqli_query($conn, $sql)) 
    {
     ?>
     <script> alert('Staff Removed');window.location.href='staff.php?fetch';</script>
     <?php
    }

}

?>