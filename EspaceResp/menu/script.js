
$(document).ready(function(){
    $(".menu").click(function(){
        $(".keep").toggleClass("width");

    });
});

$(".menu" ).click(function() {
  if($("aside").css("width")!="60px") {
        
           $("article").css("margin-left","60px");
      } 
  else{ 
    
       $("article").css("margin-left","220px");
      }
});