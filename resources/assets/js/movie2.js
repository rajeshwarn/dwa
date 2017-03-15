	
	var flagCheckAllMovie = 0, flagCheckFeaturedMovie = 0;
	var base_url = window.location.origin;

	// Button Add Coming Soon Movie
	$(" .btn-add-coming-soon-movie ").click(function(){
		$(" #modal-coming-soon-movie ").modal();
	});

	// Adding Coming Soon Movie Category
	$(" #modal-coming-soon-movie .movie-list li ").click(function(){
		var mov_id = $(this).attr('data-id');
		var count_coming_soon_movie = $(" #dashboard-admin-section .right-dashboard .coming-soon-movie-wrap ul li ").length;

		$(" #modal-coming-soon-movie .overlay-box .status").html("Please Wait ...");
		$(" #modal-coming-soon-movie .overlay-box").css("display","block");

		if( count_coming_soon_movie >= 3 )
			{
				$(" #modal-coming-soon-movie .overlay-box .status").html("Sorry you just can select 3 movie");
				$(" #modal-coming-soon-movie .overlay-box").css("display","block").delay(1000).fadeOut();				
			}
		else
			{
				$.ajax({
					type: 'GET',
					data: '',
					url: 'http://dewabioskop21.com/dev-admin/store-coming-soon-movie/'+mov_id,
					success: function(obj) {

						$(" #modal-coming-soon-movie .overlay-box .status").html("Success");
						$(" #modal-coming-soon-movie .overlay-box").fadeOut();

						var mov_title = $(" #modal-coming-soon-movie .movie-list li[data-id=" + mov_id +"] .movie-title ").text();

						$(" #modal-coming-soon-movie .movie-list li[data-id=" + mov_id +"] ").fadeOut();	
						$(" #dashboard-admin-section .right-dashboard .coming-soon-movie-wrap ul ").append("<li><span class='movie-title'>" + mov_title + "</span><a href='delete-best-movie/" + mov_id + "' class='btn-trash-coming-soon-movie'><i class='fa fa-trash' aria-hidden='true'></i></a></li>")
					},
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.status);
						console.log(thrownError);
					}
				})
			}
	});

	// Button Add Best Movie
	$(" .btn-add-best-movie ").click(function(){
		$(" #modal-best-movie ").modal();
	});

	// Adding Best Movie Category
	$(" #modal-best-movie .movie-list li ").click(function(){
		var mov_id = $(this).attr('data-id');
		var count_best_movie = $(" #dashboard-admin-section .right-dashboard .best-movie-wrap ul li ").length;

		$(" #modal-best-movie .overlay-box .status").html("Please Wait ...");
		$(" #modal-best-movie .overlay-box").css("display","block");

		if( count_best_movie >= 3 )
			{
				$(" #modal-best-movie .overlay-box .status").html("Sorry you just can select 3 movie");
				$(" #modal-best-movie .overlay-box").css("display","block").delay(1000).fadeOut();				
			}
		else
			{
				$.ajax({
					type: 'GET',
					data: '',
					url: 'http://dewabioskop21.com/dev-admin/store-best-movie/'+mov_id,
					success: function(obj) {

						$(" #modal-best-movie .overlay-box .status").html("Success");
						$(" #modal-best-movie .overlay-box").fadeOut();

						var mov_title = $(" #modal-best-movie .movie-list li[data-id=" + mov_id +"] .movie-title ").text();

						$(" #modal-best-movie .movie-list li[data-id=" + mov_id +"] ").fadeOut();	
						$(" #dashboard-admin-section .right-dashboard .best-movie-wrap ul ").append("<li><span class='movie-title'>" + mov_title + "</span><a href='delete-best-movie/" + mov_id + "' class='btn-trash-best-movie'><i class='fa fa-trash' aria-hidden='true'></i></a></li>")
					},
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.status);
						console.log(thrownError);
					}
				})
			}
	});

	// Check All Movie
	$(" #dashboard-admin-section .right-dashboard .table-movie-wrap .table-movie input[name=checkallmovie] ").click(function(){

		if( flagCheckAllMovie == 0 )
			{
				$(" #dashboard-admin-section .right-dashboard .table-movie-wrap .table-movie .checkmovie ").attr("checked","true");
				flagCheckAllMovie = 1;
			}
		else
			{
				$(" #dashboard-admin-section .right-dashboard .table-movie-wrap .table-movie .checkmovie ").removeAttr("checked");
				flagCheckAllMovie = 0;	
			}

	});

	// New Movie Check For Featured Movie & Edit Movie Check For Featured Movie
	$(" #new-movie-form label[for=movie-check-featured], #new-movie-form .check-featured-box, #edit-movie-form label[for=movie-check-featured], #edit-movie-form .check-featured-box ").click(function(){

		if( flagCheckFeaturedMovie == 0 )
			{
				if( $(this)[0].hasAttribute("style") )
					{
						$(" #new-movie-form .check-featured-box, #edit-movie-form .check-featured-box ").removeAttr("style")
						$(" #new-movie-form  input[name=movie-check-featured], #edit-movie-form  input[name=movie-check-featured] ").removeAttr('checked value');
						flagCheckFeaturedMovie = 0;
					}
				else
					{
						$(" #new-movie-form .check-featured-box, #edit-movie-form .check-featured-box ").css("background-image","url('http://dewabioskop21.com/resources/assets/img/check-icon.png')")
						$(" #new-movie-form  input[name=movie-check-featured], #edit-movie-form  input[name=movie-check-featured] ").attr('checked','checked');
						$(" #new-movie-form  input[name=movie-check-featured], #edit-movie-form  input[name=movie-check-featured] ").attr('value','true');
						flagCheckFeaturedMovie = 1;
					}
			}
		else
			{
				$(" #new-movie-form .check-featured-box, #edit-movie-form .check-featured-box ").removeAttr("style")	
				$(" #new-movie-form  input[name=movie-check-featured], #edit-movie-form  input[name=movie-check-featured] ").removeAttr('checked value');
				flagCheckFeaturedMovie = 0;
			}
	});

	// Button Close Message Alert Admin
	$(" .btn-close-alert ").click(function(){
		$(this).parent().fadeOut();
	});

	// Confirm Button Trash Movie
	$(" #dashboard-admin-section .right-dashboard .table-movie-wrap .table-movie tr td .action-btn-wrap .btn-trash ").click(function(){
		var mov_id = $(this).attr('data-id');

		$(" #modal-confirm-delete-movie a[name=link-trash] ").attr("href","destroy/"+mov_id);
		$(" #modal-confirm-delete-movie ").modal();
	});

	// Confirm Button Trash User
	$(" #dashboard-admin-section .right-dashboard .table-user-wrap .table-user tr td .action-btn-wrap .btn-trash ").click(function(){
		var mov_id = $(this).attr('data-id');

		$(" #modal-confirm-delete-user a[name=link-trash] ").attr("href","destroy/user/"+mov_id);
		$(" #modal-confirm-delete-user ").modal();
	});

	// New Movie Input FIle Click
	$(" #new-movie-form .featured-image-col .btn-add-image ").click(function(){
		$(" #new-movie-form .featured-image-col input[type=file] ").click();
	});	

	// Edit Movie Input File Click
	$(" #edit-movie-form .featured-image-col .btn-add-image ").click(function(){
		$(" #edit-movie-form .featured-image-col input[type=file] ").click();
	});	

	// Preview Poster Movie After Input
	function readURL(input) {

		if( input.files && input.files[0] )
			{
				var reader = new FileReader();

				reader.onload = function(e) {
					$(" #prev-img ").attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
	}

	// Input Poster New Movie When OnChange
	$(" #new-movie-form #featured-image-input ").change(function(){
		readURL(this);
		$(" #new-movie-form .featured-image-col #prev-img ").fadeIn();
	});

	// Input Poster Edit Movie When OnChange
	$(" #edit-movie-form #featured-image-input ").change(function(){
		readURL(this);
		$(" #edit-movie-form .featured-image-col #prev-img ").fadeIn();
	});

	// New Movie Grab
	$(" #new-movie-imdb-form .btn-grab ").on("click", function(){
		
		var link = $(" #new-movie-imdb-form .imdb-link ").val();

		if(link)
			{
				$(this).parent().find(" span.loading-status ").html("Please Wait......");
				$(this).prop("disabled","true");

				$.ajax({
					type: 'POST',
					data: 'link='+link,
					url: 'http://dewabioskop21.com/includes/grab_movie.php',
					success: function(res) {
						var obj = JSON.parse(res);

						$(" #new-movie-form input[name=movie-title] ").val(obj['data'].title);
						$(" #new-movie-form input[name=movie-rating] ").val(obj['data'].rating);
						$(" #new-movie-form input[name=movie-duration] ").val(obj['data'].duration);
						$(" #new-movie-form input[name=movie-year] ").val(obj['data'].year);					
						$(" #new-movie-form input[name=movie-actor] ").val(obj['data'].actor);
						$(" #new-movie-form input[name=movie-country] ").val(obj['data'].country);
						$(" #new-movie-form textarea[name=movie-desc] ").val(obj['data'].desc);
						$(" #new-movie-form input[name=movie-director] ").val(obj['data'].director);
						$(" #new-movie-form input[name=movie-release-date] ").val(obj['data'].release_date);
						$(" #new-movie-form input[name=featured-image-input-hidden] ").val(obj['data'].thumbnail_name);
						$(" #prev-img ").attr('src',obj['data'].thumbnail);
						$(" #prev-img ").css('display','inline-block');

						$(" #new-movie-form .category-list input[type=checkbox] ").removeAttr("checked");

						var cat_arr = obj['data'].category.split(',');						

						cat_arr.forEach(function(item){
							$(" #new-movie-form input[type=checkbox][value=" + item + "] ").attr("checked","true");
						});

						$(" #new-movie-imdb-form span.loading-status ").html("");
						$(" #new-movie-imdb-form .btn-grab ").removeAttr("disabled");
					},
					error: function (xhr, ajaxOptions, thrownError) {
        				console.log(xhr.status);
        				console.log(thrownError);
        			}
				})
			}
		else
			{
				console.log("Fail");
			}
	});


	// Edit Movie Grab
	$(" #edit-movie-imdb-form .btn-grab ").on("click", function(){
		
		var link = $(" #edit-movie-imdb-form .imdb-link ").val();

		if(link)
			{
				$(this).parent().find(" span.loading-status ").html("Please Wait......");
				$(this).prop("disabled","true");

				$.ajax({
					type: 'POST',
					data: 'link='+link,
					url: 'http://dewabioskop21.com/includes/grab_movie.php',
					success: function(res) {
						var obj = JSON.parse(res);

						$(" #edit-movie-form input[name=movie-title] ").val(obj['data'].title);
						$(" #edit-movie-form input[name=movie-rating] ").val(obj['data'].rating);
						$(" #edit-movie-form input[name=movie-duration] ").val(obj['data'].duration);
						$(" #edit-movie-form input[name=movie-year] ").val(obj['data'].year);					
						$(" #edit-movie-form input[name=movie-actor] ").val(obj['data'].actor);
						$(" #edit-movie-form input[name=movie-country] ").val(obj['data'].country);
						$(" #edit-movie-form textarea[name=movie-desc] ").val(obj['data'].desc);
						$(" #edit-movie-form input[name=movie-director] ").val(obj['data'].director);
						$(" #edit-movie-form input[name=movie-release-date] ").val(obj['data'].release_date);
						$(" #edit-movie-form input[name=featured-image-input-hidden] ").val(obj['data'].thumbnail_name);
						$(" #prev-img ").attr('src',obj['data'].thumbnail);
						$(" #prev-img ").css('display','inline-block');

						$(" #edit-movie-form .category-list input[type=checkbox] ").removeAttr("checked");

						var cat_arr = obj['data'].category.split(',');						

						cat_arr.forEach(function(item){
							$(" #edit-movie-form input[type=checkbox][value=" + item + "] ").attr("checked","true");
						});

						$(" #edit-movie-imdb-form span.loading-status ").html("");
						$(" #edit-movie-imdb-form .btn-grab ").removeAttr("disabled");
					},
					error: function (xhr, ajaxOptions, thrownError) {
        				console.log(xhr.status);
        				console.log(thrownError);
        			}
				})
			}
		else
			{
				console.log("Fail");
			}
	});