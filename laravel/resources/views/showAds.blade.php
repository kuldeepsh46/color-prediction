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
     <table class="table">
  <thead>
    <tr class="table-dark">
      <th scope="col">#</th>
      <th scope="col">Ad Name</th>
      <th scope="col">Ad Image</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      {{$i = 1}}
      @foreach($allUserAds as $item)
      @if($item->status == 0)
      {{$adStatus = "Not Active"}}
      @else
      {{$adStatus = "Active"}}
      @endif
      <tr class="table-dark">
          <td>{{$i}}</td>
      <td>{{$item->image}}</td>
      <td><img src="images/Adds/{{$item->image}}" height="100px" width="120px"  /></td>
      <td>{{$adStatus}}</td>
      <td>
          @if($item->status == 0)
          <form class="forms-sample {{$i}}" id="activateAd-{{$i}}" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="adPic" value="{{$item->image}}" />
              <input type="hidden" name="adPostingCost" class="adPostingCost" value="" />
              <input type="hidden" name="adPostingDuration" class="adPostingDuration" value="" />
              <label for="value" style=" padding: 25px 0 10px 0; font-size:16px;">Select Package</label>
              <div class="col-md-12">
                                 <?php
                                if($allAdPackages) {
                                    $i = 1;
                                ?>
                                 @foreach($allAdPackages as $item)
                                 <?php
                                $packageCostClassName = "packageCost " . $i;
                                $packageDurationClassName = "packageDuration " . $i;
                                ?>
                                 <input type="radio" class="selectAdsPackage" id="{{$packageCostClassName}}" name="package" value="{{$item->Cost}}" duration="{{$item->Duration}}"> ₹ {{$item->Cost}}  <label for="html">for {{$item->Duration}} Day</label>
                                 <?php $i++; ?>
                                 @endforeach
                                 <?php
                                }
                                ?>
                             </div>
                             <input type="submit" class="activateAdBtn" value="Activate Ad" style="background: green; outline: green; margin-top: 15px; color: white; width: 100px; height: 45px; border: solid 1px green;
                                                                            border-radius: 12px;    font-size: 18px; ">
                            <div class="adActivateStatus"></div>
          </form>
          @else
          <span>Ad Activate Till {{$item->validTill}}</span>
          @endif
      </td>
      </tr>
      {{$i++}}
      @endforeach
  </tbody>
</table>
@include('include.footer')
</body>
</html>
<script>
$(document).ready(function() {
    $(".selectAdsPackage").click(function() {
        $(this).parents("form:first").find(".adPostingCost").val(this.value);
        $(this).parents("form:first").find(".adPostingDuration").val($(this).attr('duration'));
    })
    $("form").on('submit', function(e) {
            e.preventDefault();
            var id = this.id;
            if($("#" + id).find(".adPostingCost").val() != "") {
                $("#" + id).find(".adActivateStatus").text("");
                var formData = new FormData(document.getElementById(this.id));
                    $.ajax({
                    url: "{{ url('allAds') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response.statusCode == 0) {
                            $("#header_wallet_balance").text(response.walletBalance);
                        }
                        // console.log(id);
                        $("#" + id).parents("td:first").text(response.msg);
                    },
                    error: function(error) {
                    }
                });
            } else {
                $("#" + id).find(".adActivateStatus").text("Please select package!");
            }
    });
});

</script>