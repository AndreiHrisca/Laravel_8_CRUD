$(document).ready(function() {
    $(".basic-form").validate({
      rules: {
        name : {
          required: true,
          minlength: 3
        },
        email: {
          required: true,
          email: true
        }
      }
    });
});

