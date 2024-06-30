<?php

session_start();
$unm=$_SESSION['unm'];
?>

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
<h3>C-Automation</h3>
<li onclick="window.location.href='../index.php'">Welcome <?php echo ucfirst($unm) ?> <i class="fa fa-sign-out" aria-hidden="true" style="padding-left: 15px;"></i> Logout</li>
</div>
<div class="leftmenu">
<l style="width: 90%; float: left; margin-bottom: 20px; font-weight: 700; font-size: 20px; margin-left: 20px; background-color: whitesmoke; border-radius: 5px; padding: 5px; padding-left: 10px; padding-right: 35px;"><i class="fa fa-home" aria-hidden="true"></i> Dashbord</l>
<li onclick="window.location.href='student.php?fetch'"><i class="fa fa-id-card" aria-hidden="true"></i> Student</li>
<li onclick="window.location.href='mark.php?fetch'"><i class="fa fa-id-card" aria-hidden="true"></i> Marklist</li>
<li onclick="window.location.href='resultanalisis.php?fetch'"><i class="fa fa-id-card" aria-hidden="true"></i> Result Analysis</li>

<li onclick="window.location.href='studentrecord.php?fetch'"><i class="fa fa-id-card" aria-hidden="true"></i> Student Record</li>  

</div>
<div class="rightsec">
<div class="subsec">
    <div class="bar">
        <li>Student</li>
        <input type="submit" value="Add New" class="btn btn-info btn-sm mt-3 mr-4 pull-right" onclick="window.location.href='student.php?addnew'">
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
            <th>Student ID</th>
            <th>Rollno</th>
            <th>Name</th>
            <th>Department</th>
            <th>Year of Admission</th>
            <th>Current Semester</th>
            <th>SGPA</th>
            <th width="15%">Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $d_id=$_SESSION['d_id'];
           $sql = "SELECT * FROM student s inner join department d on s.department_Id=d.department_Id where s.department_Id='$d_id'";
           $yadm = "SELECT year_of_admission FROM department d inner join student s on s.department_Id=d.department_Id where s.department_Id='$d_id'";
           $result = mysqli_query($conn, $sql);
           $yadm = mysqli_query($conn, $yadm);
           $row = mysqli_fetch_assoc($yadm);
           $yadm=$row["year_of_admission"];
           $currentyear= date("Y");
           $result = mysqli_query($conn, $sql);
            
          
           if (mysqli_num_rows($result) > 0) 
           {
            while($row = mysqli_fetch_assoc($result)) 
            {
             if(($currentyear-$row["year_of_admission"])<=4)
              {

             
        ?>
          <tr>
            <td><?php echo $row["student_id"]; ?></td>
            <td><?php echo $row["rollno"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["department"]; ?></td>
            <td><?php echo $row["year_of_admission"]; ?></td>
            <td><?php echo $row["current_sem"]; ?></td>
            <td><?php echo $row["sgpa"]; ?></td>
            <td>
            <input type="submit" value="Delete" class="btn btn-danger btn-sm mr-2 pull-right" onclick="window.location.href='student.php?delete=<?php echo $row['student_id']; ?>'">
            <input type="submit" value="Edit" class="btn btn-info btn-sm  mr-2 pull-right" onclick="window.location.href='student.php?edit=<?php echo $row['student_id']; ?>'">
            </td>
          </tr>
        <?php
            }
          
           }
          }
          else 
          {
        ?>

            <td colspan="5"><?php echo "0 results"; ?></td>

        <?php
          }
        
       
        //if i creadted for new update ends here
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
             <input type="button" value="Cancel" class="btn btn-danger mt-3 ml-3 pull-left" onclick="window.location.href='student.php?fetch'">
           </div>
         </form>
        </div>
   <?php 
      }
      if(isset($_GET['edit']))
      {
        $dptid=$_GET['edit'];

        $sql="SELECT * FROM department d inner join student s on s.department_Id=d.department_Id where s.student_id='$dptid'";
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
                <label for="">Rollno</label>
                <input type="hidden" value="<?php echo $_GET['edit']; ?>" name="id"/>
                <input type="" placeholder="Rollno" class="form-control" name="rollno" value="<?php echo $row["rollno"]; ?>"/>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="">Name</label>
                <input type="" placeholder="Name" class="form-control" name="name" value="<?php echo $row["name"]; ?>"/>
              </div>
            </div>
            <div class="col-sm-4">
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
                <label for="">SGPA</label>
                <input type="" placeholder="Name" class="form-control" name="sgpa" value="<?php echo $row["sgpa"]; ?>"/>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="">year of Admission</label>
                <input type="" placeholder="year of Admission" class="form-control" name="yandm" value="<?php echo $row["year_of_admission"]; ?>"/>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="">Semester</label>
                <select class="form-control" name="semester">
                  <option value="">Semester</option>
                  <option <?php if($row["current_sem"]=="1st"){ echo 'selected';} ?> value="1st">1st</option>
                  <option <?php if($row["current_sem"]=="2nd"){ echo 'selected';} ?> value="2nd">2nd</option>
                  <option <?php if($row["current_sem"]=="3rd"){ echo 'selected';} ?> value="3rd">3rd</option>
                  <option <?php if($row["current_sem"]=="4th"){ echo 'selected';} ?> value="4th">4th</option>
                  <option <?php if($row["current_sem"]=="5th"){ echo 'selected';} ?> value="5th">5th</option>
                  <option <?php if($row["current_sem"]=="6th"){ echo 'selected';} ?> value="6th">6th</option>
                  <option <?php if($row["current_sem"]=="7th"){ echo 'selected';} ?> value="7th">7th</option>
                  <option <?php if($row["current_sem"]=="8th"){ echo 'selected';} ?> value="8th">8th</option>
                </select>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="">Username</label>
                <input type="" placeholder="Username" class="form-control" name="username" value="<?php echo $row["username"]; ?>"/>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="">Password</label>
                <input type="" placeholder="Password" class="form-control" name="password" value="<?php echo $row["password"]; ?>"/>
              </div>
            </div>
           
            <div class="col-sm-12">
             <input type="submit" value="Update" class="btn btn-success mt-3 pull-left" name="update">
             <input type="button" value="Cancel" class="btn btn-danger mt-3 ml-3 pull-left" onclick="window.location.href='student.php?fetch'">
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
      $student_id = $filesop[0];
      $rollno = $filesop[1];
      $name = $filesop[2];
      $department_Id = $filesop[3];
      $year_of_admission = $filesop[4];
      $current_sem = $filesop[5];
      $sgpa = $filesop[6];
      $username = $filesop[7];
      $password = $filesop[8];
      
      $sql = "insert into student(student_id,rollno,name,department_Id,year_of_admission,current_sem,sgpa,username,password) values('$student_id','$rollno','$name','$department_Id','$year_of_admission','$current_sem','$sgpa','$username','$password')";
      $stmt = mysqli_query($conn,$sql);
      $c = $c + 1;
  }

  if($stmt)
  {
    ?>  
    <script> alert('students added to Database');window.location.href='student.php?fetch';</script>
    <?php
  } 
  else
  {
    ?>  
    <script> alert('Sorry! Unable to import');window.location.href='student.php?addnew';</script>
    <?php
  }
}

if(isset($_POST['update']))
{

    $id=$_POST['id'];
    $rollno=$_POST['rollno'];
    $name=$_POST['name'];
    $department=$_POST['department'];
    $yandm=$_POST['yandm'];
    $sem=$_POST['semester'];
    $sgpa=$_POST['sgpa'];
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql="UPDATE `student` SET `sgpa`='$sgpa',`rollno`='$rollno',`current_sem`='$sem',`name`='$name',`department_Id`='$department',`year_of_admission`='$yandm',`username`='$username',`password`='$password' WHERE `student_id`='$id'";
    if (mysqli_query($conn, $sql)) 
    {
     ?>
     <script> alert('Student Updated');window.location.href='student.php?fetch';</script>
     <?php
    }

}
if(isset($_GET['delete']))
{

    $id=$_GET['delete'];

    $sql="DELETE FROM `student` WHERE `student_id`='$id'";
    if (mysqli_query($conn, $sql)) 
    {
     ?>
     <script> alert('Student Removed');window.location.href='student.php?fetch';</script>
     <?php
    }

}

?>