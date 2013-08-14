
$('.tooltip').tooltipster({
   animation: 'fade',
   arrow: true,
   arrowColor: '',
   content: '',
   delay: 200,
   fixedWidth: 0,
   maxWidth: 0,
   functionBefore: function(origin, continueTooltip) {
      continueTooltip();
   },
   functionReady: function(origin, tooltip) {},
   functionAfter: function(origin) {},
   icon: '(?)',
   iconDesktop: false,
   iconTouch: false,
   iconTheme: '.tooltipster-icon',
   interactive: false,
   interactiveTolerance: 350,
   offsetX: 0,
   offsetY: 0,
   onlyOne: true,
   position: 'top',
   speed: 350,
   timer: 0,
   theme: '.tooltipster-default',
   touchDevices: true,
   trigger: '',
   updateAnimation: true
});

$('#click-me1').click(function() {
   $('#jeff').tooltipster('show');
      
   // once a key is pressed on your keyboard, hide the tooltip
   $('#click-me1').keyboard(function() {
      $('#jeff').tooltipster('hide');
   });
});

$('#click-me2').click(function() {
   $('#jose').tooltipster('show');
      
   // once a key is pressed on your keyboard, hide the tooltip
   $('#click-me2').keyboard(function() {
      $('#jose').tooltipster('hide');
   });
});

$('#click-me3').click(function() {
   $('#tom').tooltipster('show');
      
   // once a key is pressed on your keyboard, hide the tooltip
   $('#click-me3').keyboard(function() {
      $('#tom').tooltipster('hide');
   });
});