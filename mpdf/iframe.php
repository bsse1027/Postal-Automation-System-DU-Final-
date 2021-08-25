<html>
<body>
<?php
include("dbconnect.php");

session_start();
$a= $_SESSION['pdf'];
$a1=$_SESSION['memo'];
$new=$_SESSION['new'];
$c=$_SESSION['c'];
$d1=$_SESSION['d1'];
$d2=$_SESSION['d2'];
$year=$_SESSION['year'];
$xm=$_SESSION['xm'];
$yr=$_SESSION['yr'];
$r1=$_SESSION['r1'];
$r2=$_SESSION['r2'];
$cr=$_SESSION['cr'];
$deadline=$_SESSION['deadline'];
$type=$_SESSION['type'];



  

    $path='/Files/'.$a.'.pdf';
    $pdf_url = $_SERVER['DOCUMENT_ROOT'].'/Files/'.$a.'.pdf';




    $sql="SELECT * FROM teacher WHERE t_name='" . $c . "'";
    $result=mysqli_query($link,$sql);
    // $resultCheck=mysqli_num_rows($result);
    
    // if($resultCheck>0)
    // {
    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result)) 
        {
        $email= $row["email"];
        
        }
    
    }  
    
 
   
    


    
   
?>
<div>
<iframe src=<?php echo $path?> height=80% width=100% title="Iframe Example"></iframe>
</div>


<div>




<?php

/* Namespace alias (don't need Exception this time). */
//use PHPMailer\PHPMailer\PHPMailer;
function send($a,$email){
/* Include the Composer generated autoload.php file. */
//require 'C:\xampp\composer\vendor\autoload.php';

require $_SERVER['DOCUMENT_ROOT'].'/spl/PHPMailer/PHPMailerAutoload.php';



/* Create a new PHPMailer object. */
$mail = new PHPMailer();

/* Set the mail sender. */
$mail->setFrom('db28111997@gmail.com', 'Registrar Building');

/* Add a recipient. */
$mail->addAddress($email);

/* Set the subject. */
$mail->Subject = 'Official Letter';

/* Set the mail message body. */
$mail->Body = 'Please find your attached letter herewith.';
$pdf_url = $_SERVER['DOCUMENT_ROOT'].'/Files/'.$a.'.pdf';
$mail->addStringAttachment(file_get_contents($pdf_url), 'file.pdf');


/* Finally send the mail. */
if (!$mail->send())
{
   /* PHPMailer error. */
   echo $mail->ErrorInfo;
}





}

if(isset($_POST['submit']))
{ 
    send($a,$email);


    
    $b=$a.'.pdf';

    
    $sql="INSERT INTO mail (memo, pdf) VALUES ('$a','$b')";
    $result=mysqli_query($link,$sql);

    

    $result1 = mysqli_query($link,"SELECT * FROM memo1;");
    $num_rows = mysqli_num_rows($result1)+1;

     $sql1 = "INSERT INTO  memo1 (sl,memo)
                  VALUES (' $num_rows', '$a1')";
         
                 if(mysqli_query($link,$sql1))
                 {
                  //  echo "New record created successfully<br>";
                 }
    
    
    

    
                                $sql="INSERT INTO letter_data (ref_number,send_date,recipient,Designation,Department,Year,ExamType,StudyYear,Subject_name,Course,CourseType,deadline,subject)                         
                                VALUES ('$a','$new','$c','$d1','$d2','$year','$xm','$yr','$r1','$r2','$cr','$deadline','$type')";

                                
                                if(mysqli_query($link,$sql))
                                {
                                 //  echo "New record created successfully<br>";
                                }
                                 

                                $tempQuery= "INSERT INTO `emails`(`ref_number`, `recipient`, `send_date`, `subject`, `body`, `deadline`, `reply`,`email`) VALUES ('$a','$c','$new','$type','../../../Files/$a.pdf','$deadline','0','$email')";

                                if(mysqli_query($link,$tempQuery))
                                {
                                    //echo "Hoise";
                                }
                               






                                 unset($_SESSION['pdf']);
                                 unset($_SESSION['memo']); 
                                 unset($_SESSION['new']);
                                 unset($_SESSION['c']);
                                 unset($_SESSION['d1']);
                                 unset($_SESSION['d2']);
                                 unset($_SESSION['year']);
                                 unset($_SESSION['xm']);
                                 unset($_SESSION['yr']);
                                 unset($_SESSION['r1']);
                                 unset($_SESSION['r2']);
                                 unset($_SESSION['cr']);
                                 unset($_SESSION['deadline']);
                                 unset($_SESSION['type']);
                                 header('Location: ../index.php');
                                 

                            
                                                   

  } 

?>




<html>
 <head>
  <title>Send an Email on Form Submission using PHP with PHPMailer</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
 <form action="iframe.php" method="post" >
 <input type="submit" name="submit" value="Send" >
 </form>
 </body>
 </html>


</div>



</body>
</html>

