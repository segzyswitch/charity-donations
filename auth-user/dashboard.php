<?php
require '../functions/Controller.php';
if ( !isset($_SESSION['charityDonationsAdmin']) ) {
  header("Location: index");
  exit;
}
$Controller = new Controller;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <link rel="icon" href="../assets/favicon.png">
  <title>CharityHub: Admin Dashboard</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <!-- Option 1: Include in HTML -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="main-wrapper">
  <div class="row" style="padding:0 1em;">
    <div class="col-sm-3 p-0 sidebar-wrapper">
      <div class="sidebar py-3">
        <div class="w-100 d-flex">
          <h4 class="text-white mb-5 px-3 py-2 my-auto"><b>CharityHub</b></h4>
          <button class="btn text-white my-auto ml-auto d-sm-none"
            style="font-size:2em;"
            onclick="$('.sidebar-wrapper').toggleClass('open')">
            <span>&times;</span>
          </button>
        </div>
        <!-- <h6 class="menu-heading text-light mb-4"><span>menu</span></h6> -->

        <div class="sidelinks">
          <a href="#home" onclick="$('.sidebar-wrapper').toggleClass('open')" class="hashlinks"><span>Home</span></a>
          <a href="#causes" onclick="$('.sidebar-wrapper').toggleClass('open')" class="hashlinks"><span>Causes</span></a>
          <a href="#donations" onclick="$('.sidebar-wrapper').toggleClass('open')" class="hashlinks"><span>Donations</span></a>
          <a href="#payment" onclick="$('.sidebar-wrapper').toggleClass('open')" class="hashlinks"><span>Payment Details</span></a>
          <a href="#popupPayment" onclick="$('.sidebar-wrapper').toggleClass('open')" class="hashlinks"><span>Popup donations</span></a>
          <a href="#settings" onclick="$('.sidebar-wrapper').toggleClass('open')" class="hashlinks"><span>Settings</span></a>
          <a href="logout" onclick="$('.sidebar-wrapper').toggleClass('open')" class="hashlinks"><span>Logout</span></a>
        </div>
      </div>
    </div>

    <div class="col-sm-9 px-0">
      <div class="main-content container text-light">
        <div class="main-content-header w-100 py-3 sticky-top d-flex"
          style="background-color:seagreen;">
          <h4 class="text-white my-auto"><b>CharityHub</b></h4>
          <button class="ml-auto btn my-auto border border-white p-2 d-sm-none" onclick="$('.sidebar-wrapper').toggleClass('open')">
            <span class="d-block bg-white mb-1" style="width:30px;padding:1px;"></span>
            <span class="d-block bg-white mb-1" style="width:30px;padding:1px;"></span>
            <span class="d-block bg-white" style="width:30px;padding:1px;"></span>
          </button>
          <div class="user-icon d-none d-sm-flex ml-auto bg-dark">
            <i class="bi bi-person-fill m-auto" style="color:seagreen;font-size:1.6em;"></i>
          </div>
        </div>

        <div class="page-body" id="home">
          <h1>Home</h1>
          <hr class="border-light mb-4" />
          <div class="row">
            <div class="col-sm-4 mb-3">
              <a href="#causes" class="btn donation-item h-100 w-100 text-light py-4">
                <h1 class="display-1 m-0"><?php echo count($Controller->causes()); ?></h1>
                <span class="h5 m-0">Causes</span>
              </a>
            </div>
            <div class="col-sm-4 mb-3">
              <a href="#causes" class="btn donation-item h-100 w-100 text-light py-4">
                <h1 class="display-1 m-0"><?php echo count($Controller->donations()); ?></h1>
                <span class="h5 m-0">Donations</span>
              </a>
            </div>
            <div class="col-sm-4 mb-3">
              <a href="#payment" class="btn donation-item h-100 w-100 text-light py-4">
                <h1 class="display-1 m-0"><?php echo count($Controller->payment_info()); ?></h1>
                <span class="h5 m-0">Payment methods</span>
              </a>
            </div>
            <div class="col-sm-4 mb-3">
              <a href="#payment" class="btn donation-item h-100 w-100 text-light py-4">
                <h1 class="display-1 m-0"><?php echo count($Controller->popup_donations()); ?></h1>
                <span class="h5 m-0">Popus</span>
              </a>
            </div>
          </div>
        </div>
        <div class="page-body" id="causes">
          <h1>Causes</h1>
          <hr class="border-light mb-4" />

          <div class="donation-wrapper row">
            <div class="col-sm-4 mb-3">
              <button class="btn donation-item h-100 w-100 text-light"
                data-toggle="modal"
                data-target="#newDonation">
                <span class="h5">Add new</span>
              </button>
            </div>
            <?php
              foreach ($Controller->causes() as $key => $value) {
                $percent = ($value['amount_raised'] / $value['amount']) * 100;
                $percent = round($percent);
                ?>
                <div class="col-sm-4 mb-3" id="donationItem<?php echo $value['cause_id']; ?>">
                  <div class="donation-item h-100 w-100">
                    <div class="w-100 img mb-3"
                      style="background-image:url('../assets/images/resources/<?php echo $value['banner']; ?>');">
                    </div>
                    <div class="info p-2">
                      <div class="load mb-2">
                        <div class="load-bar" style="width:<?php echo $percent.'%'; ?>;"><span><?php echo $percent.'%'; ?></span></div>
                      </div>
                      <p class="mb-1 d-flex w-100">
                        <small class="cus-amt"><i class="thm-clr">$<?php echo number_format($value['amount_raised']); ?> Raised</i> of $<?php echo number_format($value['amount']); ?></small>
                        <small class="ml-auto"><?php echo $value['donors']; ?> Donors</small>
                      </p>
                      <p class="mb-0">Posted: <?php echo date('d M, Y', strtotime($value['cause_date'])); ?></p>
                    </div>
                    <div class="donation-overlay w-100 h-100">
                      <div class="m-auto">
                        <button class="btn px-4 btn-info"
                          data-toggle="modal"
                          data-target="#editDonation<?php echo $value['cause_id']; ?>"
                          id="editBtn<?php echo $value['cause_id']; ?>">
                          <span>Update</span>
                        </button>
                        <button class="btn btn-danger px-4"
                          onclick="deleteDonation('<?php echo $value['cause_id']; ?>')"
                          id="delButton<?php echo $value['cause_id']; ?>">
                          <span>Delete</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Update Modal -->
                <div class="modal fade text-dark" id="editDonation<?php echo $value['cause_id']; ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog pb-5">
                    <form class="modal-content editDonation" id="editDonationForm<?php echo $value['cause_id']; ?>" enctype="multipart/formdata" method="POST">
                      <div class="modal-header">
                        <h5 class="modal-title">Update Donation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label>Title *</label>
                          <input type="text" name="title" value="<?php echo $value['title']; ?>" required class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Amount *</label>
                          <input type="number" name="amount" value="<?php echo $value['amount']; ?>" required class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Amount raised *</label>
                          <input type="number" name="amount_raised" value="<?php echo $value['amount_raised']; ?>" required class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Donors *</label>
                          <input type="number" name="donors" value="<?php echo $value['donors']; ?>" required class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Image</label>
                          <input type="file" name="banner" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Details *</label>
                          <textarea name="details" required class="form-control"><?php echo $value['details']; ?></textarea>
                        </div>
                        <div class="form-group">
                          <label>Event date</label>
                          <input type="date"
                            name="cause_date"
                            value="<?php echo substr($value['cause_date'], 0, 10); ?>"
                            class="form-control"
                          />
                        </div>
                        <div class="feedback"></div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="hidden"
                          name="update_donation"
                          value="<?php echo $value['cause_id']; ?>"
                        />
                        <button type="submit" class="btn btn-primary submit-btn">Update</button>
                      </div>
                    </form>
                  </div>
                </div>
                <?php
              }
            ?>
          </div>
        </div>
        <div class="page-body" id="donations">
          <h1 class="mb-4">Donations</h1>

          <div class="donation-wrapper">
            <div class="table-wrapper">
              <table class="table table-hover text-white">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Amount</th>
                    <th>Email</th>
                    <th>Payment Method</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
              <?php
                foreach ($Controller->donations() as $key => $value) {
                  $x = $key + 1;
                  ?>
                  <tr>
                    <td><?php echo $x; ?></td>
                    <td><?php echo $value['amount']; ?></td>
                    <td><?php echo $value['email']; ?></td>
                    <td><?php echo $value['payment_method']; ?></td>
                    <td><?php echo date('m/d/Y', strtotime($value['createdat'])); ?></td>
                    <td>
                      <a href="javascript:void(0)" onclick="showProof('<?php echo $value['id']; ?>')" class="text-light">View proof</a>
                    </td>
                  </tr>
                  <?php
                }
              ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="page-body" id="payment">
          <h1>Payments</h1>
          <hr class="border-light mb-4" />
          <div class="row">
            <div class="col-sm-6 mb-3">
              <button class="payment-item btn text-light h-100 w-100 border d-flex p-2"
                data-toggle="modal"
                data-target="#newPayment">
                <span class="bi bi-plus" style="font-size:30px;line-height:1em;"></span>
                <span class="pl-2 my-auto">Add new</span>
              </button>
            </div>
            <?php
              foreach ($Controller->payment_info() as $key => $value) {
                ?>
                <div class="col-sm-6 mb-3" id="paymentItem<?php echo $value['id']; ?>">
                  <div class="payment-item h-100 w-100 border d-flex p-2 overflow-hidden">
                    <img src="../assets/images/<?php echo $value['icon']; ?>"
                      style="height:40px;"
                      class="my-auto" 
                    />
                    <div class="my-auto pl-2 w-100" style="line-height:1em;max-width:70%;">
                      <p class="d-block mb-2 overflow-hidden"><b><?php echo $value['tag']; ?></b></p>
                      <small class="d-block w-100"><?php echo $value['name']; ?></small>
                    </div>
                    <div class="my-auto pl-2" style="line-height:1em;margin-left:auto;">
                      <button class="p-1 mr-2 btn text-light"
                        title="Edit"
                        data-toggle="modal"
                        data-target="#editPayment<?php echo $value['id']; ?>">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <button class="p-1 btn text-light"
                        title="Delete"
                        id="delPayment<?php echo $value['id']; ?>"
                        onclick="deletePayment('<?php echo $value['id']; ?>')">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <!-- Add Modal -->
                <div class="modal fade text-dark" id="editPayment<?php echo $value['id']; ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog pb-5">
                    <form class="modal-content editPayment" id="editPaymentForm<?php echo $value['id']; ?>" enctype="multipart/formdata" method="POST">
                      <div class="modal-header">
                        <h5 class="modal-title">Add payment option</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label>Name *</label>
                          <input type="text" name="name" value="<?php echo $value['name']; ?>" required class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Tag *</label>
                          <input type="text" name="tag" value="<?php echo $value['tag']; ?>" required class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Icon *</label>
                          <input type="file" name="banner" class="form-control">
                        </div>
                        <div class="feedback"></div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="hidden" name="edit_payment" value="<?php echo $value['id']; ?>" />
                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
                <?php
              }
            ?>
          </div>
        </div>
        <div class="page-body" id="popupPayment">
          <h1>Popup donations</h1>
          <hr class="border-light mb-4" />
          <div class="row">
            <div class="col-sm-6 mb-3">
              <button class="payment-item btn text-light h-100 w-100 border d-flex p-2"
                data-toggle="modal"
                data-target="#newPopup">
                <span class="bi bi-plus" style="font-size:30px;line-height:1em;"></span>
                <span class="pl-2 my-auto">Add new</span>
              </button>
            </div>
            <?php
              foreach ($Controller->popup_donations() as $key => $value) {
                ?>
                <div class="col-sm-6 mb-3" id="popupItem<?php echo $value['id']; ?>">
                  <div class="popup-item h-100 w-100 border d-flex p-2">
                    <div class="my-auto">
                      <i style="font-size:1.5em;" class="bi bi-heart-fill"></i>
                    </div>
                    <div class="my-auto pl-2 w-100" style="line-height:1em;">
                      <span class="d-block mb-1"><?php echo $value['text']; ?></span>
                    </div>
                    <div class="my-auto pl-2 d-flex" style="line-height:1em;">
                      <button class="p-1 mr-2 btn text-light"
                        title="Edit"
                        data-toggle="modal"
                        data-target="#editPopup<?php echo $value['id']; ?>">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <button class="p-1 btn text-light"
                        title="Delete"
                        id="delPayment<?php echo $value['id']; ?>"
                        onclick="deletePopup('<?php echo $value['id']; ?>')">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <!-- Add Modal -->
                <div class="modal fade text-dark" id="editPopup<?php echo $value['id']; ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog pb-5">
                    <form class="modal-content editPopup"
                      id="editPopupForm<?php echo $value['id']; ?>" enctype="multipart/formdata" 
                      method="POST">
                      <div class="modal-header">
                        <h5 class="modal-title">edit popup donation</h5>
                        <button type="button"
                          class="close" data-dismiss="modal"
                          aria-label="Close">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label>Name *</label>
                          <input type="text" name="text" value="<?php echo $value['text']; ?>" required class="form-control">
                        </div>
                        <div class="feedback"></div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="hidden" name="edit_popup" value="<?php echo $value['id']; ?>" />
                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
                <?php
              }
            ?>
          </div>
        </div>
        <div class="page-body" id="settings">
          <h1>Settings</h1>
          <hr class="border-light mb-4" />
          <div class="row">
            <div class="col-sm-6">
              <form action="javascript:void(0)" class="w-100 rounded border p-3">
                <h4 class="mb-4"><i class="bi bi-person"></i> Change username</h4>
                <div class="form-group">
                  <label>New username</label>
                  <input type="text" name="admin_username" class="form-control" />
                </div>
                <div class="form-group">
                  <label>Enter password</label>
                  <input type="password" name="admin_password" class="form-control" />
                </div>
                <div class="feedback mb-3"></div>
                <button type="submit" class="btn btn-success submit-btn border-0 p-2">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="newDonation" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog pb-5">
    <form class="modal-content" id="donationForm" enctype="multipart/formdata" method="POST">
      <div class="modal-header">
        <h5 class="modal-title">Add new Donation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Title *</label>
          <input type="text" name="title" required class="form-control">
        </div>
        <div class="form-group">
          <label>Amount *</label>
          <input type="number" name="amount" required class="form-control">
        </div>
        <div class="form-group">
          <label>Amount raised *</label>
          <input type="number" name="amount_raised" required class="form-control">
        </div>
        <div class="form-group">
          <label>Donors *</label>
          <input type="number" name="donors" required class="form-control">
        </div>
        <div class="form-group">
          <label>Image *</label>
          <input type="file" name="banner" required class="form-control">
        </div>
        <div class="form-group">
          <label>Details *</label>
          <textarea name="details" required class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label>Event date</label>
          <input type="date" name="cause_date" class="form-control">
        </div>
        <div class="feedback"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="add_donation" />
        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
      </div>
    </form>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="newPayment" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog pb-5">
    <form class="modal-content" id="paymentForm" enctype="multipart/formdata" method="POST">
      <div class="modal-header">
        <h5 class="modal-title">Add payment option</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Name *</label>
          <input type="text" name="name" required class="form-control">
        </div>
        <div class="form-group">
          <label>Tag *</label>
          <input type="text" name="tag" required class="form-control">
        </div>
        <div class="form-group">
          <label>Icon *</label>
          <input type="file" name="banner" required class="form-control">
        </div>
        <div class="feedback"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="add_payment" />
        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
      </div>
    </form>
  </div>
</div>
<!-- Add Modal -->
<div class="modal fade" id="newPopup" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog pb-5">
    <form class="modal-content" id="popupForm" enctype="multipart/formdata" method="POST">
      <div class="modal-header">
        <h5 class="modal-title">Add popup donation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Name *</label>
          <input type="text"
            name="text" required
            class="form-control"
            placeholder="e.g, Joh doe just donated $300"
          />
        </div>
        <div class="feedback"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="add_popup" />
        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
      </div>
    </form>
  </div>
</div>


<!-- Proof Modal -->
<div class="modal fade" id="proofModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog pb-5">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Proof of Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer d-flex">
        <button type="button" class="btn btn-secondary m-auto" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="_js/script.js"></script>
<script>
  function showProof(id) {
    $("#proofModal .modal-body").html('<p class="text-center">Loading...</p>');
    $("#proofModal").modal('show');
    $.ajax({
      url: 'process.php',
      method: 'GET',
      data: {
        get_proof: id
      },
      success: function(response) {
        $("#proofModal .modal-body").html(response);
      }
    });
  }
</script>
</body>
</html>