$(document).ready(function() {
  // Function to handle hash change event
  function handleHashChange() {
    var hash = window.location.hash;
    var target = $('.page-body'+hash);

    $(".hashlinks").removeClass('active');
    $('a[href="' + hash + '"]').addClass('active');
    
    
    // Show the target section
    if (window.location.hash) {
      $('.page-body').removeClass('active');
      target.addClass('active');
    }else {
      $('.page-body').removeClass('active');
      // If target not found, show default section or do nothing
      $('.page-body#home').addClass('active');
      $('a[href="#home"]').addClass('active');
    }
  }
  
  // Trigger hash change event on page load
  handleHashChange();
  
  // Listen for hash change event
  $(window).on('hashchange', handleHashChange);

	// Add donation
  $("#donationForm").on('submit', function(e){
    e.preventDefault();

    $.ajax({
      url: "process.php",
      type: "POST",
      data: new FormData(this),
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
          // $("#donationForm input").val("");
           window.location.reload();
          // window.location.href = "dashboard";
        }

      },
      error: function() {
        $("#donationForm .submit-btn").html("Submit");
        $("#donationForm .feedback").html("<div class='alert alert-danger'><i class='bi bi-exclamation-triangle'></i> Sorry, and error occured! <br /> Try again later.</div>");
      }
    });
  });
  // Edit
  $(".editDonation").on('submit', function(e){
    e.preventDefault();
    const causeId = this.id.substring(16);
    // return console.log(new FormData(this));
    $.ajax({
      url: "process.php",
      type: "POST",
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $("#editDonation"+causeId+" .submit-btn").html("loading... <i class='fa fa-cog fa-spin'></i>");
      },
      success: function(data) {
        $("#editDonation"+causeId+" .submit-btn").html("Update");
        $("#editDonation"+causeId+" .feedback").html(data);
        
        if ( data.search('success') !== -1 ) {
          // $("#donationForm input").val("");
           window.location.reload();
          // window.location.href = "dashboard";
        }

      },
      error: function() {
        $("#editDonation"+causeId+" .submit-btn").html("Update");
        $("#editDonation"+causeId+" .feedback").html("<div class='alert alert-danger'><i class='bi bi-exclamation-triangle'></i> Sorry, and error occured! <br /> Try again later.</div>");
      }
    });
  });

  // paymentForm
  $("#paymentForm").on('submit', function(e){
    e.preventDefault();

    $.ajax({
      url: "process.php",
      type: "POST",
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $("#paymentForm .submit-btn").html("loading... <i class='fa fa-cog fa-spin'></i>");
      },
      success: function(data) {
        $("#paymentForm .submit-btn").html("Submit");
        $("#paymentForm .feedback").html(data);
        
        if ( data.search('success') !== -1 ) {
          // $("#paymentForm input").val("");
           window.location.reload();
          // window.location.href = "dashboard";
        }

      },
      error: function() {
        $("#paymentForm .submit-btn").html("Submit");
        $("#paymentForm .feedback").html("<div class='alert alert-danger'><i class='bi bi-exclamation-triangle'></i> Sorry, and error occured! <br /> Try again later.</div>");
      }
    });
  });
  // Edit
  $(".editPayment").on('submit', function(e){
    e.preventDefault();
    const payId = this.id.substring(15);
    // return console.log(payId);
    $.ajax({
      url: "process.php",
      type: "POST",
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $("#editPaymentForm"+payId+" .submit-btn").html("loading... <i class='fa fa-cog fa-spin'></i>");
      },
      success: function(data) {
        $("#editPaymentForm"+payId+" .submit-btn").html("Update");
        $("#editPaymentForm"+payId+" .feedback").html(data);
        
        if ( data.search('success') !== -1 ) {
          // $("#donationForm input").val("");
           window.location.reload();
          // window.location.href = "dashboard";
        }

      },
      error: function() {
        $("#editPaymentForm"+payId+" .submit-btn").html("Update");
        $("#editPaymentForm"+payId+" .feedback").html("<div class='alert alert-danger'><i class='bi bi-exclamation-triangle'></i> Sorry, and error occured! <br /> Try again later.</div>");
      }
    });
  });

  // Popup donations
  $("#popupForm").on('submit', function(e){
    e.preventDefault();

    $.ajax({
      url: "process.php",
      type: "POST",
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $("#popupForm .submit-btn").html("loading... <i class='fa fa-cog fa-spin'></i>");
      },
      success: function(data) {
        $("#popupForm .submit-btn").html("Submit");
        $("#popupForm .feedback").html(data);
        
        if ( data.search('success') !== -1 ) {
          // $("#popupForm input").val("");
           window.location.reload();
          // window.location.href = "dashboard";
        }

      },
      error: function() {
        $("#popupForm .submit-btn").html("Submit");
        $("#popupForm .feedback").html("<div class='alert alert-danger'><i class='bi bi-exclamation-triangle'></i> Sorry, and error occured! <br /> Try again later.</div>");
      }
    });
  });
  // Edit
  $(".editPopupForm").on('submit', function(e){
    e.preventDefault();
    const payId = this.id.substring(15);
    // return console.log(payId);
    $.ajax({
      url: "process.php",
      type: "POST",
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $("#editPopupForm"+payId+" .submit-btn").html("loading... <i class='fa fa-cog fa-spin'></i>");
      },
      success: function(data) {
        $("#editPopupForm"+payId+" .submit-btn").html("Update");
        $("#editPopupForm"+payId+" .feedback").html(data);
        
        if ( data.search('success') !== -1 ) {
          // $("#editPopupForm input").val("");
           window.location.reload();
          // window.location.href = "dashboard";
        }

      },
      error: function() {
        $("#editPopupForm"+payId+" .submit-btn").html("Update");
        $("#editPopupForm"+payId+" .feedback").html("<div class='alert alert-danger'><i class='bi bi-exclamation-triangle'></i> Sorry, and error occured! <br /> Try again later.</div>");
      }
    });
  });

  // Username form
  $("#usernameForm").on('submit', function(e){
    e.preventDefault();

    $.ajax({
      url: "process.php",
      type: "POST",
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $("#usernameForm .submit-btn").html("loading... <i class='fa fa-cog fa-spin'></i>");
      },
      success: function(data) {
        $("#usernameForm .submit-btn").html("Update username");
        $("#usernameForm .feedback").html(data);
        
        if ( data.search('success') !== -1 ) {
          $("#usernameForm input").val("");
          window.location.reload();
        }
      },
      error: function() {
        $("#usernameForm .submit-btn").html("Update username");
        $("#usernameForm .feedback").html("<div class='alert alert-danger'><i class='bi bi-exclamation-triangle'></i> Sorry, and error occured! <br /> Try again later.</div>");
      }
    });
  });

  // Password form
  $("#passwordForm").on('submit', function(e){
    e.preventDefault();

    $.ajax({
      url: "process.php",
      type: "POST",
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $("#passwordForm .submit-btn").html("loading... <i class='fa fa-cog fa-spin'></i>");
      },
      success: function(data) {
        $("#passwordForm .submit-btn").html("Change password");
        $("#passwordForm .feedback").html(data);
        
        if ( data.search('success') !== -1 ) {
          $("#passwordForm input").val("");
          window.location.reload();
        }
      },
      error: function() {
        $("#passwordForm .submit-btn").html("Change password");
        $("#passwordForm .feedback").html("<div class='alert alert-danger'><i class='bi bi-exclamation-triangle'></i> Sorry, and error occured! <br /> Try again later.</div>");
      }
    });
  });
});


// Delete 
function deleteDonation(causeId) {
	$.ajax({
    url: "process.php",
    type: "GET",
    data: {'delete_cause': causeId},
    // cache: false,
    // contentType: false,
    // processData: false,
    beforeSend: function() {
      $("#delButton"+causeId).html("loading... <i class='fa fa-cog fa-spin'></i>");
    },
    success: function(data) {
      $("#delButton"+causeId).html(data);
      
      if ( data.search('deleted') !== -1 ) {
      	$("#donationItem"+causeId).hide(300);
      }
    },
    error: function(err) {
    	alert(err.message)
      $("#delButton"+causeId).html("Error, retry?");
    }
  });
}

// Delete 
function deletePayment(payId) {
	$.ajax({
    url: "process.php",
    type: "GET",
    data: {'delete_payment': payId},
    // cache: false,
    // contentType: false,
    // processData: false,
    beforeSend: function() {
      $("#delPayment"+payId).html("loading... <i class='fa fa-cog fa-spin'></i>");
    },
    success: function(data) {
      $("#delPayment"+payId).html(data);
      
      if ( data.search('deleted') !== -1 ) {
      	$("#paymentItem"+payId).hide(300);
      }
    },
    error: function(err) {
    	alert(err.message)
      $("#delPayment"+payId).html("Error, retry?");
    }
  });
}

// Delete 
function deletePopup(payId) {
  $.ajax({
    url: "process.php",
    type: "GET",
    data: {'delete_popup': payId},
    beforeSend: function() {
      $("#editPopup"+payId).html("loading... <i class='fa fa-cog fa-spin'></i>");
    },
    success: function(data) {
      $("#editPopup"+payId).html(data);
      
      if ( data.search('deleted') !== -1 ) {
        $("#popupItem"+payId).hide(300);
      }
    },
    error: function(err) {
      alert(err.message)
      $("#editPopup"+payId).html("Error, retry?");
    }
  });
}