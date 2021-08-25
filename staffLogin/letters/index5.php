<?php 

    include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
    include BASE_URL."dbconnect.php"; 
    include('bnTime.php');

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


                      



 session_start();
  $memo= $_SESSION['memo'];
 
 
  $memo= BanglaConverter::en2bn( $memo);

  $date= $_SESSION['date'];

  $en_month = array("জানুয়ারি", "ফেব্রুয়ারি", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর","নভেম্বর","ডিসেম্বর");
  //$date= $_POST['date'];
  //echo "<pre>";print_r($en_month);exit;
  $date_explode = explode("-",$date);
  $date_m = $en_month[($date_explode[1]-1)];

  $data_d = BanglaConverter::en2bn($date_explode[0]);
  $data_y = BanglaConverter::en2bn($date_explode[2]);

  $date= $data_d. " " . $date_m ." " . $data_y;

  $Bdate = BDdate($time);

  //$new= BanglaConverter::en2bn($date);



  $deadline=date("Y-m-d", strtotime($_POST["deadline"]));

                      
                     

                     


  $year =BanglaConverter::en2bn($_POST["year"]);
  $result = $_POST["department"];
  $result_explode = explode('|', $result);

  $dept_id= $result_explode[0];
  $dept= $result_explode[1];
  $teacher=$_POST["teacher"];
  //echo"<pre>"; print_r($teacher);exit;
  $yr=$_POST["yr"];
  $xm=$_POST["xm"];
  $cr=$_POST["cr"];


  //$result = $_POST["subject"];
  //$result_explode = explode('|', $result);

  $r1= $_POST["subject"];
  //$r1= $result_explode[1];
  $r2=$_POST["course"];

 



    $sql="SELECT * FROM teacher WHERE t_name='" . $teacher . "'";
    $result=mysqli_query($link,$sql);
// $resultCheck=mysqli_num_rows($result);

// if($resultCheck>0)
// {
    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result)) 
        {
        $d1= $row["designation"];
       
       
        }

    }  

    

    
  

 
    //$x=$_SERVER['DOCUMENT_ROOT'].'\Files\\';
    $x=$_SERVER['DOCUMENT_ROOT'].'/spl/Files/';
   
    $y='.pdf'; 
    $pdf=$x.$memo.$y; 


    $image= $_POST['image'];
 
 
  if($image==1)
    $image1="<img src='".SERVER_URL."resources/img/sign.jpg' width=100 height=50 style='padding-left:40%;'>";

else
  $image1="<img src='".SERVER_URL."resources/img/white.jpg' width=100 height=20 style='padding-left:-10%;'>";
    
                    

?>

<?php
include BASE_URL."mpdf/mpdf.php";
$mpdf=new mPDF('','A4',14,'nikosh'); 
ob_start();




$str="";


$str.= "<table>";
$str.= "<tr>";

$str.= "<td width='60%'>";
$str.= "<strong>পরীক্ষা নিয়ন্ত্রকের অফিস</strong><br>
            <strong>ঢাকা বিশ্ববিদ্যালয়</strong><br>
            ফোনঃ(অফিস)৮৬১৩২৮০<br>
            ৯৬৬১৯০০-৫৯/৪০৮০<br>
            ফ্যাক্সঃ৮৮০-২-৯৬৬৭২২২<br>
            <p style=\"font-size:14px;\">Email:co_letter@du.ac.bd</p>";
$str.= "</td>";
$str.= "<td width='45%'>";
$str.= '<img src="'.SERVER_URL.'resources/img/DhakaUniversity.jpg" width="80" height="100">';
$str.= "</td>";

$str.= '<td style="font-size: 14px;" >';

$str.= "</td>";

$str.= "</tr>";
$str.= "</table>";



$str.= "<table>";
$str.= "<tr>";

$str.= "<td width='74%'>";
$str.= "মেমো নং: ".$memo."/শা-৫/প.";
$str.= "</td>";

$str.= "<td width='7%'>";
$str.= "তারিখঃ";
$str.= "</td>";
$str.= "<td>";
$str.= "<table>";
$str.= "<tr>";
$str.= "<td>";
$str.= "<u>".$date."</u>";
$str.= "<br>".$Bdate;
$str.= "</td>";
$str.= "</tr>";
$str.= "</table>";
$str.= "</td>";

$str.= "</tr>";
$str.= "</table>";

$str.= "<div align='center'>";
$str.= "<strong> গোপনীয়</strong><br>
                        <strong>(শুধু উত্তরপত্র পরীক্ষকদের জন্য)</strong>";
$str.= "</div>";

$str.= "<br>";


$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='1%'>";
$str.= "</td>";
$str.= "<td>";
$str.= $teacher;
$str.= "<br>";
$str.= $d1;
$str.= "<br>";

$str.= $dept;
$str.= "<br>";
$str.= "ঢাকা বিশ্ববিদ্যালয়";
$str.= "<br>";
$str.= "ঢাকা - ১০০০।";
$str.= "</td>";
$str.= "</tr>";


$str.= "<tr>";
$str.= "<td>";
$str.= "</td>";
$str.= "<td>";
$str.= "</td>";
$str.= "</tr>";
$str.= "<tr>";
$str.= "<td>";
$str.= "</td>";
$str.= "<td>";
$str.= "</td>";
$str.= "</tr>";

$str.= "<tr>";
$str.= "<td>";
$str.= "</td>";
$str.= "<td>";
$str.= "জনাব,";
$str.= "</td>";
$str.= "</tr>";
$str.= "</table>";


$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='1%'>";
$str.= "</td>";
$str.= "<td style='text-align: justify; text-justify: inter-word;'>";
$str.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;আপনাকে জানাইতেছি যে, আপনি  $year  সনের $yr   বর্ষ $xm  পরীক্ষার $r1  বিষয়ের  $r2 নং  $cr উত্তরপত্র পরীক্ষক নিযুক্ত হইয়াছেন। 

  <br>
  <br>
    বিধি অনুযায়ী অভ্যন্তরীণ  পরীক্ষক কোর্স ফাইনাল পরীক্ষার হলের প্রধান তত্ত্বাবধায়কের নিকট হইতে
      উত্তরপত্র ও সংশ্লিষ্ট কাগজপত্র গ্রহণ করিবেন। কোন কারণে পরীক্ষক পরীক্ষার হল হইতে উত্তরপত্র সংগ্রহ
      করিতে না পারিলে তিনি পরবর্তী তিন কর্মদিবসের মধ্যে পরীক্ষা নিয়ন্ত্রকের অফিস হইতে উহা সংগ্রহ
      করিবেন । মফঃস্বলস্থ পরীক্ষকগণের নিকট ডাকযোগে উত্তরপত্র প্রেরণ করা হইবে।

    <br>
    <br>
    আপনার কোনো নিকট আত্মীয় যেমনঃ (১) ভাই  (২) বোন  (৩) স্ত্রী/স্বামীর  (ক) ভাই/বোন 
      (৪) ছেলে  (৫) মেয়ে  (৬) ভ্রাতৃবধূ  (৭) ভগ্নিপতি 
     (৮) স্ত্রী (৯) স্বামী (১০) ভাই ও বোনের সন্তানের (১১) পুত্রবধূ 
      (১২) জামাতা  (১৩) আপন চাচা-চাচী  (১৪) আপন মামা-মামী  (১৫) আপন ফুফা-ফুফু
     এবং (১৬) আপন খালা-খালু এই পরীক্ষায় যদি পরীক্ষার্থীর/পরীক্ষার্থিনী থাকে, তবে তাহা নিয়োগপত্র গ্রহণের পূর্বে  অত্র অফিসে জানাইতে হইবে।

    <br>
    <br>

    আপনি যদি শিক্ষা প্রতিষ্ঠান/বিভাগ ছাড়া অন্য কোন সরকারী দপ্তরের কর্মকর্তা হন,তবে আপনাকে  নিযুক্তি গ্রহণের পূর্বে অবশ্যই কর্তৃপক্ষের অনুমতি নিতে হইবে এবং এই কাজের পারিশ্রমিক গ্রহণের
                        জন্য  অনুমোদন পত্র বিলের সহিত গ্রথিত করিয়া দিতে হইবে।
                        ";
$str.= "</td>";
$str.= "</tr>";

$str.= "</table>";

$str_sign = "";

$str_sign.= "<div class='h'>";
$str_sign.= "<style scoped>

   .h{
      margin-top:-3%;
      padding-top: 0%;
      padding-left: 50%;
      width: 40%;
      margin-left:20%;
  }

  .sign{
      margin-top:-3%;
      padding-top: 0%;
      padding-left: 57%;
      width: 40%;
      height:1%;
      margin-left:20%;
  }

  .img{
    padding-left: 80%;
    height:10px;
  }


</style>";


$str_sign.= "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;আপনার বিশ্বস্ত

    $image1
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;পরীক্ষা নিয়ন্ত্রকের পক্ষে<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;পরীক্ষা উপ-নিয়ন্ত্রক
        <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ঢাকা বিশ্ববিদ্যালয়।
    <br>
    </p> 
      
    </div>";



$html = ob_get_contents();
ob_end_clean(); 
$mpdf->WriteHTML($str);
$mpdf->WriteHTML($str_sign);
//$mpdf->Output();
$mpdf->Output($pdf,'F');

$_SESSION['pdf'] =$memo;


$_SESSION['new']=$newDate ;
$_SESSION['teacher']=$teacher;
$_SESSION['d1']=$d1;
$_SESSION['dept']=$dept;
$_SESSION['dept_id']=$dept_id;

$_SESSION['year']=$year;
$_SESSION['xm']=$xm;
$_SESSION['yr']=$yr;
$_SESSION['r1']=$r1;
$_SESSION['r2']=$r2;
$_SESSION['cr']=$cr;
$_SESSION['deadline']=$deadline;
$_SESSION['type']='Script scrutinizer';








header("Location:iframe5.php");
exit;

?>





