$(document).ready(function() {
var waypoint = new Waypoint({
  element: document.getElementById("titulo1"),
  handler: function(direction) {
    $("#titulo1").addClass("bounce animated");
    $("#titulo1").live("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",(function() {
      $(this).removeClass("bounce animated");
    }));
  },
  offset: 300
})

var waypoint = new Waypoint({
  element: document.getElementById("titulo2"),
  handler: function(direction) {
    $("#titulo2").addClass("bounce animated");
    $("#titulo2").live("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",(function() {
      $(this).removeClass("bounce animated");
    }));
  },
  offset: 300
})
var waypoint = new Waypoint({
  element: document.getElementById("wpcf7-f65-p73-o1"),
  handler: function(direction) {
    $("#titulo2").addClass("bounce animated");
    $("#titulo2").live("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",(function() {
      $(this).removeClass("bounce animated");
    }));
  },
  offset: 300
})
var waypoint = new Waypoint({
  element: document.getElementById("titulo3"),
  handler: function(direction) {
    $("#titulo3").addClass("bounce animated");
    $("#titulo3").live("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",(function() {
      $(this).removeClass("bounce animated");
    }));
  },
  offset: 300
})
var waypoint = new Waypoint({
  element: document.getElementById("titulo4"),
  handler: function(direction) {
    $("#titulo4").addClass("bounce animated");
    $("#titulo4").live("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",(function() {
      $(this).removeClass("bounce animated");
    }));
  },
  offset: 300
})
var waypoint = new Waypoint({
  element: document.getElementById("iconos"),
  handler: function(direction) {
    $("#iconos .ico img").each(function(i){
        var t = $(this);
        // $(".oculto ul li").css('display','block');
        setTimeout(function(){ t.addClass("flipInY animated"); }, (i+1) * 800);
    });
    $("#iconos .ico img").live("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",(function() {
      $(this).removeClass("flipInY animated");
    }));
  },
  offset: 400
})
});