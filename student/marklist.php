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
        <li>Mark List</li>
    </div>
    <?php 
      include('../connection.php');
      if(isset($_GET['fetch']))
      {

        //editing here for semester sorting
    ?>
        <div class="container pb-4" style="padding-top:15px; float:left;">
        
         <div class="container">
           
          <form action=""  method="post">
          <div class="row">
            <div class="offset-sm-6 col-sm-4">
              <div class="form-group">
              <label for="">Semester</label>
              <select class="form-control" name="sem">
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
            <div class="col-sm-2">
           
              <input type="submit" value="Submit" class="btn btn-success mt-4 pull-left" >
           
            </div>
          </div>
          </form>
<?php 
  if(isset($_POST['sem']))
  {
    $std=$_SESSION['student_id'];
    $sem=$_POST['sem'];

    $sql2="select * from subject where semester='$sem'";
    $sql="select * from mark where student_id='$std' and semester='$sem'";
    $res=mysqli_query($conn, $sql);

    if(mysqli_num_rows($res)<1)
    {
?>
          <form action="" method="post" enctype="multipart/form-data" style="width:100%;">

            <input type="hidden" name="semester" value="<?php echo $_POST['sem']; ?>"/>
            <input type="hidden" name="std_id" value="<?php echo $_SESSION['student_id']; ?>"/>

            <div class="row">
            <div class="col-sm-12">
              <div class="row" style="height:auto; border:0.5px solid rgba(0,0,0,0.5)">
              <table class="table table-hover" style="float: left;">
                <thead>
                  <tr>
                    <th>Subject</th>
                    <th>Code</th>
                    <th>Grade</th>
                    <th>Credit</th>
                    <th>Month & Year of Examination</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td> 
                    <select class="form-control" name="subject[]">
                      <option value="">Subject</option>
                      <?php
                        $subject_list1 = mysqli_query($conn, $sql2);
                        while($row_sub1 = mysqli_fetch_assoc($subject_list1)) 
                        {
                        ?>
                          <option value="<?php echo $row_sub1['subject_id']; ?>"><?php echo $row_sub1['subject']; ?></option>
                        <?php
                        }
                      ?>
                    </select>
                    </td>
                    <td><input type="" name="code[]" placeholder="Code" class="form-control"/></td>
                    <td>
                    <select class="form-control" name="grade[]">
                      <option value="">Grade</option>
                      <option value="10">O</option>
                      <option value="9">A+</option>
                      <option value="8.5">A</option>
                      <option value="8">B+</option>
                      <option value="7">B</option>
                      <option value="6">C</option>
                      <option value="5">P</option>
                      <option value="0">F</option>
                    </select>
                    </td>
                    <td><input type="" name="credit[]" placeholder="Credit" class="form-control"/></td>
                    <td><input type="" name="yandm[]" placeholder="Month & Year of Examination" class="form-control"/></td>
                  </tr>
                  <tr>
                    <td> 
                    <select class="form-control" name="subject[]">
                      <option value="">Subject</option>
                      <?php
                        $subject_list1 = mysqli_query($conn, $sql2);
                        while($row_sub1 = mysqli_fetch_assoc($subject_list1)) 
                        {
                        ?>
                          <option value="<?php echo $row_sub1['subject_id']; ?>"><?php echo $row_sub1['subject']; ?></option>
                        <?php
                        }
                      ?>
                    </select>
                    </td>
                    <td><input type="" name="code[]" placeholder="Code" class="form-control"/></td>
                    <td>
                    <select class="form-control" name="grade[]">
                      <option value="">Grade</option>
                      <option value="10">O</option>
                      <option value="9">A+</option>
                      <option value="8.5">A</option>
                      <option value="8">B+</option>
                      <option value="7">B</option>
                      <option value="6">C</option>
                      <option value="5">P</option>
                      <option value="0">F</option>
                    </select>
                    </td>
                    <td><input type="" name="credit[]" placeholder="Credit" class="form-control"/></td>
                    <td><input type="" name="yandm[]" placeholder="Month & Year of Examination" class="form-control"/></td>
                  </tr>
                  <tr>
                    <td> 
                    <select class="form-control" name="subject[]">
                      <option value="">Subject</option>
                      <?php
                        $subject_list1 = mysqli_query($conn, $sql2);
                        while($row_sub1 = mysqli_fetch_assoc($subject_list1)) 
                        {
                        ?>
                          <option value="<?php echo $row_sub1['subject_id']; ?>"><?php echo $row_sub1['subject']; ?></option>
                        <?php
                        }
                      ?>
                    </select>
                    </td>
                    <td><input type="" name="code[]" placeholder="Code" class="form-control"/></td>
                    <td>
                    <select class="form-control" name="grade[]">
                      <option value="">Grade</option>
                      <option value="10">O</option>
                      <option value="9">A+</option>
                      <option value="8.5">A</option>
                      <option value="8">B+</option>
                      <option value="7">B</option>
                      <option value="6">C</option>
                      <option value="5">P</option>
                      <option value="0">F</option>
                    </select>
                    </td>
                    <td><input type="" name="credit[]" placeholder="Credit" class="form-control"/></td>
                    <td><input type="" name="yandm[]" placeholder="Month & Year of Examination" class="form-control"/></td>
                  </tr>
                  <tr>
                    <td> 
                    <select class="form-control" name="subject[]">
                      <option value="">Subject</option>
                      <?php
                        $subject_list1 = mysqli_query($conn, $sql2);
                        while($row_sub1 = mysqli_fetch_assoc($subject_list1)) 
                        {
                        ?>
                          <option value="<?php echo $row_sub1['subject_id']; ?>"><?php echo $row_sub1['subject']; ?></option>
                        <?php
                        }
                      ?>
                    </select>
                    </td>
                    <td><input type="" name="code[]" placeholder="Code" class="form-control"/></td>
                    <td>
                    <select class="form-control" name="grade[]">
                      <option value="">Grade</option>
                      <option value="10">O</option>
                      <option value="9">A+</option>
                      <option value="8.5">A</option>
                      <option value="8">B+</option>
                      <option value="7">B</option>
                      <option value="6">C</option>
                      <option value="5">P</option>
                      <option value="0">F</option>
                    </select>
                    </td>
                    <td><input type="" name="credit[]" placeholder="Credit" class="form-control"/></td>
                    <td><input type="" name="yandm[]" placeholder="Month & Year of Examination" class="form-control"/></td>
                  </tr>
                  <tr>
                    <td> 
                    <select class="form-control" name="subject[]">
                      <option value="">Subject</option>
                      <?php
                        $subject_list1 = mysqli_query($conn, $sql2);
                        while($row_sub1 = mysqli_fetch_assoc($subject_list1)) 
                        {
                        ?>
                          <option value="<?php echo $row_sub1['subject_id']; ?>"><?php echo $row_sub1['subject']; ?></option>
                        <?php
                        }
                      ?>
                    </select>
                    </td>
                    <td><input type="" name="code[]" placeholder="Code" class="form-control"/></td>
                    <td>
                    <select class="form-control" name="grade[]">
                      <option value="">Grade</option>
                      <option value="10">O</option>
                      <option value="9">A+</option>
                      <option value="8.5">A</option>
                      <option value="8">B+</option>
                      <option value="7">B</option>
                      <option value="6">C</option>
                      <option value="5">P</option>
                      <option value="0">F</option>
                    </select>
                    </td>
                    <td><input type="" name="credit[]" placeholder="Credit" class="form-control"/></td>
                    <td><input type="" name="yandm[]" placeholder="Month & Year of Examination" class="form-control"/></td>
                  </tr>
                  <tr>
                    <td> 
                    <select class="form-control" name="subject[]">
                      <option value="">Subject</option>
                      <?php
                        $subject_list1 = mysqli_query($conn, $sql2);
                        while($row_sub1 = mysqli_fetch_assoc($subject_list1)) 
                        {
                        ?>
                          <option value="<?php echo $row_sub1['subject_id']; ?>"><?php echo $row_sub1['subject']; ?></option>
                        <?php
                        }
                      ?>
                    </select>
                    </td>
                    <td><input type="" name="code[]" placeholder="Code" class="form-control"/></td>
                    <td>
                    <select class="form-control" name="grade[]">
                      <option value="">Grade</option>
                      <option value="10">O</option>
                      <option value="9">A+</option>
                      <option value="8.5">A</option>
                      <option value="8">B+</option>
                      <option value="7">B</option>
                      <option value="6">C</option>
                      <option value="5">P</option>
                      <option value="0">F</option>
                    </select>
                    </td>
                    <td><input type="" name="credit[]" placeholder="Credit" class="form-control"/></td>
                    <td><input type="" name="yandm[]" placeholder="Month & Year of Examination" class="form-control"/></td>
                  </tr>
                  <tr>
                    <td> 
                    <select class="form-control" name="subject[]">
                      <option value="">Subject</option>
                      <?php
                        $subject_list1 = mysqli_query($conn, $sql2);
                        while($row_sub1 = mysqli_fetch_assoc($subject_list1)) 
                        {
                        ?>
                          <option value="<?php echo $row_sub1['subject_id']; ?>"><?php echo $row_sub1['subject']; ?></option>
                        <?php
                        }
                      ?>
                    </select>
                    </td>
                    <td><input type="" name="code[]" placeholder="Code" class="form-control"/></td>
                    <td>
                    <select class="form-control" name="grade[]">
                      <option value="">Grade</option>
                      <option value="10">O</option>
                      <option value="9">A+</option>
                      <option value="8.5">A</option>
                      <option value="8">B+</option>
                      <option value="7">B</option>
                      <option value="6">C</option>
                      <option value="5">P</option>
                      <option value="0">F</option>
                    </select>
                    </td>
                    <td><input type="" name="credit[]" placeholder="Credit" class="form-control"/></td>
                    <td><input type="" name="yandm[]" placeholder="Month & Year of Examination" class="form-control"/></td>
                  </tr>
                  <tr>
                    <td> 
                    <select class="form-control" name="subject[]">
                      <option value="">Subject</option>
                      <?php
                        $subject_list1 = mysqli_query($conn, $sql2);
                        while($row_sub1 = mysqli_fetch_assoc($subject_list1)) 
                        {
                        ?>
                          <option value="<?php echo $row_sub1['subject_id']; ?>"><?php echo $row_sub1['subject']; ?></option>
                        <?php
                        }
                      ?>
                    </select>
                    </td>
                    <td><input type="" name="code[]" placeholder="Code" class="form-control"/></td>
                    <td>
                    <select class="form-control" name="grade[]">
                      <option value="">Grade</option>
                      <option value="10">O</option>
                      <option value="9">A+</option>
                      <option value="8.5">A</option>
                      <option value="8">B+</option>
                      <option value="7">B</option>
                      <option value="6">C</option>
                      <option value="5">P</option>
                      <option value="0">F</option>
                    </select>
                    </td>
                    <td><input type="" name="credit[]" placeholder="Credit" class="form-control"/></td>
                    <td><input type="" name="yandm[]" placeholder="Month & Year of Examination" class="form-control"/></td>
                  </tr>
                  <tr>
                    <td> 
                    <select class="form-control" name="subject[]">
                      <option value="">Subject</option>
                      <?php
                        $subject_list1 = mysqli_query($conn, $sql2);
                        while($row_sub1 = mysqli_fetch_assoc($subject_list1)) 
                        {
                        ?>
                          <option value="<?php echo $row_sub1['subject_id']; ?>"><?php echo $row_sub1['subject']; ?></option>
                        <?php
                        }
                      ?>
                    </select>
                    </td>
                    <td><input type="" name="code[]" placeholder="Code" class="form-control"/></td>
                    <td>
                    <select class="form-control" name="grade[]">
                      <option value="">Grade</option>
                      <option value="10">O</option>
                      <option value="9">A+</option>
                      <option value="8.5">A</option>
                      <option value="8">B+</option>
                      <option value="7">B</option>
                      <option value="6">C</option>
                      <option value="5">P</option>
                      <option value="0">F</option>
                    </select>
                    </td>
                    <td><input type="" name="credit[]" placeholder="Credit" class="form-control"/></td>
                    <td><input type="" name="yandm[]" placeholder="Month & Year of Examination" class="form-control"/></td>
                  </tr>
                  <tr>
                    <td> 
                    <select class="form-control" name="subject[]">
                      <option value="">Subject</option>
                      <?php
                        $subject_list1 = mysqli_query($conn, $sql2);
                        while($row_sub1 = mysqli_fetch_assoc($subject_list1)) 
                        {
                        ?>
                          <option value="<?php echo $row_sub1['subject_id']; ?>"><?php echo $row_sub1['subject']; ?></option>
                        <?php
                        }
                      ?>
                    </select>
                    </td>
                    <td><input type="" name="code[]" placeholder="Code" class="form-control"/></td>
                    <td>
                    <select class="form-control" name="grade[]">
                      <option value="">Grade</option>
                      <option value="10">O</option>
                      <option value="9">A+</option>
                      <option value="8.5">A</option>
                      <option value="8">B+</option>
                      <option value="7">B</option>
                      <option value="6">C</option>
                      <option value="5">P</option>
                      <option value="0">F</option>
                    </select>
                    </td>
                    <td><input type="" name="credit[]" placeholder="Credit" class="form-control"/></td>
                    <td><input type="" name="yandm[]" placeholder="Month & Year of Examination" class="form-control"/></td>
                  </tr>
                  <tr>
                    <td colspan="2">
                    <div class="form-group">
                      <label for="">Please Choose your file</label>
                      <input type="file" name="files" class="form-control"/>
                    </div>
                    </td>
                    <td colspan="2">
                    <div class="form-group">
                      <label for="">SGPA</label>
                      <input type="" name="sgpa" class="form-control" Placeholder="SGPA"/>
                    </div>
                    </td>
                    <td colspan="2">
                    <div class="form-group">
                      <label for="">CGPA</label>
                      <input type="" name="cgpa" class="form-control" Placeholder="CGPA"/>
                    </div>
                    </td>
                  </tr>
                </tbody>
              </table>        
            </div>
            <div class="col-sm-12">
            <input type="submit" value="Submit" class="btn btn-success mt-3 pull-left" name="smt">
            <input type="button" value="Cancel" class="btn btn-danger mt-3 ml-3 pull-left" onclick="window.location.href='marklist.php?fetch'">
            </div>
          </div>
          </form>

        <?php
            }
            else
            {
            ?>
              <h5 style="text-align:center; margin-top:35px;">Already Added</h5>
            <?php
            }
          }
        ?>
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
  $target_dir = "upload/";
  $target_file = $target_dir . basename($_FILES["files"]["name"]);

  $fl= $_FILES["files"]["name"];
  if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)) 
  {
    echo "done";
  }
  else
  {
    echo "not";
  }

  $sem=$_POST['semester'];
  $std=$_POST['std_id'];
  $sgpa=$_POST['sgpa'];
  $cgpa=$_POST['cgpa'];

   foreach($_POST['code'] as $key => $code) 
   {
      
      $grade=$_POST['grade'][$key];
      $sub=$_POST['subject'][$key];
      $credit=$_POST['credit'][$key];
      $mandy=$_POST['yandm'][$key];
      

     
      $sql1="insert into mark(subject_id,semester,student_id,code,grade,credit,mandy,file,sgpa,cgpa) values('$sub','$sem','$std','$code','$grade','$credit','$mandy','$fl','$sgpa','$cgpa')";
      $sql2="update student set current_sem='$sem',sgpa='$sgpa' where student_Id='$std'";
      mysqli_query($conn, $sql1);
      mysqli_query($conn, $sql2);
      
    }

    ?>  
    <script> alert('mark added to Database');//window.location.href='marklist.php?fetch';</script>
    <?php
}
?> 