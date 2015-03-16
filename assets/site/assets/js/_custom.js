/*jshint smarttabs:true */

$(document).ready(function(){



var now = moment();


var dis = moment($(".moment")).fromNow();

$(".mobileShow").on("click",function(){
	$(".menu").toggle();
})


$(".moment").html(dis);


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



$("body").on('click','#addQuestion',function(e){
	e.preventDefault();

		// Vars

		var myForm = $('#askQuestion');
		var data= new FormData(myForm[0]);

		var url = $(this).data('ajax-url');

	

		// Display Location Fields Dropdown

		$.ajax({
			url: url,
			data: data,
			processData: false,
			contentType: false,
			mimeType:"multipart/form-data",
			type: 'POST',
			success: function( response ) {
				console.log(response);
				 location.reload(); 
			},
		});
})



$("body").on('click','#leaveComment',function(e){
	e.preventDefault();

		// Vars

		var myForm = $('#commentForm');
		var data= new FormData(myForm[0]);

		var url = $(this).data('ajax-url');

	

		// Display Location Fields Dropdown

		$.ajax({
			url: url,
			data: data,
			processData: false,
			contentType: false,
			mimeType:"multipart/form-data",
			type: 'POST',
			success: function( response ) {
				 location.reload(); 
			},
		});
})




$('body').on('change', '.chooseTech', function(e){
		e.preventDefault();

		// Vars
		var data = $(this).val();

		var data = {
			"technology" : data,
		}

		// Display Location Fields Dropdown

			$.ajax({
				url: 'projects/get_by_id',
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


$('body').on('click', '#answerQuestion', function(e){
		e.preventDefault();

		// Vars
		var url = $(this).data('ajax-url');

		var id = $(this).data('id');

		var answer = $(this).parent().find("textarea").val();



		var data = {
			"id" : id,
			"answer": answer,
		}

		// Display Location Fields Dropdown

			$.ajax({
				url: url,
				data: data,
				type: 'POST',
				success: function( response ) {
					// Load Results to Dom
					$(".projects").html( response );
					//formContainer.removeClass( 'hide' );
					location.reload(); 
					// Re-Initialize jQuery Plugins on Dynamic Content
				},
			});
		
		
	});


$("body").on("click",'.fa-thumbs-up',function(){


	var data = $(this).data('id');
	var tech = $(this).data('tech');
	var user = $(this).data('user');

	var clicked = $(this);


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
					response = JSON.parse(response);

					if(response.votes != true)
					{
						var votes = $(clicked).find(".col-md-10" );
						votes = votes+1;
						$(clicked).find(".numVotes").html( votes );

						var vs = $(clicked).parent().parent().find('.numVotes').data("votes");

						$(clicked).parent().parent().find(".numVotes").html(vs+1);
					}
					else {

						var n = $('.comments').noty({
							type: 'error',
							text: 'You have already voted on this comment'
						});
					}
					//formContainer.removeClass( 'hide' );
					
					// Re-Initialize jQuery Plugins on Dynamic Content
				},
			});



})



$("body").on("click",'.fa-thumbs-down',function(){


	var data = $(this).data('id');
	var tech = $(this).data('tech');
	var user = $(this).data('user');

	var clicked = $(this);

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
					response = JSON.parse(response);
					
					if(response.votes != true)
					{
						var votes = $(clicked).find(".col-md-10" );
						votes = votes+1;
						$(clicked).find(".numVotes").html( votes );

						var vs = $(clicked).parent().parent().find('.numVotes').data("votes");

						$(clicked).parent().parent().find(".numVotes").html(vs-1);
					}
					else {

						var n = $('.comments').noty({
							type: 'error',
							text: 'You have already voted on this comment'
						});
					}
				},
			});



})



});




