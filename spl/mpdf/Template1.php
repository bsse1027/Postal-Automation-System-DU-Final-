 <!doctype html>
<html lang="en">
   <head>

    <title>Template1</title>
    <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="t1.css">
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
       

  </head>

  <?php include "dbconnect.php"; ?>
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
  <form action="index1.php" method="post" enctype="multipart/form-data">
  <div class="container">
        <div class="w" >

           

        
                <div class="row">
                    <div class="column address">

                    <strong>পরীক্ষা নিয়ন্ত্রকের অফিস</strong><br>
                        <strong>ঢাকা বিশ্ববিদ্যালয়</strong><br>
                        ঢাকা-১০০০,বাংলাদেশ।<br>
                        ফোনঃ(অফিস)৮৬১৩২৮০<br>
                        ৯৬৬১৯০০-৫৯/৪০৭৫<br>
                        (বাসা)৯৬৬৬১৩৫<br>
                        ফ্যাক্সঃ৮৮০-২-৯৬৬৭২২২<br>
                        <p>Email: examcontroller@du.ac.bd</p>


                    </div>

                    <div class="column image">
                         <img src="DhakaUniversity.jpg" width="80" height="100">
                    </div>
                </div>

                
                
                <div class="row">
                        

                <div class="column right">

                               
<p>মেমো নংঃ 


<?php


    $sql="SELECT * FROM memo1 WHERE letter_id=2  ORDER BY sl DESC LIMIT 1";
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

                                    echo  $date ?>
                                    
            
                        </div>
                </div>

            
                <div class="teacher">

                        <select name="department" id="department" class="demoInputBox"  onChange="getState1(this.value);">
                              <option value="">Select department</option>
                              <?php

                              

                              $sql="SELECT DISTINCT department,tid FROM teacher";
                              $result=mysqli_query($link,$sql);
                              while($row=mysqli_fetch_array($result)) { 
                              ?>
                              <option value="<?php echo $row["tid"]."|".$row["department"]; ?>"><?php echo $row["department"]; ?></option>
                              <?php
                              }
                              ?>
                              </select>



                              
                                
                               
                            </select>




                              
<select id="teacher" name="teacher"  >
                              <option value="">Select teacher's name</option>
                              </select> 
                        </div>

            <div class="in">
            জনাব,
            </div>
            
            <div class="intro">
                <p>
               
                আপনাকে জানাইতেছি যে, <select name="year" value="Year" id="ddlYears"></select>
      
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
                    </script> সনের
                    <input type="text" name="hj" id="opt1">
                    <!-- <select name="hj" id="opt1">
                    <option> Select exam name</option>
                    <?php
                            
                            
                            $sql="SELECT *  FROM examlist";
                            $result=mysqli_query($link,$sql);

                            





                           
                            

                            while($row=mysqli_fetch_array($result))
                            {?>
                               <option><?php echo $row["E_name"]; ?></option>
                              <?php
                              }
                              ?>
                              </select>
                            <?php
                           

                            ?> -->পরীক্ষার 
                              
                                  
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
                                 কোর্স/পত্র নং 
                                
                               
                                  



                এর বাংলা ও ইংরেজি উভয় ভাষার প্রশ্নপত্র প্রণয়ন করার জন্য আপনাকে যুগ্ম প্রশ্নপত্র প্রণেতা ও পরীক্ষক নিয়োগ করা হইয়াছে।
                </p>

            </div>

            <div class="start">

                <strong>বিশেষ নির্দেশনাবলীঃ</strong>

            </div>


        <div class="a">

                <p> উল্লেখিত প্রশ্নপত্র প্রণয়ন প্রসঙ্গে আনুসাঙ্গিক তথ্যাবলী সম্বলিত নিম্নলিখিত কাগজপত্র এতদসঙ্গে গ্রথিত হইলঃ (১) প্রশ্নপত্র প্রণেতাদের 
                প্রতি নির্দেশনাবলী (২) নির্ধারিত পাঠ্যসূচী (৩) সংশ্লিষ্ট পত্রের পূর্ববর্তী  বৎসরের প্রশ্নপত্র (৪) প্রশ্নপত্র প্রণয়নের জন্য রেখাঙ্কিত কাগজ (৫) ঠিকানা
                যুক্ত ছোট বড় প্রয়োজনীয় খাম।</p>

        </div>


        <div class="b">
                <p>
                প্রনীত প্রশ্নপত্র গ্রথিত খামে সিলমোহর পূর্বক  বীমাকৃত ডাকে অথবা ব্যক্তিগতভাবে <input type="date" id="deadline" name="deadline" required> ইং তারিখের মধ্যে ঢাকা বিশ্ববিদ্যালয়ের
                সংশ্লিষ্ট বিষয়ের  পরীক্ষা কমিটির চেয়ারম্যান প্রফেসর/ড/জনাব <input id="chairman" name="chairman" > 
                এর নিকট জমা দেয়ার জন্য আপনাকে সবিনয় অনুরোধ করিতেছি।সরবরাহকৃত ছোট খামের শূন্যস্থানগুলি যথাযথভাবে পূরন করা প্রয়োজনীয়।
                </p>
        </div>

            <div class="c">

                <p>
                আপনার প্রণীত  প্রশ্নপত্র নির্ধারিত তারিখের মধ্যে পাওয়া না গেলে বিশ্ববিদ্যালয় কর্তৃপক্ষ বিকল্প ব্যবস্থা গ্রহণ করিতে বাধ্য হইবে।
                নিযুক্তিপত্র গ্রহণে অপারগ হইলে অবশ্যই ইহার কারণ জানাইয়া সঙ্গে এতদসংলগ্ন কাগজপত্রাদিও ফেরত পাঠানোর জন্য আপনাকে অনুরোধ 
                করতেছি।
                </p>

            </div>

            <div class="d">

                <p> প্রণয়নকৃত প্রশ্নপত্রের পান্ডুলিপি পরিষ্কার পরিচ্ছন্ন ও সুস্পষ্ট  হওয়া  একান্ত বাঞ্ছনীয়। কোন ছক বা অন্য কোন তথ্যাদি প্রশ্নপত্রের সঙ্গে 
                সরবরাহ করার প্রয়োজন হইলে তাহা পৃথকভাবে সংশ্লিষ্ট  চেয়ারম্যানকে সঠিক নির্দেশিকা প্রদান করিতে অনুরোধ করিতেছি।</p>

            </div>
                    
            <div class="e">

                <p> আপনার কোনো নিকট আত্মীয় যেমনঃ (১) ভাই  (২) বোন  (৩) স্ত্রী/স্বামীর  (ক) ভাই/বোন  (৪) ছেলে  (৫) মেয়ে  (৬) ভ্রাতৃবধূ  (৭) ভগ্নিপতি 
                (৮) স্ত্রী (৯) স্বামী (১০) ভাই ও বোনের সন্তানের (১১) পুত্রবধূ  (১২) জামাতা  (১৩) আপন চাচা-চাচী  (১৪) আপন মামা-মামী  (১৫) আপন ফুফা-ফুফু
                এবং (১৬) আপন খালা-খালু এই পরীক্ষায় যদি পরীক্ষার্থীর/পরীক্ষার্থিনী থাকে ,তবে তাহা নিয়োগপত্র গ্রহণের পূর্বে  অত্র অফিসে জানানোর জন্য 
                অনুরোধ করতেছি।
                </p>

            </div>

            

            <div class="f">

                <p>আপনি যদি শিক্ষা প্রতিষ্ঠান/বিভাগ ছাড়া অন্য কোন সরকারী দপ্তরের কর্মকর্তা হন,তবে আপনাকে এই কাজের পারিশ্রমিক গ্রহণের
                জন্য সরকারী অনুমোদন পত্র বিলের সহিত গ্রথিত করিয়া দিতে হইবে।সরকারী কর্মচারীদের নিযুক্ত
                গ্রহণের পূর্বে  অবশ্যই কর্তৃপক্ষের অনুমতিনিতে হইবে।</p>
            
            </div >

                
            <div class="g">

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



<div>
    <label>Upload Syllabus</label>
    <input required type="file" name="syllabus_file" id="syllabus_file">

</div>

<div class="submit">
        <input type="submit"  value="Done"  id="search">

    </div>
</form>
  </body>
</html>