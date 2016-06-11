
<?php include_once 'dbclass/dbset.php';
$monthly=$art->getNewsByMonthLink(); ?>
<div id="home_ads">

<?php
if(isset($_GET['search'])){
	?>
    <div id="ltitle">DEFINE SEARCH</div>
    <form action="" method="post">
    <table border="1">
    	<tr>
        	<td>
			<select name="cat">
            	<option>National News</option>
                <option>Yangon</option>
                <option>Mandaylay</option>
                <option>Sport</option>
                <option>EPL</option>
                <option>LALIGA</option>
                </select>
                </td>
         </tr>
         <tr>
         	<td>
            <input type="search" name="key_word" />
            </td>
            </tr>
            <tr>
            <td align="center">
            <input type="submit" value="search" name="search" />
            </td>
            </tr>
         </table>
         </form>
    
    <?php
	
	
}
?>

<div id="adsI">
<img src="ads/ads2.jpg" width="100%"/>
</div>

<div id="adsII">
<img src="ads/ads.jpg" width="100%" />
</div>
<div id="achieve1">
<div id="ltitle">MONTHLY ACHIEVES</div>
<ul>
<?php
foreach($monthly as $m){
	extract($m);
	echo "<li><a href='monthlylisting.php?month=".$mon."'>".$mon_year."</a></li>";
	
}
?>
</ul>
    <a href="seemoreach.php">see more old news</a>
 </ul>
</div>
</div>