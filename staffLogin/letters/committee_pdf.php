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
$time = time();
$Bdate = BDdate($time);
//echo'<pre>';print_r($_POST);exit;

//$memo= $_POST['memo']; 
//$memo= 11122; 
$memo= $_SESSION['memo'];
 
 
$memo= BanglaConverter::en2bn( $memo);

$_SESSION['memo'] = $memo;

$en_month = array("জানুয়ারি", "ফেব্রুয়ারি", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর","নভেম্বর","ডিসেম্বর");
$date= $_POST['date'];

$date_explode = explode("-",$date);
$date_m = $en_month[($date_explode[1]-1)];

$data_d = BanglaConverter::en2bn($date_explode[0]);
$data_y = BanglaConverter::en2bn($date_explode[2]);

$date= $data_d. " " . $date_m ." " . $data_y;

//echo'<pre>';print_r($_POST);exit;
$teacher_type= $_POST['teacher_type'];
//$teacher_type= $date_month;
$year_type= $_POST['year_type'];
$exam_type= $_POST['exam_type'];

if($exam_type =="পুনঃগঠনের"){
	$exam_type_show = "পুনঃগঠিত";
}
else{
	$exam_type_show = "";
}
$teacher_1_explode= explode("|", $_POST['teacher_1']);
$teacher_1= $teacher_1_explode[1];
$teacher_id[1]= $teacher_1_explode[0];

$teacher_2_explode= explode("|", $_POST['teacher_2']);
$teacher_2= $teacher_2_explode[1];
$teacher_id[2]= $teacher_2_explode[0];

$teacher_3_explode= explode("|", $_POST['teacher_3']);
$teacher_3= $teacher_3_explode[1];
$teacher_id[3]= $teacher_3_explode[0];


$teacher_4= $_POST['teacher_4'];


$teacher[1] = $teacher_1;
$teacher[2] = $teacher_2;
$teacher[3] = $teacher_3;
$teacher[4] = $teacher_4;


$_SESSION['teacher_name_1'] = $teacher_1;
$_SESSION['teacher_name_2'] = $teacher_2;
$_SESSION['teacher_name_3'] = $teacher_3;
$_SESSION['teacher_name_4'] = $teacher_4;

$teacher_des_1= $_POST['teacher_des_1'];
$teacher_des_2= $_POST['teacher_des_2'];
$teacher_des_3= $_POST['teacher_des_3'];



if($_POST['teacher_des_4']!=""){
	$teacher_des_4= $_POST['teacher_des_4'].",";
}
else{
	$teacher_des_4 = "";
}

$teacher_des_[1] = $teacher_des_1;
$teacher_des_[2] = $teacher_des_2;
$teacher_des_[3] = $teacher_des_3;
$teacher_des_[4] = $teacher_des_4;

$teacher_dept_4= $_POST['teacher_dept_4'];
$teacher_versity_4= $_POST['teacher_versity_4'];
/*$teacher_designation_4= $_POST['teacher_designation_4'];*/
if($teacher_type=="ডিন"){
	$dept_explode= explode("|", $_POST['faculty']);
	$dept = $dept_explode[1];
	$dept_1_explode= explode("|", $_POST['dept_1']);
	$dept_1= $dept_1_explode[1];

	$dept_2_explode= explode("|", $_POST['dept_2']);
	$dept_2= $dept_2_explode[1];

	$dept_3_explode= explode("|", $_POST['dept_3']);
	$dept_3= $dept_3_explode[1];

}
else{
	$dept_explode= explode("|", $_POST['dept']);
	$dept = $dept_explode[1];
	$dept_1 = $dept;
	$dept_2 = $dept;
	$dept_3 = $dept;
}



$_SESSION['teacher_email_1'] = $_POST['teacher_email_1'];
$_SESSION['teacher_email_2'] = $_POST['teacher_email_2'];
$_SESSION['teacher_email_3'] = $_POST['teacher_email_3'];
$_SESSION['teacher_email_4'] = $_POST['teacher_email_4'];

$teacher_id[4]= $_POST['teacher_email_4'];


$_SESSION['teacher_mob_1'] = $_POST['teacher_mob_1'];
$_SESSION['teacher_mob_2'] = $_POST['teacher_mob_2'];
$_SESSION['teacher_mob_3'] = $_POST['teacher_mob_3'];
$_SESSION['teacher_mob_4'] = $_POST['teacher_mob_4'];

$start_date= $_POST['start_date'];
$paper_no= $_POST['paper_no'];




if($paper_no!=""){
	$paper_no_show = "নং";
}
else{
	$paper_no_show = "";
}

$subject= $_POST['subject'];
$year= $_POST['year'];
$year= BanglaConverter::en2bn( $year);

$batch= $_POST['batch'];
$sem= $_POST['sem'];

if($sem!=""){
	$sem_show="সেমিস্টার";
}

else{
	$sem_show="";
}

if($batch!=""){
	$batch_show="ব্যাচ";
}

else{
	$batch_show="";
}

$years= $_POST['years'];

if($years!=""){
	$years_show="বর্ষ";
}

else{
	$years_show="";
}


$_SESSION['dept_teacher_mob'] = $_POST['chairman_mob'];
$_SESSION['dept_teacher_name']=$dept;

$query ="SELECT * FROM dept_table WHERE  dept_name = '$dept'";
$result=mysqli_query($link,$query);


	{
		while($row=mysqli_fetch_array($result)) { 
			//echo $row['memo'];
			$chairman_email = $row['email'];
		}

	}

$_SESSION['dept_email'] = $chairman_email;

$exam= $_POST['exam'];

$image= $_POST['image'];
 
 
if($image==1)
   	$image1="<img src='".SERVER_URL."resources/img/sign.jpg' width=100 height=50 style='padding-left:40%;'>";

else
	$image1="<img src='".SERVER_URL."resources/img/white.jpg' width=100 height=20 style='padding-left:-10%;'>";





$str = "";


$str.= "<div class='h'>";
$str.= "<style scoped>

   .h{
	    margin-top:-3%;
	    padding-top: 0%;
	    padding-left: 58%;
	    width: 40%;
	    margin-left:20%;
	}

	.sign{
	    
	    padding-top: 0%;
	    padding-left: 57%;
	    width: 40%;
	    height:4%;
	    margin-left:20%;
	}

	.img{
		padding-left: 80%;
		height:10px;
	}


</style>";
$str.= "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;আপনার বিশ্বস্ত
	<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;স্বা/-
	<br>
	পরীক্ষা নিয়ন্ত্রকের পক্ষে
	<br>
	&nbsp;&nbsp;পরীক্ষা উপ-নিয়ন্ত্রক
	<br>
	&nbsp;&nbsp;ঢাকা বিশ্ববিদ্যালয়।

	</p> 
	</div>";

$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='5%'>";
$str.= "</td>";
$str.= "<td>";
$str.= "অবগতি ও প্রয়োজনীয় ব্যবস্থা গ্রহণের অনুরোধসহ অনুলিপি প্রেরিত হইলঃ";
$str.= "<br>";
$str.= "১। $teacher_1, $teacher_des_1, $dept_1, ঢাঃ বিঃ।";
$str.= "<br>";
$str.= "২। উপ-রেজিস্ট্রার (কাউন্সিল), ঢাকা বিশ্ববিদ্যালয়।";
$str.= "</td>";
$str.= "</tr>";
$str.= "</table>";

$str_footer = $str;

$str="";


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

$str.= "<hr>";

$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='1%'>";
$str.= "</td>";
$str.= "<td width='70%'>";
$str.= "মেমো নং: ".$memo."/শা-৫/প.";
$str.= "</td>";

$str.= "<td width='10%'>";
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
$str.= "<td width='1%'>";
$str.= "</td>";
$str.= "<td>";
$str.= $teacher_type;
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
$str.= "</td>";
$str.= "<td>";
$str.= "মহোদয়,";
$str.= "</td>";
$str.= "</tr>";
$str.= "</table>";

$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='1%'>";
$str.= "</td>";
$str.= "<td style='text-align: justify; text-justify: inter-word;'>";
$str.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;আপনার $start_date তারিখের $paper_no $paper_no_show পত্রের বরাতে আপনাকে জানাইতেছি যে, $dept $year $year_type $exam $batch $batch_show $years $years_show $sem $sem_show পরীক্ষার পরীক্ষা কমিটি নিম্নলিখিতভাবে $exam_type জন্য বিভাগীয় একাডেমিক কমিটির সভায় সুপারিশ অনুমোদিত হইয়াছে <span style='font-size: 10px;'>|</span>";
$str.= "</td>";
$str.= "</tr>";

$str.= "</table>";




$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='15%'>";
$str.= "</td>";
$str.= "<td>";
$str.= "<u>$year $year_type $exam $batch $batch_show $years $years_show $sem $sem_show পরীক্ষার $exam_type_show পরীক্ষা কমিটি</u>";
$str.= "</td>";
$str.= "</tr>";
$str.= "</table>";




$str.= "<table>";
$str.= "<tr>";

$str.= "<td>১।";
$str.= "</td>";
$str.= "<td>$teacher_1, $teacher_des_1, $dept_1, ঢাঃ বিঃ";
$str.= "</td width='1%'>";
$str.= "<td>-";
$str.= "</td>";
$str.= "<td>সভাপতি";
$str.= "</td>";
$str.= "</tr>";
$str.= "<tr>";

$str.= "<td>২।";
$str.= "</td>";
$str.= "<td>$teacher_2, $teacher_des_2, $dept_2, ঢাঃ বিঃ";
$str.= "</td>";
$str.= "<td>-";
$str.= "</td>";
$str.= "<td>সদস্য";
$str.= "</td>";
$str.= "</tr>";
$str.= "<tr>";

$str.= "<td>৩।";
$str.= "</td>";
$str.= "<td>$teacher_3, $teacher_des_3, $dept_3, ঢাঃ বিঃ";
$str.= "</td>";
$str.= "<td>-";
$str.= "</td>";
$str.= "<td>সদস্য";
$str.= "</td>";
$str.= "</tr>";
$str.= "<tr>";

$str.= "<td>৪।";
$str.= "</td>";
$str.= "<td style='font-size: 16px;' >$teacher_4, $teacher_des_4 $teacher_dept_4, $teacher_versity_4";
$str.= "</td>";
$str.= "<td>-";
$str.= "</td>";
$str.= "<td>";
$str.= "বহিঃসদস্য";
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



$str_main = $str;



for($i=1;$i<=4;$i++){

	$mpdf = new \Mpdf\Mpdf(['format' => 'A4','default_font_size' => 14,'default_font' => 'nikosh']);
	ob_start();
	$mpdf->SetAuthor("Sharmista Kuri");
	$mpdf->SetTitle("committee.pdf");
	//$t = "teacher_".$i;

	$str = "";

	$str.= "<table>";
	$str.= "<tr>";
	$str.= "<td width='5%'>";
	$str.= "</td>";
	$str.= "<td width='17%'>";
	$str.= "<strong>গোপনীয়</strong>
	           <br>";
	$str.= "</td>";
	$str.= "<td align='center' width='56%'>";
	$str.= '<img src="'.SERVER_URL.'resources/img/DhakaUniversity.jpg" width="80" height="100">';
	$str.= "</td>";

	$str.= "<td align='center'>";
	$str.= "পরীক্ষা নিয়ন্ত্রকের অফিস<br>
	            ঢাকা বিশ্ববিদ্যালয়<br>
	            ঢাকা - ১০০০।";
	$str.= "</td>";

	$str.= "</tr>";

	$str.= "<tr>";
	$str.= "<td>";
	$str.= "</td>";
	$str.= "<td>";
	$str.= "</td>";
	$str.= "<td align='center' style='font-size: 30px;'><strong>ঢাকা বিশ্ববিদ্যালয়</strong>";
	$str.= "</td>";
	$str.= "<td>";
	$str.= "</td>";
	$str.= "</tr>";

	$str.= "</table>";


	$str.= "<table>";
	$str.= "<tr>";
	$str.= "<td width='1%'>";
	$str.= "</td>";
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
	$str.= "<td width='1%'>";
	$str.= "</td>";
	$str.= "<td>";
	$str.= $teacher[$i];
	$str.= "<br>";
	$str.= $teacher_des_[$i];
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
	$str.= "</td>";
	$str.= "<td>";
	$str.= "মহোদয়,";
	$str.= "</td>";
	$str.= "</tr>";
	$str.= "</table>";

	$str.= "<table>";
	$str.= "<tr>";
	$str.= "<td width='1%'>";
	$str.= "</td>";
	$str.= "<td style='text-align: justify; text-justify: inter-word;'>";


	$str.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;আপনাকে জানাইতেছি যে, বিষয়ে $year $year_type $exam পরীক্ষা কমিটির আপনি একজন অভ্যন্তরীণ/বহিরাগত সদস্য নিযুক্ত হইয়াছেন। উক্ত পরীক্ষা কমিটির সভা অনুষ্ঠানের সঠিক তারিখ আপনাকে যথাসময়ে জানান হইবে। <br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;আপনাকে উক্ত কার্য সম্পাদন উপলক্ষ্যে কার্যক্ষেত্রে গমনাগমন ও থাকার জন্য ভ্রমন ভাতা ও দৈনিক ভাতা বিশ্ববিদ্যালয় আইনানুযায়ী প্রদান করা হইবে। <br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;আপনার কোন নিকট আত্মীয় যেমনঃ (১) ভাই (২) বোন (৩) স্ত্রী/স্বামীর (ক) ভাই (খ) বোন (৪) ছেলে (৫) মেয়ে (৬) ভ্রাতৃবধু (৭) ভগ্নীপতি (৮) স্ত্রী (৯) স্বামী (১০) ভাই ও বোনের সন্তান (১১) পুত্রবধু (১২) জামাতা (১৩) আপন চাচা-চাচী (১৪) আপন মামা-মামী (১৫) আপন ফুফা-ফুফু এবং (১৬) আপন খালা-খালু এই পরীক্ষায় যদি পরীক্ষার্থী থাকে, তবে তাহা নিয়োগপত্র গ্রহণের পূর্বে অত্র অফিসে জানাইতে হইবে। <br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;আপনি যদি শিক্ষা প্রতিষ্ঠান/বিভাগ ছাড়া অন্য কোন সরকারী দপ্তরের কর্মচারী হন, তবে আপনাকে এই কাজের পারিশ্রমিক গ্রহণের জন্য সরকারী অনুমোদনপত্র বিলের সহিত গ্রথিত করিয়া দিতে হইবে। সরকারী কর্মচারীদের নিযুক্তি গহণের পূর্বে অবশ্যই কর্তৃপক্ষের অনুমতি নিতে হইবে।	<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;উক্ত নিযুক্তির বিষয়ে আপনার সম্মতি যথাশীঘ্র জানাইবার জন্য অনুরোধ করিতেছি।";
	$str.= "</td>";
	$str.= "</tr>";

	$str.= "</table>";

	$str.= "<br>";

	if($i==1){
		$mpdf->writeHTML($str_main);
		$mpdf->writeHTML($str_footer);
		$mpdf->writeHTML($str_sign);


		$mpdf->WriteHTML('<pagebreak />');
	}


	$mpdf->writeHTML($str);
	$mpdf->writeHTML($str_sign);


	$teacher_ids = $teacher_id[$i];

	$_SESSION['teacher_id_'.$i] = $teacher_ids;

	$path=BASE_URL.'Files/';

	$mpdf->Output($path.$memo."_".$teacher_ids.'_committee.pdf','F');

	$str = "";

}

	
$mpdf = new \Mpdf\Mpdf(['format' => 'A4','default_font_size' => 14,'default_font' => 'nikosh']);
ob_start();
$mpdf->SetAuthor("Shamma");
$mpdf->SetTitle("committee.pdf");

$mpdf->writeHTML($str_main);
$mpdf->writeHTML("<br>");
$mpdf->writeHTML("<br>");
$mpdf->writeHTML("<br>");
$mpdf->writeHTML($str_sign);

$path=BASE_URL.'Files/';

$mpdf->Output($path.$memo."_".'_chairman_committee.pdf','F');


header("Location:committee_pdf_show.php");