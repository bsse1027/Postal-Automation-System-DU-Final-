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

                      $date1= $data_d. " " . $date_m ." " . $data_y;

                      $Bdate = BDdate($time);



                      $deadline=date("Y-m-d", strtotime($_POST["deadline"]));
                      $deadline1=BanglaConverter::en2bn($deadline);




                     
                      $year =BanglaConverter::en2bn($_POST["year"]);
                              $result = $_POST["department"];
                              $result_explode = explode('|', $result);

                              $dept_id= $result_explode[0];
                              $dept= $result_explode[1];
                              $teacher=$_POST["teacher"];

                            

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
                
                              
                            
                              
                              //$result = $_POST["subject"];
                              //$result_explode = explode('|', $result);

                              $r1= $_POST["subject"];
                              //$r1= $result_explode[1];
                              $r2=$_POST["course"];
                                



                           
                             $xm=$_POST["hj"];


                             


                           /*
                            
                            $result11 = $_POST["subject"];
                            $result_explode11 = explode('|', $result);
                            $query11="

                            SELECT chairman FROM subject
                            WHERE ID='$result_explode11[0]'


                            ";
                            $result111=mysqli_query($link,$query11);
                            $row=mysqli_fetch_array($result111);

                            */
                            $ch= $_POST["chairman"];
                            //$ch= $row[0];
                           // $ch="shamma";

                           



                            //$x=$_SERVER['DOCUMENT_ROOT'].'\Files\\';
                            $x=$_SERVER['DOCUMENT_ROOT'].'/spl/Files/';
                               
                            $y='.pdf'; 
                            $pdf=$x.$memo.$y; 


                            $image= $_POST['image'];


if($image==1)
   $image1="<img src='".SERVER_URL."resources/img/sign.jpg' width=\"200\" height=\"50\" style=\"padding-left:-10%;\">";

else
$image1="<img src='".SERVER_URL."resources/img/white.jpg' width=\"200\" height=\"50\" style=\"padding-left:-10%;\">";
    



echo "Letter fields:<br>";

echo $memo;
echo $date;

echo $teacher;
echo $dept;
echo $d1;
echo $year;
echo $r1;
echo $r2;
echo $xm;
echo $ch;
echo $pdf;
echo $image;
echo $deadline;


?>



<?php
include BASE_URL."mpdf/mpdf.php";
$mpdf=new mPDF('','A4',14,'nikosh'); 
ob_start();

$mpdf->AddPageByArray([
    'margin-top' => 0,
    'margin-bottom' => 0,
]);

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
$str.= "<u>".$date1."</u>";
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
$str.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; আপনাকে জানাইতেছি যে, $year সনের $xm    পরীক্ষার $r1 বিষয়ে কোর্স/পত্র নং $r2 
  এর বাংলা ও ইংরেজি উভয় ভাষার প্রশ্নপত্র প্রণয়ন করার জন্য আপনাকে যুগ্ম প্রশ্নপত্র প্রণেতা ও পরীক্ষক নিয়োগ করা হইয়াছে।

  <br>
  <br>
    <strong>বিশেষ নির্দেশনাবলীঃ</strong>

    <br>
  
    উল্লেখিত প্রশ্নপত্র প্রণয়ন প্রসঙ্গে আনুসাঙ্গিক তথ্যাবলী সম্বলিত নিম্নলিখিত কাগজপত্র এতদসঙ্গে গ্রথিত হইলঃ(১)প্রশ্নপত্র প্রণেতাদের 
  প্রতি নির্দেশনাবলী (২) নির্ধারিত পাঠ্যসূচী (৩) সংশ্লিষ্ট পত্রের পূর্ববর্তী  বৎসরের প্রশ্নপত্র (৪) প্রশ্নপত্র প্রণয়নের জন্য রেখাঙ্কিত কাগজ (৫) ঠিকানা
  যুক্ত ছোট বড় প্রয়োজনীয় খাম।

    <br>
 
    প্রনীত প্রশ্নপত্র গ্রথিত খামে সিলমোহর পূর্বক  বীমাকৃত ডাকে অথবা ব্যক্তিগতভাবে $deadline1 ইং তারিখের মধ্যে ঢাকা বিশ্ববিদ্যালয়ের
      সংশ্লিষ্ট বিষয়ের  পরীক্ষা কমিটির চেয়ারম্যান প্রফেসর/ড/জনাব$ch এর নিকট জমা দেয়ার জন্য আপনাকে সবিনয় অনুরোধ করিতেছি।সরবরাহকৃত ছোট খামের শূন্যস্থানগুলি যথাযথভাবে পূরন করা প্রয়োজনীয়।
    <br>


      আপনার প্রণীত  প্রশ্নপত্র নির্ধারিত তারিখের মধ্যে পাওয়া না গেলে বিশ্ববিদ্যালয় করতিপক্ষ বিকল্প ব্যবস্থা গ্রহণ করিতে বাধ্য হইবে।
নিযুক্তিপত্র গ্রহণে অপারগ হইলে অবশ্যই ইহার কারণ জানাইয়া সঙ্গে এতদসংলগ্ন কাগজপত্রাদিও ফেরত পাঠানোর জন্য আপনাকে অনুরোধ 
করতেছি।

    <br>


প্রণয়নকৃত প্রশ্নপত্রের পান্ডুলিপি পরিষ্কার পরিচ্ছন্ন ও সুস্পষ্ট  হওয়া  একান্ত বাঞ্ছনীয়। কোন ছক বা অন্য কোন তথ্যাদি প্রশ্নপত্রের সঙ্গে 
সরবরাহ করার প্রয়োজন হইলে তাহা পৃথকভাবে সংশ্লিষ্ট  চেয়ারম্যানকে সঠিক নির্দেশিকা প্রদান করিতে অনুরোধ করিতেছি।

    <br>


আপনার কোনো নিকট আত্মীয় যেমনঃ (১) ভাই  (২) বোন  (৩) স্ত্রী/স্বামীর  (ক) ভাই/বোন  (৪) ছেলে  (৫) মেয়ে  (৬) ভ্রাতৃবধূ  (৭) ভগ্নিপতি 
(৮) স্ত্রী (৯) স্বামী (১০) ভাই ও বোনের সন্তানের (১১) পুত্রবধূ  (১২) জামাতা  (১৩) আপন চাচা-চাচী  (১৪) আপন মামা-মামী  (১৫) আপন ফুফা-ফুফু
এবং (১৬) আপন খালা-খালু এই পরীক্ষায় যদি পরীক্ষার্থীর/পরীক্ষার্থিনী থাকে ,তবে তাহা নিয়োগপত্র গ্রহণের পূর্বে  অত্র অফিসে জানানোর জন্য
অনুরোধ করতেছি।

    <br>



আপনি যদি শিক্ষা প্রতিষ্ঠান/বিভাগ ছাড়া অন্য কোন সরকারী দপ্তরের কর্মকর্তা হন,তবে আপনাকে এই কাজের পারিশ্রমিক গ্রহণের
জন্য সরকারী অনুমোদন পত্র বিলের সহিত গ্রথিত করিয়া দিতে হইবে।সরকারী কর্মচারীদের নিযুক্ত
গ্রহণের পূর্বে  অবশ্যই কর্তৃপক্ষের অনুমতি নিতে হইবে।

    <br>
    <br>

উক্ত বিষয়ে আপনার সম্মতি যথাশীঘ্র জানাইবার জন্য অনুরোধ করিতেছি।
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

//$mpdf->WriteHTML('<pagebreak />');
//$mpdf->Output();
//$mpdf->Output($pdf,'F');

$_SESSION['pdf'] =$memo;
$_SESSION['new']=$newDate ;
$_SESSION['teacher']=$teacher;
$_SESSION['d1']=$d1;
$_SESSION['dept_id']=$dept_id;
$_SESSION['dept']=$dept;
$_SESSION['year']=$year;
$_SESSION['xm']=$xm;
$_SESSION['r1']=$r1;
$_SESSION['r2']=$r2;
$_SESSION['ch']=$ch;
$_SESSION['deadline']=$deadline;
$_SESSION['type']='Question Setter & Script Scrutinizer';

$flag = 0; $NewFileNameEnq =""; $NewFileNameUt="";
$UploadDirectory = $_SERVER['DOCUMENT_ROOT'] ."/spl/syllabus_file/";


if(!empty($_FILES) && $_FILES['syllabus_file']['name'] !="" && $_FILES['syllabus_file']['tmp_name']!="")
{
    $File_Ext = substr($_FILES['syllabus_file']['name'], strrpos($_FILES['syllabus_file']['name'], '.')); //get file extention
    $NewFileNameEnq = "syllabus_file_".$memo."_".$teacher."_".time().$File_Ext; //new file name

    if(move_uploaded_file($_FILES['syllabus_file']['tmp_name'], $UploadDirectory.$NewFileNameEnq))
    {
        $flag = 0;
        $_SESSION['syllabus_file'] = $NewFileNameEnq; 
    }
    else{ $flag++; }
}


$pdf_url1 = $_SERVER['DOCUMENT_ROOT'].'/spl/syllabus_file/'.$NewFileNameEnq;

$pagecount = $mpdf->SetSourceFile($pdf_url1);

$mpdf->SetImportUse();



$x = 65;


for ($i = 1; $i <= $pagecount; $i++) {
    $tplId = $mpdf->ImportPage($i); // in mPdf v8 should be 'importPage($i)'
    $mpdf->UseTemplate($tplId, $x);
    //if ($i != $pagecount) {
        $mpdf->WriteHTML('<pagebreak />');
    //}
}


$x = 0;
$y = 0;
$w = 00;
$h = 00;


$pdf_url1 = $_SERVER['DOCUMENT_ROOT'].'/spl/letter_2/Instruction.pdf';

$pagecount = $mpdf->SetSourceFile($pdf_url1);

$mpdf->SetImportUse();

$tplId = $mpdf->ImportPage(1);

$mpdf->UseTemplate($tplId, $x, $y, $w, $h);

$mpdf->WriteHTML('<pagebreak />');



$pdf_url1 = $_SERVER['DOCUMENT_ROOT'].'/spl/letter_2/bill forom final.pdf';

$pagecount = $mpdf->SetSourceFile($pdf_url1);

$mpdf->SetImportUse();

$tplId = $mpdf->ImportPage(1);

$mpdf->UseTemplate($tplId, $x, $y, $w, $h);

$mpdf->WriteHTML('<pagebreak />');



$pdf_url1 = $_SERVER['DOCUMENT_ROOT'].'/spl/letter_2/Number form.pdf';

$pagecount = $mpdf->SetSourceFile($pdf_url1);

$mpdf->SetImportUse();

$tplId = $mpdf->ImportPage(1);

$mpdf->UseTemplate($tplId, $x, $y, $w, $h);

$mpdf->WriteHTML('<pagebreak />');



$pdf_url1 = $_SERVER['DOCUMENT_ROOT'].'/spl/letter_2/Number form1.pdf';

$pagecount = $mpdf->SetSourceFile($pdf_url1);

$mpdf->SetImportUse();

$tplId = $mpdf->ImportPage(1);

$mpdf->UseTemplate($tplId, $x, $y, $w, $h);

$mpdf->WriteHTML('<pagebreak />');



$pdf_url1 = $_SERVER['DOCUMENT_ROOT'].'/spl/letter_2/Number form1.pdf';

$pagecount = $mpdf->SetSourceFile($pdf_url1);

$mpdf->SetImportUse();

$tplId = $mpdf->ImportPage(1);

$mpdf->UseTemplate($tplId, $x, $y, $w, $h);

//$mpdf->WriteHTML('<pagebreak />');




//$tplId = $mpdf->ImportPage(1);

//$mpdf->UseTemplate($tplId);

$mpdf->Output($pdf,'F');


header("Location:iframe1.php");
exit;

?>







