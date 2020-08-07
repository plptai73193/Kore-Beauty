
// slider 
$('.images_before_after .slider').slick({
     // code here

 }).on('beforeChange', (event, slick, currentSlide, nextSlide) => {
     if (currentSlide !== nextSlide) {
         document.querySelectorAll('.slick-center + .slick-cloned').forEach((next) => {
             setTimeout(() => next.classList.add('slick-current', 'slick-center'));
         });
     }
 });
// resize
 function myResizeFunction() {
     // var w = $(".sale_off .content").width() - $('.sale_off .images').width();
     // $(".sale_off .content_main").css({
     //     width: w
     // })
 }
 myResizeFunction();
 $(function () {
     $(window).resize(myResizeFunction).trigger('resize');
 });