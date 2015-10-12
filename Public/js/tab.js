$(".footer ul li").click(function(e) {

  // make sure we cannot click the slider
  if ($(this).hasClass('slider')) {
    return;
  }

  /* Add the slider movement */

  // what tab was pressed
  var whatTab = $(this).index();

  // Work out how far the slider needs to go
  var howFar = 25 * whatTab;

  $(".slider").css({
    left: howFar + "%"
  });
  $(".slider").attr('index',whatTab);
  /* Add the ripple */

  // Remove olds ones
  $(".ripple").remove();

  // Setup
  var posX = $(this).offset().left,
      posY = $(this).offset().top,
      buttonWidth = $(this).width(),
      buttonHeight = $(this).height();

  // Add the element
  $(this).prepend("<span class='ripple'></span>");

  // Make it round!
  if (buttonWidth >= buttonHeight) {
    buttonHeight = buttonWidth;
  } else {
    buttonWidth = buttonHeight;
  }

  // Get the center of the element
  var x = e.pageX - posX - buttonWidth / 2;
  var y = e.pageY - posY - buttonHeight / 2;

  // Add the ripples CSS and start the animation
  $(".ripple").css({
    width: buttonWidth,
    height: buttonHeight,
    top: y + 'px',
    left: x + 'px'
  }).addClass("rippleEffect");
});

//content切換
$(document).ready(function(e) {
  $(".slider").attr('index',0);
  $("#index").on("swipeleft",function(){
      $('.tab_list li').eq($(".slider").attr('index')).next('li').trigger('click');
});
  $("#index").on("swiperight",function(){
      $('.tab_list li').eq($(".slider").attr('index')).prev('li').trigger('click');
});
    $(".footer ul li").click(function(){
    //$("#p1").animate({left: '100%'});
    //$("#p1").removeClass('act');
    
    var pre_index=$(".act").attr('index');
    var act_index=$($(this).attr('href')).attr('index');
    var next=$($(this).attr('href'));
    var pre=$("#p"+pre_index);
    if(act_index>pre_index){
      next.removeClass('next');
      next.addClass('act');
      pre.removeClass('act');
      for(var i=1;i<act_index;i++){
        pre=$("#p"+i);
        pre.removeClass('next');
        pre.addClass('pre');
      } 
    }
    else if(act_index<pre_index){
      next.removeClass('pre');
      next.addClass('act');
      pre.removeClass('act');
      for(var i=pre_index;i>act_index;i--){
        pre=$("#p"+i);
        pre.removeClass('pre');
        pre.addClass('next');
      }
    }

    });
    
});