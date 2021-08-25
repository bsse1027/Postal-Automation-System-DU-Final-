<?php 

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

?>

<!DOCTYPE html>
<html>
<head>
  <title>Committee Letter</title>
  <link rel="stylesheet" href="<?php echo SERVER_URL?>resources/css/committee.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
   <script type="text/javascript" src="<?php echo SERVER_URL?>resources/js/ckeditor/ckeditor.js"></script>
  
</head>
<body>
<form action="template_pdf.php" method="post">
  <div class="container">
    <div class="w">
      <div class="row">
        <div class="column address">
            <strong>পরীক্ষা নিয়ন্ত্রকের অফিস</strong><br>
            <strong>ঢাকা বিশ্ববিদ্যালয়</strong><br>
            ফোনঃ(অফিস)৮৬১৩২৮০<br>
            ৯৬৬১৯০০-৫৯/৪০৮০<br>
            ফ্যাক্সঃ৮৮০-২-৯৬৬৭২২২<br>
        </div>

        <div class="column image">
             <img src="<?php echo SERVER_URL?>resources/img/DhakaUniversity.jpg" width="80" height="100">
        </div>

        <div class="column addresses">
            <strong>OFFICE OF THE CONTROLLER OF EXAMINATIONS</strong><br>
            UNIVERSITY OF DHAKA<br>
            DHAKA-1000, BANGLADESH<br>
            Phone : (off.) 8613280<br>
            9661900-59/4080<br>
            Fax : 88-02-9667222<br>
            Email: co_letter@du.ac.bd
        </div>

      </div>

      <div class="row">
        <div class="in column right1">
          মেমো নংঃ 

          <?php
              session_start();

              $sql="SELECT * FROM memo ORDER BY id DESC LIMIT 1";
              $result=mysqli_query($link,$sql);
              //echo $sql;
              //echo "Error message = ".mysqli_error($link);

              if ($result)
              {
                  if (mysqli_num_rows($result) > 0)
                  {
                      while($row=mysqli_fetch_array($result)) { 
                          //echo $row['memo_no'];
                          $memo = $row['memo_no']+1;
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
        $_SESSION['memo'] = $memo;      
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
                data = val.split("|");


                $.ajax({
                type: "POST",
                url: "ajax4.php",
                
                data:'tid='+val,
                success: function(data){
                    $("#teacher").html(data);
                }
                });
            }

            function teacher_type_change(){
              var val = $("#teacher_type").val();
              if(val=="ডিন"){
                $("#faculty").show();
                $("#dept").hide();
                $("#dept_1").show();
                $("#dept_2").show();
                $("#dept_3").show();
              }
              else{
                $("#dept").show();
                $("#faculty").hide();
                $("#dept_1").hide();
                $("#dept_2").hide();
                $("#dept_3").hide();
              }

            }

            function designation(){
              var val = $("#teacher").val();
              $.ajax({
              type: "POST",
              url: "ajax3.php",
              data:'tid='+val,
              success: function(data){
                  data = data.split("###");
                  $("#teacher_des").val(data[0]);
                  $("#teacher_email").val(data[1]);
                  $("#teacher_mob").val(data[2]);
              }
              });

            }

            function faculty_change(){
              var val = $("#faculty").val();
              $.ajax({
              type: "POST",
              url: "ajax5.php",
              
              data:'fid='+val,
              success: function(data){

                  $("#dept_1").html(data);
                  $("#dept_2").html(data);
                  $("#dept_3").html(data);
              }
              });
            }

            function dept_change(i){
              var val = $("#dept_"+i).val();
              //alert(val);
              $.ajax({
              type: "POST",
              url: "ajax4.php",
              data:'tid='+val,
              success: function(data){
                //alert(data);
                  $("#teacher_"+i).html(data);
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
          <select id="teacher" name="teacher" onchange="designation()">
            <option value="">Select teacher's name</option>
          </select>
          <input type="text" name="teacher_des" id="teacher_des">
          <input type="text" name="teacher_email" id="teacher_email">
          <input type="text" name="teacher_mob" id="teacher_mob">
        <br>


        <br>
          <!-- <input onblur="dept()" type="text" name="dept" id="dept"> -->
        <br>
          ঢাকা বিশ্ববিদ্যালয়
        <br>
          ঢাকা - ১০০০ <span style='font-size: 10px;'>|</span>
        </div>
        <div class="in">
              মহোদয়,
        </div>
        <div class="intro">
          <br>

          <!-- <h6>Some Tag and Code for design template properly: </h6>

          <p>A commonly used entity in HTML is the non-breaking space: <strong>&amp;nbsp;</strong></p>

          <p>Use the <code class="w3-codespan">&lt;br&gt;</code> tag to enter line breaks, </p> -->

        <!-- <textarea id="template" name="template" class="form-control"></textarea> -->


        <textarea class="ckeditor" name="template" rows="5" cols="28" style="width:349px;" id="template" ></textarea>

        <script type="text/javascript">
            CKEDITOR.replace('template');
        </script>

        </div>
          
      </div>

      <br>
      <br>
      

     

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <div class="submit">
      <input type="submit" class="btn-lg btn-primary" value="NEXT">
      
  </div>
</form>
</body>
</html>