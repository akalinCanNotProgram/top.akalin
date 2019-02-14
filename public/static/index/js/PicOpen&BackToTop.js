	$(document).ready(function() {
		$('.galpop-single').galpop();

		$('.galpop-multiple').galpop();

		var callback = function() {
			var wrapper = $('#galpop-wrapper');
			var info    = $('#galpop-info');
			var count   = wrapper.data('count');
			var index   = wrapper.data('index');
			var current = index + 1;
			var string  = '（Image '+ current +' of '+ count+'）';

			info.append('<p>'+ string +'</p>').fadeIn();

		};
		$('.galpop-info').galpop({
			callback: callback
		});
		$('.galpop-callback').galpop({
			callback: callback
		});

	});
$('#back-to-top').click(function () {
$('html, body').animate({
scrollTop: $($.attr(this, 'href')).offset().top
}, 500);
return false;
});