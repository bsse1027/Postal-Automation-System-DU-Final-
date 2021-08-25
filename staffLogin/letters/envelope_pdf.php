<?php 
class BanglaConverter {
    public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    
    public static $en_month = array("জানুয়ারি", "ফেব্রুয়ারি", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর","নভেম্বর","ডিসেম্বর");
    
    public static function bn2en($number) {
        return str_replace(self::$bn, self::$en, $number);
    }
    
    public static function en2bn($number) {
        return str_replace(self::$en, self::$bn, $number);
    }



 }


                      
include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 
include('bnTime.php');
$time = time();
$Bdate = BDdate($time);
//echo'<pre>';print_r($_POST);exit;

$memo= $_POST['memo']; 

$dept_explode= explode("|", $_POST['dept']);
$dept= $dept_explode[1]; 
$teacher_name= $_POST['teacher_name']; 

$teacher_name_explode= explode("|", $_POST['teacher_name']);
$teacher_name= $teacher_name_explode[1]; 

$teacher_des= $_POST['teacher_des']; 
//$memo= 11122; 
$memo= BanglaConverter::en2bn( $memo);

$en_month = array("জানুয়ারি", "ফেব্রুয়ারি", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর","নভেম্বর","ডিসেম্বর");
$date= date("d-m-Y"); 

$date_explode = explode("-",$date);
$date_m = $en_month[($date_explode[1]-1)];

$data_d = BanglaConverter::en2bn($date_explode[0]);
$data_y = BanglaConverter::en2bn($date_explode[2]);

$date= $data_d. " " . $date_m ." " . $data_y;

//echo'<pre>';print_r($_POST);exit;


include BASE_URL."mpdf/mpdf.php";


$mpdf=new mPDF('','ENVELOPE',14,'nikosh'); 


$mpdf->AddPageByArray([
    'margin-left' => 0,
    'margin-right' => 0,
    'margin-top' => 0,
    'margin-bottom' => 0,
]);

$str = "";
$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='1%'>";
$str.= "</td>";
$str.= "<td width='75%'>";
$str.= "মেমো নং: ".$memo."/শা-৫/প.";
$str.= "</td>";

$str.= "<td width='5%'>";
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


$str.= '<style>
* {
  box-sizing: border-box;
}

/* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 30.33%;
  padding: 10px;
  height: 30px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>';

$str.= '<div class="row">
  <div class="column">

  </div>
    <div class="column">

  </div>
  <div class="column"  style="font-size: 25px;">';

$str.= $teacher_name;
$str.= "<br>";
$str.= $teacher_des;
$str.= "<br>";
$str.= $dept;
$str.= "<br>";
$str.= "ঢাকা বিশ্ববিদ্যালয়";
$str.= "<br>";
$str.= "ঢাকা - ১০০০|";

$str.= '</div>

</div>';



/*$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='70%'>";
$str.= "</td>";
$str.= "<td style='font-size: 20px;'>";
$str.= $teacher_name;
$str.= "</td>";
$str.= "</tr>";
$str.= "<tr>";
$str.= "<td>";
$str.= "</td>";
$str.= "<td style='font-size: 25px;'>";
$str.= $teacher_des;
$str.= "</td>";
$str.= "</tr>";
$str.= "<tr>";
$str.= "<td>";
$str.= "</td>";
$str.= "<td style='font-size: 25px;'>";
$str.= $dept;
$str.= "</td>";
$str.= "</tr>";
$str.= "<tr>";
$str.= "<td>";
$str.= "</td>";
$str.= "<td style='font-size: 25px;'>";
$str.= "ঢাকা বিশ্ববিদ্যালয়";
$str.= "</td>";
$str.= "</tr>";
$str.= "</table>";*/

$mpdf->writeHTML($str);

$path=BASE_URL.'Files/';

$mpdf->Output($path.$memo.'_committee.pdf','I');