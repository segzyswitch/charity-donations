<?php
require 'functions/Controller.php';
$Controller = new Controller;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <link rel="icon" href="assets/images/favicon.png" sizes="32x32" type="image/png">
  <title>CharityHub - Recent donations</title>

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
    background-color: rgba(0,0,0,0.4);
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
    <div class="page-loader">
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
    </div>

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

    <!-- Page Header -->
    <section class="page-header">
      <div class="block no-padding" style="height:300px;overflow:hidden;">
      <div class="pg-tp-bg" style="background-image: url(assets/images/pg-tp-bg1.jpg);">
        <h1 class="container page-title text-white">Recent donations</h1>
      </div>
      </div>
    </section>
    <!-- Breadcrumbs Wrap -->
    <div class="gray-bg3 brdcrmb-wrp">
      <div class="container">
      <div class="brdcrmb-inr flex justify-content-between">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index" title="" itemprop="url">Home</a></li>
        <li class="breadcrumb-item active">Donations</li>
        </ol>
      </div>
      </div>
    </div>

    <!-- Causes -->
    <section>
      <div class="block">
        <div class="container">
          <div class="cus-wrp remove-ext5">
            <div class="row">
              <?php
              foreach ($Controller->causes() as $key => $value) {
                $percent = ($value['amount_raised'] / $value['amount']) * 100;
                $percent = round($percent);
                ?>
              <div class="col-md-4 col-sm-6 col-lg-4">
                <div class="cus-bx">
                  <div class="cus-thmb">
                    <img src="assets/images/resources/<?php echo $value['banner']; ?>" alt="<?php echo $value['title']; ?>" itemprop="image">
                    <a class="thm-btn" href="donate?cause=<?php echo $value['cause_id']; ?>" title="" itemprop="url">Donate Now<span></span></a>
                  </div>
                  <div class="cus-inf">
                    <ul class="cus-mta">
                      <!-- <li><i class="fa fa-calendar"></i><?php echo date('d M, Y', strtotime($value['cause_date'])); ?></li> -->
                      <li><i class="flaticon-user"></i><?php echo $value['donors']; ?> Donors</li>
                    </ul>
                    <h4 itemprop="headline">
                      <a href="cause-detail?cause=<?php echo $value['cause_id']; ?>"><?php echo $value['title']; ?></a>
                    </h4>
                    <div class="progress">
                      <div class="progress-bar thm-bg" style="width:<?php echo $percent.'%'; ?>;"><span><?php echo $percent.'%'; ?></span></div>
                    </div>
                    <span class="cus-amt"><i class="thm-clr">$<?php echo number_format($value['amount_raised']); ?> Raised</i> of $<?php echo number_format($value['amount']); ?></span>
                  </div>
                </div>
              </div>
                <?php
              }
              ?>
            </div>
          </div>
          <!-- <div class="pgntin-wrp text-center">
            <ul class="pagination">
              <li class="page-item"><a class="page-link prev" href="#" title="" itemprop="url"><i class="fa fa-angle-left"></i></a></li>
              <li class="page-item"><a class="page-link" href="#" title="" itemprop="url">1</a></li>
              <li class="page-item active"><span class="page-link">2</span></li>
              <li class="page-item"><a class="page-link" href="#" title="" itemprop="url">3</a></li>
              <li class="page-item">......</li>
              <li class="page-item"><a class="page-link" href="#" title="" itemprop="url">12</a></li>
              <li class="page-item"><a class="page-link next" href="#" title="" itemprop="url"><i class="fa fa-angle-right"></i></a></li>
            </ul>
          </div> -->
        </div>
      </div>
    </section>

    <!-- Country counter -->
    <section>
      <div class="block gray-layer opc7">
      <div class="fixed-bg gray-bg back-blend-multiply" style="background-image: url(assets/images/prlx-bg11.jpg);"></div>
      <div class="container">
        <div class="we-hlp-wrp">
        <div class="row align-items-center">
          <div class="col-md-4 col-sm-12 col-lg-4">
          <div class="we-hlp-titl">
            <h2 itemprop="headline">Where We Help</h2>
            <p itemprop="description">Children's Villages works in 136 countries and territories around the world</p>
          </div>
          </div>
          <div class="col-md-8 col-sm-12 col-lg-8">
          <div class="cntry-hlp-wrp">
            <div class="cntry-hlp-car owl-carousel">
            <div class="cntry-hlp-bx">
              <div class="cntry-hlp-tp">
              <h6 itemprop="headline">Philippines</h6>
              <img src="assets/images/resources/flg-img1.jpg" alt="flg-img1.jpg" itemprop="image">
              </div>
              <div class="cntry-hlp-md">
              <span>Population: <i>741.4 Million</i></span>
              <span>CharityHuby: <i>17.3 percent</i></span>
              <strong>Donated:<span>$123010</span></strong>
              </div>
              <a class="thm-btn2" href="causes" title="" itemprop="url">Donate Now</a>
            </div>
            <div class="cntry-hlp-bx">
              <div class="cntry-hlp-tp">
              <h6 itemprop="headline">Europe</h6>
              <img src="assets/images/resources/flg-img2.jpg" alt="flg-img2.jpg" itemprop="image">
              </div>
              <div class="cntry-hlp-md">
              <span>Population: <i>741.4 Million</i></span>
              <span>CharityHuby: <i>17.3 percent</i></span>
              <strong>Donated:<span>$123010</span></strong>
              </div>
              <a class="thm-btn2" href="causes" title="" itemprop="url">Donate Now</a>
            </div>
            <div class="cntry-hlp-bx">
              <div class="cntry-hlp-tp">
              <h6 itemprop="headline">UAE</h6>
              <img src="assets/images/resources/flg-img3.jpg" alt="flg-img3.jpg" itemprop="image">
              </div>
              <div class="cntry-hlp-md">
              <span>Population: <i>741.4 Million</i></span>
              <span>CharityHuby: <i>17.3 percent</i></span>
              <strong>Donated:<span>$123010</span></strong>
              </div>
              <a class="thm-btn2" href="causes" title="" itemprop="url">Donate Now</a>
            </div>
            </div>
          </div>
          </div>
        </div>
        </div><!-- Where We Help Wrap -->
      </div>
      </div>
    </section>
    
    <!-- Charity Organizations -->
    <section>
      <div class="block">
        <div class="container">
          <div class="sec-ttl v2 text-center">
            <div class="sec-ttl-inr">
            <h2 itemprop="headline">Charity Organizations Work In The Fundraising</h2>
            <span>Trusted by world-class organizations. he people of Equity Trust enable.</span>
            </div>
          </div><!-- Sec Title Style 2 -->
          <div class="orgn-wrp2 remove-ext3 text-center">
            <div class="row">
            <div class="col-md-4 col-sm-4 col-lg-4">
              <div class="orgn-bx2">
              <img src="assets/images/resources/org-img2-1.png" alt="org-img2-1.png" itemprop="image">
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4">
              <div class="orgn-bx2">
              <img src="assets/images/resources/org-img2-2.png" alt="org-img2-2.png" itemprop="image">
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4">
              <div class="orgn-bx2">
              <img src="assets/images/resources/org-img2-3.png" alt="org-img2-3.png" itemprop="image">
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4">
              <div class="orgn-bx2">
              <img src="assets/images/resources/org-img2-4.png" alt="org-img2-4.png" itemprop="image">
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4">
              <div class="orgn-bx2">
              <img src="assets/images/resources/org-img2-5.png" alt="org-img2-5.png" itemprop="image">
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4">
              <div class="orgn-bx2">
              <img src="assets/images/resources/org-img2-6.png" alt="org-img2-6.png" itemprop="image">
              </div>
            </div>
            </div>
          </div><!-- Organization Wrap Style 2 -->
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