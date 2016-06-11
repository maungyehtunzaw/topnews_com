<?php
$q = intval($_GET['q']);
if($q=='aa'){
	echo "<td>Add Top Category</td><td><input type='text' name='topcat'  id='txtbox' /></td>";
}
else{

$con = mysqli_connect('localhost','root','','topnew');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"topnew");
$sql="SELECT name FROM category WHERE parent_id = '".$q."'";
$result = mysqli_query($con,$sql);
$row_cnt = mysqli_num_rows($result);
if($row_cnt==0)
{
	echo "<td>Add Sub Category $row_cnt</td><td> <input type='text' name='subcat' id='txtbox' /></td>";
	
}
if($row_cnt>=0)
{
echo "<td>Sub Category</td><td><select  id='txtbox'>";
while($row = mysqli_fetch_array($result)) {
  echo "<option>" . $row['name'] . "</option>";
		}
	 echo "</select></td></tr>";
 echo "<tr><td>apple</td>";
}
mysqli_close($con);

}
?> 