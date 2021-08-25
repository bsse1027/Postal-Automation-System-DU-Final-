<?php 

    include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
    include BASE_URL."dbconnect.php"; 

?>
<html>
<body>
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




session_start();
$a= $_SESSION['pdf'];
$a1=$_SESSION['memo'];
$new=$_SESSION['new'];
$c=$_SESSION['teacher'];
$d1=$_SESSION['d1'];
$dept=$_SESSION['dept'];
$dept_id=$_SESSION['dept_id'];
$year=$_SESSION['year'];
$xm=$_SESSION['xm'];
$yr=$_SESSION['yr'];
$r1=$_SESSION['r1'];
$r2=$_SESSION['r2'];
$cr=$_SESSION['cr'];
$deadline=$_SESSION['deadline'];
$type=$_SESSION['type'];
$date=$_SESSION['date'];
$date1=date("Y-m-d", strtotime($date));

$email = "";
$mobile_no = "";




  

    $path='/spl/Files/'.$a.'.pdf';
    $pdf_url = $_SERVER['DOCUMENT_ROOT'].'/spl/Files/'.$a.'.pdf';




 
    $sql="SELECT * FROM teacher WHERE t_name='" . $c . "' AND tid = ".$dept_id."";
    //echo '<pre>';print_r($sql);exit;
    $result=mysqli_query($link,$sql);
    // $resultCheck=mysqli_num_rows($result);
    
    // if($resultCheck>0)
    // {
    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result)) 
        {
        $email= $row["email"];
        $mobile_no = $row["mobile_no"];
        
        }
    
    }  
    
 
 
    


    
   
?>
<div>
<iframe src=<?php echo $path?> height=800 width=100% title="Iframe Example"></iframe>
<!-- <object data="<?php echo $path?>" width="100%" height="800">
    <embed ng-src="<?php echo $path?>" width="100%" height="800"> </embed> 
</object> -->
</div>


<div>




<?php

$sucessMsg="";
$errorMsg="";
$error=0;

/* Namespace alias (don't need Exception this time). */





function send($a,$email,$type){
/* Include the Composer generated autoload.php file. */
//require 'C:\xampp\composer\vendor\autoload.php';
//require $_SERVER['DOCUMENT_ROOT'].'/spl/PHPMailer';
require $_SERVER['DOCUMENT_ROOT'].'/spl/PHPMailer/PHPMailerAutoload.php';



/* Create a new PHPMailer object. */

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
  
/* Set the mail sender. */

/* Add a recipient. */

$addresses = explode(',', $email);
foreach ($addresses as $address) {
    $mail->AddAddress($address);
}



//echo '<pre>';print_r($type);exit;

//$mail->AddAddress('bsse1018@iit.du.ac.bd');
/* Set the subject. */
$mail->Subject = $type;

/* Set the mail message body. */
$mail->Body = 'Please find your attached letter here with';
$pdf_url = $_SERVER['DOCUMENT_ROOT'].'/spl/Files/'.$a.'.pdf';
$mail->addStringAttachment(file_get_contents($pdf_url), 'file.pdf');


/* Finally send the mail. */
if (!$mail->send())
{
   /* PHPMailer error. */
   //$errorMsg .= "Mail was not sent successfully.\n\n\n"; 
   //echo $mail->ErrorInfo;
    //echo '<script type="text/javascript"> alert("Mail was not sent succesfully") ; $(location).attr("href", "../index.php"); </script>';
   //sleep(0.5);
   header('Location: ../index.php?error=1');
   //echo '<script type="text/javascript"> alert("Mail was not sent succesfully") </script>';
   //$error++;
   return false;
   
   
}

else
{
    echo "Email Sent Succefully.\n\n\n";
    return true;
    
}

// if($error>0)
// {
//     header('Location: ../index.php');
// }





}

function send_msg($mobile_no){
    $mobile_no="0". BanglaConverter::bn2en( $mobile_no);
    $token  = "2adc6a46028eaaf69879e7dce3f3037e";
    $msg ="Dear Faculty, An Official email has been sent to your institutional e-mail address. Please take necessary actions accordingly.- Exam Control Office,DU.";
    //header("Location: /spl/bulk_sms.php?m=$mobile_no");

    //echo "<script> alert('$mobile_no') </script>"
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
        //document.getElementById('msg_form').submit(); // SUBMIT FORM
        //msg_form();
        
        //$number = number.slice(0,-2);
        
        //alert(number.slice(0,-1));
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

<?php } 

if(isset($_POST['submit']))
{ 
    //echo $mobile_no;
    if (send($a,$email,$type) == true)
    {
        send_msg($mobile_no);

    }

    // else
    // {
    //     echo '<script type="text/javascript"> alert("Mail was not sent succesfully") ; $(location).attr("href", "../index.php"); </script>'; 
    // }

    /*$mobile_nos = explode(',', $mobile_no);
    foreach ($mobile_nos as $mobile_no) {
        send_msg($mobile_no);
    }*/
    
     
   // send_msg('1787027488');


    


    
    $b=$a.'.pdf';

  
    $sql="INSERT INTO mail (memo_no, pdf) VALUES ('$a','$b')";
    $result=mysqli_query($link,$sql);

   


    $result1 = mysqli_query($link,"SELECT * FROM memo;");
    $num_rows = mysqli_num_rows($result1)+1;
    $memo_en= BanglaConverter::bn2en($a1);
    $sql1 = "INSERT INTO  memo (memo_no,letter_id)
                  VALUES ($memo_en,1)";
         
     if(mysqli_query($link,$sql1))
     {
       // echo "New record created successfully<br>";
     }
  
    
    

    
                                    $sql="INSERT INTO letter_data (ref_number,send_date,recipient,Designation,Department,Year,ExamType,StudyYear,Subject_name,Course,CourseType,deadline,subject)                         
                                    VALUES ('$a','$date1','$c','$d1','$dept','$year','$xm','$yr','$r1','$r2','$cr','$deadline','$type')";

                                    
                                    if(mysqli_query($link,$sql))
                                    {
                                     // echo "New record created successfully<br>";
                                    }
                                    
                                 $tempQuery= "INSERT INTO `emails`(`ref_number`, `recipient`, `send_date`, `subject`, `body`, `deadline`, `reply`,`email`) VALUES
                                  ('$a','$c','$date1','$type','../../../spl/Files/$a.pdf','$deadline','0','$email')";

                                if(mysqli_query($link,$tempQuery))
                                {
                                   // echo "Hoise";
                                }
                               





                                 unset($_SESSION['pdf']);
                                 unset($_SESSION['memo']); 
                                 unset($_SESSION['new']);
                                 unset($_SESSION['teacher']);
                                 unset($_SESSION['d1']);
                                 unset($_SESSION['dept']);
                                 unset($_SESSION['year']);
                                 unset($_SESSION['xm']);
                                 unset($_SESSION['yr']);
                                 unset($_SESSION['r1']);
                                 unset($_SESSION['r2']);
                                 unset($_SESSION['cr']);
                                 unset($_SESSION['deadline']);
                                 unset($_SESSION['type']);
                                 //header('Location: ../index.php');
                                 
                                                   

  } 

?>







 
 
<html>
 <head>
  <title></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
 <form action="iframe5.php" method="post" >
    <div class="card-body text-center">
      <input class="btn btn-primary" type="submit" name="submit" value="Send" >
    </div>
 </form>
 </body>
 </html>


</div>



</body>
</html>





