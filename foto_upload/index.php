<html>  
    <head>  
  
 
  <script src="croppie.js"></script>
  <link rel="stylesheet" href="croppie.css" />
   </head>
<div class="demo"></div>
<!-- or even simpler -->
<img class="my_image" id="my_image" src="man-woman-thinking(1).png" />
<script>

var el = document.getElementById('my_image');
var vanilla = new Croppie(el, {
    viewport: {
        width: 150,
        height: 200
    },
    boundary: { width: 300, height: 300 },
    showZoomer: false,
    enableOrientation: true
});

vanilla.bind({
    url: 'man-woman-thinking(1).png',
    points: [77,469,280,739]
});
vanilla.result('blob').then(function(blob) {
    // do something with cropped blob
});
</script>
</body>
