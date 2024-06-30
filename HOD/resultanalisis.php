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
<li onclick="window.location.href='performanceanalisis.php'"><i class="fa fa-th" aria-hidden="true"></i> Performance Analysis</li>
</div>
</div>
<div class="rightsec">
<div class="subsec">
    <div class="bar">
        <li>Result Analysis</li>
        <form action="" method="post">
        <input type="submit" value="Search" class="btn btn-success m-2 pull-right" name="smt" >
        <input type="" name="yadm" placeholder="Year of Admission" class="form-control m-2" style="width:25%; float:right;"/>
        <select class="form-control m-2" name="semester" style="width:25%; float:right;">
        <option value="">Regular</option>
          <option value="1st">Semester 1</option>
          <option value="2nd">Semester 2</option>
          <option value="3rd">Semester 3</option>
          <option value="4th">Semester 4</option>
          <option value="5th">Semester 5</option>
          <option value="6th">Semester 6</option>
          <option value="7th">Semester 7</option>
          <option value="8th">Semester 8</option>
        </select>
        </form>
    </div>
    <?php 
       include('../connection.php');
      if(isset($_POST['smt']))
      {
        
    ?>
    <div class="tbl">
    
    <table class="table table-hover" style="float: left;">
        <thead>
          <tr>
            <th>Semester</th>
            <th>Number of Student</th>
            <th>Pass</th>
            <th>pass %</th>
          </tr>
        </thead>
        <tbody>
          <?php
          
          $yadm=$_POST['yadm'];
          $sem=$_POST['semester'];

          if($sem!='')
          {
            $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS tab (SELECT m.semester,m.student_id,count(if(m.grade>5, m.grade, NULL)) AS pass,count(if(m.grade = '0', m.grade, NULL)) AS fail,IF(count(if(m.grade = '0', m.grade, NULL))<1,'pass','fail') AS res FROM mark m inner join student s on s.student_id=m.student_id where s.year_of_admission='$yadm' and m.semester='$sem' GROUP BY m.semester,m.student_id)";
            $sql1="SELECT (SELECT COUNT(*) FROM student WHERE year_of_admission='$yadm') as scount,semester,count(if(res = 'pass', res, NULL)) AS pass FROM tab GROUP BY semester";
          }
          else
          {
            $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS tab (SELECT m.semester,m.student_id,count(if(m.grade>5, m.grade, NULL)) AS pass,count(if(m.grade = '0', m.grade, NULL)) AS fail,IF(count(if(m.grade = '0', m.grade, NULL))<1,'pass','fail') AS res FROM mark m inner join student s on s.student_id=m.student_id where s.year_of_admission='$yadm' GROUP BY m.semester,m.student_id)";
            $sql1="SELECT (SELECT COUNT(*) FROM student WHERE year_of_admission='$yadm') as scount,semester,count(if(res = 'pass', res, NULL)) AS pass FROM tab GROUP BY semester";
          }

           $result1 = mysqli_query($conn, $sql);
           $result = mysqli_query($conn, $sql1);
            
           if (mysqli_num_rows($result) > 0) 
           {
            while($row = mysqli_fetch_assoc($result)) 
            {
          ?>
          <tr>
            <td><?php echo $row["semester"]; ?></td>
            <td><?php echo $row["scount"]; ?></td>
            <td><?php echo $row["pass"]; ?></td>
            <td><?php echo get_percentage($row["scount"],$row["pass"]).'%'; ?></td>
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
  function get_percentage($total, $number)
  {
    if ( $total > 0 ) {
    return round($number / ($total / 100),2);
    } else {
      return 0;
    }
  }
?>