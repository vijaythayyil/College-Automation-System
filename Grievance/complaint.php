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
        <li>Complaints</li>
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
            <th>Date</th>
            <th>Complaint</th>
            <th>Student</th>
            <th>Status</th>
            <th>Report</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
         
           $sql = "SELECT * FROM complaints c inner join student s on s.student_id=c.student_id";
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
            <td><?php echo $row["status"]; ?></td>
            <td><?php echo $row["report"]; ?></td>
            <td><input type="submit" value="Update Status" class="btn btn-info btn-sm" onclick="window.location.href='complaint.php?addnew='+<?php echo $row['id']; ?>"></td>
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
         <input type="hidden" name="cid" value="<?php echo $_GET['addnew']; ?>"/>
         <div class="container">
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label for="">Status</label>
                <select class="form-control" name="sts">
                <option value="">Status</option>
                <option value="Recived">Recived</option>
                <option value="Solved">Solved</option>
                </select>
              </div>
            </div>
            <div class="col-sm-9">
            <div class="form-group">
                <label for="">Status</label>
                <textarea class="form-control" name="report" placeholder="Report"></textarea>
              </div>
            </div>
            <div class="col-sm-12">
             <input type="submit" value="Submit" class="btn btn-success mt-3 pull-left" name="smt">
             <input type="button" value="Cancel" class="btn btn-danger mt-3 ml-3 pull-left" onclick="window.location.href='complaint.php?fetch'">
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
  $cid=$_POST['cid'];
  $sts=$_POST['sts'];
  $report=$_POST['report'];
  
  

  $sql="update complaints set status='$sts',report='$report' where id='$cid'";
  if (mysqli_query($conn, $sql)) 
  {
   ?>
   <script> alert('Status Updated');window.location.href='complaint.php?fetch';</script>
   <?php
  }
}


?>