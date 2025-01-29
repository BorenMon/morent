import "cropperjs";
import "jquery-cropper";

var $image = $('#image');

$image.cropper({
  aspectRatio: 1 / 1,
  crop: function(event) {
    
  }
});

// Get the Cropper.js instance after initialized
var cropper = $image.data('cropper');