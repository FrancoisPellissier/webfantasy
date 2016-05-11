function exemple(movieid, type) {
	$.ajax({
		url : 'film/'+movieid+'/addWish/'+type,
	}).done(function() {
		$('#'+type).attr('onClick', 'delWish('+movieid+', \''+type+'\')');
		$('#'+type).removeClass('btn-default').addClass('btn-success');
	});
}