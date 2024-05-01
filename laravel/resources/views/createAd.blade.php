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

        label.error {

            color: #fa0000;

            font-size: 14px;

            font-weight: 500;

        }



        #success_msg {

            color: #6b7d8e !important;

            text-align: center !important;

            font-size: 14px !important;

            font-weight: 500 !important;

        }



        .okbtn {

            min-width: auto;

            font-size: 18px !important;

        }



        .tab_title {

            padding: 10px;

        }



        .tab-content>.active {

            display: contents;

        }



        .avatar_img {

            padding: 10px;

        }



        #image_div {

            text-align: -webkit-center;

        }



        .side_logo {

            width: 60px;

        }



        .balance_btn {

            background-color: #003364;

        }



        #invite_link_btn {

            color: #003364;

            background-color: #fff;

        }



        .copy_owner_details:hover {

            color: #0c5396;

        }

    </style>

<meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    @include('include.game-header')
    <div class="content-wrapper" style="padding: 50px 0 250px 0;">

        <!--<div class="page-header">-->

        <!--    <h3 class="page-title">-->

        <!--        <span class="page-title-icon bg-gradient-primary text-white me-2">-->

        <!--            <i class="mdi mdi-home"></i>-->

        <!--        </span> Upload New Ad-->

        <!--    </h3>-->

        <!--</div>-->
         <div class="container" style="  width: 410px; text-align: center; height: 248px;">
            <div class="row justify-content-center">

        <div class="row">

            <div class="grid-margin stretch-card">

                <div class="card">

                    <div class="card-body">

                        <h4 class="card-title" style="padding: 15px 0 20px 0;background: #00d432; color: #000;">Upload Your Advertisement</h4>

                        <form class="forms-sample" id="createNewAd" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <input type='hidden' id='addPostingCost' name='addPostingCost' value='' />
                                <input type='hidden' id='addPostingDuration' name='addPostingDuration' value='' />
                                <label for="value" style=" padding: 5px 0 10px 0;">Advertisement Image</label>

                                <input type="file" class="form-control" id="uploaAdPic" name="uploaAdPic" style="width: 324px;margin-left: 20px;">
                                
                                <label for="value" style=" padding: 5px 0 10px 0; font-size:11px;">Image Size (1640 x 670px) Only in JPG Format</label>

                            </div>
                            <!--<button type="submit" class="btn btn-gradient-primary me-2">Submit</button>-->
                            <input type="submit" value="Submit" style="background: green; outline: green; margin-top: 15px; color: white; width: 100px; height: 45px; border: solid 1px green;
                                                                            border-radius: 12px;    font-size: 18px; "><br>
                            <div id="adPostStatus" style="margin-top: 11px;color: #f3630f;"></div>
                                                                            
                             <label for="value" style=" padding: 20px 0 7px 0; font-size:18px;">Select Package</label>
                             
                             <div class="col-md-12" style="padding: 15px 15px;font-size: 16px;">
                                 <?php
                                if($allAdPackages) {
                                    $i = 1;
                                ?>
                                 @foreach($allAdPackages as $item)
                                 <?php
                                $packageCostClassName = "packageCost " . $i;
                                $packageDurationClassName = "packageDuration " . $i;
                                ?>
                                 <input type="radio" class="selectAdsPackage" id="{{$packageCostClassName}}" duration="{{$item->Duration}}" name="package" value="{{$item->Cost}}"> ₹ {{$item->Cost}}  <label for="html">for {{$item->Duration}} Day</label>
                                 <?php $i++; ?>
                                 @endforeach
                                 <?php
                                }
                                ?>
                             </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>
        </div>
</div>
    </div>

    <!-- content-wrapper ends -->
    @include('include.footer')
</body>
</body>
</html>
<script>
$(document).ready(function() {
    $(".selectAdsPackage").click(function() {
        $("#addPostingCost").val(this.value);
        $(this).parents("form:first").find("#addPostingDuration").val($(this).attr('duration'));
    })
    function addNewAd() {
        var formData = new FormData(document.getElementById('createNewAd'));
    $.ajax({
    url: "{{ route('addNewaAd') }}",
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: function(response) {
        if(response.statusCode == 1 || response.statusCode == 3) {
            $("#header_wallet_balance").text(response.walletBalance);
        }
        $("#adPostStatus").text(response.msg);
    },
    error: function(error) {
    }
});
}
    $("form").on('submit', function(e) {
        e.preventDefault();
        if($(this).find("#addPostingCost").val() != "") {
            addNewAd();
        } else {
             $(this).find("#adPostStatus").text("Please select package!");
        }
        if($('#uploaAdPic')[0].files.length === 0) {
            $(this).find("#adPostStatus").text("Please select your ad picture!");
        }
    });
});

</script>