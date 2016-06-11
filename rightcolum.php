<?php 
include_once 'dbclass/dbset.php';
$lastten=$art->getLastTenNews();
$topview=$art->getTopViewNews();
?>
	<section id="rightlist">
    <div id="emailsubr">
		<div id="ltitle">EMAIL SUBSCRIBE</div>
        <form action="" method="post" name="subscribe">
			<input type="email" name="subscremail" class="subscri" placeholder="eg: maungmaung@gmail.com" required="required" value="<?=isset($_POST['subscremail'])? $_POST['subscremail']:''?>"/>                           
    		<input type="submit" name="subscribe" value="SUBSCRIBE" id="btn"/>
        	<a href="index.php?usersubcribe">Detail Sub</a>
        </form>
    </div>
    <?php
	if(isset($_POST['subscribe'])){
		$email=htmlentities(trim($_POST['subscremail']));
		
		if(!$usr->email_exist($email))
	{
		echo $email."/";
		$chkmail=$usr->checkStatus($email);
		echo $chkmail['status']."/";
		if($chkmail['status']=='pending')
		{
			$msg= 'email is already exist, please verified or';
			$msg.='resend verified code';//email resend
		}
		else if($chkmail['status']=='block')
		{
			$msg= 'Please Contact administartor at mailto:yeye@mail.com or <a href="contactus.php">Contact</a>';
		}
		else if($chkmail['status']=='unscribe')
		{
			$msg= 'subscribe';
		}
		else
		{
		  $msg='Your Email is Already Subscribe or if you think you email have problem contact admin';
		}
	}
	else 
	{
		//email is not exist
		$usr->regNewEmail($email);
		$msg='Verified your Email';
	}
echo $msg;
		
		}

	?>
    	<div id="ltitle">LINK SOCIAL MEDIA</div>
        <a href="www.facebook.com/myanmar_top_news" target="new">
        	<img src="img/socialmedia/32/Facebook.png" />
        </a>
        <a href="www.twitter.com/myanmar_top_news" target="new">
 			<img src="img/socialmedia/32/Twitter.png" />
        </a>
        <a href="www.tumblr.com/myanmar_top_news">
	        <img src="img/socialmedia/32/Tumblr.png" />
        </a>
        <a href="www.linkedin.com">
        	<img src="img/socialmedia/32/Linkedin.png" />  
        </a>
        <a href="www.pinterest.com">
        	<img src="img/socialmedia/32/Pinterest.png" /> 
        </a>
        <a href="www.blogger.com/maungyehtunzaw">
        	<img src="img/socialmedia/32/Blogger.png" /> 
        </a>
        <a href="www.googleplus.com">
        <img src="img/socialmedia/32/Google +.png" /> 
        </a>
        <a href="www.youtube.com">
        	<img src="img/socialmedia/32/Youtube.png" /> 
        </a>
        <a href="www.stumbleupon.com">
        <img src="img/socialmedia/32/StumbleUpon.png" /> 
        </a>
        <a href="rss">
         	<img src="img/socialmedia/32/RSS.png" />    
         </a>
 
    </section>
    <section id="rightlist">
		<div id="ltitle">Latest News</div> <!-- Lasted Posts -->
			<ul id="listing">
            <?php foreach($lastten as $lstns){
				?>
				<li><a href="index.php?newsid=<?=$lstns['id'];?>"><?=strip_tags(substr($lstns['title'],0,40));?>
				<?php if(strlen($lstns['title'])>40){
				echo '...';
				}?></a></li>
			<?php }?>
          </ul>
	</section>
      <section id="rightlist">
            <div id="ltitle">Popular News/Top Views news </div>
                <ul id="listing">
                <?php foreach($topview as $tp){ ?>
                <li><a href="index.php?newsid=<?=$tp['id'];?>"  onclick="<?php // $add=$art->addViewCount($tp['idnews'])?>" > <?=$tp['title'];?> <small><em>&Delta; <?=$tp['view_count'];?> views &Delta;</em></small> </a></li>
               <?php } ?>
			</ul>
</section>
