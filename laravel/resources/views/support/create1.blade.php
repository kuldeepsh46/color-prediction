<html>
    <head>
<script src="../vendor/jquery/jquery-3.6.1.min.js"></script>
<script src="../vendor/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/js/jquery.min.js"></script>
<script src="/js/popper.min.js"></script>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../user/aviatorbyapp.js"></script>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />



    <!--====== Title ======-->

    <title>{{ env('APP_NAME') }}</title>



    <!--====== Favicon Icon ======-->

    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/png" />



    <!--====== Material Design Icons CSS ======-->

    <!-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500&family=Oswald:wght@200;300;400&display=swap" rel="stylesheet"> -->

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"

        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />



    <!--====== mCustomScrollbar CSS ======-->

    <link rel="stylesheet" href="../../css/jquery.mCustomScrollbar.min.css" />



    <!--====== Pretty Checkbox CSS ======-->

    <link rel="stylesheet" href="../../css/pretty-checkbox.min.css" />

    <!--====== Cuntry Selection CSS ======-->

    <link rel="stylesheet" href="../../css/niceCountryInput.css" />

    <link rel="stylesheet" type="text/css" href="../../css/jquery.ccpicker.css">



    <!--====== Bootstrap CSS ======-->

    <link rel="stylesheet" href="../../css/bootstrap.css" />



    <!--====== Owl Carousel CSS ======-->

    <link rel="stylesheet" href="../../css/owl.carousel.min.css" />



    <!--====== Style CSS ======-->

    <link rel="stylesheet" href="../../css/style.css" />



    <!-- ====== Toastr CSS ====== -->

    <link rel="stylesheet" href="../../css/toastr.min.css" />



    <!-- ====== Datatable CSS ====== -->

    <link rel="stylesheet" href="../../css/dataTables.bootstrap5.min.css" />

    <link rel="stylesheet" href="../../css/responsive.dataTables.min.css" />



    <script crossorigin src="https://unpkg.com/react@18/umd/react.production.min.js"></script>

    <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>

    <style>

        
        .input-group-text:focus {
            box-shadow: none !important;
        }
        
        
        
        input[type=text], select, textarea{
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  resize: vertical;
}

/* Style the label to display next to the inputs */
label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

/* Style the submit button */
input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

/* Style the container */
.container_sp {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

/* Floating column for labels: 25% width */
.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

/* Floating column for inputs: 75% width */
.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}

    </style>

<meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    @include('include.game-header')
    <div class="container_sp">
  <form action="action_page.php">
    <div class="row">
      <div class="col-25">
        <label for="fname">First Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="fname" name="firstname" placeholder="Your name..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Last Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="lastname" placeholder="Your last name..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="country">Country</label>
      </div>
      <div class="col-75">
        <select id="country" name="country">
          <option value="australia">Australia</option>
          <option value="canada">Canada</option>
          <option value="usa">USA</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="subject">Subject</label>
      </div>
      <div class="col-75">
        <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Submit">
    </div>
  </form>
</div>
    @include('include.footer')
</body>
</body>
</html>
<script>
        (function($) {
            "use strict";
            var fileAdded = 0;
            $('.addFile').on('click', function() {
                if (fileAdded >= 4) {
                    notify('error', 'You\'ve added maximum number of file');
                    return false;
                }
                fileAdded++;
                $("#fileUploadsContainer").append(`
                    <div class="input-group my-3">
                        <input type="file" name="attachments[]" class="form-control form--control" required />
                        <button type="button" class="input-group-text btn-danger remove-btn"><i class="las la-times"></i></button>
                    </div>
                `)
            });
            $(document).on('click', '.remove-btn', function() {
                fileAdded--;
                $(this).closest('.input-group').remove();
            });
            
            $("form").on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(document.getElementById('createTicket'));
                $.ajax({
                    url: "{{ url('create-ticket') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                    },
                    error: function(error) {
                    }
                });
            });
        })(jQuery);
    </script>