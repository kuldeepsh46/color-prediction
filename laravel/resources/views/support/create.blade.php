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

    </style>

<meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    @include('include.game-header')
    <div class="row justify-content-center" style="padding: 50px 0 50px 0; background-image: url('images/support.jpg');">
        <div class="col-md-8">
            <div class="card custom-card" style=" border: none;">
                <div class="card-body">
                    <div style="background: lightblue; font-size: 20px; color:#000 ; padding:10px;text-align:center;">SUPPORT SECTION...(Create Your Ticket)</div>
                    <form class="forms-sample" id="createTicket" enctype="multipart/form-data">
                        @csrf
                            <div class="row" style="width:100%; padding:40px 40px 40px 50px; ">
                                <div class="form-group mb-12 col-md-12" style="padding: 0px 0 15px 12px;">
                                <label class="form-label">@lang('Full Name :')</label>
                                <input type="text" name="name" value="{{ $userDetails->name }}" class="form--control" required readonly style="width: 25%;">&ensp;
                                
                                <label class="form-label">@lang('E-mail Address')</label>
                                <input type="email" name="email" value="{{ $userDetails->email }}" class="form--control" required readonly style="width: 25%;">&ensp;
                                
                                 <label class="form-label">@lang('Priority')</label>
                                    <select name="priority" class="select" required>
                                        <option value="3">@lang('High')</option>
                                        <option value="2">@lang('Medium')</option>
                                        <option value="1">@lang('Low')</option>
                                    </select>
                                </div>

                                <div class="form-group mb-12 col-md-12">
                                    <label class="form-label" style="  margin-bottom: 21px;">@lang('Subject')</label>&emsp;&ensp;
                                    <input type="text" name="subject" class="form--control" required style="width: 90%;" >
                                </div>
                        
                                <div class="col-12 mb-12">
                                    <label class="form-label">@lang('Message')</label>
                                    <textarea name="message" id="inputMessage" rows="6" class="form--control" required style=" width: 100%;"></textarea>
                                </div>
                            

                        <div class="form-group">
                            <div class="text-end">
                                <button type="button" class="btn btn--base btn-sm addFile" style=" background: green; margin-top: 10px; color: #fff;">
                                    <i class="fa fa-plus"></i> @lang('Add New')
                                </button>
                            </div>
                            <div class="file-upload" style="border: solid 1px grey; padding: 10px;">
                                <label class="form-label">@lang('Attachments')</label> <small
                                    class="text-danger">@lang('(Max 5 files can be uploaded)'). @lang('Maximum upload size is')
                                    {{ ini_get('upload_max_filesize') }})</small><br>
                                <input type="file" name="attachments[]" id="inputAttachments"
                                    class="form--control mb-2 attach" />
                                <div id="fileUploadsContainer"></div>
                                <p class="ticket-attachments-message text-muted mb-2">
                                    @lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'),
                                    .@lang('pdf'), .@lang('doc'), .@lang('docx')
                                </p>
                            </div>

                        </div>

                        <div class="form-group">
                            <button class="btn btn--base w-100" type="submit" style=" background: lightblue;padding: 10px;margin-top: 10px;"><i
                                    class="fa fa-paper-plane"></i>&nbsp;@lang('Submit')</button>
                        </div>
                        <!--<div class="form-group">-->
                        <!--    <div id='supportTicketCreated'></div>-->
                        <!--</div>-->
                    </form>
                </div>
            </div>
        
    </div>
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
                        // console.log(response);
                        // $('#supportTicketCreated').html('Tickets Created Successfully!');
                        // alert('Ticket Created Successfully');
                        // if(confirm('Ticket Created Successfully!')){
                        //     window.location = '';  
                        // }
                        if(!alert('Ticket Created Successfully!')) {
                            window.location.href = window.location.protocol + "//" + window.location.host;
                        }
                        setTimeout(() =>{
                            $('#supportTicketCreated').html('');
                        }, 7000);
                    },
                    error: function(error) {
                    }
                });
            });
        })(jQuery);
    </script>