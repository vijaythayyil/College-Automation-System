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
    <link rel="stylesheet" href="../css/main2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
</head>


<body>
    <div class="topmenu">
          <h3>C-Automation</h3>
          <li onclick="window.location.href='../index.php'">Welcome <?php echo ucfirst($unm) ?> (HOD) <i class="fa fa-sign-out" aria-hidden="true" style="padding-left: 15px;"></i> Logout</li>
    </div>
<div class="leftmenu">
<l style="width: 90%; float: left; margin-bottom: 20px; font-weight: 700; font-size: 20px; margin-left: 20px; background-color: whitesmoke; border-radius: 5px; padding: 5px; padding-left: 10px; padding-right: 35px;"><i class="fa fa-home" aria-hidden="true"></i> Dashbord</l>
<li onclick="window.location.href='subject.php?fetch'"><i class="fa fa-th" aria-hidden="true"></i> Subject</li>
<li onclick="window.location.href='resultanalisis.php?fetch'"><i class="fa fa-th" aria-hidden="true"></i> Result Analysis</li>
<li onclick="window.location.href='performanceanalisis.php?fetch'"><i class="fa fa-th" aria-hidden="true"></i> Performance Analysis</li>
</div>
<div class="rightsec">
<div class="subsec">
    <div class="bar">
        <li>Subject</li>
        <input type="submit" value="Add New" class="btn btn-info btn-sm mt-3 mr-4 pull-right" onclick="window.location.href='subject.php?addnew'">
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
            <th>Subject Id</th>
            <th>Subject</th>
            <th>Semester</th>
            <th>Department</th>
            <th>Staff</th>
            <th width="15%">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php

           $did=$_SESSION['did'];
           $sql = "SELECT * FROM subject sb inner join department d on d.department_Id=sb.department_Id inner join staff st on st.Emp_Id=sb.Emp_Id where d.department_Id=$did";
           $result = mysqli_query($conn, $sql);
            
           if (mysqli_num_rows($result) > 0) 
           {
            while($row = mysqli_fetch_assoc($result)) 
            {
          ?>
          <tr>
            <td><?php echo $row["subject_id"]; ?></td>
            <td><?php echo $row["subject"]; ?></td>
            <td><?php echo $row["semester"]; ?></td>
            <td><?php echo $row["department"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td>
            <input type="submit" value="Delete" class="btn btn-danger btn-sm mr-2 pull-right" onclick="window.location.href='subject.php?delete=<?php echo $row['subject_id']; ?>'">
            <input type="submit" value="Edit" class="btn btn-info btn-sm  mr-2 pull-right" onclick="window.location.href='subject.php?edit=<?php echo $row['subject_id']; ?>'">
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
        $did=$_SESSION['did'];
        $sql1="select * from department where department_Id='$did'";
        $dpt_list = mysqli_query($conn, $sql1);

        $sql2="select * from staff";
        $staff_list = mysqli_query($conn, $sql2);
    ?>
      <div class="container pb-4" style="padding-top:15px; float:left;">
         <form action="" method="post">
         <div class="container">
          <div class="row">
          <div class="col-sm-3">
              <div class="form-group">
              <label for="">Subject</label>
              <input type="" placeholder="Subject" class="form-control" name="subject"/>
            </div>
            </div>
          <!-- department drop down menu was here .R.I.P to that..
          
          
          
           <div class="col-sm-3">
              <div class="form-group">
                <label for="">Departments</label>
                <select class="form-control" name="department">
                <option value="">Department</option>
                <?php
               // while($row_dpt = mysqli_fetch_assoc($dpt_list)) 
              //  {
                ?>
                  <option value="<?php //echo $row_dpt['department_Id']; ?>"><?php// echo $row_dpt['department']; ?></option>
                <?php
                //}
                ?>
                </select>
              </div>
            </div>-->


            <div class="col-sm-3">
              <div class="form-group">
              <label for="">Semester</label>
              <select class="form-control" name="semester">
               <option value="">Semester</option>
               <option value="1st">1st</option>
               <option value="2nd">2nd</option>
               <option value="3rd">3rd</option>
               <option value="4th">4th</option>
               <option value="5th">5th</option>
               <option value="6th">6th</option>
               <option value="7th">7th</option>
               <option value="8th">8th</option>
              </select>
            </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
              <label for="">Staff</label>
              <select class="form-control" name="staff">
               <option value="">Staff</option>
               <?php
                while($row_stf = mysqli_fetch_assoc($staff_list)) 
                {
                ?>
                  <option value="<?php echo $row_stf['Emp_Id']; ?>"><?php echo $row_stf['name']; ?></option>
                <?php
                }
              ?>
              </select>
            </div>
            </div>
            <div class="col-sm-12">
             <input type="submit" value="Submit" class="btn btn-success mt-3 pull-left" name="smt">
             <input type="button" value="Cancel" class="btn btn-danger mt-3 ml-3 pull-left" onclick="window.location.href='subject.php?fetch'">
            </div>
          </div>
        </div>
      </div>
   <?php 
      }
      if(isset($_GET['edit']))
      {
        $did=$_SESSION['did'];
        $dptid=$_GET['edit'];

        $sql="SELECT * FROM subject sb inner join department d on d.department_Id=sb.department_Id inner join staff st on st.Emp_Id=sb.Emp_Id where sb.subject_id='$dptid'";
        $emp = mysqli_query($conn, $sql);

        $sql1="select * from department where department_Id=$did"; //edited with where...did; vijay
        $dpt_list = mysqli_query($conn, $sql1);

        $sql2="select * from staff";
        $staff_list = mysqli_query($conn, $sql2);
    ?>
      <div class="container pb-4" style="padding-top:15px; float:left;">
      <?php
        while($row = mysqli_fetch_assoc($emp)) 
        {

      ?>
         <form action="" method="post">
         <div class="container">
          <div class="row">
          <div class="col-sm-3">
              <div class="form-group">
              <label for="">Subject</label>
              <input type="hidden" value="<?php echo $_GET['edit']; ?>" name="id"/>
              <input type="" placeholder="Subject" class="form-control" name="subject" value="<?php echo $row["subject"]; ?>"/>
            </div>
            </div>
            <!-- edit for department was here..R.I.P to that aswell.
            
            <div class="col-sm-3">
              <div class="form-group">
                <label for="">Department</label>
                <select class="form-control" name="department">
                <option value="">Department</option>
                <?php
                //while($row_dpt = mysqli_fetch_assoc($dpt_list)) 
                //{
                ?>
                  <option <?php //if($row['department_Id']==$row_dpt['department_Id']){ echo 'selected';} ?> value="<?php// echo $row_dpt['department_Id']; ?>"><?php// echo $row_dpt['department']; ?></option>
                <?php
                //}
                ?>
                </select>
              </div>
            </div> -->




            <div class="col-sm-3">
              <div class="form-group">
              <label for="">Semester</label>
              <select class="form-control" name="semester">
               <option value="">Semester</option>
               <option <?php if($row['semester']=="1st"){ echo 'selected';} ?> value="1st">1st</option>
               <option <?php if($row['semester']=="2nd"){ echo 'selected';} ?> value="2nd">2nd</option>
               <option <?php if($row['semester']=="3rd"){ echo 'selected';} ?> value="3rd">3rd</option>
               <option <?php if($row['semester']=="4th"){ echo 'selected';} ?> value="4th">4th</option>
               <option <?php if($row['semester']=="5th"){ echo 'selected';} ?> value="5th">5th</option>
               <option <?php if($row['semester']=="6th"){ echo 'selected';} ?> value="6th">6th</option>
               <option <?php if($row['semester']=="7th"){ echo 'selected';} ?> value="7th">7th</option>
               <option <?php if($row['semester']=="8th"){ echo 'selected';} ?> value="8th">8th</option>
              </select>
            </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
              <label for="">Staff</label>
              <select class="form-control" name="staff">
               <option value="">Staff</option>
               <?php
                while($row_stf = mysqli_fetch_assoc($staff_list)) 
                {
                ?>
                  <option <?php if($row['Emp_Id']==$row_stf['Emp_Id']){ echo 'selected';} ?> value="<?php echo $row_stf['Emp_Id']; ?>"><?php echo $row_stf['name']; ?></option>
                <?php
                }
              ?>
              </select>
            </div>
            </div>
            <div class="col-sm-12">
             <input type="submit" value="Update" class="btn btn-success mt-3 pull-left" name="Update">
             <input type="button" value="Cancel" class="btn btn-danger mt-3 ml-3 pull-left" onclick="window.location.href='subject.php?fetch'">
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
  $sub=$_POST['subject'];
  $sem=$_POST['semester'];
 //$dpt=$_POST['department'];
 $dpt=$_SESSION['did']; //for getting dept id from hod, bcz im smart..yeah i know..hhehe
 

  $stf=$_POST['staff'];

  $sql="insert into subject(subject,semester,department_Id,Emp_Id) values('$sub','$sem','$dpt','$stf')";
  if (mysqli_query($conn, $sql)) 
  {
   ?>
   <script> alert('Subject added to Database');window.location.href='subject.php?fetch';</script>
   <?php
  }
}

if(isset($_POST['Update']))
{

    $id=$_POST['id'];
    $name=$_POST['subject'];
  //  $department=$_POST['department'];
  $department=$_SESSION['did'];
    $semester=$_POST['semester'];
    $staff=$_POST['staff'];

    $sql="UPDATE `subject` SET `subject`='$name',`semester`='$semester',`department_Id`='$department',`Emp_Id`='$staff' WHERE `subject_id`='$id'";
    if (mysqli_query($conn, $sql)) 
    {
     ?>
     <script> alert('Subject Updated');window.location.href='subject.php?fetch';</script>
     <?php
    }

}


if(isset($_GET['delete']))
{

    $id=$_GET['delete'];

    $sql="DELETE FROM `subject` WHERE `subject_id`='$id'";
    if (mysqli_query($conn, $sql)) 
    {
     ?>
     <script> alert('Subject Removed');window.location.href='subject.php?fetch';</script>
     <?php
    }

}
?>