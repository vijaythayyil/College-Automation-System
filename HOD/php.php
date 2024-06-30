<?php
  include('../connection.php');

$sql="SELECT AVG(m.sgpa)as average FROM mark m  inner join student s on m.student_Id=s.student_Id where  m.semester='8th'";

$result= mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result); 
$average = $row['average'];

echo ("This is the sum: $average");

?>
