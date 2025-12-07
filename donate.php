<?php
require 'functions/Controller.php';
$Controller = new Controller;

if ( isset($_GET['cause']) ) {
  $cause_id = $_GET['cause'];
}else {
  header('Location: causes');
}
$row = $Controller->single_cause($cause_id);

$percent = ($row['amount_raised'] / $row['amount']) * 100;
$percent = round($percent);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <link rel="icon" href="assets/favicon.ico" type="image/ico">
  <title>CharityHub - Donate to <?php echo $row['title']; ?></title>

  <link rel="stylesheet" href="assets/css/icons.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="assets/css/animate.min.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/fancybox.min.css">
  <link rel="stylesheet" href="assets/css/perfect-scrollbar.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <link rel="stylesheet" href="assets/css/color.css">

  <!-- REVOLUTION STYLE SHEETS -->
  <link rel="stylesheet" href="assets/css/revolution/settings.css">
  <!-- REVOLUTION LAYERS STYLES -->
  <link rel="stylesheet" href="assets/css/revolution/layers.css">
  <!-- REVOLUTION NAVIGATION STYLES -->
  <link rel="stylesheet" href="assets/css/revolution/navigation.css">
  <style>
  .page-header {
    position: relative;
  }
  .page-header:after {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.3);
  }
  .page-header .page-title {
    margin-top: 200px;
    position: relative;
    z-index: 1;
  }
  </style>
</head>
<body itemscope>
  <main>
    <!-- Page Loader -->
    <!-- <div class="page-loader">
      <div class="loader">
        <div class='loader-style-1 panelLoad'>
          <div class='cube-face cube-face-front'>G</div>
          <div class='cube-face cube-face-back'>O</div>
          <div class='cube-face cube-face-left'>F</div>
          <div class='cube-face cube-face-right'>U</div>
          <div class='cube-face cube-face-bottom'>N</div>
          <div class='cube-face cube-face-top'>D</div>
        </div>
        <span class="cube-face">CharityHub</span>
      </div>
    </div> -->

    <!-- Header -->
    <header class="style1 stick flex">
      <?php include 'inc/navbar.php'; ?>
    </header>

    <!-- Sticky Header -->
    <div class="sticky-header flex">
      <?php include 'inc/navbar.php'; ?>
    </div>

    <!-- Mobile Header -->
    <?php include 'inc/mobile-navbar.php'; ?>

    <!-- Page header -->
    <section class="page-header">
      <div class="block no-padding" style="height:300px;overflow:hidden;">
      <div class="pg-tp-bg" style="background-image: url(assets/images/pg-tp-bg1.jpg);">
        <h1 class="container page-title text-white">Donate Now</h1>
      </div>
      </div>
    </section>

    <!-- Breadcrumbs Wrap -->
    <div class="gray-bg3 brdcrmb-wrp">
      <div class="container">
        <div class="brdcrmb-inr flex justify-content-between">
          <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index" title="" itemprop="url">Home</a></li>
          <li class="breadcrumb-item"><a href="causes" title="" itemprop="url">Causes</a></li>
          <li class="breadcrumb-item active">Donate Now</li>
          </ol>
        </div>
      </div>
    </div>

    <section>
      <div class="block">
        <div class="container">
          <div class="dnt-wrp">
            <div class="dnt-titl">
              <div class="row">
                <div class="col-sm-3 my-auto">
                  <img src="assets/images/resources/<?php echo $row['banner']; ?>" class="w-100 mb-3">
                </div>
                <div class="col-sm-9 my-auto cus-dtl-inf">
                  <h4 class=""><?php echo $row['title']; ?></h4>
                  <p class="mb-3"><span class="cus-amt"><i class="thm-clr">$<?php echo number_format($row['amount_raised']); ?> Raised</i> of $<?php echo number_format($row['amount']); ?></span></p>
                  <div class="progress mb-3">
                    <div class="progress-bar thm-bg" style="width:<?php echo $percent.'%'; ?>;"><span><?php echo $percent.'%'; ?></span></div>
                  </div>
                  <ul class="cus-mta">
                    <li><i class="fa fa-calendar"></i><?php echo date('d M, Y', strtotime($row['cause_date'])); ?></li>
                    <li><i class="flaticon-user"></i><?php echo $row['donors']; ?> Donors</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="dnt-frm-wrp">
              <h4 itemprop="headline">Donate Now For Helping CharityHub People?</h4>
              <form class="pt-4">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-lg-12">
                    <!-- <div class="w-100 p-2 d-flex border bg-white mb-3">
                      <img src="assets/images/pymnt-mthd-img2.jpg"
                        style="height:40px;"
                        class="my-auto" 
                      />
                      <div class="my-auto pl-2" style="line-height:1em;">
                        <small class="d-block mb-1">Paypal</small>
                        <b class="d-block m-0">johnmele@gmail.com</b>
                      </div>
                    </div> -->
                <?php
                  foreach ($Controller->payment_info() as $key => $value) {
                    ?>
                    <div class="w-100 mb-3">
                      <div class="payment-item bg-white h-100 w-100 border d-flex p-2">
                        <img src="assets/images/<?php echo $value['icon']; ?>"
                          style="height:40px;"
                          class="my-auto" 
                        />
                        <div class="my-auto pl-2 w-100" style="line-height:1em;">
                          <b class="d-block mb-1"><?php echo $value['tag']; ?></b>
                          <small class="d-block"><?php echo $value['name']; ?></small>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                ?>
                    <!-- <div class="w-100 p-3 d-flex border bg-white">
                      <img src="assets/images/pymnt-mthd-img1.jpg" style="width:120px;" />
                      <p class="my-auto pl-2 h6">Credit/Debit cards</p>
                    </div> -->
                  </div>
                  <div class="col-md-12 col-sm-12 col-lg-12">
                    <span class="dnt-fld2">
                      <i>$</i>
                      <input type="text"
                        id="priceInput" value="0"
                        style="font-size:2em;padding-left:80px;color:#aaa;"
                      />
                    </span>
                    <ul class="dnt-prc-lst">
                      <li><span onclick="$('#priceInput').val(50)">$50</span></li>
                      <li><span onclick="$('#priceInput').val(100)">$100</span></li>
                      <li><span onclick="$('#priceInput').val(200)">$200</span></li>
                      <li><span onclick="$('#priceInput').val(500)">$500</span></li>
                      <li><span onclick="$('#priceInput').val(700)">$700</span></li>
                      <li><span onclick="$('#priceInput').val(1000)">$1000</span></li>
                      <!-- <li><a class="thm-btn" href="javascript:void(0)" onclick="$('#priceInput').focus()" title="" itemprop="url">Custom Amount<span></span></a></li> -->
                    </ul>
                  </div>
                  <div class="col-md-12 col-sm-12 col-lg-12">
                    <!-- <div class="pymnt-mthd">
                      <span class="cstm-rdo">
                      <input type="radio" id="pymnt-mthd1" name="pymnt-mthd">
                      <label for="pymnt-mthd1"><img src="assets/images/pymnt-mthd-img1.jpg" alt="pymnt-mthd-img1.jpg" itemprop="image"></label>
                      </span>
                      <span class="cstm-rdo">
                      <input type="radio" id="pymnt-mthd2" name="pymnt-mthd">
                      <label for="pymnt-mthd2"><img src="assets/images/pymnt-mthd-img2.jpg" alt="pymnt-mthd-img2.jpg" itemprop="image"></label>
                      </span>
                    </div> -->
                    <span class="dnt-fld3">
                      <label>Email address</label>
                      <span class="dnt-fld-inr">
                      <input type="email" placeholder="Enter email">
                      </span>
                    </span>
                  </div>
                  <div class="col-md-12 col-sm-12 col-lg-12">
                  <span class="dnt-fld3">
                    <button class="thm-btn" type="submit">Submit Donation<span></span></button>
                  </span>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <?php include 'inc/footer.php'; ?>
  </main>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/bootstrap-select.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/fancybox.min.js"></script>
  <script src="assets/js/wow.min.js"></script>
  <script src="assets/js/perfectscrollbar.min.js"></script>
  <script src="assets/js/scroll-up-bar.min.js"></script>
  <script src="assets/js/custom-scripts.js"></script>

  <script src="assets/js/revolution/jquery.themepunch.tools.min.js"></script>
  <script src="assets/js/revolution/jquery.themepunch.revolution.min.js"></script>

  <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->  
  <script src="assets/js/revolution/extensions/revolution.extension.actions.min.js"></script>
  <script src="assets/js/revolution/extensions/revolution.extension.carousel.min.js"></script>
  <script src="assets/js/revolution/extensions/revolution.extension.kenburn.min.js"></script>
  <script src="assets/js/revolution/extensions/revolution.extension.layeranimation.min.js"></script>
  <script src="assets/js/revolution/extensions/revolution.extension.migration.min.js"></script>
  <script src="assets/js/revolution/extensions/revolution.extension.navigation.min.js"></script>
  <script src="assets/js/revolution/extensions/revolution.extension.parallax.min.js"></script>
  <script src="assets/js/revolution/extensions/revolution.extension.slideanims.min.js"></script>
  <script src="assets/js/revolution/extensions/revolution.extension.video.min.js"></script>
  <script src="assets/js/revolution/revolution-init.js"></script>
</body>
</html>