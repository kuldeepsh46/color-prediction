@extends('Layout.usergame')
@section('content')
<style>
    /*.sid{*/
    /*    margin-top:10px;*/
    /*}*/
    .teringtitle{
        display:flex;
        margin:auto;
        justify-content: space-between;
        margin-top:20px;
        margin-bottom:20px;
    }
    .trgbtn{
    background: #00bd4e;
    padding: 5px;
    font-size:10px;
    padding-left:10px;
    padding-right:10px;
    border-radius: 25px;
    color:#000;
}
    .trgbtn:hover{
    background: #FFF;
    .a{
    	color:red;
    }

}
.trgbtn a{
    font-size:15px;
    color:#000;
}
.tringgame span{
    color: #00bd4e;
}
.tringgame{
    font-size:20px;
}
.tringgame img{
    width:30px;
}
</style>


<div class="main-container">
    <div class="collection-page d-none sid" style="margin-top: 18px;">
        <!--====== Slider Start ======-->
        <div class="owl-carousel owl-theme" id="homepage">
            <div class="item" data-autoplay-timeout="5000"><img src="images/3.jpg" class="w-100" /></div>
            <div class="item" data-autoplay-timeout="5000"><img src="images/3a.jpg" class="w-100" /></div>
            <div class="item" data-autoplay-timeout="5000"><img src="images/3b.jpg" class="w-100" /></div>
            <div class="item" data-autoplay-timeout="5000"><img src="images/3c.jpg" class="w-100" /></div>
            <div class="item" data-autoplay-timeout="5000"><img src="images/3d.jpg" class="w-100" /></div>
        </div>


        <!--====== Slider End ======-->
       @if (session()->has('userlogin'))   
         <section id="choice" class="pt-12 pb-12">
							<div class="container">
							 <div class="row trend_2 mt-4">
  							 <div id="carouselExampleCaptions3" class="carousel slide" data-bs-ride="carousel">
  									<div class="carousel-inner">
    									<div class="carousel-item active">
      									<div class="trend_2i row">
	    										<div class="col-md-4">
		  											<div class="trend_2im clearfix position-relative">
		   												<div class="trend_2im1 clearfix">
		     												<div class="grid">
		  													<figure class="effect-jazz mb-0">
																 <a class=" avitot active" aria-current="page" href="/crash" ><img src="images/avi11.png" class="w-100" alt="img25"></a>
		  													</figure>
	  														</div>
		   												</div>
		  											</div>
													</div>
													
													<div class="col-md-4">
		  											<div class="trend_2im clearfix position-relative">
		   												<div class="trend_2im1 clearfix">
		     												<div class="grid">
		  													<figure class="effect-jazz mb-0">
																 <a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/avi_112.png" class="w-100" alt="img25"></a>
		  													</figure>
	  														</div>
		   												</div>
		  											</div>
													</div>
													
													<div class="col-md-4">
		  											<div class="trend_2im clearfix position-relative">
		   												<div class="trend_2im1 clearfix">
		     												<div class="grid">
		  													<figure class="effect-jazz mb-0">
																 <a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/avi_113.png" class="w-100" alt="img25"></a>
		  													</figure>
	  														</div>
		   												</div>
		  											</div>
													</div>
													
													
													
	  										</div>
    									</div>
										</div>
 									</div>
								</div>
						</section>
						@else
						<section id="choice" class="pt-12 pb-12">
							<div class="container">
							 <div class="row trend_2 mt-4">
  							 <div id="carouselExampleCaptions3" class="carousel slide" data-bs-ride="carousel">
  									<div class="carousel-inner">
    									<div class="carousel-item active">
      									<div class="trend_2i row">
	    										<div class="col-md-4">
		  											<div class="trend_2im clearfix position-relative">
		   												<div class="trend_2im1 clearfix">
		     												<div class="grid">
		  													<figure class="effect-jazz mb-0">
																 <a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/avi11.png" class="w-100" alt="img25"></a>
		  													</figure>
	  														</div>
		   												</div>
		  											</div>
													</div>
													
													<div class="col-md-4">
		  											<div class="trend_2im clearfix position-relative">
		   												<div class="trend_2im1 clearfix">
		     												<div class="grid">
		  													<figure class="effect-jazz mb-0">
																 <a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/avi_112.png" class="w-100" alt="img25"></a>
		  													</figure>
	  														</div>
		   												</div>
		  											</div>
													</div>
													
													<div class="col-md-4">
		  											<div class="trend_2im clearfix position-relative">
		   												<div class="trend_2im1 clearfix">
		     												<div class="grid">
		  													<figure class="effect-jazz mb-0">
																 <a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/avi_113.png" class="w-100" alt="img25"></a>
		  													</figure>
	  														</div>
		   												</div>
		  											</div>
													</div>
													
													
													
	  										</div>
    									</div>
										</div>
 									</div>
								</div>
						</section>
						 @endif


        <!--====== Game List Start ======-->
@if (session()->has('userlogin'))
        <div class="container">
            <div class="teringtitle">
                <div class="tringgame"><img src="images/logonew.png" alt="">  Trending <span>Games</span></div>
                <div class="tringgame trgbtn"><a href="">view all</a></div>
            </div>
             <div class="row trend_2 mt-4">
   <div id="carouselExampleCaptions1" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide-to="1" aria-label="Slide 2" class="" aria-current="true"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="trend_2i row">
	    <div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
			<a class=" avitot active" aria-current="page" href="/crash" ><img src="images/11.jpg" class="w-100" alt="img25"></a>
		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="/crash">Aviator</a></h5>
			<p class="mb-2"style="font-size: 14px;">Aviator game's main objective is to cash out your bet before the plane crash. </p>
			
		  </div>  
		</div>
		<div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/5.jpg" class="w-100" alt="img25"></a>
		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="#">Roulette</a></h5>
			<p class="mb-2"style="font-size: 14px;">Roulette in the game, a player may choose to place a bet on a single number</p>
			
		  </div>  
		</div>
		<div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/6.jpg" class="w-100" alt="img25"></a>
            		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="#">Color Prediction</a></h5>
			<p class="mb-2"style="font-size: 14px;">Color Prediction is very simple and profitable game. Only choose one color and bet .</p>
			
		  </div>  
		</div>
		<div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/12.jpg" class="w-100" alt="img25"></a>
		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="#">Teen Patti</a></h5>
			<p class="mb-2"style="font-size: 14px;">Teen Patti is gambling card game originated popular throughout South Asia.</p>
			
		  </div>  
		</div>
		
	  </div>
    </div>

    <div class="carousel-item">
      <div class="trend_2i row">
	    <div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/7.jpg" class="w-100" alt="img25"></a>
		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="#">Roulette</a></h5>
			<p class="mb-2"style="font-size: 14px;">Roulette in the game, a player may choose to place a bet on a single number</p>
			
		  </div>  
		</div>
		<div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/9.jpg" class="w-100" alt="img25"></a>
		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="#">Spin Win</a></h5>
			<p class="mb-2"style="font-size: 14px;">Players bet on where they predict number the ball will land on the roulette wheel.</p>
			
		  </div>  
		</div>
		<div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/10.jpg" class="w-100" alt="img25"></a>
		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="#">Poker</a></h5>
			<p class="mb-2"style="font-size: 14px;">It's a family of comparing card games in which players over which hand is best.</p>
			
		  </div>  
		</div>
		<div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
			<a class=" avitot active" aria-current="page" href="/crash" ><img src="images/4.jpg" class="w-100" alt="img25"></a>
		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="#">Aviator</a></h5>
			<p class="mb-2"style="font-size: 14px;">Aviator game's main objective is to cash out your bet before the plane crash. </p>
			
		  </div>  
		</div>
	  </div>
    </div>
    
  </div>

</div>
 </div>
</div>
            <!--<section id="upcome" class="pt-4 pb-5">-->
            <!--    <div class="container" style=" margin-top: 35px;">-->
            <!--     <div class="row trend_1">-->
            <!--      <div class="col-md-12 col-12">-->
            <!--       <marquee behavior="alternate" width="100%" direction="right" height="100px">-->
            <!--        <img src="images/28.jpg" width="180" height="120" alt="Natural" />-->
            <!--        <img src="images/29.jpg" width="180" height="120" alt="Natural" />-->
            <!--        <img src="images/30.jpg" width="180" height="120" alt="Natural" />-->
            <!--        <img src="images/31.jpg" width="180" height="120" alt="Natural" />-->
            <!--        <img src="images/32.jpg" width="180" height="120" alt="Natural" />-->
            <!--        <img src="images/33.jpg" width="180" height="120" alt="Natural" />-->
            <!--        <img src="images/34.jpg" width="180" height="120" alt="Natural" />-->
            <!--       </marquee>-->
            <!--      </div>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--</section>-->


        
            
            <section id="choice" class="pt-4 pb-5">
            <div class="container">
              <div class="teringtitle">
                            <div class="tringgame"><img src="images/logonew.png" alt="">  Most  <span> Popular Games </span></div>
                            <div class="tringgame trgbtn"><a href="">view all</a></div>
                        </div>
             <div class="row trend_2 mt-4">
               <div id="carouselExampleCaptions3" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="1" aria-label="Slide 2" class="" aria-current="true"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="trend_2i row">
            	    <div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/35.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="/crash" ><img src="images/36.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/37.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		
            	  </div>
                </div>
                <div class="carousel-item">
                  <div class="trend_2i row">
            	    
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/38.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="/crash" ><img src="images/39.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		  
            		  </div>
            		    
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/40.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            
            		    
            		</div>
            	  </div>
                </div>
                
              </div>
            
            </div>
             </div>
            </div>
            </section>
            
            <div class="container">
            <section id="upcome" class="pt-4 pb-5">
              <div class="teringtitle">
                            <div class="tringgame"><img src="images/logonew.png" alt="">  Upcoming <span>Games</span></div>
                            <div class="tringgame trgbtn"><a href="">view all</a></div>
                        </div>
             <div class="row trend_2 mt-4">
               <div id="carouselExampleCaptions2" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide-to="1" aria-label="Slide 2" class="" aria-current="true"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="trend_2i row">
            	    <div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/12 (1).jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		  
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/13.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            		<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/14.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		  
            		</div>
            		
            	  </div>
                </div>
                <div class="carousel-item">
                  <div class="trend_2i row">
            	    
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/15.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		  
            		  </div>
            		  
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/16.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		  
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/17.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   
            		  </div>
            
            		  
            		</div>
            	  </div>
                </div>
                
              </div>
            
            </div>
             </div>
            </div>
            </section>
            
            
            <section id="stream" class="pb-5 pt-4">
            <div class="container">
              <div class="teringtitle">
                            <div class="tringgame"><img src="images/logonew.png" alt="">  Online <span> Video Games </span></div>
                            <div class="tringgame trgbtn"><a href="">view all</a></div>
                        </div>
             <div class="row trend_2 mt-4">
               <div id="carouselExampleCaptions4" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions4" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions4" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="trend_2i row">
            	    <div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/41.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		  
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/42.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		  
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/43.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		 
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/44.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/45.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            	  </div>
                </div>
                <div class="carousel-item">
                  <div class="trend_2i row">
            	    <div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/46.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/47.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		  
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a href="#"><img src="images/48.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		  
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/49.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/50.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		  
            		  </div>
            		    
            		</div>
            	  </div>
                </div>
                
              </div>
            </div>
            </div>
            
            
            <!-- Chatboat start -->
            
            <!--<div class="chat-bar-collapsible">-->
            	
            <!--	<span id="chat-button" class="collapsible"><img src="images/bot3.gif"></span>-->
            
            <!--	<div class="content"  style="flex-wrap: wrap;">-->
            
            <!--		<div class="full-chat-block">-->
            
            			<!-- Message Container -->
            <!--			<div class="outer-container" >-->
            <!--						<p style="padding: 10px 10px 10px 20px; background: #0790cd; position: fixed; z-index: 99; width: 350px"> Hi! 👋 it's great to see you!</p>-->
            						
            
            						
            <!--				<div class="chat-container">-->
            					<!-- Messages -->
            <!--					<div id="chatbox" style="padding: 200px 6px 0 6px; overflow:hidden;">-->
            <!--						<h5 id="chat-timestamp"></h5>-->
            <!--						<p style="padding: 7px 10px 5px 20px; color: #000; background: #e0e0e0; "> Please Select Your Query!</p>-->
            <!--						<p id="botStarterMessage" class="botText"><span> 📩 Deposit Related ! <br> 📩 Withdrawal Related ! <br> 🚀 Application Related !</span></p>-->
            <!--					</div>-->
            
            					<!-- User input box -->
            <!--					<div class="chat-bar-input-block">-->
            <!--						<div id="userInput">-->
            <!--							<input id="textInput" class="input-box" type="text" name="msg"-->
            <!--								placeholder="Tap 'Enter' to send a message">-->
            <!--							<p></p>-->
            <!--						</div>-->
            
            <!--						<div class="chat-bar-icons">-->
            							<!--<i id="chat-icon" style="color: crimson;" class="fa fa-fw fa-heart"-->
            							<!--	onclick="heartButton()"></i>-->
            <!--							<i style="color:blue;" class="fa-solid fa-paper-plane" onclick="sendButton()"></i>-->
            							<!--<i id="chat-icon" style="color: #333;" class="fa fa-fw fa-send"-->
            							<!--	></i>-->
            <!--						</div>-->
            <!--					</div>-->
            <!--					<div id="chat-bar-bottom">-->
            <!--						<p></p>-->
            <!--					</div>-->
            
            <!--				</div>-->
            <!--			</div>-->
            
            <!--		</div>-->
            <!--	</div>-->
            
            <!--</div>-->
            
            
            
            
            </div>
             </div>
            </div>
            
            
            <script>
            window.onscroll = function() {myFunction()};
            
            var navbar_sticky = document.getElementById("navbar_sticky");
            var sticky = navbar_sticky.offsetTop;
            var navbar_height = document.querySelector('.navbar').offsetHeight;
            
            function myFunction() {
              if (window.pageYOffset >= sticky + navbar_height) {
                navbar_sticky.classList.add("sticky")
            	document.body.style.paddingTop = navbar_height + 'px';
              } else {
                navbar_sticky.classList.remove("sticky");
            	document.body.style.paddingTop = '0'
              }
            }
            </script>
            </section>
        </div>
@else
         <div class="container">
            <div class="teringtitle">
                <div class="tringgame"><img src="images/logonew.png" alt="">  Trending <span>Games</span></div>
                <div class="tringgame trgbtn"><a href="">view all</a></div>
            </div>
             <div class="row trend_2 mt-4">
   <div id="carouselExampleCaptions1" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide-to="1" aria-label="Slide 2" class="" aria-current="true"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="trend_2i row">
	    <div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/11.jpg" class="w-100" alt="img25"></a>
		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="/crash">Aviator</a></h5>
			<p class="mb-2"style="font-size: 14px;">Aviator game's main objective is to cash out your bet before the plane crash. </p>
			
		  </div>  
		</div>
		<div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/5.jpg" class="w-100" alt="img25"></a>
		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="#">Roulette</a></h5>
			<p class="mb-2"style="font-size: 14px;">Roulette in the game, a player may choose to place a bet on a single number</p>
			
		  </div>  
		</div>
		<div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/6.jpg" class="w-100" alt="img25"></a>
		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="#">Color Prediction</a></h5>
			<p class="mb-2"style="font-size: 14px;">Color Prediction is very simple and profitable game. Only choose one color and bet .</p>
			
		  </div>  
		</div>
		<div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/12.jpg" class="w-100" alt="img25"></a>
		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="#">Teen Patti</a></h5>
			<p class="mb-2"style="font-size: 14px;">Teen Patti is gambling card game originated popular throughout South Asia.</p>
			
		  </div>  
		</div>
		
	  </div>
    </div>

    <div class="carousel-item">
      <div class="trend_2i row">
	    <div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/7.jpg" class="w-100" alt="img25"></a>
		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="#">Roulette</a></h5>
			<p class="mb-2"style="font-size: 14px;">Roulette in the game, a player may choose to place a bet on a single number</p>
			
		  </div>  
		</div>
		<div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/9.jpg" class="w-100" alt="img25"></a>
		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="#">Spin Win</a></h5>
			<p class="mb-2"style="font-size: 14px;">Players bet on where they predict number the ball will land on the roulette wheel.</p>
			
		  </div>  
		</div>
		<div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/10.jpg" class="w-100" alt="img25"></a>
		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="#">Poker</a></h5>
			<p class="mb-2"style="font-size: 14px;">It's a family of comparing card games in which players over which hand is best.</p>
			
		  </div>  
		</div>
		<div class="col-md-3 col-6">
		  <div class="trend_2im clearfix position-relative">
		   <div class="trend_2im1 clearfix">
		     <div class="grid">
		  <figure class="effect-jazz mb-0">
			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/4.jpg" class="w-100" alt="img25"></a>
		  </figure>
	  </div>
		   </div>
		   <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
		     <span class="fs-1"><a class="col_red" href="#"><i class="fa fa-youtube-play"></i></a></span>
		   </div>
		  </div>
		  <div class="trend_2ilast bg_grey p-3 clearfix">
		    <h5><a class="col_red" href="#">Aviator</a></h5>
			<p class="mb-2"style="font-size: 14px;">Aviator game's main objective is to cash out your bet before the plane crash. </p>
			
		  </div>  
		</div>
	  </div>
    </div>
    
  </div>

</div>
 </div>
</div>
            <!--<section id="upcome" class="pt-4 pb-5">-->
            <!--    <div class="container" style=" margin-top: 35px;">-->
            <!--     <div class="row trend_1">-->
            <!--      <div class="col-md-12 col-12">-->
            <!--       <marquee behavior="alternate" width="100%" direction="right" height="100px">-->
            <!--        <img src="images/28.jpg" width="180" height="120" alt="Natural" />-->
            <!--        <img src="images/29.jpg" width="180" height="120" alt="Natural" />-->
            <!--        <img src="images/30.jpg" width="180" height="120" alt="Natural" />-->
            <!--        <img src="images/31.jpg" width="180" height="120" alt="Natural" />-->
            <!--        <img src="images/32.jpg" width="180" height="120" alt="Natural" />-->
            <!--        <img src="images/33.jpg" width="180" height="120" alt="Natural" />-->
            <!--        <img src="images/34.jpg" width="180" height="120" alt="Natural" />-->
            <!--       </marquee>-->
            <!--      </div>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--</section>-->


        <div class="container">
            <section id="upcome" class="pt-4 pb-5">
              <div class="teringtitle">
                            <div class="tringgame"><img src="images/logonew.png" alt="">  Upcoming <span>Games</span></div>
                            <div class="tringgame trgbtn"><a href="">view all</a></div>
                        </div>
             <div class="row trend_2 mt-4">
               <div id="carouselExampleCaptions2" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide-to="1" aria-label="Slide 2" class="" aria-current="true"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="trend_2i row">
            	    <div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/12 (1).jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		  
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/13.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/14.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		  
            		</div>
            		
            	  </div>
                </div>
                <div class="carousel-item">
                  <div class="trend_2i row">
            	    
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/15.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		  
            		  </div>
            		  
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/16.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		  
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/17.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   
            		  </div>
            
            		  
            		</div>
            	  </div>
                </div>
                
              </div>
            
            </div>
             </div>
            </div>
            </section>
            
            
            
            <section id="choice" class="pt-4 pb-5">
            <div class="container">
              <div class="teringtitle">
                            <div class="tringgame"><img src="images/logonew.png" alt="">  Most  <span> Popular Games </span></div>
                            <div class="tringgame trgbtn"><a href="">view all</a></div>
                        </div>
             <div class="row trend_2 mt-4">
               <div id="carouselExampleCaptions3" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="1" aria-label="Slide 2" class="" aria-current="true"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="trend_2i row">
            	    <div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/35.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/36.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/37.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		
            	  </div>
                </div>
                <div class="carousel-item">
                  <div class="trend_2i row">
            	    
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/38.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/39.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		  
            		  </div>
            		    
            		</div>
            		<div class="col-md-4">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/40.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            
            		    
            		</div>
            	  </div>
                </div>
                
              </div>
            
            </div>
             </div>
            </div>
            </section>
            <section id="stream" class="pb-5 pt-4">
            <div class="container">
              <div class="teringtitle">
                            <div class="tringgame"><img src="images/logonew.png" alt="">  Online <span> Video Games </span></div>
                            <div class="tringgame trgbtn"><a href="">view all</a></div>
                        </div>
             <div class="row trend_2 mt-4">
               <div id="carouselExampleCaptions4" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions4" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions4" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="trend_2i row">
            	    <div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/41.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		  
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/42.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		  
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/43.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		 
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/44.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/45.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            	  </div>
                </div>
                <div class="carousel-item">
                  <div class="trend_2i row">
            	    <div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/46.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/47.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		  
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a href="#"><img src="images/48.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		  
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/49.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		   
            		  </div>
            		    
            		</div>
            		<div class="col">
            		  <div class="trend_2im clearfix position-relative">
            		   <div class="trend_2im1 clearfix">
            		     <div class="grid">
            		  <figure class="effect-jazz mb-0">
            			<a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/50.jpg" class="w-100" alt="img25"></a>
            		  </figure>
            	  </div>
            		   </div>
            		  
            		  </div>
            		    
            		</div>
            	  </div>
                </div>
                
              </div>
            </div>
            </div>
            
            
            <!-- Chatboat start -->
            
            <!--<div class="chat-bar-collapsible">-->
            	
            <!--	<span id="chat-button" class="collapsible"><img src="images/bot3.gif"></span>-->
            
            <!--	<div class="content"  style="flex-wrap: wrap;">-->
            
            <!--		<div class="full-chat-block">-->
            
            			<!-- Message Container -->
            <!--			<div class="outer-container" >-->
            <!--						<p style="padding: 10px 10px 10px 20px; background: #0790cd; position: fixed; z-index: 99; width: 350px"> Hi! 👋 it's great to see you!</p>-->
            						
            
            						
            <!--				<div class="chat-container">-->
            					<!-- Messages -->
            <!--					<div id="chatbox" style="padding: 200px 6px 0 6px; overflow:hidden;">-->
            <!--						<h5 id="chat-timestamp"></h5>-->
            <!--						<p style="padding: 7px 10px 5px 20px; color: #000; background: #e0e0e0; "> Please Select Your Query!</p>-->
            <!--						<p id="botStarterMessage" class="botText"><span> 📩 Deposit Related ! <br> 📩 Withdrawal Related ! <br> 🚀 Application Related !</span></p>-->
            <!--					</div>-->
            
            					<!-- User input box -->
            <!--					<div class="chat-bar-input-block">-->
            <!--						<div id="userInput">-->
            <!--							<input id="textInput" class="input-box" type="text" name="msg"-->
            <!--								placeholder="Tap 'Enter' to send a message">-->
            <!--							<p></p>-->
            <!--						</div>-->
            
            <!--						<div class="chat-bar-icons">-->
            							<!--<i id="chat-icon" style="color: crimson;" class="fa fa-fw fa-heart"-->
            							<!--	onclick="heartButton()"></i>-->
            <!--							<i style="color:blue;" class="fa-solid fa-paper-plane" onclick="sendButton()"></i>-->
            							<!--<i id="chat-icon" style="color: #333;" class="fa fa-fw fa-send"-->
            							<!--	></i>-->
            <!--						</div>-->
            <!--					</div>-->
            <!--					<div id="chat-bar-bottom">-->
            <!--						<p></p>-->
            <!--					</div>-->
            
            <!--				</div>-->
            <!--			</div>-->
            
            <!--		</div>-->
            <!--	</div>-->
            
            <!--</div>-->
            
            
            
            
            </div>
             </div>
            </div>
            
            
            <script>
            window.onscroll = function() {myFunction()};
            
            var navbar_sticky = document.getElementById("navbar_sticky");
            var sticky = navbar_sticky.offsetTop;
            var navbar_height = document.querySelector('.navbar').offsetHeight;
            
            function myFunction() {
              if (window.pageYOffset >= sticky + navbar_height) {
                navbar_sticky.classList.add("sticky")
            	document.body.style.paddingTop = navbar_height + 'px';
              } else {
                navbar_sticky.classList.remove("sticky");
            	document.body.style.paddingTop = '0'
              }
            }
            </script>
            </section>
        </div>
@endif
        <!--====== Game List End ======-->
    </div>
</div>

@endsection
@section('js')

@endsection