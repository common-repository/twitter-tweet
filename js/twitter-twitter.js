jQuery(document).ready(function(){
	jQuery('.t1').click(function(){
		jQuery('.tt_buttons').fadeIn("slow");
		jQuery('.tt_tweet_text').hide();
		jQuery('.tt_language').hide();
		jQuery('.tt_tabs li').removeClass('active');
		jQuery('.t1').addClass('active');
	});
	jQuery('.t2').click(function(){
		jQuery('.tt_buttons').hide();
		jQuery('.tt_tweet_text').fadeIn("slow");
		jQuery('.tt_language').hide();
		jQuery('.tt_tabs li').removeClass('active');
		jQuery('.t2').addClass('active');
	});
	jQuery('.t3').click(function(){
		jQuery('.tt_buttons').hide();
		jQuery('.tt_tweet_text').hide();
		jQuery('.tt_language').fadeIn("slow");
		jQuery('.tt_tabs li').removeClass('active');
		jQuery('.t3').addClass('active');
	});

	jQuery('.tt_emailbutton').click(function(){
		jQuery('.tt_email_form').slideToggle();
		jQuery('.tt_email_buttons').slideToggle();
	});
	jQuery('.tt_closeemail').click(function(){
		jQuery('.tt_email_form').slideToggle();
		jQuery('.tt_email_buttons').slideToggle();
	});


	jQuery('.tt_v').click(function(){
		var lang = jQuery('#lang').val();
		jQuery('.tt_preview span').attr('class', 'etv' + lang);
		jQuery('.tt_displayhidden').val('etv');
//debug		jQuery('.tt_preview span').text('etv' + lang);
	});
	jQuery('#tt_horizontal').click(function(){
		var lang = jQuery('#lang').val();
		jQuery('.tt_preview span').attr('class', 'eth' + lang);
		jQuery('.tt_displayhidden').val('eth');
//debug		jQuery('.tt_preview span').text('eth' + lang);
	});
	jQuery('#tt_none').click(function(){
		var lang = jQuery('#lang').val();
		jQuery('.tt_preview span').attr('class', 'etn' + lang);
		jQuery('.tt_displayhidden').val('etn');
//debug		jQuery('.tt_preview span').text('etn' + lang);
	});
	jQuery('#lang').change(function(){
		var display = jQuery('.tt_displayhidden').val();
		var lang = jQuery('#lang').val();
		jQuery('.tt_preview span').attr('class', display + lang);
//debug		jQuery('.tt_preview span').text(display + lang);
	});
});