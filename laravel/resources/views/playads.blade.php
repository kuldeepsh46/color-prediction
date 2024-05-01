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
    section {
    position: relative;
    width: 320px;
    height: 33vh;
}

section video {
    position: absolute;
    top: 0;
    left: 0;
    width:320px;
    height: auto;
    object-fit: cover;
}
section .navigation {
    position: absolute;
    bottom: 0px;
    left: 45%;
    transform: translateX(-50%);
    z-index: 100;
    display: flex;
    justify-content: center;
    align-items: center;
}

section .navigation li {
    list-style: none;
    cursor: pointer;
    margin: 0 10px;
    border-radius: 1px;
    background: #fff;
    padding: 1px 1px 0;
    opacity: 0.7;
    transition: 0.5s;
}

section .navigation li:hover {
    opacity: 1;
}


section .navigation li img {
    width: 50px;
    transition: 0.5s;
}

section .navigation li img:hover {
    width: 75px;
}
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    @include('include.game-header')
    <div class="content-wrapper" style="padding: 50px 0 250px 0;">
         <div class="container" style="  width: 410px; text-align: center; height: 248px;">
            <div class="row justify-content-center">

        <div class="row">

            <div class="grid-margin stretch-card">

                <div class="card">

                    <div class="card-body">

                        <h4 class="card-title" style="padding: 15px 0 20px 0;background: #ffb700; color: #000;">Upload Your Advertisement</h4>
 <div class="owl-carousel owl-theme owl-loaded owl-drag" style="padding-top: 20px;">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(-894px, 0px, 0px); transition: all 0.25s ease 0s; width: 3278px;">
                        <div class="owl-item" style="width: 298px; height: 140px">
                            <div class="item">
                                <video class="video-player" width="400px" height="auto" controls="controls" controls preload="metadata" autoplay="autoplay" playsinline> 
                                <source src="images/video/song1.mp4" type="video/mp4" ></video>
                            </div>
                        </div>
                        <div class="owl-item" style="width: 298px; height: 140px">
                            <div class="item">
                                <video class="video-player" width="400px" height="auto" controls="controls" controls preload="metadata" autoplay="autoplay" playsinline> 
                                <source src="images/video/song2.mp4" type="video/mp4" ></video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    <!--<section>-->
    <!--    <video id="slider"  class="video-player" controls="controls" controls preload="auto" autoplay="auto-play" loop playsinline muted class="owl-carousel owl-theme owl-loaded owl-drag">-->
    <!--        <source src="images/video/Jeena.mp4" type="video/mp4">-->
    <!--    </video>-->

    <!--    <ul class="navigation">-->
    <!--        <li><img onclick="videoUrl('images/video/song1.mp4')" src="images/23.jpg" alt=""></li>-->
    <!--        <li><img onclick="videoUrl('images/video/new_song.mp4')" src="images/24.jpg" alt=""></li>-->
    <!--        <li><img onclick="videoUrl('images/video/punjabi_song.mp4')" src="images/25.jpg" alt=""></li>-->
    <!--        <li><img onclick="videoUrl('images/video/song2.mp4')" src="images/26.jpg" alt=""></li>-->

    <!--    </ul>-->
    <!--    <div style="color:#fff;position: relative; font-size: 14px;text-align: right;padding: 4px 6px 0px 0;"><a href="https://www.youtube.com/watch?v=NxfzbXTBE2Y">-->
    <!--        <span style="color:red; font-style: italic;">Click Here.. </span> For Full Video on YouTube</a></div>-->
    </section>

    <script>
        function videoUrl(url) {
            document.getElementById("slider").src = url;
            
            }
        
    </script>

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