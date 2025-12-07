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
  <title>CharityHub - <?php echo $row['title']; ?></title>

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

    <section class="page-header">
      <div class="block no-padding" style="height:300px;overflow:hidden;">
      <div class="pg-tp-bg" style="background-image: url(assets/images/pg-tp-bg1.jpg);">
        <h1 class="container page-title text-white">Cause Detais</h1>
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
        <li class="breadcrumb-item active">Causes Details</li>
        </ol>
      </div>
      </div>
    </div>

    <!-- Cause details -->
    <section>
      <div class="block">
      <div class="container">
        <div class="cus-dtl-thmb">
        <img src="assets/images/resources/<?php echo $row['banner']; ?>" alt="<?php echo $row['title']; ?>" itemprop="image">
        <div class="cus-dtl-dnt">Make a Difference Today <a class="thm-btn" href="donate?cause=<?php echo $row['cause_id']; ?>" title="" itemprop="url">Donate Now<span></span></a></div>
        </div>
        <div class="cus-dtl-wrp">
        <div class="cus-dtl-inf">
          <ul class="cus-mta">
          <li><i class="fa fa-calendar"></i><?php echo date('d M, Y', strtotime($row['cause_date'])); ?></li>
          <li><i class="flaticon-user"></i><?php echo $row['donors']; ?> Donors</li>
          </ul>
          <h1 itemprop="headline"><?php echo $row['title']; ?></h1>
          <div class="progress">
          <div class="progress-bar thm-bg" style="width:<?php echo $percent.'%'; ?>;"><span><?php echo $percent.'%'; ?></span></div>
          </div>
          <span class="cus-amt"><i class="thm-clr">$<?php echo number_format($row['amount_raised']); ?> Raised</i> of $<?php echo number_format($row['amount']); ?></span>
        </div>
        <p itemprop="description"><?php echo nl2br($row['details']); ?></p>
        <p><a class="thm-btn2" href="donate?cause=<?php echo $row['cause_id']; ?>">Donate Now<span></span></a></p>
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