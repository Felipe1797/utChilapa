$(document).ready(function()
	{
		$(window).scroll(function() { 
        if ($(document).scrollTop() > 90) { 
          $(".navbar").css({"background-color": "rgb(4, 126, 137)","-webkit-transition": "background-color 2s", "transition": "background-color 2s"}); 
        } else {
          $(".navbar").css({"background-color": "rgba(65, 78, 106, .45)", "-webkit-transition": "background-color 1s", "transition": "background-color 1s"}); 
      }
      });
    
		$('.navbar-nav li a.dropdown-togglee').click(function(e)
		{
			e.preventDefault();
			$(this).parent().toggleClass('open');
		});
		$('[data-toggle="collapsee"]').click(function()
		{
			var target = $(this).attr('data-target');
			$(target).toggleClass('iin');
		});
    
    $(".navbar-togglee").on("click", function () {
				    $(this).toggleClass("active");
    });
    
     $('[data-tooltipp="tooltip"]').tooltip()
          
	});
    
