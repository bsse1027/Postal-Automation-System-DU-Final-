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
                                $x=$_SERVER['DOCUMENT_ROOT'].'/Files/';
                               
                                $y='.pdf'; 
                                $pdf=$x.$memo1.$y; 


                                $image= $_POST['image'];
 
 
 if($image==1)
       $image1="<img src=\"signature.jpg\" width=\"200\" height=\"50\" style=\"padding-left:-10%;\">";

 else
 $image1="<img src=\"white.jpg\" width=\"200\" height=\"50\" style=\"padding-left:-10%;\">";


      


                              


                              
                                
                                
                               

                      

?>

<?php
include("mpdf.php");
$mpdf=new mPDF('','A3',14,'nikosh'); 
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
        padding-top:5%;
           
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
height:12%;



}
 </style>

  <strong>পরীক্ষা নিয়ন্ত্রকের অফিস</strong><br>
        <strong>ঢাকা বিশ্ববিদ্যালয়</strong><br>
        ঢাকা-১০০০,বাংলাদেশ।<br>
        ফোনঃ(অফিস)৮৬১৩২৮০<br>
        ৯৬৬১৯০০-৫৯/৪০৭৫<br>
        (বাসা)৯৬৬৬১৩৫<br>
        ফ্যাক্সঃ৮৮০-২-৯৬৬৭২২২<br>
        <p style=\"font-size:15px;\">Email:examcontroller@du.ac.bd</p>
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
     height:12%;

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

        padding-top: 2%;
       
        width: 30%;
        height:5%;
        
}
 </style>

 <p> <p>মেমো নং: $memo1 শা-৫/প</p></p>
  </div>

  <div class=\"column p2\">

<style scoped>
.column {
      
      float: left;

     /* Should be removed. Only for demonstration */
}

   .p2{
       margin-left:20%;

    padding-top: 8%;
    padding-left: 10%;
    width: 30%;
    height:4%;

}
</style>

তারিখঃ  $new
</div>
</div>
<div class=\"top\">
<style scoped>
.top{ text-indent: 7%;
    width:30%;
    margin-left:35%; 
    width:30%;
 

     }
 </style>


                       <strong> গোপনীয়</strong><br>
                        <strong>(শুধু উত্তরপত্র পরীক্ষকদের জন্য)</strong><br>

</div>

<div class=\"teacher\">
                <style scoped>
               .teacher{ width: 25%;

                    height: 8%;
                    padding-top:0%;
                  
                        

                    }
                </style>

                         $teacher ,<br>
                         $d1,<br>
                         $dept, <br>
                         ঢাকা বিশ্ববিদ্যালয়, ঢাকা।<br>
                        
                 </div>

               

                 <div class=\"a\">
                                জনাব,
                        <div>

                        <div class=\"b\">
         
                        <style scoped>
                            .b{ width: 90%;
                                text-indent: 7%;
                                word-spacing: 8px;
                                text-align: justify;
                                text-justify: inter-word;
                              
                            }

                           
                        </style>

                        <p>আপনাকে জানাইতেছি যে, আপনি  $year  সনের $yr   বর্ষ $xm  পরীক্ষার 
                        $r1  বিষয়ের  $r2 নং  $cr উত্তরপত্র পরীক্ষক নিযুক্ত হইয়াছেন।

                        </div>

                        <div class=\"c\">

                        <style scoped>
                            .c{ width: 90%;
                                text-indent: 7%;
                                word-spacing: 8px;
                                text-align: justify;
                                text-justify: inter-word;
                              
                            }
                        </style>
                        <p>

                        বিধি অনুযায়ী অভ্যন্তরীণ  পরীক্ষক কোর্স ফাইনাল পরীক্ষার হলের প্রধান তত্ত্বাবধায়কের নিকট হইতে
                        উত্তরপত্র ও সংশ্লিষ্ট কাগজপত্র গ্রহণ করিবেন। কোন কারণে পরীক্ষক পরীক্ষার হল হইতে উত্তরপত্র সংগ্রহ
                        করিতে না পারিলে তিনি পরবর্তী তিন কর্মদিবসের মধ্যে পরীক্ষা নিয়ন্ত্রকের অফিস হইতে উহা সংগ্রহ
                        করিবেন । মফঃস্বলস্থ পরীক্ষকগণের নিকট ডাকযোগে উত্তরপত্র প্রেরণ করা হইবে।
                       <p>


                        </div>


                        <div class=\"d\">
                        <style scoped>
                            .d{ width: 90%;
                                text-indent: 7%;
                                word-spacing: 8px;
                                text-align: justify;
                                text-justify: inter-word;
                            
                            }
                        </style>
                        

                        <p> আপনার কোনো নিকট আত্মীয় যেমনঃ (১) ভাই  (২) বোন  (৩) স্ত্রী/স্বামীর  (ক) ভাই/বোন 
                        (৪) ছেলে  (৫) মেয়ে  (৬) ভ্রাতৃবধূ  (৭) ভগ্নিপতি 
                       (৮) স্ত্রী (৯) স্বামী (১০) ভাই ও বোনের সন্তানের (১১) পুত্রবধূ 
                        (১২) জামাতা  (১৩) আপন চাচা-চাচী  (১৪) আপন মামা-মামী  (১৫) আপন ফুফা-ফুফু
                       এবং (১৬) আপন খালা-খালু এই পরীক্ষায় যদি পরীক্ষার্থীর/পরীক্ষার্থিনী থাকে ,তবে তাহা নিয়োগপত্র গ্রহণের পূর্বে  অত্র অফিসে জানাইতে হইবে।
                       
                       </p>

</div>



<div class=\"e\">
<style scoped>
                            .e{ 

                                width: 90%;
                                text-indent: 7%;
                                word-spacing: 8px;
                                text-align: justify;
                                text-justify: inter-word;
                              


                            }
                        </style>

                        <p>আপনি যদি শিক্ষা প্রতিষ্ঠান/বিভাগ ছাড়া অন্য কোন সরকারী দপ্তরের কর্মকর্তা হন,তবে আপনাকে  নিযুক্তি গ্রহণের পূর্বে অবশ্যই কর্তৃপক্ষের অনুমতি নিতে হইবে এবং এই কাজের পারিশ্রমিক গ্রহণের
                        জন্য  অনুমোদন পত্র বিলের সহিত গ্রথিত করিয়া দিতে হইবে। </p>

</div >


<div class=\"f\">
<style scoped>
                            .f{  width: 90%;
                                text-indent: 7%;
                                word-spacing: 8px;
                                text-align: justify;
                                text-justify: inter-word;
                              
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


 
  

 


</html>

";



$html = ob_get_contents();
ob_end_clean(); 
$mpdf->WriteHTML($html);
//$mpdf->Output();
$mpdf->Output($pdf,'F');

$_SESSION['pdf'] =$memo1;


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





