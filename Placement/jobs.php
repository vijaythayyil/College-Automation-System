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
        <li>Jobs</li>
        <input type="submit" value="Add New" class="btn btn-info btn-sm mt-3 mr-4 pull-right" onclick="window.location.href='jobs.php?addnew'">
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
            <th>Job Title</th>
            <th>Location</th>
            <th>Skills</th>
            <th>Qualification</th>
            <th>SGPA</th>
            <th>Salary</th>
            <th>Company</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          
           $sql = "SELECT * FROM company c inner join job j on c.cid=j.c_id";
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
            <td><?php echo $row["sgpa"]; ?></td>
            <td><?php echo $row["salary"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["description"]; ?></td>
            <td>
            <input type="submit" value="Applied Candidate" class="btn btn-info btn-sm" onclick="window.location.href='appliedcandidates.php?fetch='+<?php echo $row['id']; ?>">
            <input type="submit" value="Delete" class="btn btn-danger btn-sm mr-2 pull-right" onclick="window.location.href='jobs.php?delete=<?php echo $row['id']; ?>'">
            <input type="submit" value="Edit" class="btn btn-info btn-sm  mr-2 pull-right" onclick="window.location.href='jobs.php?edit=<?php echo $row['id']; ?>'">
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
              <input type="" name="location" placeholder="Location" class="form-control"/>
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
            <div class="col-sm-2">
              <div class="form-group">
              <label for="">Salary</label>
              <input type="" name="salary" placeholder="Salary" class="form-control"/>
            </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
              <label for="">SGPA</label>
              <input type="" name="sgpa" placeholder="SGPA" class="form-control"/>
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
            <div class="col-sm-5">
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

      if(isset($_GET['edit']))
      {

        $dptid=$_GET['edit'];

        $sql="SELECT * FROM company c inner join job j on c.cid=j.c_id where j.id='$dptid'";
        $job = mysqli_query($conn, $sql);
        
    ?>
      <div class="container pb-4" style="padding-top:15px; float:left;">
      <?php
        while($row = mysqli_fetch_assoc($job)) 
        {

      ?>
         <form action="" method="post">
         <div class="container">
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label for="">Job Title</label>
                <input type="hidden" value="<?php echo $_GET['edit']; ?>" name="id"/>
                <input type="" name="jobtitle" placeholder="Job Title" class="form-control" value="<?php echo $row["jobtitle"]; ?>"/>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
              <label for="">Location</label>
              <input type="" name="location" placeholder="Location" class="form-control" value="<?php echo $row["location"]; ?>"/>
            </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="">Skills</label>
                <input type="" name="skills" placeholder="Skills" class="form-control" value="<?php echo $row["skills"]; ?>"/>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
              <label for="">Qualification</label>
              <input type="" name="qualification" placeholder="Qualification" class="form-control" value="<?php echo $row["qualification"]; ?>"/>
            </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
              <label for="">Salary</label>
              <input type="" name="salary" placeholder="Salary" class="form-control" value="<?php echo $row["salary"]; ?>"/>
            </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
              <label for="">SGPA</label>
              <input type="" name="sgpa" placeholder="SGPA" class="form-control"  value="<?php echo $row["sgpa"]; ?>"/>
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
                          <option <?php if($row_sub1['cid']==$row['c_id']){ echo 'selected';} ?> value="<?php echo $row_sub1['cid']; ?>"><?php echo $row_sub1['name']; ?></option> <!-- edited id to cid -->
                        <?php
                        }
                      ?>
                    </select>
            </div>
            </div>
            <div class="col-sm-5">
              <div class="form-group">
              <label for="">Description</label>
              <input type="" name="des" placeholder="Description" class="form-control" value="<?php echo $row["description"]; ?>"/>
            </div>
            </div>
            <div class="col-sm-12">
             <input type="submit" value="Update" class="btn btn-success mt-3 pull-left" name="update">
             <input type="button" value="Cancel" class="btn btn-danger mt-3 ml-3 pull-left" onclick="window.location.href='jobs.php?fetch'">
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

if(isset($_POST['smt']))
{
  $jobtitle=$_POST['jobtitle'];
  $location=$_POST['location'];
  $skills=$_POST['skills'];
  $qualification=$_POST['qualification'];
  $salary=$_POST['salary'];
  $company=$_POST['company'];
  $des=$_POST['des'];
  $sgpa=$_POST['sgpa'];
  

  $sql="insert into job(jobtitle,qualification,description,skills,salary,location,c_id,sgpa) values('$jobtitle','$qualification','$des','$skills','$salary','$location','$company','$sgpa')";
  if (mysqli_query($conn, $sql)) 
  {
   ?>
   <script> alert('job added to Database');window.location.href='jobs.php?fetch';</script>
   <?php
  }
}

if(isset($_POST['update']))
{

    $id=$_POST['id'];
    $jobtitle=$_POST['jobtitle'];
    $location=$_POST['location'];
    $skills=$_POST['skills'];
    $qualification=$_POST['qualification'];
    $salary=$_POST['salary'];
    $company=$_POST['company'];
    $des=$_POST['des'];
    $sgpa=$_POST['sgpa'];

    $sql="UPDATE `job` SET `sgpa`='$sgpa',`jobtitle`='$jobtitle',`description`='$des',`skills`='$skills',`qualification`='$qualification',`salary`='$salary',`location`='$location',`c_id`='$company' WHERE `id`='$id'"; //cid is edited it was just id
    if (mysqli_query($conn, $sql)) 
    {
     ?>
     <script> alert('Job Updated');window.location.href='jobs.php?fetch';</script>
     <?php
    }

}


if(isset($_GET['delete']))
{

    $id=$_GET['delete'];

    $sql="DELETE FROM `job` WHERE `id`='$id'";
    if (mysqli_query($conn, $sql)) 
    {
     ?>
     <script> alert('Job Removed');window.location.href='jobs.php?fetch';</script>
     <?php
    }

}

?>