<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>&hearts; Administarion Home &hearts;</title>
	<link href="css/styleupadmin.css" rel="stylesheet" type="text/css" />
	<link href="css/stylesmenu.css" rel="stylesheet" type="text/css" />
	<style type="text/css" class="init"></style>
   	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/menu_jquery.js"></script>
</head>

<body>
	<div id="banner">
		<div id="logo">
			<img src="images/logooftopnew.png" width="100%" height="100%" />
		</div>
		<div id="title">
			<h1>TOPNEW.COM</h1>
		</div>
		
		<div id="title2">
			<span id="timeid"></span>
			ADMINISTRATION DASHBOARD
		</div>
	</div>
<script type="text/javascript">
function ctime(){
if (!document.getElementById)
return
timeElement=document.getElementById("timeid")
var curdate=new Date()
var hours=curdate.getHours()
var minutes=curdate.getMinutes()
var seconds=curdate.getSeconds()
var DayNight="PM"
if (hours<12) DayNight="AM";
if (hours>12) hours=hours-12;
if (hours==0) hours=12;
if (minutes<=9) minutes="0"+minutes;
if (seconds<=9) seconds="0"+seconds;
var ctime=hours+":"+minutes+":"+seconds+" "+DayNight;
timeElement.innerHTML="<p class='time'>"+ctime+"</p>"
setTimeout("ctime()",1000)
}
window.onload=ctime
</script>