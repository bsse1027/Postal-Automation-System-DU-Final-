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


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<link href="http://www.jqwidgets.com/jquery-widgets-demo/jqwidgets/styles/jqx.base.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="http://www.jqwidgets.com/jquery-widgets-demo/jqwidgets/jqxcore.js"></script>
<script src="http://www.jqwidgets.com/jquery-widgets-demo/jqwidgets/jqxscrollbar.js"></script>
<script src="http://www.jqwidgets.com/jquery-widgets-demo/jqwidgets/jqxlistbox.js"></script>
<script src="http://www.jqwidgets.com/jquery-widgets-demo/jqwidgets/jqxbuttons.js"></script>
<script src="http://www.jqwidgets.com/jquery-widgets-demo/jqwidgets/jqxcombobox.js"></script>

</head>
<body>

<?php
    session_start();
    ?>
<form action="committee_pdf.php" method="post">
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
        <p>মেমো নংঃ 

<?php


    $sql="SELECT * FROM memo ORDER BY id DESC LIMIT 1";
    $result=mysqli_query($link,$sql);

    //echo "Error message = ".mysqli_error($link);

    if ($result)
    {
        if (mysqli_num_rows($result) > 0)
        {
            while($row=mysqli_fetch_array($result)) { 
                //echo $row['memo'];
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
    $_SESSION['memo'] =$memo;
?>/শা-৫/প</p>

            
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
      <!-- <input id="memo" name="memo" type="hidden" value="<?php echo $memo?>"> -->
      <input id="date" name="date" type="hidden" value="<?php echo $date?>">
      <div>
        <div class="in teacher">
          <script type="text/javascript">
            function deptartment() {
                var val = $("#dept").val();
                data = val.split("|");
                $("#teacher_dept_1").text(data[1]);
                $("#teacher_dept_2").text(data[1]);
                $("#teacher_dept_3").text(data[1]);

                $.ajax({
                type: "POST",
                url: "ajax4.php",
                
                data:'tid='+val,
                success: function(data){
                    $("#teacher_1").html(data);
                    $("#teacher_2").html(data);
                    $("#teacher_3").html(data);

                    department_details(val);
                }
                });
            }

            function department_details(val){
              $.ajax({
                type: "POST",
                url: "<?php echo SERVER_URL?>staffLogin/letters/department_ajax.php",
                
                data:'id='+val,
                success: function(data){
                    //alert(data);
                    /*var data_explode = data.split("###");
                    $("#dept_name").val(data_explode[0]);
                    $("#faculty").val(data_explode[1]);
                    $("#dept_email").val(data_explode[2]);
                    if(data_explode[3]!=0){
                      $("#teacher_name").val(data_explode[4]);
                    }

                    $("#tid").val(data_explode[3]);
                    */

                    //chairman er email ta session a rakhte hobe then email korte hobe

                    var chairman_id = data_explode[3];


                    $.ajax({
                      type: "POST",
                      url: "ajax3.php",
                      
                      data:'tid='+chairman_id,
                      success: function(data){
                          data = data.split("###");
                          //$("#teacher_des_"+i).val(data[0]);
                          $("#chairman_email").val(data[1]);
                          $("#chairman_mob").val(data[2]);


                      }
                      });

                    
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

            function designation(i){
              var val = $("#teacher_"+i).val();
              $.ajax({
              type: "POST",
              url: "ajax3.php",
              
              data:'tid='+val,
              success: function(data){
                  data = data.split("###");
                  $("#teacher_des_"+i).val(data[0]);
                  $("#teacher_email_"+i).val(data[1]);
                  $("#teacher_mob_"+i).val(data[2]);
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
          <input type="hidden" name="chairman_email" id="chairman_email">
          <input type="hidden" name="chairman_mob" id="chairman_mob">
          <!-- <input onblur="teacher()" type="text" name="teacher" id="teacher"> -->
          <select id="teacher_type" name="teacher_type" onchange="teacher_type_change()">
            <option value="পরিচালক">পরিচালক</option>
            <option value="চেয়ারম্যান">চেয়ারম্যান</option>
            <option value="ডিন">ডিন</option>
          </select>

          <!-- <div id="types"></div>

                    
          <script type="text/javascript">
                    var data = [
                         {value: 'পরিচালক', label:'পরিচালক'},
                         {value: 'চেয়ারম্যান', label:'চেয়ারম্যান'},
                         {value: 'ডিন', label:'ডিন'}];
             
              jQuery("#types").jqxComboBox({theme: 'energyblue', width: 250, autoOpen: false, autoDropDownHeight: false, placeHolder: "পরিচালক", source: data});
          </script> -->

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

          <select style="display: none" name="faculty" id="faculty" onChange="faculty_change();">
            <option value="">Select Faculty</option>
            <?php
              $sql="SELECT DISTINCT id,name FROM faculty_table";
              $result=mysqli_query($link,$sql);
              while($row=mysqli_fetch_array($result)) { 
            ?>
              <option value="<?php echo $row["id"]."|".$row["name"]; ?>"><?php echo $row["name"]; ?>
              </option>
            <?php
              }
            ?>
          </select>
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

          আপনার <input type="text" id="start_date" name="start_date" placeholder="তারিখের"> তারিখের <input type="text" name="paper_no" id="paper_no"  placeholder="paper_no"> নং পত্রের বরাতে আপনাকে জানাইতেছি যে, <input type="text" name="subject" id="subject" placeholder="বিষয়ের"> বিষয়ের <input type="text" name="year" id="year"  placeholder="সনের"> 
          <select id="year_type" name="year_type">
            <option value="সনের">সনের</option>
            <option value="শিক্ষাবর্ষের">শিক্ষাবর্ষের</option>
          </select>
          <input type="text" name="exam" id="exam" placeholder="পরীক্ষা" >
          <input type="text" name="batch" id="batch" placeholder="ব্যাচ"> ব্যাচ
          <input type="text" name="years" id="years" placeholder="বর্ষ"> বর্ষ 
          <input type="text" name="sem" id="sem" placeholder="সেমিস্টার"> সেমিস্টার
            পরীক্ষার পরীক্ষা কমিটি নিম্নলিখিতভাবে 

           <select id="exam_type" name="exam_type">
            <option value="গঠনের">গঠনের</option>
            <option value="পুনঃগঠনের">পুনঃগঠনের</option>
           </select>

            জন্য বিভাগীয় একাডেমিক কমিটির সভায় সুপারিশ অনুমোদিত হইয়াছে।
        </div>
      </div>

      <div class="middle">
        <u><span id="batch_show" name="batch_show"></span> ব্যাচ, <span id="years_show" name="years_show"></span> বর্ষ <span id="batch_show" name="batch_show"></span> পরীক্ষার পরীক্ষা কমিটি </u>
      </div>

      <div class="in">
        ১।
        
        <select id="dept_1" name="dept_1" style="display: none" onChange="dept_change(1)">
            <option value="">Select teacher's Department</option>
        </select>

        <select id="teacher_1" name="teacher_1" onchange="designation(1)">
            <option value="">Select teacher's name</option>
        </select>
        <input type="text" name="teacher_des_1" id="teacher_des_1">
        <input required type="text" name="teacher_email_1" id="teacher_email_1">
        <input type="text" name="teacher_mob_1" id="teacher_mob_1">
        , <span id="teacher_dept_1" name="teacher_dept_1"></span>, ঢাঃ বিঃ -------------------- সভাপতি
        <br>
        ২।

        <select id="dept_2" name="dept_2" style="display: none" onChange="dept_change(2)">
            <option value="">Select teacher's Department</option>
        </select>

        <select id="teacher_2" name="teacher_2" onchange="designation(2)">
            <option value="">Select teacher's name</option>
        </select>
        <input type="text" name="teacher_des_2" id="teacher_des_2">
        <input required type="text" name="teacher_email_2" id="teacher_email_2">
        <input type="text" name="teacher_mob_2" id="teacher_mob_2">
        , <span id="teacher_dept_2" name="teacher_dept_2"></span>, ঢাঃ বিঃ, -------------------- সদস্য 
        <br>
        ৩।

        <select id="dept_3" name="dept_3" style="display: none" onChange="dept_change(3)">
            <option value="">Select teacher's Department</option>
        </select>

        <select id="teacher_3" name="teacher_3" onchange="designation(3)">
            <option value="">Select teacher's name</option>
        </select>
        <input type="text" name="teacher_des_3" id="teacher_des_3">
        <input required type="text" name="teacher_email_3" id="teacher_email_3">
        <input type="text" name="teacher_mob_3" id="teacher_mob_3">
        , <span id="teacher_dept_3" name="teacher_dept_3"></span>, ঢাঃ বিঃ, -------------------- সদস্য 
        <br>
        ৪।<input type="text" name="teacher_4" id="teacher_4" placeholder="name">,<input type="text" name="teacher_des_4" id="teacher_des_4" placeholder="designation">,<input required type="text" name="teacher_email_4" id="teacher_email_4" placeholder="email">,<input type="text" name="teacher_mob_4" id="teacher_mob_4">, <input type="text" name="teacher_dept_4" id="teacher_dept_4" placeholder="department">, <input type="text" name="teacher_versity_4" id="teacher_versity_4" placeholder="university"> -------------------- বহিঃসদস্য
        
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <div class="submit">
      <input type="submit" class="btn-lg btn-primary" value="NEXT">
      
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