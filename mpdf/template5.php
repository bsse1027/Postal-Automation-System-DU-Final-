<?php include "dbconnect.php"; 

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


?>


<!doctype html>
<html lang="en">
   <head>

    <title>Template5</title>
    <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href=  "t5.css">
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script>





</script>

  </head>


        <script>
        function getState(val) {
            $.ajax({
            type: "POST",
            url: "ajax.php",
            data:'ID='+val,
            success: function(data){
                $("#course").html(data);
            }
            });
        }

        function getState1(val) {
            $.ajax({
            type: "POST",
            url: "ajax1.php",
            
            data:'tid='+val,
            success: function(data){
                $("#teacher").html(data);
            }
            });
        }
       
       
               </script>


        
        <body>
        <?php
    session_start();
    ?>
        <form action="index5.php" method="post">

        <div class="container">
        <div class="w">
       
        <div class="row">
                    <div class="column address">

                        <strong>পরীক্ষা নিয়ন্ত্রকের অফিস</strong><br>
                        <strong>ঢাকা বিশ্ববিদ্যালয়</strong><br>
                        ঢাকা-১০০০,বাংলাদেশ।<br>
                        ফোনঃ(অফিস)৮৬১৩২৮০<br>
                        ৯৬৬১৯০০-৫৯/৪০৭৫<br>
                        (বাসা)৯৬৬৬১৩৫<br>
                        ফ্যাক্সঃ৮৮০-২-৯৬৬৭২২২<br>
                        <p>Email:examcontroller@du.ac.bd</p>

                    </div>

                    <div class="column image">
                         <img src="DhakaUniversity.jpg" width="70" height="90">
                    </div>
                </div>

                
                
                <div class="row">
                        

                        <div class="column right">

                               
                        <p>মেমো নংঃ 


<?php


    $sql="SELECT * FROM memo1 WHERE letter_id=1  ORDER BY sl DESC LIMIT 1";
    $result=mysqli_query($link,$sql);

    //echo "Error message = ".mysqli_error($link);

    if ($result)
    {
        if (mysqli_num_rows($result) > 0)
        {
            while($row=mysqli_fetch_array($result)) { 
                //echo $row['memo'];
                $memo = $row['memo']+1;
            }

        }

        else{
            $memo = 1000;
        }

        
    }

    else{
        $memo = 1000;
    }

    echo "$memo";
    $_SESSION['memo'] =$memo;
?>/শা-৫/প</p>

                                                

                        
                        </div>

                        <div class="column left">
                        তারিখঃ
                        <?php $date= date("d-m-Y"); 
                            $_SESSION['date'] =$date;
                            $new= BanglaConverter::en2bn($date);
                                    echo  $new ?>
                                    
            
                        </div>
                </div>

                <div class="top">
                       <strong> গোপনীয়</strong><br>
                        <strong>(শুধু উত্তরপত্র পরীক্ষকদের জন্য)</strong><br>

                        </div>
                        <div class="teacher">

                        <select name="department" id="department" class="demoInputBox"  onChange="getState1(this.value);">
                              <option value="">Select department</option>
                              <?php

                                

                              $sql="SELECT DISTINCT dept_name,dept_id FROM dept_table";
                              $result=mysqli_query($link,$sql);
                              while($row=mysqli_fetch_array($result)) { 
                              ?>
                              <option value="<?php echo $row["dept_id"]."|".$row["dept_name"]; ?>"><?php echo $row["dept_name"]; ?></option>
                              <?php
                              }
                              ?>
                              </select>



                              
                                
                           




                              
<select id="teacher" name="teacher"  >
                              <option value="">Select teacher's name</option>
                              </select> 
                        </div>


               
                        <div class="a">
                                জনাব,
                            </div>

                        <div class="b">
                        <p>
                                            
                        আপনাকে জানাইতেছি যে, আপনি <select name="year" value="Year" id="ddlYears"></select>
      
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
      <script type="text/javascript">
          $(function () {
              //Reference the DropDownList.
              var ddlYears = $("#ddlYears");
      
              //Determine the Current Year.
              var currentYear = (new Date()).getFullYear();
      
              //Loop and add the Year values to DropDownList.
              for (var i =currentYear ; i <=2100 ; i++) {
                  var option = $("<option />");
                  option.html(i);
                  option.val(i);
                  ddlYears.append(option);
              }
          });
      </script>  সনের   <select name="yr" id="yr">
  <option>১ম</option>
  <option>২য়</option>
  <option>৩য়</option>
  <option>৪র্থ</option>
</select>  বর্ষ 
    <select name="xm" id="xm">
  <option>বি.এস সম্মান</option>
  <option>এম.এ</option>
  <option>এম.এস.এস</option>
  <option>এম.এস</option>
</select>পরীক্ষার 
               <input type="text" name="subject" id="subject">               
                                  
                            
                                <!-- <select name="subject" id="subject" class="demoInputBox"  onChange="getState(this.value);">
                                <option value="">Select Subject</option>
                                <?php
                                $sql1="SELECT * FROM subject";
                                //$results=$dbhandle->query($sql1); 
                                $results=mysqli_query($link,$sql1);
                                while($rs=$results->fetch_assoc()) { 
                                ?>
                                <option value="<?php echo $rs["ID"]."|".$rs["Subject_name"]; ?>"><?php echo $rs["Subject_name"]; ?></option>
                                <?php
                                }
                                ?>
                                </select> -->
                                
বিষয়ের
<input type="text" name="course" id="course">   
<!-- <select id="course" name="course"  >
  <option value="">Select Courses</option>
</select>  -->
নং 
<select name="cr" id="cr">
  <option>কোর্সের</option>
  <option>পত্রের</option>
  <option>থিসিসের </option>
  
</select>উত্তরপত্র পরীক্ষক নিযুক্ত হইয়াছেন।
                        <p>

                        </div>


                        <div class="c">
                        <p>

                        বিধি অনুযায়ী অভ্যন্তরীণ  পরীক্ষক কোর্স ফাইনাল পরীক্ষার হলের প্রধান তত্ত্বাবধায়কের নিকট হইতে
                        উত্তরপত্র ও সংশ্লিষ্ট কাগজপত্র গ্রহণ করিবেন। কোন কারণে পরীক্ষক পরীক্ষার হল হইতে উত্তরপত্র সংগ্রহ
                        করিতে না পারিলে তিনি পরবর্তী তিন কর্মদিবসের মধ্যে পরীক্ষা নিয়ন্ত্রকের অফিস হইতে উহা সংগ্রহ
                        করিবেন । মফঃস্বলস্থ পরীক্ষকগণের নিকট ডাকযোগে উত্তরপত্র প্রেরণ করা হইবে।
                       <p>


                        </div>


                        <div class="d">
                        

<p> আপনার কোনো নিকট আত্মীয় যেমনঃ (১) ভাই  (২) বোন  (৩) স্ত্রী/স্বামীর  (ক) ভাই/বোন (৪) ছেলে 
 (৫) মেয়ে  (৬) ভ্রাতৃবধূ  (৭) ভগ্নিপতি (৮) স্ত্রী (৯) স্বামী (১০) ভাই ও বোনের সন্তানের (১১) পুত্রবধূ 
 (১২) জামাতা  (১৩) আপন চাচা-চাচী  (১৪) আপন মামা-মামী  (১৫) আপন ফুফা-ফুফুএবং (১৬) আপন
 খালা-খালু এই পরীক্ষায় যদি পরীক্ষার্থীর/পরীক্ষার্থিনী থাকে ,তবে তাহা নিয়োগপত্র গ্রহণের পূর্বে  অত্র অফিসে 
 জানাইতে হইবে।

</p>

</div>



<div class="e">

<p>আপনি যদি শিক্ষা প্রতিষ্ঠান/বিভাগ ছাড়া অন্য কোন সরকারী দপ্তরের কর্মকর্তা হন,তবে আপনাকে  নিযুক্তি 
গ্রহণের পূর্বে অবশ্যই কর্তৃপক্ষের অনুমতি নিতে হইবে এবং এই কাজের পারিশ্রমিক গ্রহণের জন্য  অনুমোদন
 পত্র বিলের সহিত গ্রথিত করিয়া দিতে হইবে। </p>

</div >


<div class="f">

<p>উক্ত বিষয়ে আপনার সম্মতি যথাশীঘ্র জানাইবার জন্য অনুরোধ করিতেছি।<p>

</div>    

<div class="h">

<p>আপনার বিশ্বস্ত</p>

<input value="1" name="image" class="image-list" type="checkbox">Add signature<br>
    <input value="2" name="image" class="image-list" type="checkbox">Blank signature<br>
   
    <script type="text/javascript">
	    $('.image-list').on('change', function() {
		    $('.image-list').not(this).prop('checked', false);  
		});
    </script>

<p style="margin-left:-3%;text-indent:-2%">পরীক্ষা নিয়ন্ত্রকের পক্ষে<br>
        পরীক্ষা উপ-নিয়ন্ত্রক<br>
        ঢাকা বিশ্ববিদ্যালয়।<br>
</p>

</div>

   


   
    
   

</div>
</div>

<div class="deadline">

<label for="Date">Deadline:</label>
<input type="date" id="deadline" name="deadline" style="width:200px; " required >

</div>

<div class="submit">
    <input type="submit"  value="Done"  id="search">
</div>


 </form>
 
</body>

</html>