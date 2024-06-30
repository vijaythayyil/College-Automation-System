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
    <div class="container">
        <form method="post">
          <div class="row">
            <div class="col-8">
              <li>Placement</li>
            </div>
            <div class="col-sm-2">
            <div class="form-group">
                <select class="form-control mt-2" name="department">
                <option value="">Department</option>
                <?php
                 include('../connection.php');
                 $sql1="select * from department";
                 $dpt_list = mysqli_query($conn, $sql1);
                while($row_dpt = mysqli_fetch_assoc($dpt_list)) 
                {
                ?>
                  <option value="<?php echo $row_dpt['department_Id']; ?>"><?php echo $row_dpt['department']; ?></option>
                <?php
                }
                ?>
                </select>
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
      
      if(isset($_POST['department']))
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
            <th>Company</th>
            <th>Job</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php

            $d_id=$_POST['department'];

           $sql = "SELECT d.department,s.*,a.*,j.jobtitle,c.name as cname FROM department d inner join student s on s.department_Id=d.department_Id inner join appliedjobs a on s.student_id=a.student_id inner join job j on j.id=a.j_id inner join company c on c.cid=j.c_id where s.department_Id='$d_id' and a.status='selected'";
           $result = mysqli_query($conn, $sql);
            
           if (mysqli_num_rows($result) > 0) 
           {
            while($row = mysqli_fetch_assoc($result)) 
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
            <td><?php echo $row["cname"]; ?></td>
            <td><?php echo $row["jobtitle"]; ?></td>
            <td><?php echo $row["status"]; ?></td>
          </tr>
        <?php
            }
          }
          else 
          {
        ?>

            <td colspan="5"><?php echo "0 results"; ?></td>

        <?php
          }
        ?>
        </tbody>
      </table>
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