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
        <div class="subsec" style="height:auto;">
                <div class="bar">
                        <li>Performance Analysis</li>
                        <form action="" method="post">
                        <input type="submit" value="Analyse" class="btn btn-success m-2 pull-right" name="smt" >
                        <input type="" name="yadm" placeholder="Year of Admission" class="form-control m-2" style="width:25%; float:right;"/>
                        <select class="form-control m-2 regularselect" name="semester" style=" display:none;width:25%; float:right;">
                        <option value="">Regular</option>
                        </select>
                        </form>
                 </div>
  <?php 
       include('../connection.php');
      if(isset($_POST['smt']))
      {
        
    ?>

        <div class="tbl" style=" border:none;">

     
</body>
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
    <center>
        
            <canvas id="myChart"  style="width:1168px; height:450px; display:block;"></canvas> 
            
            </center>  
        
        <div class="new" style="width:auto;height: 50px;border-radius: 10px;background: #73AD21;">
        <center>
            <ul class="list" style="padding-top: 13px;margin-bottom: 0px;color:white;">
                <li style="display: inline;"> Excellent : 9.1-10</li>
                <li style="display: inline;">Good : 8.1-9.0</li>
                <li style="display: inline;">Above average : 7.1-8.0</li>
                <li style="display: inline;">Average : 6.1-7.0</li>
                <li style="display: inline;">Below average : 5.1-6.0</li>
                <li style="display: inline;">Low : below 5.0</li>
            </ul>
        </center>
         </div>



<?php
$did=$_SESSION['did'];
$sql="SELECT AVG(m.sgpa)as s1 FROM mark m  inner join student s on m.student_Id=s.student_Id where s.year_of_admission=$yadm and s.department_Id='$did' and m.semester='1st'";
$result= mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result); 
$s1 = $row['s1'];
$sql="SELECT AVG(m.sgpa)as s2 FROM mark m  inner join student s on m.student_Id=s.student_Id where s.year_of_admission=$yadm and s.department_Id='$did' and m.semester='2nd'";
$result= mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result); 
$s2 = $row['s2'];
$sql="SELECT AVG(m.sgpa)as s3 FROM mark m  inner join student s on m.student_Id=s.student_Id where s.year_of_admission=$yadm and s.department_Id='$did' and m.semester='3rd'";
$result= mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result); 
$s3 = $row['s3'];
$sql="SELECT AVG(m.sgpa)as s4 FROM mark m  inner join student s on m.student_Id=s.student_Id where s.year_of_admission=$yadm and s.department_Id='$did' and m.semester='4th'";
$result= mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result); 
$s4 = $row['s4'];
$sql="SELECT AVG(m.sgpa)as s5 FROM mark m  inner join student s on m.student_Id=s.student_Id where s.year_of_admission=$yadm and s.department_Id='$did' and m.semester='5th'";
$result= mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result); 
$s5 = $row['s5'];
$sql="SELECT AVG(m.sgpa)as s6 FROM mark m  inner join student s on m.student_Id=s.student_Id where s.year_of_admission=$yadm and s.department_Id='$did' and m.semester='6th'";
$result= mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result); 
$s6 = $row['s6'];
$sql="SELECT AVG(m.sgpa)as s7 FROM mark m  inner join student s on m.student_Id=s.student_Id where s.year_of_admission=$yadm and s.department_Id='$did' and m.semester='7th'";
$result= mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result); 
$s7 = $row['s7']; 
$sql="SELECT AVG(m.sgpa)as s8 FROM mark m  inner join student s on m.student_Id=s.student_Id where s.year_of_admission=$yadm and s.department_Id='$did' and m.semester='8th'";
$result= mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result); 
$s8 = $row['s8'];

?>   
</div> 
          <?php
            }
          }
          else 
          {?>
          <tr>
            <td colspan="5"><?php echo "0 results"; ?></td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    
<?php
    }
?> 
</div>
</div>
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery-3.2.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'line',
        fill: 'false',
        data: {
            labels: ['0','S1', 'S2', 'S4','S3', 'S5', 'S6', 'S7', 'S8'],
            datasets: [{
                label: '<?php echo " ".$yadm." Batch" ?>',
                data: [0.0,<?php echo round($s1,2) ?>,<?php echo round($s2,2) ?>,<?php echo round($s3,2) ?>,<?php echo round($s4,2) ?>,<?php echo round($s5,2) ?>,<?php echo round($s6,2) ?>, <?php echo round($s7,2) ?>,<?php echo round($s8,2) ?>],
                fill:false,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [ 
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                    }
                }]
            }
        }
    });
</script>
</html> 
