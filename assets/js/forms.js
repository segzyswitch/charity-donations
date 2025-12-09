$(document).ready(function() {
	// Add donation
  $("#donationForm").on('submit', function(e){
    e.preventDefault();

    $.ajax({
      url: "functions/process.php",
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
          $("#donationForm input").val("");
        }

      },
      error: function() {
        $("#donationForm .submit-btn").html("Submit");
        $("#donationForm .feedback").html("<div class='alert alert-danger'><i class='bi bi-exclamation-triangle'></i> Sorry, and error occured! <br /> Try again later.</div>");
      }
    });
  });
});