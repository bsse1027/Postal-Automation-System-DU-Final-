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


                      
include("dbconnect.php");

//echo'<pre>';print_r($_POST);exit;

$memo= $_POST['memo']; 
$memo= BanglaConverter::en2bn( $memo);

$date= $_POST['date'];
$date= BanglaConverter::en2bn($date);


$teacher= $_POST['teacher'];
$teacher_2= $_POST['teacher_2'];
$teacher_3= $_POST['teacher_3'];
$teacher_4= $_POST['teacher_4'];
$teacher_dept_4= $_POST['teacher_dept_4'];
$teacher_versity_4= $_POST['teacher_versity_4'];
$teacher_designation_4= $_POST['teacher_designation_4'];
$dept_explode= explode("|", $_POST['dept']);
$dept = $dept_explode[1];
$year= $_POST['year'];
$year= BanglaConverter::en2bn( $year);

$batch= $_POST['batch'];
$method= $_POST['method'];
$years= $_POST['years'];
$exam= $_POST['exam'];

$image= $_POST['image'];
 
 
if($image==1)
   	$image1="<img src=\"signature.jpg\" width=\"200\" height=\"40\" style=\"padding-left:70%;\">";

else
	$image1="<img src=\"white.jpg\" width=\"200\" height=\"20\" style=\"padding-left:-10%;\">";

include("mpdf.php");
$mpdf=new mPDF('','A4',14,'nikosh'); 
ob_start();

$str = "";

$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='5%'>";
$str.= "</td>";
$str.= "<td width='35%'>";
$str.= "<strong>পরীক্ষা নিয়ন্ত্রকের অফিস</strong><br>
            <strong>ঢাকা বিশ্ববিদ্যালয়</strong><br>
            ফোনঃ(অফিস)৮৬১৩২৮০<br>
            ৯৬৬১৯০০-৫৯/৪০৭৫<br>
            ফ্যাক্সঃ৮৮০-২-৯৬৬৭২২২<br>";
$str.= "</td>";
$str.= "<td width='25%'>";
$str.= '<img src="DhakaUniversity.jpg" width="80" height="100">';
$str.= "</td>";

$str.= '<td style="font-size: 14px;" >';
$str.= "<strong>OFFICE OF THE CONTROLLER OF EXAMINATIONS</strong><br>
            UNIVERSITY OF DHAKA<br>
            DHAKA-1000, BANGLADESH<br>
            Phone : (off.) 8613280<br>
            9661900-59/4080<br>
            Fax : 88-02-9667222<br>
            Email: examcontroller@du.ac.bd";
$str.= "</td>";

$str.= "</tr>";
$str.= "</table>";

$str.= "<hr>";

$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='6%'>";
$str.= "</td>";
$str.= "<td width='50%'>";
$str.= "মেমো নং: ".$memo;
$str.= "</td>";

$str.= "<td width='15%'>";
$str.= "তারিখঃ ".$date;
$str.= "</td>";

$str.= "</tr>";
$str.= "</table>";

$str.= "<br>";
$str.= "<br>";

$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='20%'>";
$str.= "</td>";
$str.= "<td>";
$str.= $teacher;
$str.= "</td>";
$str.= "</tr>";
$str.= "<tr>";
$str.= "<td>";
$str.= "</td>";
$str.= "<td>";
$str.= $dept;
$str.= "</td>";
$str.= "</tr>";
$str.= "<tr>";
$str.= "<td>";
$str.= "</td>";
$str.= "<td>";
$str.= "ঢাকা বিশ্ববিদ্যালয়";
$str.= "</td>";
$str.= "</tr>";
$str.= "<tr>";
$str.= "<td>";
$str.= "</td>";
$str.= "<td>";
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
$str.= "<td width='8%'>";
$str.= "</td>";
$str.= "<td style='text-align: justify; text-justify: inter-word;'>";
$str.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;আপনাকে জানাইতেছি যে, আপনি $dept $year সনের $method $batch ব্যাচ, $years বর্ষ $exam পরীক্ষা কমিটির সভাপতি নিযুক্ত হইয়াছেন <span style='font-size: 10px;'>|</span> উক্ত পরীক্ষা কমিটি নিন্মলিখিত ভাবে গঠিত হইয়াছে <span style='font-size: 10px;'>|</span>";
$str.= "</td>";
$str.= "</tr>";

$str.= "</table>";

$str.= "<br>";
$str.= "<br>";

$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='25%'>";
$str.= "</td>";
$str.= "<td>";
$str.= "<u>$batch ব্যাচ, $years বর্ষ $exam পরীক্ষা কমিটি-$year ($method)</u>";
$str.= "</td>";
$str.= "</tr>";
$str.= "</table>";


$str.= "<br>";

$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='10%'>";
$str.= "</td>";
$str.= "<td>১।";
$str.= "</td width='65%'>";
$str.= "<td>$teacher, $dept, ঢঃ বিঃ";
$str.= "</td width='5%'>";
$str.= "<td>-----------------------";
$str.= "</td>";
$str.= "<td>সভাপতি";
$str.= "</td>";
$str.= "</tr>";
$str.= "<tr>";
$str.= "<td width='10%'>";
$str.= "</td>";
$str.= "<td>২।";
$str.= "</td width='65%'>";
$str.= "<td>$teacher_2, $dept, ঢঃ বিঃ";
$str.= "</td width='5%'>";
$str.= "<td>-----------------------";
$str.= "</td>";
$str.= "<td>সদস্য";
$str.= "</td>";
$str.= "</tr>";
$str.= "<tr>";
$str.= "<td width='10%'>";
$str.= "</td>";
$str.= "<td>৩।";
$str.= "</td width='65%'>";
$str.= "<td>$teacher_3, $dept, ঢঃ বিঃ";
$str.= "</td width='5%'>";
$str.= "<td>-----------------------";
$str.= "</td>";
$str.= "<td>সদস্য";
$str.= "</td>";
$str.= "</tr>";
$str.= "<tr>";
$str.= "<td width='10%'>";
$str.= "</td>";
$str.= "<td>৪।";
$str.= "</td width='65%'>";
$str.= "<td>$teacher_4, $dept, ঢঃ বিঃ";
$str.= "</td width='5%'>";
$str.= "<td>-----------------------";
$str.= "</td>";
$str.= "<td>";
$str.= $teacher_designation_4;
$str.= "</td>";
$str.= "</tr>";
$str.= "</table>";


$str.= "<br>";
$str.= "<br>";

$str.= "<div class='h'>";
$str.= "<style scoped>

   .h{
	    margin-top:-3%;
	    padding-top: 0%;
	    padding-left: 60%;
	    width: 40%;
	    margin-left:20%;
	}

	.sign{
	    margin-top:-3%;
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
$str.= "<p>আপনার বিশ্বস্ত</p> 
			
		</div>
		$image1

		
		
		<div class='sign'> 
		<p>
			পরীক্ষা নিয়ন্ত্রকের পক্ষে<br>
		    &nbsp;&nbsp;পরীক্ষা উপ-নিয়ন্ত্রক<br>
		    &nbsp;&nbsp;ঢাকা বিশ্ববিদ্যালয়।<br>
     	</p>";
$str.= "</div>";



$mpdf->SetAuthor("Sharmista Kuri");
$mpdf->SetTitle("committee.pdf");
$mpdf->AddPage('P', 'A4');
$mpdf->writeHTML($str);
$mpdf->WriteHTML('<pagebreak />');

$str.="<br>";



$str.= "<table>";
$str.= "<tr>";
$str.= "<td width='5%'>";
$str.= "</td>";
$str.= "<td>";
$str.= "অবগতি ও প্রয়োজনীয় ব্যবস্থা গ্রহণের অনুরোধসহ অনুলিপি প্রেরিত হইলঃ";
$str.= "</td>";
$str.= "</tr>";
$str.= "</table>";


$mpdf->writeHTML($str);
$mpdf->Output('Committee','I');