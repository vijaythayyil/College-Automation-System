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
<li onclick="window.location.href='company.php?fetch'"><i class="fa fa-id-card" aria-hidden="true"></i> Company</li>
<li onclick="window.location.href='jobs.php?fetch'"><i class="fa fa-id-card" aria-hidden="true"></i> Jobs</li>
<li onclick="window.location.href='student.php?fetch'"><i class="fa fa-id-card" aria-hidden="true"></i> Report</li>
</div>
<div class="rightsec">
<div class="subsec">
    <div class="bar">
        <li>Applied Candidates</li>
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
            <th>Job Title</th>
            <th>Location</th>
            <th>Skills</th>
            <th>Qualification</th>
            <th>Salary</th>
            <th>Company</th>
            <th>Candidate</th>
            <th>Department</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
           $jid=$_GET['fetch'];
           echo $jid;
           $sql = "SELECT j.*,a.*,c.name as cname,s.name as sname,d.department FROM appliedjobs a inner JOIN job j ON a.j_id=j.id inner JOIN company c on c.cid=j.c_id inner join student s on s.student_id=a.student_id inner join department d on s.department_Id=d.department_Id where a.j_id='$jid'"; //editted a.j_id to s.department_Id
           $result = mysqli_query($conn, $sql);
            
           if (mysqli_num_rows($result) > 0) 
           {
            while($row = mysqli_fetch_assoc($result)) 
            {
          ?>
          <tr>
            <td><?php echo $row["date"]; ?></td>
            <td><?php echo $row["jobtitle"]; ?></td>
            <td><?php echo $row["location"]; ?></td>
            <td><?php echo $row["skills"]; ?></td>
            <td><?php echo $row["qualification"]; ?></td>
            <td><?php echo $row["salary"]; ?></td>
            <td><?php echo $row["cname"]; ?></td>
            <td><?php echo $row["sname"]; ?></td>
            <td><?php echo $row["department"]; ?></td>
            <td><?php echo $row["status"]; ?></td>
            <td><input type="submit" value="Reject" class="btn btn-danger btn-sm m-1" onclick="window.location.href='appliedcandidates.php?reject='+<?php echo $row['a_id']; ?>">
                    <input type="submit" value="Select" class="btn btn-info btn-sm m-1" onclick="window.location.href='appliedcandidates.php?select='+<?php echo $row['a_id']; ?>">
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

if(isset($_GET['reject']))
{
  $id=$_GET['reject'];

  $sql="UPDATE appliedjobs set status='Rejected' where a_id='$id'";
  if (mysqli_query($conn, $sql)) 
  {
   ?>
   <script> alert('Rejected');window.history.back();</script>
   <?php
  }
  
}

if(isset($_GET['select']))
{
  $id=$_GET['select'];
  
  $sql="UPDATE appliedjobs set status='Selected' where a_id='$id'";
  if (mysqli_query($conn, $sql)) 
  {
   ?>
   <script> alert('Selected ');window.history.back();</script>
   <?php
  }
}

?>