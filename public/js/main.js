var url = 'http://localpruebarrss.com/';
window.addEventListener("load", function() {

	$('.btn-like').css('cursor', 'pointer');
	$('.btn-dislike').css('cursor', 'pointer');

	//Boton de like
	function like() {
		$('.btn-dislike').unbind('click').click(function() {
			console.log('like');
			$(this).addClass('btn-like').removeClass('btn-dislike');
			$(this).attr('src', url+'img/heart-red.png');

			$.ajax({
				url: url+'like/'+$(this).data('id'),
				type: 'GET',
				success: function(response){
					if(response.like) {
						console.log('Has dado like a la publicación');
					} else {
						console.log('Error al dar like');
					}
				}
			});

			dislike();
		});
	}

	like();

	//Boton de dislike
	function dislike() {
		$('.btn-like').unbind('click').click(function() {
			console.log('dislike');
			$(this).addClass('btn-dislike').removeClass('btn-like');
			$(this).attr('src', url+'img/heart.png');

			$.ajax({
				url: url+'dislike/'+$(this).data('id'),
				type: 'GET',
				success: function(response){
					if(response.like) {
						console.log('Has dado dislike a la publicación');
					} else {
						console.log('Error al dar dislike');
					}
				}
			});

			like();
		});
	}

	dislike();

	//BUSCADOR

	$('#buscar').click(function() {
		$('#buscador').attr('action', url+'users/'+$('#search').val());
	});
});