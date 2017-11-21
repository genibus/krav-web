$(document).ready(function(){

	var menuIsOpen = false;
	$(".open").click(function(){
		if (menuIsOpen == false){
			$(this).fadeOut(200);
			$("nav").animate({left:"0%"}, "slow").fadeIn("slow").dequeue();
			menuIsOpen = true;
		}
	});
	$(".close").click(function(){
		if(menuIsOpen == true){
			$("nav").animate({left:"-20%"}, "slow").fadeOut().dequeue();
			$(".open").fadeIn(2500);
			menuIsOpen = false;
		}
	});

	$(".btn-contact").click(function(){
		$("#contact-form").fadeIn();
	})
	$(".close-contact").click(function(){
		$("#contact-form").fadeOut();
	})

	$(".graphiste").textillate({
		in:{
			effect:'bounce',
			selector: '.graphiste',
			minDisplayTime: 9000,
			}	
	});
	$(".graphiste").click(function(){
		$(".graphiste").textillate({ in: { effect: 'rollIn' } });
	});

});

function recaptchaCallback(){
	document.getElementById('submitBtn').removeAttribute('disabled');
}
