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
      

        $sql2="select * from subject";
    ?>
      <div class="container pb-4" style="padding-top:15px; float:left;">
        <div class="container"> 
<?php 
  if(isset($_GET['sem']))
  {
    $std=$_GET['fetch'];
    $sem=$_GET['sem'];

    $sql="select * from mark where student_id='$std' and semester='$sem'";
    $sql1="select * from mark where student_id='$std' and semester='$sem'";
    $res=mysqli_query($conn, $sql);
    $res1=mysqli_query($conn, $sql);
    $re=mysqli_query($conn, $sql);
    $r=mysqli_fetch_array($re);
?>
          <img src="../student/upload/<?php echo $r['file']; ?>" style="width:100%;"/>
          <form action="" method="post" enctype="multipart/form-data" style="width:100%;">

            <input type="hidden" name="semester" value="<?php echo $_GET['sem']; ?>"/>
            <input type="hidden" name="std_id" value="<?php echo $_GET['fetch']; ?>"/>

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
                <?php
                  while($row = mysqli_fetch_array($res)) 
                  {

                ?>
                  <tr>
                    <td>  <input type="hidden" name="mid[]" value="<?php echo $row["id"]; ?>"/>
                    <select class="form-control" name="subject[]">
                      <option value="">Subject</option>
                      <?php
                        $subject_list1 = mysqli_query($conn, $sql2);
                        while($row_sub1 = mysqli_fetch_array($subject_list1)) 
                        {
                        ?>
                          <option <?php if($row_sub1['subject_id']==$row['subject_id']){ echo 'selected';} ?> value="<?php echo $row_sub1['subject_id']; ?>"><?php echo $row_sub1['subject']; ?></option>
                        <?php
                        }
                      ?>
                    </select>
                    </td>
                    <td><input type="" name="code[]" placeholder="Code" class="form-control" value="<?php echo $row["code"]; ?>"/></td>
                    <td>
                    <select class="form-control" name="grade[]">
                      <option  value="">Grade</option>
                      <option <?php if($row['grade']=='10'){ echo 'selected';} ?> value="10">D</option>
                      <option <?php if($row['grade']=='9'){ echo 'selected';} ?> value="9">A+</option>
                      <option <?php if($row['grade']=='8.5'){ echo 'selected';} ?> value="8.5">A</option>
                      <option <?php if($row['grade']=='8'){ echo 'selected';} ?> value="8">B+</option>
                      <option <?php if($row['grade']=='7'){ echo 'selected';} ?> value="7">B</option>
                      <option <?php if($row['grade']=='6'){ echo 'selected';} ?> value="6">C</option>
                      <option <?php if($row['grade']=='5'){ echo 'selected';} ?> value="5">P</option>
                      <option <?php if($row['grade']=='0'){ echo 'selected';} ?> value="0">F</option>
                    </select>
                    </td>
                    <td><input type="" name="credit[]" placeholder="Credit" class="form-control" value="<?php echo $row["credit"]; ?>"/></td>
                    <td><input type="" name="yandm[]" placeholder="Month & Year of Examination" class="form-control" value="<?php echo $row["mandy"]; ?>"/></td>
                  </tr>

                  <?php
                      }
                  ?>
                  <tr>
                  <?php
                    $row1 = mysqli_fetch_array($res1);
                  ?>
                  <td colspan="2">
                  <div class="form-group">
                      <label for="">Please Choose your file</label>
                      <input type="file" name="files" class="form-control"/>
                    </div>
                    </td>
                    <td colspan="2">
                    <div class="form-group">
                      <label for="">SGPA</label>
                      <input type="" name="sgpa" class="form-control" Placeholder="SGPA" value="<?php echo $row1["sgpa"]; ?>"/>
                    </div>
                    </td>
                    <td colspan="2">
                    <div class="form-group">
                      <label for="">CGPA</label>
                      <input type="" name="cgpa" class="form-control" Placeholder="CGPA" value="<?php echo $row1["cgpa"]; ?>"/>
                    </div>
                    </td>
                  </tr>
                </tbody>
              </table>        
            </div>
            <div class="col-sm-12">
            <input type="submit" value="Update" class="btn btn-success mt-3 pull-left" name="smt">
            <input type="button" value="Cancel" class="btn btn-danger mt-3 ml-3 pull-left" onclick="window.location.href='mark.php?fetch'">
            </div>
          </div>
          </form>

        <?php
          }
        ?>
         </div>
        </div>
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
  $target_dir = "../student/upload/";
  $target_file = $target_dir . basename($_FILES["files"]["name"]);

  $fl= $_FILES["files"]["name"];
  if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)) 
  {
    $sts= "done";
  }
  else
  {
    $sts= "not";
  }
  
  $sem=$_POST['semester'];
  $std=$_POST['std_id'];
  $sgpa=$_POST['sgpa'];
  $cgpa=$_POST['cgpa'];


  $x=0;
   foreach($_POST['code'] as $key => $code) 
   {
      
      $grade=$_POST['grade'][$key];
      $sub=$_POST['subject'][$key];
      $credit=$_POST['credit'][$key];
      $mandy=$_POST['yandm'][$key];
      $id=$_POST['mid'][$key];

      if($sts=="done")
      {
        $sql1="update mark set file='$fl',sgpa='$sgpa',cgpa='$cgpa',subject_id='$sub',semester='$sem',student_id='$std',code='$code',grade='$grade',credit='$credit',mandy='$mandy' where id='$id'";
      }
      else
      {
        $sql1="update mark set sgpa='$sgpa',cgpa='$cgpa',subject_id='$sub',semester='$sem',student_id='$std',code='$code',grade='$grade',credit='$credit',mandy='$mandy' where id='$id'";
        $sql2="update student set current_sem='$sem',sgpa='$sgpa' where student_Id='$std'";
      
      }
     
      mysqli_query($conn, $sql1);
      mysqli_query($conn, $sql2);

      
    }

    ?>  
    <script> alert('mark Updated to Database');window.history.back();</script>
    <?php
}
?> 

<!-- CREATE TEMPORARY TABLE IF NOT EXISTS tab (SELECT * FROM mark WHERE grade=0 GROUP BY semester,student_id);
SELECT semester,COUNT(*) from tab GROUP BY semester;  -->


<!-- SELECT semester,student_id,count(if(grade = '5', grade, NULL)) AS pass,count(if(grade = '0', grade, NULL)) AS fail,IF(count(if(grade = '0', grade, NULL))<1,'pass','fail') AS res FROM mark GROUP BY semester,student_id -->