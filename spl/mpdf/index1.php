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
 session_start();
 $memo= $_SESSION['memo'];
 
 
                      $memo1= BanglaConverter::en2bn( $memo);

                      $date= $_SESSION['date'];
                      $new= BanglaConverter::en2bn($date);



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


                             



                            
                            $result11 = $_POST["subject"];
                            $result_explode11 = explode('|', $result);
                            $query11="

                            SELECT chairman FROM subject
                            WHERE ID='$result_explode11[0]'


                            ";
                            $result111=mysqli_query($link,$query11);
                            $row=mysqli_fetch_array($result111);


                            $ch= $_POST["chairman"];
                            //$ch= $row[0];
                           // $ch="shamma";

                           



                            //$x=$_SERVER['DOCUMENT_ROOT'].'\Files\\';
                            $x=$_SERVER['DOCUMENT_ROOT'].'/Files/';
                               
                            $y='.pdf'; 
                            $pdf=$x.$memo1.$y; 


                            $image= $_POST['image'];


if($image==1)
   $image1="<img src=\"signature.jpg\" width=\"200\" height=\"50\" style=\"padding-left:-10%;\">";

else
$image1="<img src=\"white.jpg\" width=\"200\" height=\"50\" style=\"padding-left:-10%;\">";
    





echo $memo;
echo $memo1;
echo $new;

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
include("mpdf.php");
$mpdf=new mPDF('','A3',12,'nikosh'); 
ob_start();

echo "
<html>

<div class=\"container\">
<style scoped>
     .container{ display: flex;
        justify-content: center;
     
        font-size: 18px;
        margin: 0 auto;
        border-style: solid;
        width: 80%;
        padding-left:0%;
        padding-top:0%;
           
      }
 </style>


<div class=\"row\">
<style scoped>
    
  
 

/* Clear floats after the columns */
.row:after {
    content: \"\";
      display: table;
      clear: both;
}
      }
 </style>

  <div class=\"column address\" >
  <style scoped>
 .column {
        
        float: left;

         /* Should be removed. Only for demonstration */
}

     .address{

width: 35%;
height:10%;



}
 </style>
 <strong>পরীক্ষা নিয়ন্ত্রকের অফিস</strong><br>
 <strong>ঢাকা বিশ্ববিদ্যালয়</strong><br>
 ঢাকা-১০০০,বাংলাদেশ।<br>
 ফোনঃ(অফিস)৮৬১৩২৮০<br>
 ৯৬৬১৯০০-৫৯/৪০৭৫<br>
 (বাসা)৯৬৬৬১৩৫<br>
 ফ্যাক্সঃ৮৮০-২-৯৬৬৭২২২<br>
 <p style=\"font-size:15px;\">Email: examcontroller@du.ac.bd</p>
</div>
<div class=\"column image\">

<style scoped>
.column {
 
 float: left;

  /* Should be removed. Only for demonstration */
}

.image{



padding-top: 4%;
padding-left: 10%;
width: 40%;
height:10%;

}
</style>

<p> <img src=\"DhakaUniversity.jpg\" width=\"70\" height=\"90\"></p>
</div>
</div>



<div class=\"row\">
<style scoped>
    
  

 

/* Clear floats after the columns */
.row:after {
    content: \"\";
      display: table;
      clear: both;
}
      }
 </style>

  <div class=\"column p1\" >
  <style scoped>
 .column {
        
        float: left;

       /* Should be removed. Only for demonstration */
}

     .p1{

        padding-top: -4%;
       
        width: 30%;
        height:2%;
     
}
 </style>


 <p> <p>মেমো নং: $memo1/শা-৫/প</p></p>
  </div>

  <div class=\"column p2\">

<style scoped>
.column {
      
      float: left;

     /* Should be removed. Only for demonstration */
}

   .p2{
       margin-left:20%;

    padding-top: 2%;
    padding-left: 10%;
    width: 30%;
    height:2%;
   

}
</style>

তারিখঃ  $new
</div>
</div>


<div class=\"teacher\">
                <style scoped>
               .teacher{ width: 35%;

                    height: 8%;
                    padding-top:0%;
                  
                        

                    }
                </style> প্রাপকঃ 

                         $teacher ,<br>
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $d1,<br>
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $dept, <br>
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ঢাকা বিশ্ববিদ্যালয়, ঢাকা।<br>
                        
                 </div>


                 <div class=\"in\">
                      জনাব,
                 <div>


                 
<div class=\"intro\">

<style scoped>
                            .intro{
                                padding-top:-2%;
                                width: 90%;
                                text-indent: 7%;
                                word-spacing: 8px;
                                text-align: justify;
                                text-justify: inter-word;
                                height:3%;
                              
                              
                            }

                           
                        </style>
  <p>
  

  আপনাকে জানাইতেছি যে, $year সনের $xm    পরীক্ষার $r1 বিষয়ে কোর্স/পত্র নং $r2 
  এর বাংলা ও ইংরেজি উভয় ভাষার প্রশ্নপত্র প্রণয়ন করার জন্য আপনাকে যুগ্ম প্রশ্নপত্র প্রণেতা ও পরীক্ষক নিয়োগ করা হইয়াছে।
  </p>

</div>
<div class=\"start\">

<strong>বিশেষ নির্দেশনাবলীঃ</strong>

</div>


<div class=\"a\">
<style scoped>
                            .a{  width: 90%;
                                text-indent: 7%;
                                word-spacing: 8px;
                                text-align: justify;
                                text-justify: inter-word;
                                padding-top:-2%;
                              
                            }
                        </style>

  <p> উল্লেখিত প্রশ্নপত্র প্রণয়ন প্রসঙ্গে আনুসাঙ্গিক তথ্যাবলী সম্বলিত নিম্নলিখিত কাগজপত্র এতদসঙ্গে গ্রথিত হইলঃ(১)প্রশ্নপত্র প্রণেতাদের 
  প্রতি নির্দেশনাবলী (২) নির্ধারিত পাঠ্যসূচী (৩) সংশ্লিষ্ট পত্রের পূর্ববর্তী  বৎসরের প্রশ্নপত্র (৪) প্রশ্নপত্র প্রণয়নের জন্য রেখাঙ্কিত কাগজ (৫) ঠিকানা
  যুক্ত ছোট বড় প্রয়োজনীয় খাম।</p>

</div>


<div class=\"b\">

<style scoped>
.b{  width: 90%;
    text-indent: 7%;
    word-spacing: 8px;
    text-align: justify;
    text-justify: inter-word;
    height:3%;
    padding-top:-2%;
                               
  
}
</style>
      <p>
      প্রনীত প্রশ্নপত্র গ্রথিত খামে সিলমোহর পূর্বক  বীমাকৃত ডাকে অথবা ব্যক্তিগতভাবে $deadline1 ইং তারিখের মধ্যে ঢাকা বিশ্ববিদ্যালয়ের
      সংশ্লিষ্ট বিষয়ের  পরীক্ষা কমিটির চেয়ারম্যান প্রফেসর/ড/জনাব$ch এর নিকট জমা দেয়ার জন্য আপনাকে সবিনয় অনুরোধ করিতেছি।সরবরাহকৃত ছোট খামের শূন্যস্থানগুলি যথাযথভাবে পূরন করা প্রয়োজনীয়।<br>
      </p>
</div>



<div class=\"c\">

<style scoped>
                            .c{  width: 90%;
                                text-indent: 7%;
                                word-spacing: 8px;
                                text-align: justify;
                                text-justify: inter-word;
                                height:3%;
                               
                                padding-top:-2%;
                              
                            }
                        </style>

<p>
আপনার প্রণীত  প্রশ্নপত্র নির্ধারিত তারিখের মধ্যে পাওয়া না গেলে বিশ্ববিদ্যালয় করতিপক্ষ বিকল্প ব্যবস্থা গ্রহণ করিতে বাধ্য হইবে।
নিযুক্তিপত্র গ্রহণে অপারগ হইলে অবশ্যই ইহার কারণ জানাইয়া সঙ্গে এতদসংলগ্ন কাগজপত্রাদিও ফেরত পাঠানোর জন্য আপনাকে অনুরোধ 
করতেছি।
</p>

</div>

<div class=\"d\">
<style scoped>
                            .d{  width: 90%;
                                text-indent: 7%;
                                word-spacing: 8px;
                                text-align: justify;
                                text-justify: inter-word;
                                height:3%;
                                padding-top:-2%;
                              
                            }
                        </style>

<p> প্রণয়নকৃত প্রশ্নপত্রের পান্ডুলিপি পরিষ্কার পরিচ্ছন্ন ও সুস্পষ্ট  হওয়া  একান্ত বাঞ্ছনীয়। কোন ছক বা অন্য কোন তথ্যাদি প্রশ্নপত্রের সঙ্গে 
সরবরাহ করার প্রয়োজন হইলে তাহা পৃথকভাবে সংশ্লিষ্ট  চেয়ারম্যানকে সঠিক নির্দেশিকা প্রদান করিতে অনুরোধ করিতেছি।</p>

</div>

<div class=\"e\">
<style scoped>
                            .e{  width: 90%;
                                text-indent: 7%;
                                word-spacing: 8px;
                                text-align: justify;
                                text-justify: inter-word;
                                padding-top:-2%;
                              
                            }
                        </style>

<p> আপনার কোনো নিকট আত্মীয় যেমনঃ (১) ভাই  (২) বোন  (৩) স্ত্রী/স্বামীর  (ক) ভাই/বোন  (৪) ছেলে  (৫) মেয়ে  (৬) ভ্রাতৃবধূ  (৭) ভগ্নিপতি 
(৮) স্ত্রী (৯) স্বামী (১০) ভাই ও বোনের সন্তানের (১১) পুত্রবধূ  (১২) জামাতা  (১৩) আপন চাচা-চাচী  (১৪) আপন মামা-মামী  (১৫) আপন ফুফা-ফুফু
এবং (১৬) আপন খালা-খালু এই পরীক্ষায় যদি পরীক্ষার্থীর/পরীক্ষার্থিনী থাকে ,তবে তাহা নিয়োগপত্র গ্রহণের পূর্বে  অত্র অফিসে জানানোর জন্য
অনুরোধ করতেছি।
</p>

</div>



<div class=\"f\">
<style scoped>
                            .f{  width: 90%;
                                text-indent: 7%;
                                word-spacing: 8px;
                                text-align: justify;
                                text-justify: inter-word;
                                height:3%;
                                padding-top:-2%;
                              
                            }
                        </style>

<p>আপনি যদি শিক্ষা প্রতিষ্ঠান/বিভাগ ছাড়া অন্য কোন সরকারী দপ্তরের কর্মকর্তা হন,তবে আপনাকে এই কাজের পারিশ্রমিক গ্রহণের
জন্য সরকারী অনুমোদন পত্র বিলের সহিত গ্রথিত করিয়া দিতে হইবে।সরকারী কর্মচারীদের নিযুক্ত
গ্রহণের পূর্বে  অবশ্যই কর্তৃপক্ষের অনুমতি নিতে হইবে।</p>

</div >


<div class=\"g\">
<style scoped>
                            .g{  width: 90%;
                                text-indent: 7%;
                                word-spacing: 8px;
                                text-align: justify;
                                text-justify: inter-word;
                                height:3%;
                                padding-top:-2%;
                              
                            }
                        </style>

<p>উক্ত বিষয়ে আপনার সম্মতি যথাশীঘ্র জানাইবার জন্য অনুরোধ করিতেছি।<p>

</div>  

<div class=\"h\">

<style scoped>

   .h{
     margin-top:-3%;
     padding-top: 0%;
     padding-left: 40%;
     width: 40%;
     height:4%;
     
     margin-left:20%;
}


</style>

<p>আপনার বিশ্বস্ত</p>
$image1  <br>
     
<p style=\"margin-left:-3%;text-indent:-2%\">পরীক্ষা নিয়ন্ত্রকের পক্ষে<br>
     পরীক্ষা উপ-নিয়ন্ত্রক<br>
     ঢাকা বিশ্ববিদ্যালয়।<br>
     </p>
</div>
    
</div>
</div>
  

</body>
</html>

";




$html = ob_get_contents();
ob_end_clean(); 
$mpdf->WriteHTML($html);

$mpdf->WriteHTML('<pagebreak />');
//$mpdf->Output();
//$mpdf->Output($pdf,'F');

$_SESSION['pdf'] =$memo1;
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
$UploadDirectory = $_SERVER['DOCUMENT_ROOT'] ."/syllabus_file/";


if(!empty($_FILES) && $_FILES['syllabus_file']['name'] !="" && $_FILES['syllabus_file']['tmp_name']!="")
{
    $File_Ext = substr($_FILES['syllabus_file']['name'], strrpos($_FILES['syllabus_file']['name'], '.')); //get file extention
    $NewFileNameEnq = "syllabus_file_".$memo1."_".$teacher."_".time().$File_Ext; //new file name

    if(move_uploaded_file($_FILES['syllabus_file']['tmp_name'], $UploadDirectory.$NewFileNameEnq))
    {
        $flag = 0;
        $_SESSION['syllabus_file'] = $NewFileNameEnq; 
    }
    else{ $flag++; }
}


$pdf_url1 = $_SERVER['DOCUMENT_ROOT'].'/syllabus_file/'.$NewFileNameEnq;

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
$w = 300;
$h = 400;


$pdf_url1 = $_SERVER['DOCUMENT_ROOT'].'/letter_2/Instruction.pdf';

$pagecount = $mpdf->SetSourceFile($pdf_url1);

$mpdf->SetImportUse();

$tplId = $mpdf->ImportPage(1);

$mpdf->UseTemplate($tplId, $x, $y, $w, $h);

$mpdf->WriteHTML('<pagebreak />');



$pdf_url1 = $_SERVER['DOCUMENT_ROOT'].'/letter_2/bill forom final.pdf';

$pagecount = $mpdf->SetSourceFile($pdf_url1);

$mpdf->SetImportUse();

$tplId = $mpdf->ImportPage(1);

$mpdf->UseTemplate($tplId, $x, $y, $w, $h);

$mpdf->WriteHTML('<pagebreak />');



$pdf_url1 = $_SERVER['DOCUMENT_ROOT'].'/letter_2/Number form.pdf';

$pagecount = $mpdf->SetSourceFile($pdf_url1);

$mpdf->SetImportUse();

$tplId = $mpdf->ImportPage(1);

$mpdf->UseTemplate($tplId, $x, $y, $w, $h);

$mpdf->WriteHTML('<pagebreak />');



$pdf_url1 = $_SERVER['DOCUMENT_ROOT'].'/letter_2/Number form1.pdf';

$pagecount = $mpdf->SetSourceFile($pdf_url1);

$mpdf->SetImportUse();

$tplId = $mpdf->ImportPage(1);

$mpdf->UseTemplate($tplId, $x, $y, $w, $h);

$mpdf->WriteHTML('<pagebreak />');



$pdf_url1 = $_SERVER['DOCUMENT_ROOT'].'/letter_2/Number form1.pdf';

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







