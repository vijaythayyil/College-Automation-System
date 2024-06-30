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
<li onclick="window.location.href='complaint.php?fetch'"><i class="fa fa-id-card" aria-hidden="true"></i> Complaints</li>
<li onclick="window.location.href='complaintsrpt.php?fetch'"><i class="fa fa-id-card" aria-hidden="true"></i> Complaints Report</li>
</div>
<div class="rightsec">
<div class="subsec">
    <div class="bar">
        
        <div class="container">
        <form method="post">
          <div class="row">
            <div class="col-4">
              <li>Complaints</li>
            </div>
            <div class="col-sm-2">
            <div class="form-group">
                <select class="form-control mt-2" name="status">
                <option value="">Status</option>
                <option value="Recived">Recived</option>
                <option value="Solved">Solved</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <input type="" placeholder="Start" class="form-control mt-2" name="start"/>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <input type="" placeholder="End" class="form-control mt-2" name="end"/>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
              <input type="submit" value="Search" class="btn btn-success mt-2" name="search">
              </div>
            </div>
            
          </div>
          </form>
        </div>
    </div>
    <?php 
       include('../connection.php');
      if(isset($_POST['search']))
      {

        $status=$_POST['status'];
        $start=$_POST['start'];
        $end=$_POST['end'];

        if($_POST['status']!='' and $_POST['start']!='' and $_POST['end']!='')
        {
          $sql = "SELECT * FROM complaints c inner join student s on s.student_id=c.student_id inner join department d on d.department_Id=s.department_Id where c.status='$status' and c.date between '$start' and '$end'";
        }
        else if($_POST['start']!='' and $_POST['end']!='')
        {
          $sql = "SELECT * FROM complaints c inner join student s on s.student_id=c.student_id inner join department d on d.department_Id=s.department_Id where c.date between '$start' and '$end'";
        }
        else if($_POST['status']!='')
        {
          $sql = "SELECT * FROM complaints c inner join student s on s.student_id=c.student_id inner join department d on d.department_Id=s.department_Id where c.status='$status'";
        }
        else
        {
          $sql = "SELECT * FROM complaints c inner join student s on s.student_id=c.student_id inner join department d on d.department_Id=s.department_Id";
        }
        
        
    ?>
    <div class="tbl">
    <table class="table table-hover" style="float: left;">
        <thead>
          <tr>
            <th>Date</th>
            <th>Complaint</th>
            <th>Student</th>
            <th>Department</th>
            <th>Status</th>
            <th>Report</th>
          </tr>
        </thead>
        <tbody>
          <?php

            $result = mysqli_query($conn, $sql);
           if (mysqli_num_rows($result) > 0) 
           {
            while($row = mysqli_fetch_assoc($result)) 
            {
          ?>
          <tr>
            <td><?php echo $row["date"]; ?></td>
            <td><?php echo $row["complaint"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["department"]; ?></td>
            <td><?php echo $row["status"]; ?></td>
            <td><?php echo $row["report"]; ?></td>
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
  $cid=$_POST['cid'];
  $sts=$_POST['sts'];
  
  

  $sql="update complaints set status='$sts' where id='$cid'";
  if (mysqli_query($conn, $sql)) 
  {
   ?>
   <script> alert('Status Updated');window.location.href='complaint.php?fetch';</script>
   <?php
  }
}


?>