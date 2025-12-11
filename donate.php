<?php
require 'functions/Controller.php';
$Controller = new Controller;

if (isset($_GET['cause'])) {
  $cause_id = $_GET['cause'];
} else {
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
  <style>
    .page-header {
      position: relative;
    }

    .page-header:after {
      content: "";
      position: absolute;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.3);
    }

    .page-header .page-title {
      margin-top: 200px;
      position: relative;
      z-index: 1;
    }
    
    .payment-methods .payment-item {
      transition: all 0.3s ease;
    }
    .payment-methods input:checked + .payment-item {
      border-color: rgb(37, 194, 105)!important;
      background-color: rgb(37, 194, 105)!important;
      color: #fff;
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
                  <p class="mb-3"><span class="cus-amt"><i
                        class="thm-clr">$<?php echo number_format($row['amount_raised']); ?> Raised</i> of
                      $<?php echo number_format($row['amount']); ?></span></p>
                  <div class="progress mb-3">
                    <div class="progress-bar thm-bg" style="width:<?php echo $percent . '%'; ?>;">
                      <span><?php echo $percent . '%'; ?></span>
                    </div>
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
              <form class="pt-4" id="donationForm" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <p class="mb-2 px-3">Amount to donate:</p>
                  <div class="col-md-12 col-sm-12 col-lg-12 mb-4">
                    <span class="dnt-fld2 mt-0">
                      <i>$</i>
                      <input type="text"
                        name="amount"
                        id="priceInput"
                        value=""
                        style="font-size:2em;padding-left:80px;color:#aaa;"
                        required
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
                    <p class="mb-0">Select payment method:</p>
                    <?php
                    foreach ($Controller->payment_info() as $key => $value) {
                      ?>
                      <div class="payment-methods mb-0 mt-2" onclick="copyText('<?php echo $value['name']; ?>', '<?php echo $value['tag']; ?>')">
                        <input type="radio"
                          id="pymnt<?php echo $value['id']; ?>"
                          value="<?php echo $value['name']; ?>"
                          name="payment_method"
                          class="position-absolute"
                          style="opacity:0;"
                          required
                        />
                        <label for="pymnt<?php echo $value['id']; ?>"
                          class="bg-white border payment-item h-100 w-100 d-flex p-2">
                          <img src="assets/images/<?php echo $value['icon']; ?>" style="height:40px;" class="my-auto" />
                          <div class="my-auto pl-2" style="line-height:1em;max-width:75%;">
                            <b class="d-block mb-1"><?php echo $value['name']; ?></b>
                            <small class="d-block single-truncate"><?php echo $value['tag']; ?></small>
                          </div>
                          <div class="my-auto ml-auto">
                            <button class="btn p-0 bi bi-copy" type="button"></button>
                          </div>
                        </label>
                      </div>
                      <?php
                    }
                    ?>
                    <p class="small" id="paymentText"></p>
                  </div>
                  <div class="col-md-12 col-sm-12 col-lg-12">
                    <p class="mb-1">Upload reciept or payment files:</p>
                    <!-- Hidden Input -->
                    <input type="file" id="imagesInput" name="images[]" multiple accept="image/*" style="display:none;" />
                    <!-- Big Upload Button -->
                    <button type="button" class="w-100 btn bg-light border border-dashed py-5" id="uploadBtn">
                      <i class="bi bi-upload h1"></i>
                      <p class="mb-0 mt-3">Select image files</p>
                    </button>
                    <small id="limitMsg" class="text-danger py-1 d-block"></small>
                    <!-- Preview Area -->
                    <div id="previewArea" class="d-flex flex-wrap mt-3"></div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-lg-12">
                    <span class="dnt-fld3">
                      <label>Email address</label>
                      <span class="dnt-fld-inr">
                        <input type="email" name="email" placeholder="Enter email" required />
                      </span>
                    </span>
                  </div>
                  <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="w-100 feedback"></div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-lg-12">
                    <span class="dnt-fld3">
                      <input type="hidden" name="make_donation" />
                      <button class="thm-btn submit-btn" type="submit">Submit Donation<span></span></button>
                    </span>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="donateSuccess"  data-backdrop="static" data-keyboard="false"
      tabindex="-1" aria-labelledby="donateSuccessLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="donateSuccessLabel">Thank you</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h1 class="text-success text-center display-2"><i class="bi bi-check-circle"></i></h1>
            <p style="line-height:1.4em;" class="lead mb-2">Your donation has been received successfully. We appreciate your support! We will send you updates via your email.</p>
          </div>
          <div class="modal-footer d-flex">
            <a href="index" class="btn thm-btn m-auto">Go home</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include 'inc/footer.php'; ?>
  </main>

  <script src="assets/js/jquery.min.js"></script>
  <script>
    function copyText(name, input) {
      document.getElementById("paymentText").innerHTML =
        "Please send your donation through <b>" + name + "</b> and make sure to upload the payment receipt/images below";
      navigator.clipboard.writeText(input)
        .then(() => {
          // alert("Copied!");
        })
        .catch(err => {
          console.error("Failed to copy: ", err);
        });
    }
  </script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/bootstrap-select.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/fancybox.min.js"></script>
  <script src="assets/js/wow.min.js"></script>
  <script src="assets/js/perfectscrollbar.min.js"></script>
  <script src="assets/js/scroll-up-bar.min.js"></script>
  <script src="assets/js/custom-scripts.js"></script>
  <!-- <script src="assets/js/forms.js"></script> -->
  <script>
    // $('#donateSuccess').modal('show');
    const MAX_IMAGES = 5;       // 🔥 Set your limit
    let selectedFiles = [];     // Holds actual File objects

    document.getElementById('uploadBtn').addEventListener('click', () => {
      document.getElementById('imagesInput').click();
    });

    document.getElementById('imagesInput').addEventListener('change', function () {

      const newFiles = Array.from(this.files);

      // 🔥 Check limit before adding
      if (selectedFiles.length + newFiles.length > MAX_IMAGES) {
        document.getElementById("limitMsg").textContent =
          `You can only upload up to ${MAX_IMAGES} images.`;
        this.value = ""; // Reset input
        return;
      }

      document.getElementById("limitMsg").textContent = "";

      selectedFiles = selectedFiles.concat(newFiles);

      renderPreviews();
      this.value = ""; // Reset input so user can reselect
    });

    // Add donation
    $("#donationForm").on('submit', function(e){
      e.preventDefault();
      const formdata = new FormData(this);
      // Append selected files
      selectedFiles.forEach((file, index) => {
        formdata.append('images[]', file);
      });
      $.ajax({
        url: "functions/process.php",
        type: "POST",
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $("#donationForm .submit-btn").html("loading... <i class='fa fa-cog fa-spin'></i>");
        },
        success: function(data) {
          $("#donationForm .submit-btn").html("Submit");
          $("#donationForm .feedback").html(data);
          
          if ( data.search('success') !== -1 ) {
            $("#donationForm input").val("");
            // show success modal
            $('#donateSuccess').modal('show');
            // reset selected files
            selectedFiles = [];
            renderPreviews();
          }

        },
        error: function() {
          $("#donationForm .submit-btn").html("Submit");
          $("#donationForm .feedback").html("<div class='alert alert-danger'><i class='bi bi-exclamation-triangle'></i> Sorry, and error occured! <br /> Try again later.</div>");
        }
      });
    });

    function renderPreviews() {
      const previewArea = document.getElementById('previewArea');
      previewArea.innerHTML = "";

      selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function (e) {
          const box = document.createElement("div");
          box.className = "position-relative";
          box.style.width = "90px";
          box.style.height = "90px";
          box.style.margin = "5px";
          box.style.border = "1px solid #ddd";
          box.style.borderRadius = "4px";
          box.style.overflow = "hidden";

          box.innerHTML = `
                <img src="${e.target.result}" 
                     style="width:100%; height:100%; object-fit:cover;">
                <button class="btn btn-sm btn-danger"
                    style="position:absolute; top:2px; right:2px; padding:0px 5px;"
                    onclick="removeImage(${index})">×</button>
            `;

          previewArea.appendChild(box);
        };
        reader.readAsDataURL(file);
      });
    }

    function removeImage(index) {
      selectedFiles.splice(index, 1);
      renderPreviews();
    }
  </script>
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