<?php 

$title = "CHECK MALT";

?>

<div id="loader" class="loading">
  <img src="media/loading.gif" alt="">
</div>


<div class="headerPin">
  <canvas id="jagerCanvas"></canvas>
  <div class="header-title">
    <div class="header-title-left">
      <h1 id="subHeader-left-text" class="main-header-title">CHECK</h1>
    </div>
    <div class="header-title-right">
      <h1 id="subHeader-right-text" class="main-header-title">MALTS</h1>
    </div>
  </div>
  <div id="scroll-down" class="bottom-header">
    <h1>SCROLL DOWN</h1>
    <i class="fas fa-chevron-down"></i>
  </div>
</div>


<script type="text/javascript">

animateCanvas("jagerCanvas", 3840, 2160, 150, "media/jagerFrame/", ".headerPin", "top", "bottom", true, false);

$(document).ready(function(){
  $('#scroll-down').click(function(){
    $([document.documentElement, document.body]).animate({
        scrollTop: $(".cocktailsPin").offset().top
    }, 5000);
  })
})

const headerTitleAnimation = gsap.timeline( { 
  scrollTrigger: {
    trigger: ".headerPin",
    start: "100 top+=150",
    end: "center top+=250",
    scrub: 2,
    markers: false
  }  
});
 
headerTitleAnimation
  .to('#jagerCanvas', { opacity: 0, duration: 5 }, 5)
  .to('#jagerCanvas', { opacity: 1, duration: 5 }, 5)
  .to("#subHeader-left-text", {duration: 5, text: {value:"The Best <span style='font-weight:500'>Cocktails</span> in Town!", newClass: "main-header-title-B"}, delay: 5, ease: "power2"}, "end")
  .to("#subHeader-right-text", {duration: 5, text: {value:"From <span style='font-weight:500'>Mojito</span> to <span style='font-weight:500'>Margarita</span>", newClass: "main-header-title-B"}, delay: 5,  ease: "power2"}, "end")

</script>