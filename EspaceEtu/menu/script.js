$(document).ready(function(){
    $(".menu").click(function(){
        $(".keep").toggleClass("width");
    });
});

$("#img").hide();
$(".menu" ).click(function() {
  if($("aside").css("width")!="60px") {
           $("#img").hide(); 
           $("article").css("margin-left","60px");
      } 
  else{ 
       $("#img").show();
       $("article").css("margin-left","220px");
      }
});