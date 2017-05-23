(function($){

	var loader = $('#loader');

	var videoModal = $('#video-modal');

	var playSong = $('.play-song-btn');

	var playerContainer = $('#player-container');

	var noResults = $('#no-results');

	var resultsContainer = playerContainer.find('tbody');

	$.get(routes.api + 'songs', function(res){
		console.log(res);		
		renderSongs(res);
	});

	var renderSongs = function(res) {
		if( typeof res != 'undefined' && res.length ) {
			resultsContainer.html('');
			$("#song-item-tmpl").tmpl(res).appendTo( resultsContainer.slideDown() );	
		} else {
			noResults.slideDown();
			resultsContainer.slideDown();
		}		
		loader.slideUp('fast');
	}

	playerContainer.on('click', '.play-song-btn', function(e){
		var title = $(this).data('title');
		var video_url = $(this).data('video');
		var myId = getYouTubeId(video_url);

		var youtube_iframe = '<iframe width="560" height="315" src="//www.youtube.com/embed/' 
    + myId + '" frameborder="0" allowfullscreen></iframe>';

    	videoModal.find('.modal-title').html(title);
		videoModal.find('.modal-body').html(youtube_iframe);
	});

/*	videoModal.on('shown.bs.modal', function(e){
		var title = $(this).data('title');
		var video_url = $(this).data('video');
		console.log(title,	video_url); 
		var myId = getYouTubeId(video_url);

		var youtube_iframe = '<iframe width="560" height="315" src="//www.youtube.com/embed/' 
    + myId + '" frameborder="0" allowfullscreen></iframe>';

    	$(this).find('.modal-title').html(title);
		$(this).find('.modal-body').html(youtube_iframe);
	}); */

	videoModal.on('hidden.bs.modal', function(e){
		$(this).find('.modal-title').html('');
		$(this).find('.modal-body').html('');
	});

	$('.search-form').on('submit', function(e){
		e.preventDefault();
		
		var input = $(this).find('input[name="q"]').val();
		
		var data = {action: 'search_song', q: input};
		
		$('#no-results').slideUp();

		loader.slideDown('fast');

		//playerContainer.slideUp();

		resultsContainer.slideUp()

		$.get(routes.ajaxurl, data, function(res){
			console.log(res);
			renderSongs(res.songs);
		});
	})

	function getYouTubeId(url) {
	    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
	    var match = url.match(regExp);

	    if (match && match[2].length == 11) {
	        return match[2];
	    } else {
	        return 'error';
	    }
	}

})(jQuery);


/*(function(angular) {
    'use strict';
    angular.module('demo', [])
		.controller('Hello', function($scope, $http) {
		    $http.get('http://sandbox.dev/wp-json/wp/v2/songs').
		        then(function(response) {
		            $scope.greeting = response.data;
		            //console.log(response.data);
		        });
		});
})(window.angular);*/