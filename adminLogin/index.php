<?php 

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

?>

<?php

  $errorMessage="";
  $errorNo=0;
  $curDate=date("Y-m-d");



  

  $tempQuery="
  
  SELECT * FROM `signed_teacher`
  WHERE status=0;
  
  
  ";

  $result=mysqli_query($link,$tempQuery);
  $pending=mysqli_num_rows($result);

  $tempQuery="
  
  SELECT * FROM `signed_teacher`
  
  
  ";

  $result=mysqli_query($link,$tempQuery);
  $signedUp=mysqli_num_rows($result);

  $tempQuery="
  
  SELECT * FROM `emails`
  WHERE send_date<=CURRENT_DATE()
  AND send_date>=DATE_ADD('$curDate', INTERVAL -6 DAY); 
  
  
  ";

  $result=mysqli_query($link,$tempQuery);
  $sentLetters=mysqli_num_rows($result);

  $tempQuery11="
  
  SELECT * FROM `emails`
  WHERE reply=1
  AND send_date<=CURRENT_DATE()
  AND send_date>=DATE_ADD('$curDate', INTERVAL -6 DAY)
  ;
  
  
  ";

  $result11=mysqli_query($link,$tempQuery11);
  $Replied_1week=mysqli_num_rows($result11);


  $tempQuery11="
  
  SELECT * FROM `emails`
  WHERE reply=0
  AND send_date<=CURRENT_DATE()
  AND send_date>=DATE_ADD('$curDate', INTERVAL -6 DAY)
  ;
  
  
  ";

  $result11=mysqli_query($link,$tempQuery11);
  $notReplied_1week=mysqli_num_rows($result11);

  
  
  

  $tempQuery11="
  
  SELECT * FROM `emails`
  WHERE reply=0;
  
  
  ";

  $result11=mysqli_query($link,$tempQuery11);
  $notReplied=mysqli_num_rows($result11);
  $reply_percentage=0;

  if($notReplied_1week+$Replied_1week>0)
  {
    $reply_percentage=(int)(($Replied_1week/($notReplied_1week+$Replied_1week))*100);
  }

  if($notReplied>0)
  {
    $errorNo++;
    $errorMessage=$errorMessage."<strong class='text-success'>($errorNo)</strong> You have <strong class=text-danger> ".$notReplied. "</strong> letter(s) which you haven't got a reply yet or might have reached deadline without getting a reply.Please,click the <a href='tables.php' class='btn btn-danger text-center' style='font-size:13px;'>Got Reply</a> button after getting replies.<br><br> ";
  }

  $tempQuery111="
  
  SELECT deadline FROM `emails`
  WHERE deadline<=DATE_ADD('$curDate', INTERVAL 2 DAY)
  AND deadline>=CURRENT_DATE()
  AND reply='0';
  
  
  ";

  $result111=mysqli_query($link,$tempQuery111);
  $reachingDeadline=mysqli_num_rows($result111);

  if($reachingDeadline>0)
  {
    $errorNo++;
    $errorMessage=$errorMessage."<div class='text-danger'><strong class='text-success'>($errorNo)</strong> You have <strong class=text-primary> ".$reachingDeadline. "</strong> letter(s) appraoching deadline in <strong class=text-primary>Two</strong> days.Please contact the concerned faculty as soon as possible. Please,click the <a href='tables.php' class='btn btn-danger text-center' style='font-size:13px;'>Got Reply</a> button if you have got replies.<br><br></div> ";
  }

  $tempQuery1111="
  
      SELECT deadline FROM `emails` 
      WHERE deadline<CURRENT_DATE()
      AND reply='0';
      
      
      ";

    $result1111=mysqli_query($link,$tempQuery1111);
    $reachedDeadline=mysqli_num_rows($result1111);

    if($reachedDeadline>0)
    {
      $errorNo++;
      $errorMessage=$errorMessage."<div class='text-danger'><strong class='text-success'>($errorNo)</strong><strong> You have <strong class=text-primary> ".$reachedDeadline. "</strong> letter(s) which have passsed Deadlies. Check <a href='tables.php'>Letters</a> and contact the concerned faculty.<br></strong> ";
    

    }

    $tempQuery="
  
  SELECT * FROM `emails`
  WHERE send_date=DATE_ADD('$curDate', INTERVAL -6 DAY);
  
  
  ";

  $result=mysqli_query($link,$tempQuery);
  $row7=mysqli_num_rows($result);


    $tempQuery="
  
  SELECT * FROM `emails`
  WHERE send_date=DATE_ADD('$curDate', INTERVAL -5 DAY);
  
  
  ";

  $result=mysqli_query($link,$tempQuery);
  $row6=mysqli_num_rows($result);

  $tempQuery="
  
  SELECT * FROM `emails`
  WHERE send_date=DATE_ADD('$curDate', INTERVAL -4 DAY);
  
  
  ";

  $result=mysqli_query($link,$tempQuery);
  $row5=mysqli_num_rows($result);

  $tempQuery="
  
  SELECT * FROM `emails`
  WHERE send_date=DATE_ADD('$curDate', INTERVAL -3 DAY);
  
  
  ";

  $result=mysqli_query($link,$tempQuery);
  $row4=mysqli_num_rows($result);

  $tempQuery="
  
  SELECT * FROM `emails`
  WHERE send_date=DATE_ADD('$curDate', INTERVAL -2 DAY);
  
  
  ";

  $result=mysqli_query($link,$tempQuery);
  $row3=mysqli_num_rows($result);

  $tempQuery="
  
  SELECT * FROM `emails`
  WHERE send_date=DATE_ADD('$curDate', INTERVAL -1 DAY);
  
  
  ";

  $result=mysqli_query($link,$tempQuery);
  $row2=mysqli_num_rows($result);

  $tempQuery="
  
  SELECT * FROM `emails`
  WHERE send_date=CURRENT_DATE()
  
  
  ";

  $result=mysqli_query($link,$tempQuery);
  $row1=mysqli_num_rows($result);

  $tempQuery11="
  
  SELECT * FROM `emails`
  WHERE deadline<CURRENT_DATE
  AND deadline>=DATE_ADD('$curDate', INTERVAL -6 DAY)
  AND reply='0'
  ;
  
  
  ";

  $result11=mysqli_query($link,$tempQuery11);
  $deadline_1week=mysqli_num_rows($result11);

  if(isset($_GET['error']))
  {
    echo '<script type="text/javascript"> alert("Mail was not sent succesfully") </script>';
  }










?>


<!DOCTYPE html>
<html lang="en">

<head>

  <?php include BASE_URL."adminLogin/include/head.php"; ?> 

</head>

<body id="page-top">

  <div id="wrapper">

    <?php include BASE_URL."adminLogin/include/sidebar.php"; ?> 

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

       <?php include BASE_URL."adminLogin/include/header.php"; ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Bigger Notification-->

          <!-- Content Row -->
          <div class="row">

            <!-- Signed Up Faculty -->
            <div style="cursor: pointer;" onclick="window.location='verify.php';" class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Signed up Teachers</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $signedUp; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div style="cursor: pointer;" onclick="window.location='verify.php';" class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pending Verification(s)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $pending; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sent Letters (last 7 days)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "$sentLetters"; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-fw fa-envelope fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Replies Got(last 7 days)</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $reply_percentage."%"; ?></div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width:<?php echo $reply_percentage.'%'; ?>" aria-valuenow="<?php echo $reply_percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div> 
          
          <?php if(!empty($errorMessage)) { ?>
          
          <div>
            

          <div class="card shadow mb-4 col-md-12">
              <div class="card-header py-3">
                
                <h6 class="m-0 font-weight-bold text-danger text-center">Alert!</h6>
              </div>
              <div class="card-body text-center text-primary">
                <?php echo $errorMessage ?>
              </div>
            </div>


          </div>
        
          
        <?php }; ?>

            

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Letter Stats(Last 7 Days)</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-bar">
                    <canvas id="myBarChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Letters Overview(Last 7 Days)</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small" style="font-size: 10px;">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Sent Letter(s)
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Repliable Letter(s)
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Replie(s) Got
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-danger"></i> Deadline Reached
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

              

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include BASE_URL."adminLogin/include/footer.php"; ?> 
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php include BASE_URL."adminLogin/include/script.php"; ?> 


  <!-- Page level plugins -->
  <script src="<?php echo SERVER_URL?>resources/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <!-- <script src="js/demo/chart-bar-demo.js"></script> -->
  <script>

                  // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
          // *     example: number_format(1234.56, 2, ',', ' ');
          // *     return: '1 234,56'
          number = (number + '').replace(',', '').replace(' ', '');
          var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
              var k = Math.pow(10, prec);
              return '' + Math.round(n * k) / k;
            };
          // Fix for IE parseFloat(0.55).toFixed(0) = 0;
          s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
          if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
          }
          if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
          }
          return s.join(dec);
        }

        // Bar Chart Example
        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ["<?php echo date("Y/m/d") ?>", "<?php echo date('Y-m-d', strtotime("-1 days")); ?>", "<?php echo date('Y-m-d', strtotime("-2 days")); ?>", "<?php echo date('Y-m-d', strtotime("-3 days")); ?>", "<?php echo date('Y-m-d', strtotime("-4 days")); ?>", "<?php echo date('Y-m-d', strtotime("-5 days")); ?>","<?php echo date('Y-m-d', strtotime("-6 days")); ?>"],
            datasets: [{
              label: "Letter(s) Sent",
              backgroundColor: "#4e73df",
              hoverBackgroundColor: "#2e59d9",
              borderColor: "#4e73df",
              data: [<?php echo $row1.','.$row2.','.$row3.','.$row4.','.$row5.','.$row6.','.$row7; ?>],
            }],
          },
          options: {
            maintainAspectRatio: false,
            layout: {
              padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
              }
            },
            scales: {
              xAxes: [{
                time: {
                  unit: 'date'
                },
                gridLines: {
                  display: false,
                  drawBorder: false
                },
                ticks: {
                  maxTicksLimit: 7
                },
                maxBarThickness: 20,
              }],
              yAxes: [{
                ticks: {
                  min: 0,
                  max: 100,
                  maxTicksLimit: 20,
                  padding: 10,
                  
                  
                },
                gridLines: {
                  color: "rgb(234, 236, 244)",
                  zeroLineColor: "rgb(234, 236, 244)",
                  drawBorder: false,
                  borderDash: [2],
                  zeroLineBorderDash: [2]
                }
              }],
            },
            legend: {
              display: false
            },
            tooltips: {
              titleMarginBottom: 10,
              titleFontColor: '#6e707e',
              titleFontSize: 14,
              backgroundColor: "rgb(255,255,255)",
              bodyFontColor: "#858796",
              borderColor: '#dddfeb',
              borderWidth: 1,
              xPadding: 15,
              yPadding: 15,
              displayColors: false,
              caretPadding: 10,
              
            },
          }
        });





  </script>

  <script>
    // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Sent Letters", "Repliable Letters", "Replies Got","Deadlines Reached"],
    datasets: [{
      data: [<?php echo $sentLetters.','.($Replied_1week+$notReplied_1week).','.$Replied_1week.','.$deadline_1week; ?>],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc','#ff0000'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf','#CA3F21'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

  </script>

</body>

</html>
