$(".accordion > div").hide().parent().hover(function(event) {
  $(this).children("div").slideToggle(event.type === "mouseenter");
});