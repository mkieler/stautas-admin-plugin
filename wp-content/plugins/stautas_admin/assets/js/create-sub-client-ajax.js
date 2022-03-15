/*( function( $ ) {

	$(document).ready(function () {
		$('#create-sub-user-form').submit(ajaxSubmit);
		
		$("#close-post-status-icon").on( "click", function() {
	  		$("#post-status-message").removeClass( "error" );
	  		$("#post-status-message").removeClass( "success" );
		});
	})

	function ajaxSubmit(event){
		$("#loading-wrap").css('display', 'flex');
		event.preventDefault();
		var form = $(this);
    	var actionUrl = form.attr('action');
    
	    $.ajax({
	        type: "POST",
	        url: actionUrl,
	        data: form.serialize(), // serializes the form's elements.
	        success: success,
	        error: error
	    });
	}



	function success(){
		$("#loading-wrap").css('display', 'none');
		$("#post-status-message").addClass( "success" );
		$("#post-status-message #status-info p").html("Klienten blev oprettet.");
		$("#post-status-message #status-info i").addClass( "fa-check" );
	}


	function error(){
		$("#loading-wrap").css('display', 'none');
		$("#post-status-message").addClass( "error" );
		$("#post-status-message #status-info p").html("Klienten blev ikke oprettet.");
		$("#post-status-message #status-info i").addClass( "fa-times" );
	}




})( jQuery );*/
