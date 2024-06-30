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
<li onclick="window.location.href='marklist.php?fetch'"><i class="fa fa-id-card" aria-hidden="true"></i> Mark List</li>
<li onclick="window.location.href='complaint.php?fetch'"><i class="fa fa-id-card" aria-hidden="true"></i> Complaints</li>
<li onclick="window.location.href='jobs.php?fetch'"><i class="fa fa-id-card" aria-hidden="true"></i> Jobs</li>
<li onclick="window.location.href='appliedjobs.php?fetch'"><i class="fa fa-id-card" aria-hidden="true"></i> Applied Jobs</li>
</div>
<div class="rightsec">
<div class="subsec">
    <div class="bar">
        <li>Jobs</li>
    </div>
    <?php 
       include('../connection.php');
      if(isset($_GET['fetch']))
      {
           $std=$_SESSION['student_id'];
           $sql="select * from student where student_id='$std' and current_sem in ('6th','7th','8th')";
           $result = mysqli_query($conn, $sql);
           if (mysqli_num_rows($result) > 0) 
           {
             $rowc=mysqli_fetch_assoc($result);
             $sgpa=$rowc['sgpa'];
    ?>
    <div class="tbl">
    <table class="table table-hover" style="float: left;">
        <thead>
          <tr>
            <th>Job Title</th>
            <th>Location</th>
            <th>Skills</th>
            <th>Qualification</th>
            <th>Salary</th>
            <th>Company</th>
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
             $sql = "SELECT * FROM job j LEFT OUTER JOIN appliedjobs a ON a.j_id=j.id and a.student_id='$std' inner JOIN company c on c.cid=j.c_id where j.sgpa<='$sgpa'";
           
             $result = mysqli_query($conn, $sql);
            
           if (mysqli_num_rows($result) > 0) 
           {
            while($row = mysqli_fetch_assoc($result)) 
            {
          ?>
          <tr>
            <td><?php echo $row["jobtitle"]; ?></td>
            <td><?php echo $row["location"]; ?></td>
            <td><?php echo $row["skills"]; ?></td>
            <td><?php echo $row["qualification"]; ?></td>
            <td><?php echo $row["salary"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["description"]; ?></td>
            <td><?php echo $row["status"]; ?></td>
            <td>
            <?php
            if($row["status"]==NULL)
            {
              ?>
              <input type="submit" value="Apply" class="btn btn-info btn-sm" onclick="window.location.href='jobs.php?addnew='+<?php echo $row['id']; ?>">
              <?php
            }
            ?>
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
    else 
      {?>

       <?php echo '<center style="float:left; padding:35px;">You are not Eligible Now</center>'; ?>

      <?php
      }
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

if(isset($_GET['addnew']))
{
  $jid=$_GET['addnew'];
  $std=$_SESSION['student_id'];

  $sql="insert into appliedjobs(j_id,student_id,date,status) values('$jid','$std',CURDATE(),'Applied')";
  if (mysqli_query($conn, $sql)) 
  {
   ?>
   <script> alert('job applied');window.location.href='jobs.php?fetch';</script>
   <?php
  }
}

?>