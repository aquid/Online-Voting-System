<html>
  <?php
	require("db.php");
	require("db2.php");
	 if(isset($_POST['submit'])) 
	 {
	 $ip=$_SERVER['REMOTE_ADDR'];
	 $ip= ip2long($ip);
	 mysql_select_db('my_pol');
	 $ipad="select ID from voting where ID=".$ip;
	 //if($ipad){
		 //echo "you can vote only once";
	 //}
	 //else{
	     $con=mysql_connect('localhost', 'root','');
	     if(mysql_error($con))
	    {
		    echo "Failed to conect".mysql_error();
	    }
		if($_POST['submit'])
	    {
		if(empty($_POST['p']))
		{
			echo '<script type="text/javascript">alert("You Have To Select An Option. "); </script>';
		}
		else
		{
	    $a=$_POST['p'];
	    $b=("insert into voting values('$a','$ip')");
        mysql_select_db('my_pol');
        $r=mysql_query($b,$con);
        if(!$r){
	      echo '<script type="text/javascript">alert("You Can Vote Only Once. "); </script>';
        }
        else{
		   //echo "success<br/> ";
	   }
	    $x=("select count(ANSWERS) AS total1 from voting where ANSWERS='YES'");
	    $y=mysql_query($x) or die(mysql_error());
	    $count1=mysql_fetch_array($y);
	    //echo " Number of yes ".$count1['total1']."<br/>";
	    $m=("select count(ANSWERS) AS total2 from voting where ANSWERS='NO'");
	    $n=mysql_query($m) or die(mysql_error());
	    $count2=mysql_fetch_array($n);
	    echo "  ";
	    //echo "<html> <h1>Number Of No ".$count2['total2']."</h1><br/></html>";
	    $p=("select count(ANSWERS) AS total3 from voting where ANSWERS='MAY'");
	    $q=mysql_query($p) or die(mysql_error());
	    $count3=mysql_fetch_array($q);
	    echo "  ";
	    //echo"Number Of May Be ".$count3['total3']."<br/>";
	    $r=("select count(ANSWERS) AS total4 from voting where ANSWERS='DONT'");
	    $s=mysql_query($r) or die(mysql_error());
	    $count4=mysql_fetch_array($s);
	    echo "  ";
	    $sum=($count1['total1']+$count2['total2']+$count3['total3']+$count4['total4']);
	    //echo"Number Of Don't want to ans  ".$count4['total4']."<br/>";
	    
	   // }
   }
   }
	}
	?>
<head>
		 <link rel="stylesheet" type="text/css" href="css-graph.css" />
	     <script type="text/javascript" src="jquery-1.3.2.min.js"></script>
	     <script type="text/javascript" src="css-graph.js"></script>
	     <script type="text/javascript">
	     </script>
           <script type="text/javascript">
            var CSSGRAPH1_OPTIONS = {
            graph: 'myGraph1',
            type: 'vertical',
            width: 320,
            height: 90,
            pattern: 'h_d2l_256.png',
            labels: 'Yes:<?php echo ($count1['total1']/$sum)*100;?>%,No:<?php echo ($count2['total2']/$sum)*100;?>%,Maybe:<?php echo ($count3['total3']/$sum)*100;?>%,dont:<?php echo ($count4['total4']/$sum)*100;?>%',
            data: '<?php echo ($count1['total1']/$sum)*100;?>,<?php echo ($count2['total2']/$sum)*100;?>,<?php echo ($count3['total3']/$sum)*100;?>,<?php echo ($count4['total4']/$sum)*100;?>',
            animate: true,
            start: 'bottom'
        }
        
        jQuery(document).ready(function($) {
		 
            $().cssgraph(CSSGRAPH1_OPTIONS);
        });
    </script>

	<style>
body
{
margin-left:200px;
margin-right:200px;
background:#CCFF33;
}

#container
{
text-align:center;
}
#radio
{
	
	text-align:left;
}
#my
{
	margin-left:150px;
}
	
#center
{
border:5px solid blue;
margin-left:auto;
margin-right:auto;
width:700px;
height:400px;
background-color:#d0f0f6;
text-align:center;
padding:50px;
}
</style>
</head>

<body>
	<div id="container">
		<div id="center">
			<h1>NationsRoot Voting</h1>
			<h2>Does NationsRoot conect groups with meaningful work and content? </h2>
		<div id="radio">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="pollForm"><h3>Poll Options</h3>
			<input id="radio1" type ="radio" name="p" value="YES">YES<br>
	        <input id="radio2" type="radio" name="p" value="NO">NO<br>
	        <input id="radio3" type="radio" name="p" value="MAY">MAY BE<br>
	        <input id="radio4" type="radio" name="p" value="DONT">Dont Want To Answer<br>
	        <div id="submit"><input id="vote" type="submit" name="submit" value="VOTE"></div>
	        </form>
		 </div>
		  <div id="my">
		     <div id="myGraph1"></div>
		   </div>
		 </div>
	</div>
	
</body>

</html>
