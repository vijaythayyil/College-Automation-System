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
        <li>Company</li>
        <input type="submit" value="Add New" class="btn btn-info btn-sm mt-3 mr-4 pull-right" onclick="window.location.href='company.php?addnew'">
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
            <th>Name</th>
            <th>Location</th>
            <th>Email</th>
            <th>Mobile</th>
            <th width="15%">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          
           $sql = "SELECT * FROM company";
           $result = mysqli_query($conn, $sql);
            
           if (mysqli_num_rows($result) > 0) 
           {
            while($row = mysqli_fetch_assoc($result)) 
            {
          ?>
          <tr>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["adders"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["mobile"]; ?></td>
            <td>
            <input type="submit" value="Delete" class="btn btn-danger btn-sm mr-2 pull-right" onclick="window.location.href='company.php?delete=<?php echo $row['cid']; ?>'">
            <input type="submit" value="Edit" class="btn btn-info btn-sm  mr-2 pull-right" onclick="window.location.href='company.php?edit=<?php echo $row['cid']; ?>'">
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
                <label for="">Name</label>
                <input type="" name="name" placeholder="Name" class="form-control"/>
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
                <label for="">Email</label>
                <input type="" name="email" placeholder="Email" class="form-control"/>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
              <label for="">Mobile</label>
              <input type="" name="mobile" placeholder="Mobile" class="form-control"/>
            </div>
            </div>
            <div class="col-sm-12">
             <input type="submit" value="Submit" class="btn btn-success mt-3 pull-left" name="smt">
             <input type="button" value="Cancel" class="btn btn-danger mt-3 ml-3 pull-left" onclick="window.location.href='company.php?fetch'">
            </div>
          </div>
        </div>
      </div>
   <?php 
      }

    if(isset($_GET['edit']))
    {

      $dptid=$_GET['edit'];

        $sql="SELECT * FROM company where cid='$dptid'";
        $com = mysqli_query($conn, $sql);
      
  ?>
    <div class="container pb-4" style="padding-top:15px; float:left;">
    <?php
        while($row = mysqli_fetch_assoc($com)) 
        {

      ?>
       <form action="" method="post">
       <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label for="">Name</label>
              <input type="hidden" value="<?php echo $_GET['edit']; ?>" name="id"/>
              <input type="" name="name" placeholder="Name" class="form-control" value="<?php echo $row["name"]; ?>"/>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
            <label for="">Location</label>
            <input type="" name="address" placeholder="Location" class="form-control"  value="<?php echo $row["adders"]; ?>"/>
          </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="">Email</label>
              <input type="" name="email" placeholder="Email" class="form-control" value="<?php echo $row["email"]; ?>"/>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
            <label for="">Mobile</label>
            <input type="" name="mobile" placeholder="Mobile" class="form-control" value="<?php echo $row["mobile"]; ?>"/>
          </div>
          </div>
          <div class="col-sm-12">
           <input type="submit" value="Update" class="btn btn-success mt-3 pull-left" name="update">
           <input type="button" value="Cancel" class="btn btn-danger mt-3 ml-3 pull-left" onclick="window.location.href='company.php?fetch'">
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
  $name=$_POST['name'];
  $location=$_POST['address'];
  $email=$_POST['email'];
  $mobile=$_POST['mobile'];
  

  $sql="insert into company(name,adders,email,mobile) values('$name','$location','$email','$mobile')";
  if (mysqli_query($conn, $sql)) 
  {
   ?>
   <script> alert('company added to Database');window.location.href='company.php?fetch';</script>
   <?php
  }
}

if(isset($_POST['update']))
{

    $id=$_POST['id'];
    $name=$_POST['name'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];

    $sql="UPDATE `company` SET `name`='$name',`adders`='$address',`email`='$email',`mobile`='$mobile' WHERE `cid`='$id'";
    if (mysqli_query($conn, $sql)) 
    {
     ?>
     <script> alert('Company Updated');window.location.href='company.php?fetch';</script>
     <?php
    }

}


if(isset($_GET['delete']))
{

    $id=$_GET['delete'];

    $sql="DELETE FROM `company` WHERE `cid`='$id'";
    if (mysqli_query($conn, $sql)) 
    {
     ?>
     <script> alert('Company Removed');window.location.href='company.php?fetch';</script>
     <?php
    }

}

?>