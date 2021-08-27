<?php

	include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
	include BASE_URL."dbconnect.php"; 

?>

<?php include BASE_URL."/staffLogin/include/head.php"; 
	require $_SERVER['DOCUMENT_ROOT'].'/spl/PHPMailer/PHPMailerAutoload.php';
?>

<?php 
class BanglaConverter {
    public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    
    
    public static function bn2en($number) {
        return str_replace(self::$bn, self::$en, $number);
    }
    
    public static function en2bn($number) {
        return str_replace(self::$en, self::$bn, $number);
    }


 }
?>



<?php


function send($teacher_id,$email,$type,$memo){

	

	$mail = new PHPMailer;
 $mail->SMTPOptions = array(
  'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
  );
	$mail->isSMTP();
	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->SMTPAuth = true;  
	$mail->Host = 'smtp.gmail.com';

//$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;

$mail->Username = 'db28111997@gmail.com';

//Password to use for SMTP authentication
$mail->Password = '28111997';

$mail->setFrom('db28111997@gmail.com','Exam Control Office, DU');



	$addresses = explode(',', $email);
	foreach ($addresses as $address) {
	    $mail->AddAddress($address);
	}

	$mail->Subject = $type;


	$mail->Body = 'Please find your attached letter here with';
	$pdf_url = SERVER_URL.'Files/'.$memo.'_'.$teacher_id.'_committee.pdf';
	$mail->addStringAttachment(file_get_contents($pdf_url), 'file.pdf');


	if (!$mail->send())
	{
	   //echo $mail->ErrorInfo;
	   header('Location: ../index.php?error=1');
	}



}?>

<?php

function send_msg($mobile_no){
    $mobile_no="0". BanglaConverter::bn2en( $mobile_no);
    $token  = "2adc6a46028eaaf69879e7dce3f3037e";
    $msg ="Dear Faculty, An Official email has been sent to your institutional e-mail address. Please take necessary actions accordingly.- Exam Control Office,DU.";
    //header("Location: /spl/bulk_sms.php?m=$mobile_no");
    ?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

    <!-- <form style="display: hidden" id="msg_form" action="http://api.greenweb.com.bd/api.php" method="post">
        <input type="hidden" name="token" value="2adc6a46028eaaf69879e7dce3f3037e" />
        <input type="hidden" name="to" value="<?php echo $mobile_no?>" />
        <textarea class="span11" name="message" id="message" style="position: relative; left: 4%;" >Please Check Your Email</textarea>
        <button type="submit" name="submits" class="btn btn-success btn-large">Send Message</button>
    </form> -->
    
    <script type="text/javascript">
        msg_form();
        
        function msg_form() {
            var form = $('#msg_form')[0];
            var data = new FormData(form);
            $.ajax({
            type: "POST",
            processData: false,
            url: "http://api.greenweb.com.bd/api.php?token=<?php echo $token?>&to=<?php echo $mobile_no?>&message=<?php echo $msg?>",
            data: data,
            success: function(data){
                //alert(data);
                var numbers = "<?php echo $mobile_no?>".toString().split(",");
                for(var i=0;i<numbers.length;i++)
                {
                    number = "+88"+ numbers[i] + ",";
                }
                if(data.indexOf("Ok")> -1){
                    $sucessMsg="Email and Message has been sent succesfully.\n" 
                     alert ($sucessMsg);
                     $(location).attr('href', "../index.php");
                     //alert ("Message has been sent succesfully.");
                }
                else{
                    alert("Message was not sent succesfully. Please check your balance.");
                    $(location).attr('href', "../index.php");
                }
            }
            });
        }

    </script>

<?php } ?>

<?php
if(isset($_POST['submit']))
{ 
    $type = "Letter for Committee";

    $memo = $_SESSION['memo'];
	$teacher_id_1 = $_SESSION['teacher_id_1'];
	$teacher_id_2 = $_SESSION['teacher_id_2'];
	$teacher_id_3 = $_SESSION['teacher_id_3'];
	$teacher_id_4 = $_SESSION['teacher_id_4'];
	//$memo = $_GET['memo'];
	$memo= BanglaConverter::en2bn($memo);
	//echo $memo;
	//echo $_SESSION['name'];

	/*echo '<pre>';
	print_r($_SESSION);
	echo '</pre>';*/

	$teacher_name_1 = $_SESSION['teacher_name_1'];
	$teacher_name_2 = $_SESSION['teacher_name_2'];
	$teacher_name_3 = $_SESSION['teacher_name_3'];
	$teacher_name_4 = $_SESSION['teacher_name_4'];
	
	$dept_teacher_name = $_SESSION['dept_teacher_name'];

	$teacher_email_1 = $_SESSION['teacher_email_1'];
	$teacher_email_2 = $_SESSION['teacher_email_2'];
	$teacher_email_3 = $_SESSION['teacher_email_3'];
	$teacher_email_4 = $_SESSION['teacher_email_4'];
	
	$dept_email = $_SESSION['dept_email'];


	$teacher_mob_1 = $_SESSION['teacher_mob_1'];
	$teacher_mob_2 = $_SESSION['teacher_mob_2'];
	$teacher_mob_3 = $_SESSION['teacher_mob_3'];
	$teacher_mob_4 = $_SESSION['teacher_mob_4'];
	$dept_teacher_mob = $_SESSION['dept_teacher_mob'];
	



	$path1=SERVER_URL.'Files/'.$memo.'_'.$teacher_id_1.'_committee.pdf';
	$path2=SERVER_URL.'Files/'.$memo.'_'.$teacher_id_2.'_committee.pdf';
	$path3=SERVER_URL.'Files/'.$memo.'_'.$teacher_id_3.'_committee.pdf';
	$path4=SERVER_URL.'Files/'.$memo.'_'.$teacher_id_4.'_committee.pdf';
	$path5=SERVER_URL.'Files/'.$memo.'_'.'_chairman_committee.pdf';

    
	send($teacher_id_1,$teacher_email_1,$type,$memo);
    send($teacher_id_2,$teacher_email_2,$type,$memo);
    send($teacher_id_3,$teacher_email_3,$type,$memo);
    send($teacher_id_4,$teacher_email_4,$type,$memo);
	send ('_chairman',$dept_email,$type,$memo);


    send_msg($teacher_mob_1);
    send_msg($teacher_mob_2);
    send_msg($teacher_mob_3);
    send_msg($teacher_mob_4);
    //send_msg($dept_teacher_mob);
     
    
    $b1=$memo.'_'.$teacher_id_1.'_committee.pdf';
    $b2=$memo.'_'.$teacher_id_2.'_committee.pdf';
    $b3=$memo.'_'.$teacher_id_3.'_committee.pdf';
    $b4=$memo.'_'.$teacher_id_4.'_committee.pdf';
    $b5=$memo.'_'.'_chairman_committee.pdf';


    $sql="INSERT INTO mail (memo_no, pdf) VALUES ('$memo','$b1')";
    $result=mysqli_query($link,$sql);

    $sql="INSERT INTO mail (memo_no, pdf) VALUES ('$memo','$b2')";
    $result=mysqli_query($link,$sql);

    $sql="INSERT INTO mail (memo_no, pdf) VALUES ('$memo','$b3')";
    $result=mysqli_query($link,$sql);

    $sql="INSERT INTO mail (memo_no, pdf) VALUES ('$memo','$b4')";
    $result=mysqli_query($link,$sql);

    $sql="INSERT INTO mail (memo_no, pdf) VALUES ('$memo','$b5')";
    $result=mysqli_query($link,$sql);

 
    $memo_en= BanglaConverter::bn2en($memo);

    $sql1 = "INSERT INTO  memo (memo_no,letter_id) VALUES ($memo_en,3)";
    //echo '<pre>';print_r($sql1);exit;
    $result=mysqli_query($link,$sql1);     


    
    $date= date("Y-m-d"); 
    $deadline= date("Y-m-d"); 
    
    $tempQuery= "INSERT INTO `emails`(`ref_number`, `recipient`, `send_date`, `subject`, `body`, `deadline`, `reply`,`email`)
	 VALUES ('$memo','$teacher_name_1','$date','$type','$path1','$deadline','0','$teacher_email_1')";

	 if(mysqli_query($link,$tempQuery))
	 {
	     //echo "Hoise";
	 }



	 $tempQuery= "INSERT INTO `emails`(`ref_number`, `recipient`, `send_date`, `subject`, `body`, `deadline`, `reply`,`email`)
	  VALUES ('$memo','$teacher_name_2','$date','$type','$path2','$deadline','0','$teacher_email_2')";

	 if(mysqli_query($link,$tempQuery))
	 {
	     //echo "Hoise";
	 }


	 $tempQuery= "INSERT INTO `emails`(`ref_number`, `recipient`, `send_date`, `subject`, `body`, `deadline`, `reply`,`email`)
	  VALUES ('$memo','$teacher_name_3','$date','$type','$path3','$deadline','0','$teacher_email_3')";

	 if(mysqli_query($link,$tempQuery))
	 {
	     //echo "Hoise";
	 }


	 $tempQuery= "INSERT INTO `emails`(`ref_number`, `recipient`, `send_date`, `subject`, `body`, `deadline`, `reply`,`email`) 
	 VALUES ('$memo','$teacher_name_4','$date','$type','$path4','$deadline','0','$teacher_email_4')";

	 if(mysqli_query($link,$tempQuery))
	 {
	     //echo "Hoise";
	 }

	 
	 $tempQuery= "INSERT INTO `emails`(`ref_number`, `recipient`, `send_date`, `subject`, `body`, `deadline`, `reply`,`email`) VALUES
	  ('$memo','$','$date','$type','$path5','$deadline','0','$dept_email')";

	 if(mysqli_query($link,$tempQuery))
	 {
	    // echo "Hoise";
	 }
    
  
     

                       

} ?>


<?php
	//session_start();
	$memo = $_SESSION['memo'];
	$teacher_id_1 = $_SESSION['teacher_id_1'];
	$teacher_id_2 = $_SESSION['teacher_id_2'];
	$teacher_id_3 = $_SESSION['teacher_id_3'];
	$teacher_id_4 = $_SESSION['teacher_id_4'];
	//$memo = $_GET['memo'];
	$memo= BanglaConverter::en2bn($memo);
	//echo $memo;
	//echo $_SESSION['name'];

	/*echo '<pre>';
	print_r($_SESSION);
	echo '</pre>';*/

	$teacher_name_1 = $_SESSION['teacher_name_1'];
	$teacher_name_2 = $_SESSION['teacher_name_2'];
	$teacher_name_3 = $_SESSION['teacher_name_3'];
	$teacher_name_4 = $_SESSION['teacher_name_4'];
	//$dept_teacher_name = $_SESSION['dept_teacher_name'];

	$teacher_email_1 = $_SESSION['teacher_email_1'];
	$teacher_email_2 = $_SESSION['teacher_email_2'];
	$teacher_email_3 = $_SESSION['teacher_email_3'];
	$teacher_email_4 = $_SESSION['teacher_email_4'];
	$dept_email = $_SESSION['dept_email'];


	$teacher_mob_1 = $_SESSION['teacher_mob_1'];
	$teacher_mob_2 = $_SESSION['teacher_mob_2'];
	$teacher_mob_3 = $_SESSION['teacher_mob_3'];
	$teacher_mob_4 = $_SESSION['teacher_mob_4'];
	//$dept_teacher_mob = $_SESSION['dept_teacher_mob'];


	$path1='/spl/Files/'.$memo.'_'.$teacher_id_1.'_committee.pdf';
	$path2='/spl/Files/'.$memo.'_'.$teacher_id_2.'_committee.pdf';
	$path3='/spl/Files/'.$memo.'_'.$teacher_id_3.'_committee.pdf';
	$path4='/spl/Files/'.$memo.'_'.$teacher_id_4.'_committee.pdf';
	$path5='/spl/Files/'.$memo.'_'.'_chairman_committee.pdf';

	/*echo '<pre>';
	print_r($_SESSION);
	echo '</pre>';*/
?>


<iframe src="<?php echo $path1?>" height=800 width=100% title="Iframe Example"></iframe>
<iframe src="<?php echo $path2?>" height=800 width=100% title="Iframe Example"></iframe>
<iframe src="<?php echo $path3?>" height=800 width=100% title="Iframe Example"></iframe>
<iframe src="<?php echo $path4?>" height=800 width=100% title="Iframe Example"></iframe>
<iframe src="<?php echo $path5?>" height=800 width=100% title="Iframe Example"></iframe>

<form action="committee_pdf_show.php" method="post" >
	<div class="card-body text-center">
		<input class="btn btn-primary" type="submit" name="submit" value="Send" >
	</div>
</form>