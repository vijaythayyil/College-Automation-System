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
        <li>Mark List</li>
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
            <th>Student</th>
            <th>Department</th>
            <th>Semester</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $d_id=$_SESSION['d_id'];

           $sql = "SELECT * FROM mark m inner join student s on s.student_id=m.student_id inner join department d on d.department_Id=s.department_Id where s.department_Id='$d_id' group by m.semester,m.student_id";
           $result = mysqli_query($conn, $sql);
            
           if (mysqli_num_rows($result) > 0) 
           {
            while($row = mysqli_fetch_assoc($result)) 
            {
          ?>
          <tr>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["department"]; ?></td>
            <td><?php echo $row["semester"]; ?></td>
            <td><input type="submit" value="View Marklist" class="btn btn-info btn-sm" onclick="window.location.href='<?php echo 'marklist.php?fetch='.$row['student_id'].'&sem='.$row['semester']; ?>'"></td>
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
      <div class="container pb-4" style="padding-top:15px; float:left;">
         <form action="" method="post">
         <div class="container">
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label for="">Job Title</label>
                <input type="" name="jobtitle" placeholder="Job Title" class="form-control"/>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
              <label for="">Location</label>
              <input type="" name="address" placeholder="Location" class="form-control"/>
            </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="">Skills</label>
                <input type="" name="skills" placeholder="Skills" class="form-control"/>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
              <label for="">Qualification</label>
              <input type="" name="qualification" placeholder="Qualification" class="form-control"/>
            </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
              <label for="">Salary</label>
              <input type="" name="salary" placeholder="Salary" class="form-control"/>
            </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
              <label for="">Company</label>
              <select class="form-control" name="company">
                      <option value="">Company</option>
                      <?php
                        $sql2="select * from company";
                        $subject_list1 = mysqli_query($conn, $sql2);
                        while($row_sub1 = mysqli_fetch_assoc($subject_list1)) 
                        {
                        ?>
                          <option value="<?php echo $row_sub1['id']; ?>"><?php echo $row_sub1['name']; ?></option>
                        <?php
                        }
                      ?>
                    </select>
            </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
              <label for="">Description</label>
              <input type="" name="des" placeholder="Description" class="form-control"/>
            </div>
            </div>
            <div class="col-sm-12">
             <input type="submit" value="Submit" class="btn btn-success mt-3 pull-left" name="smt">
             <input type="button" value="Cancel" class="btn btn-danger mt-3 ml-3 pull-left" onclick="window.location.href='jobs.php?fetch'">
            </div>
          </div>
        </div>
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

if(isset($_POST['smt']))
{
  $jobtitle=$_POST['jobtitle'];
  $location=$_POST['location'];
  $skills=$_POST['skills'];
  $qualification=$_POST['qualification'];
  $salary=$_POST['salary'];
  $company=$_POST['company'];
  $des=$_POST['des'];
  

  $sql="insert into job(jobtitle,description,skills,salary,location,c_id) values('$jobtitle','$des','$skills','$salary','$location','$company')";
  if (mysqli_query($conn, $sql)) 
  {
   ?>
   <script> alert('job added to Database');window.location.href='jobs.php?fetch';</script>
   <?php
  }
}


?>