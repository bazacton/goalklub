

/* ---------------------------------------------------------------------------
	*  menu toggle Function
	* --------------------------------------------------------------------------- */
	
jQuery(document).ready(function($) {

               
             
/*MenuToggle();
	jQuery(".navigation .nav  li.parentIcon > a") .click(function(){
		jQuery(this).next().toggle(200);
		return false;
	});
	jQuery('.cs-click-menu').live('click', function(event) {        
		jQuery(this).next().toggle('show');
		jQuery(".navigation .nav ul") .hide();
	});
});
function MenuToggle() {
		jQuery(".navigation .nav ul") .parent('li') .addClass('parentIcon');
}
jQuery(window).resize(function($) {
  		var a = jQuery(window).width();
		var b = 1000
		if (a >= b) {
			jQuery(".navigation .nav ul,.navigation .nav") .show();
		}else{
			jQuery(".navigation .nav ul,.navigation .nav") .hide();
		}*/
	
	jQuery('.navigation>ul').slicknav();
		
});


/* ---------------------------------------------------------------------------
* ParentIcon add class in Menu Function
* --------------------------------------------------------------------------- */
jQuery(document).ready(function($) {
		jQuery("ul.sub-dropdown") .parent('li') .addClass('parentIcon');
	});
	
/* ---------------------------------------------------------------------------
	* nice scroll for theme
 	* --------------------------------------------------------------------------- */
	function cs_nicescroll(){
		'use strict';	
		var nice = jQuery("html").niceScroll({mousescrollstep: "20",scrollspeed: "150",}); 
	}

/* ---------------------------------------------------------------------------
* Parallex Function
* --------------------------------------------------------------------------- */
function cs_parallax_func(){
	"use strict";
	// Cache the Window object     
	jQuery('section.parallex-bg[data-type="background"]').each(function(){
		var $bgobj = jQuery(this); // assigning the object
		jQuery(window).scroll(function() {
			// Scroll the background at var speed
			// the yPos is a negative value because we're scrolling it UP!								
			var yPos = -(jQuery(window).scrollTop() / $bgobj.data('speed')); 
			// Put together our final background position
			var coords = '50% '+ yPos + 'px';
			// Move the background
			$bgobj.css({ backgroundPosition: coords });
		}); // window scroll Ends
	});
}

/* ---------------------------------------------------------------------------
	* skills Function
 	* --------------------------------------------------------------------------- */
	function cs_skill_bar(){
		
		"use strict";	 
		jQuery(document).ready(function($){
			jQuery('.skillbar').each(function($) {
				jQuery(this).waypoint(function(direction) {
					jQuery(this).find('.skillbar-bar').animate({
						width: jQuery(this).attr('data-percent')
					}, 2000);
				}, {
					offset: "100%",
					triggerOnce: true
				});
			});
		});
	}

/* ---------------------------------------------------------------------------
	*  Mail Chimp Funtion For Ajax Submit Function
	* --------------------------------------------------------------------------- */
	function cs_mailchimp_submit(theme_url,counter,admin_url){
		'use strict';
		$ = jQuery;
		$('#btn_newsletter_'+counter).hide();
		$('#process_'+counter).html('<div id="process_newsletter_'+counter+'"><i class="icon-refresh fa-spin"></i></div>');
		$.ajax({
			type:'POST', 
			url: admin_url,
			data:$('#mcform_'+counter).serialize()+'&action=cs_mailchimp', 
			success: function(response) {
				$('#mcform_'+counter).get(0).reset();
				$('#newsletter_mess_'+counter).fadeIn(600);
				$('#newsletter_mess_'+counter).html(response);
				$('#btn_newsletter_'+counter).fadeIn(600);
				$('#process_'+counter).html('');
			}
		});
	}
	
// js fucntion for news ticker
function fn_jsnewsticker(cls,startDelay,tickerRate){
	'use strict';
	var options = {
		newsList: "."+cls,
		startDelay: startDelay,
		tickerRate: tickerRate,
		controls: true,
		ownControls: false,
		stopOnHover: false,
		resumeOffHover: true
	}
	jQuery().newsTicker(options);
}

/* ---------------------------------------------------------------------------
	* Basic FitVids Function
 	* --------------------------------------------------------------------------- */
    jQuery(document).ready(function($) {
    	jQuery(".page-section").fitVids();
    });
    
    
      
    
    function point_table_tabs(thisObj, admin_url, atts, cs_point_table_num_post){
        
        jQuery('.active').removeClass('active');
        jQuery(thisObj).parent().addClass('active');
        
        var slug = jQuery(thisObj).data('slug');
        
	var holder_table = "<div class='holder-table'><div class='overlay'><i class='icon-refresh fa-spin'></i></div></div>";
        jQuery("#table_content").prepend(holder_table);
        
        var table_html = jQuery('.table');
        jQuery('.holder-table').prepend(table_html);

        var dataString = 'categorys=' + slug + '&atts=' + atts + '&cs_point_table_num_post=' + cs_point_table_num_post + '&action=cs_point_table_ajax_based';
                
        jQuery.ajax({
        type: 'GET',
        url: admin_url,
        data: dataString,
        success: function (response) {
            jQuery('#table_content').html(response);
        }
    });
                
    }
    
    
function goto_func(link){
    link = 'https://'+link;
    window.location.href = link;
}



wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();
    if(document.getElementById('moar')){
      document.getElementById('moar').onclick = function() {
	  var section = document.createElement('section');
      section.className = 'section--purple wow fadeInDown';
      this.parentNode.insertBefore(section, this);
      };
    }
