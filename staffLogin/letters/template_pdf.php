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

                      
include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 
include('bnTime.php');
require_once BASE_URL . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(['format' => 'A4','default_font_size' => 14,'default_font' => 'nikosh']);
ob_start();
$mpdf->SetAuthor("Sharmista Kuri");
$mpdf->SetTitle("template.pdf");

$time = time();
$Bdate = BDdate($time);
//echo'<pre>';print_r($_POST);exit;
$memo= $_SESSION['memo'];
$teacher_explode= explode("|", $_POST['teacher']); 
$teacher= $teacher_explode[1];

$dept_explode= explode("|", $_POST['dept']);
$dept= $dept_explode[1];

$teacher_des= $_POST['teacher_des']; 
$teacher_email= $_POST['teacher_email']; 
$teacher_mob= $_POST['teacher_mob']; 
//$memo= 11122; 
$memo= BanglaConverter::en2bn( $memo);



$en_month = array("জানুয়ারি", "ফেব্রুয়ারি", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর","নভেম্বর","ডিসেম্বর");
$dated= $_POST['date'];

$date_explode = explode("-",$dated);
$date_m = $en_month[($date_explode[1]-1)];

$data_d = BanglaConverter::en2bn($date_explode[0]);
$data_y = BanglaConverter::en2bn($date_explode[2]);

$date= $data_d. " " . $date_m ." " . $data_y;


    //$x=$_SERVER['DOCUMENT_ROOT'].'\Files\\';
    $x=$_SERVER['DOCUMENT_ROOT'].'/spl/Files/';
   
    $y='.pdf'; 
    $pdf=$x.$memo.$y; 


$image= $_POST['image'];
 
 
if($image==1)
   	$image1="<img src='".SERVER_URL."resources/img/sign.jpg' width=100 height=50 style='padding-left:40%;'>";

else
	$image1="<img src='".SERVER_URL."resources/img/white.jpg' width=100 height=20 style='padding-left:-10%;'>";

//echo'<pre>';print_r($_POST);exit;

$template = $_POST['template'];


$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='5%'>";
$str.= "</td>";
$str.= "<td width='35%'>";
$str.= "<strong>পরীক্ষা নিয়ন্ত্রকের অফিস</strong><br>
            <strong>ঢাকা বিশ্ববিদ্যালয়</strong><br>
            ফোনঃ(অফিস)৮৬১৩২৮০<br>
            ৯৬৬১৯০০-৫৯/৪০৮০<br>
            ফ্যাক্সঃ৮৮০-২-৯৬৬৭২২২<br>";
$str.= "</td>";
$str.= "<td width='25%'>";
$str.= '<img src="'.SERVER_URL.'resources/img/DhakaUniversity.jpg" width="80" height="100">';
$str.= "</td>";

$str.= '<td style="font-size: 14px;" >';
$str.= "<strong>OFFICE OF THE CONTROLLER OF EXAMINATIONS</strong><br>
            UNIVERSITY OF DHAKA<br>
            DHAKA-1000, BANGLADESH<br>
            Phone : (off.) 8613280<br>
            9661900-59/4080<br>
            Fax : 88-02-9667222<br>
            Email: co_letter@du.ac.bd";
$str.= "</td>";

$str.= "</tr>";
$str.= "</table>";

$str.= "<br>";


$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='72%'>";
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


$str.= "<br>";

$str.= "<table>";
$str.= "<tr>";

$str.= "<td>";
$str.= $teacher;
$str.= "<br>";
$str.=$teacher_des;
$str.= "<br>";
$str.= $dept;
$str.= "<br>";
$str.= "ঢাকা বিশ্ববিদ্যালয়";
$str.= "<br>";
$str.= "ঢাকা - ১০০০ <span style='font-size: 10px;'>|</span>";
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
$str.= "মহোদয়,";
$str.= "</td>";
$str.= "</tr>";
$str.= "</table>";


$str.= $template;

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


$mpdf->writeHTML($str);
$mpdf->writeHTML($str_sign);




$path=BASE_URL.'Files/';


$mpdf->Output($pdf,'F');

$_SESSION['pdf'] =$memo;
$_SESSION[ '$dated']=$dated;
$_SESSION[ 'teacher']=$teacher;
$_SESSION[ 'dept']=$dept;
$_SESSION['teacher_des']=$teacher_des; 
$_SESSION['teacher_email']=$teacher_email; 
$_SESSION['teacher_mob']=$teacher_mob; 


header("Location:template_pdf_show.php");