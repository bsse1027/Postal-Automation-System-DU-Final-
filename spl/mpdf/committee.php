<?php include "dbconnect.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Committee Letter</title>
  <link rel="stylesheet" href="committee.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
</head>
<body>
<form action="committee_pdf.php" method="post">
  <div class="container">
    <div class="w">
      <div class="row">
        <div class="column address">
            <strong>পরীক্ষা নিয়ন্ত্রকের অফিস</strong><br>
            <strong>ঢাকা বিশ্ববিদ্যালয়</strong><br>
            ফোনঃ(অফিস)৮৬১৩২৮০<br>
            ৯৬৬১৯০০-৫৯/৪০৭৫<br>
            ফ্যাক্সঃ৮৮০-২-৯৬৬৭২২২<br>
        </div>

        <div class="column image">
             <img src="DhakaUniversity.jpg" width="80" height="100">
        </div>

        <div class="column addresses">
            <strong>OFFICE OF THE CONTROLLER OF EXAMINATIONS</strong><br>
            UNIVERSITY OF DHAKA<br>
            DHAKA-1000, BANGLADESH<br>
            Phone : (off.) 8613280<br>
            9661900-59/4080<br>
            Fax : 88-02-9667222<br>
            Email: examcontroller@du.ac.bd
        </div>

      </div>

      <div class="row">
        <div class="in column right1">
          মেমো নংঃ 

          <?php


              $sql="SELECT * FROM memo1 WHERE letter_id=3  ORDER BY sl DESC LIMIT 1";
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
        ?>/শা-৫/প.
        </div>
        <div class="column image">
          .
        </div>
        <div class="column date">
          তারিখঃ
            <?php 
              $date= date("d-m-Y"); 
              $_SESSION['date'] = $date;

              echo $date; 
            ?>
        </div>
        
      </div>
      <input id="memo" name="memo" type="hidden" value="<?php echo $memo?>">
      <input id="date" name="date" type="hidden" value="<?php echo $date?>">
      <div>
        <div class="in teacher">
          <script type="text/javascript">
            function deptartment() {
                var val = $("#dept").val();
                //alert(val);
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
          <!-- <input onblur="teacher()" type="text" name="teacher" id="teacher"> -->
          <select name="dept" id="dept" onChange="deptartment();">
            <option value="">Select department</option>
            <?php
              $sql="SELECT DISTINCT dept_name,dept_id FROM dept_table";
              $result=mysqli_query($link,$sql);
              while($row=mysqli_fetch_array($result)) { 
            ?>
              <option value="<?php echo $row["dept_id"]."|".$row["dept_name"]; ?>"><?php echo $row["dept_name"]; ?>
              </option>
            <?php
              }
            ?>
          </select>
        <br>
          <select id="teacher" name="teacher">
            <option value="">Select teacher's name</option>
          </select>

        <br>
          <!-- <input onblur="dept()" type="text" name="dept" id="dept"> -->
        <br>
          ঢাকা বিশ্ববিদ্যালয়
        <br>
          ঢাকা
        </div>

        <div class="in">
              মহোদয়,
        </div>
        <div class="intro">

          আপনাকে জানাইতেছি যে, আপনি <span id="dept_show"></span> 

          <select>
            <option value="বিভাগের">
              বিভাগের
            </option>
            <option value="ইনস্টিটিউটের">
              ইনস্টিটিউটের 
            </option>
          </select>


          <select name="year" id="ddlYears"></select>
        
          
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
          </script> 

          সনের 
          <input type="text" name="method" id="method">
          <input onblur="batch()" type="text" name="batch" id="batch"> ব্যাচ, 
          <input onblur="years()" type="text" name="years" id="years"> বর্ষ 
          <input onblur="exam()" type="text" name="exam" id="exam"> পরীক্ষা কমিটির সভাপতি নিযুক্ত হইয়াছেন | উক্ত পরীক্ষা কমিটি নিন্মলিখিত ভাবে গঠিত হইয়াছে |
        </div>
      </div>

      <div class="middle">
        <u><span id="batch_show" name="batch_show"></span> ব্যাচ, <span id="years_show" name="years_show"></span> বর্ষ <span id="batch_show" name="batch_show"></span> অনার্স পরীক্ষা কমিটি-২০২০(সেমিস্টার পদ্ধতিতে) </u>
      </div>

      <div class="in">
        ১।<span name="teacher_1" id="teacher_1"></span>, <span id="teacher_dept_1" name="teacher_dept_1"></span>, ঢঃ বিঃ -------------------- সভাপতি
        <br>
        ২।<input type="text" name="teacher_2" id="teacher_2">, <span id="teacher_dept_2" name="teacher_dept_2"></span>, ঢঃ বিঃ, -------------------- সদস্য 
        <br>
        ৩।<input type="text" name="teacher_3" id="teacher_3">, <span id="teacher_dept_3" name="teacher_dept_3"></span>, ঢঃ বিঃ, -------------------- সদস্য 
        <br>
        ৪।<input type="text" name="teacher_4" id="teacher_4">, <input type="text" name="teacher_dept_4" id="teacher_dept_4">, <input type="text" name="teacher_versity_4" id="teacher_versity_4"> -------------------- <input type="text" name="teacher_designation_4" id="teacher_designation_4">
        
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
      <br>
      <br>
      <br>
      <br>
  </div>
  <br>
  <div class="submit">
      <input type="submit"  value="Done">
  </div>
</form>
<script type="text/javascript">
  function teacher(){
    var teacher = $("#teacher").val();
    $("#teacher_1").text(teacher);
  }

  function dept(){
    var dept = $("#dept").val();
    $("#teacher_dept_1").text(dept);
  }
</script>
</body>
</html>