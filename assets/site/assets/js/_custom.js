/*jshint smarttabs:true */

$(document).ready(function(){





$(".menu").on("click",function(){

	if(!$(this).hasClass("active"))
	{
		$(".showMenu").show('slow');
		$(".additional").html(".bar:nth-of-type(1) {
		    -webkit-transform-origin: 20px 10px;
		    transform-origin: 30px 10px;
		}
		.bar:nth-of-type(3) {
		    -webkit-transform-origin: 20px 20px;
		    transform-origin: 20px 20px;
		}
		 .bar:nth-of-type(1) {
		    -webkit-transform: rotate(-45deg) translateY(-10px) translateX(-8px);
		    transform: rotate(-45deg) translateY(-10px) translateX(-8px);
		}
		.bar:nth-of-type(2) {
		    opacity: 0;
		}
		.bar:nth-of-type(3) {
		    -webkit-transform: rotate(45deg) translateY(6px) translateX(0px);
		    transform: rotate(45deg) translateY(6px) translateX(0px);
		}
	");
		$(this).addClass('active');
	}
	else
	{
		$(".showMenu").hide();
		$(this).removeClass('active');
		$(".additional").html("");
	}

});




$('body').on('change', '.chooseTech', function(e){
		e.preventDefault();

		// Vars
		var data = $(this).val();

		var data = {
			"technology" : data,
		}

		// Display Location Fields Dropdown

			$.ajax({
				url: '/projects/get_by_id',
				data: data,
				type: 'POST',
				success: function( response ) {
					// Load Results to Dom
					$(".projects").html( response );
					//formContainer.removeClass( 'hide' );
					
					// Re-Initialize jQuery Plugins on Dynamic Content
				},
			});
		
		
	});


$("body").on("click",'.fa-thumbs-up',function(){

	var vs = $(this).parent().parent().find('.numVotes').data("votes");

	$(this).parent().parent().find(".numVotes").html(vs+1);

	var data = $(this).data('id');
	var tech = $(this).data('tech');
		var user = $(this).data('user');


		var data = {
			"id" : data,
			"tech" : tech,
			"user" : user,
		}


		$.ajax({
				url: '/admin/projects/add_vote/'+data['id'],
				data: data,
				type: 'POST',
				success: function( response ) {
					// Load Results to Dom
					var votes = $(this).find(".col-md-10" );

					
					votes = votes+1;
					$(this).find(".numVotes").html( votes );
					//formContainer.removeClass( 'hide' );
					
					// Re-Initialize jQuery Plugins on Dynamic Content
				},
			});



})



$("body").on("click",'.fa-thumbs-down',function(){

	var vs = $(this).parent().parent().find('.numVotes').data("votes");

	$(this).parent().parent().find(".numVotes").html(vs-1);

	var data = $(this).data('id');
	var tech = $(this).data('tech');
	var user = $(this).data('user');

		var data = {
			"id" : data,
			"tech" : tech,
			"user" : user,
		}


		$.ajax({
				url: '/admin/projects/down_vote/'+data['id'],
				data: data,
				type: 'POST',
				success: function( response ) {
					// Load Results to Dom
					var votes = $(this).find(".col-md-10" );

					
					votes = votes+1;
					$(this).find(".numVotes").html( votes );
					//formContainer.removeClass( 'hide' );
					
					// Re-Initialize jQuery Plugins on Dynamic Content
				},
			});



})



});




