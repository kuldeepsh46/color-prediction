<!--====== Header Start ======-->
<header class="hed">   
    
    <style>
        *{
    margin: 0;
    padding: 0;
}
.mainhed{
    background-color: #000;
    margin-bottom:100px;
}
.subhed{
    background: #191A1D;
    width: 100%;
    height: 80px;
}
.subhader{
    width: 90%;
    margin: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 10px;
}
.sublist{
    display: inline-flex;
    gap: 5px;
    list-style: none;
}
.logo{
    display:flex;
}
.logo img{
    width: 40px;
}
.logo span{
    font-size: 25px;
    color: #fff;
    letter-spacing: 1px;
}
.login{
    background: #1cba42;
    padding: 10px;
    padding-left:13px;
    padding-right:13px;
    font-size: 13px;
    border-radius: 20px;
    transition: 500ms;
    border:none;
}
.sublist li a{
    text-decoration: none;
    color: black;
    transition: 500ms;
}
.sublist li:hover{
    background: #fff;
    .login{
        color: #FFCA00;
    }
}
.navbar-nav{
    /*border: 2px solid rgb(236, 229, 229);*/
    width:100%;
    margin:auto;
    border-radius: 25px;
    background-color: #25251E;
    color: #ccc;
}
.avitot{
    color: #fff;
    text-decoration: none;
    align-items: center;
}
.avitot:hover{
    color: #FFCA00;
    text-decoration: none;
    align-items: center;
}
.navbar-nav{
    width:100%;
    padding: 10px;
    margin:auto;
    gap:70px;
}
.navbar-nav li {
    padding: 0px;
    font-size:16px;
}
.subbar{
    width: 60%;
    /*margin: auto;*/
}
.navbar-brand {
    font-size: 15px;
    padding: 10px;
    background-color: #FFCA00;
    border-radius: 20px;
    width:60px;
    border:2px solid red;
}

.sticky {
  position: fixed;
  top: 0;
  width: 100%;
  z-index:9;
  background:#000;
}
.hedlis{
    margin-top:7px;
}
.header-left{
    margin-left:70px;
}
.header-left img{
            width:40px;
        }
        .header-left span{
            font-size:20px;
            color:#fff;
        }
        
        .header-right{
            padding-right:70px;
            z-index:9999;
        }
        .btn-group{
            z-index:1000;
        }
        .fa-bars{
        font-size:30px;
        color:#fff;
    }
    .header-right{
        margin-right:-70px;
    }
    .nav-item{
        text-align: center;
        padding:0px;
    }
    table, th, td {
  border:1px solid #fff;
  text-align:center;
}
@media(max-width:410px) {
       .navbar-brand {
        width: auto;
        margin-left: 30px;
    }
    .header-left{
        margin-left:20px;
    }

}
@media(max-width:400px) {
    .header-left img{
        margin-left:-40px;
    }

}
@media(min-width:1000px) {
       .subbarr{
        display:none;
       }

}
@media(max-width:1000px) {
       .subbar {
        display:none;
    }

}

</style>
<?php
$walletAmt = wallet(user('id'), 'num');
if(!$walletAmt) {
    $walletAmt = 0;
}
// dd($walletAmt);
$walletAmt = (float)str_replace([',', '.'], ['', '.'], $walletAmt);
$bonusAmt = getBonusAmt(user('id'));
if(!$bonusAmt) {
    $bonusAmt = 0;
}
// dd($bonusAmt);
$totalAmt = $walletAmt + $bonusAmt;
?>
    <div class="header-top" style=" background-color: #000; height: 70px;">
        <div class="header-left" onclick="window.location.href='/dashboard'" style="margin-left: 25px; ">
            <img src="images/main_logo.png" class="logo1" style="width: 175px; padding: 10px;"><span>  </span>
        </div>
        @if (session()->has('userlogin'))
         <div class="subbar">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation" style="background:none;">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto" style="background:#000;">
                                <li class="nav-item">
                                    <a class=" avitot active" aria-current="page" href="/crash" ><img src="images/logo.svg" class="side_logo" style="width: 80px;"></a>
                                </li>
                                <li class="nav-item">
                                    <a class="avitot" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/col_p.png" class="" style="width: 30px;"> Colour Prediction</a>
                                </li>
                                <li class="nav-item">
                                    <a class="avitot" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/roulet.png" class="" style="width: 30px;"> Roulet</a>
                                </li>
                                <li class="nav-item">
                                    <a class="avitot" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/teenpatti.png" class="" style="width: 25px;">Teen Patti</a>
                                </li>
                               
                                <li class="nav-item dropdown">
                                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="display: contents; color: #fff;"> More</a>
                                      <ul class="dropdown-menu drop_1" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal">SPORTS</a></li>
                                        <li><a class="dropdown-item border-0" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal">CASINO</a></li>
                                      </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        @else
        <div class="subbar">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation" style="background:none;">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto" style=background:#000;>
                                <li class="nav-item">
                                    <a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/logo.svg" class="side_logo" style="width: 80px;"></a>
                                </li>
                                <li class="nav-item">
                                    <a class="avitot" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/col_p.png" class="" style="width: 30px;"> Colour Prediction</a>
                                </li>
                                <li class="nav-item">
                                    <a class="avitot" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/roulet.png" class="" style="width: 30px;"> Roulet</a>
                                </li>
                                <li class="nav-item">
                                    <a class="avitot" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/teenpatti.png" class="" style="width: 25px;">Teen Patti</a>
                                </li>
                               
                                <li class="nav-item dropdown">
                                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="display: contents; color: #fff;"> More</a>
                                      <ul class="dropdown-menu drop_1" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#login-modal">SPORTS</a></li>
                                        <li><a class="dropdown-item border-0" href="#" data-bs-toggle="modal" data-bs-target="#login-modal">CASINO</a></li>
                                      </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        @endif
        @if (session()->has('userlogin'))
            <div class="header-right d-flex align-items-center">
                <a href="/deposit">
                    <button class="deposite-btn rounded-pill d-flex align-items-center me-2">
                        <span class="material-symbols-outlined me-2"> payments </span>
                        <span class="me-2" id="header_wallet_balance">₹{{ $totalAmt }}</span>
                        DEPOSIT
                    </button>
                    
                 <!--   <div class="Bal_button">-->
                 <!--   <img src="images/button.png" alt="balance" style="width:167px; height:auto;">-->
                 <!--   <div class="me-2" id="header_wallet_balance" style="color: #fff; font-size: 15px; position: absolute; transform: translate(20%, -110%);">₹ {{ wallet(user('id')) }}</div>-->
                 <!--</div>-->
                </a>
                <div class="btn-group">
                    <button type="button"
                        class="btn btn-transparent dropdown-toggle p-0 d-flex align-items-center justify-content-center caret-none"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="material-symbols-outlined f-24 menu-icon text-white">
                            menu
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark profile-dropdown p-0" >
                        <li class="profile-head justify-content-between align-items-center text-align-center">
                            <div class="align-items-center">
                                <table style="width:100%;">
                                 <tr>
                                   <td STYLE="background:#00d432;color:#000;">DEPOSIT</td>
                                   <td STYLE="background:#00d432;color:#000;">BONUS</td>
                                 </tr>
                                 <tr>
                                     <td>₹<?php
                                     echo wallet(user('id'));
                                     ?></td>
                                   <td>₹{{getBonusAmt(user('id'))}}</td>
                                 </tr>
                               </table>

                            </div>
                        </li>
                        <li class="profile-head d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="images/avtar/av-1.png" class="avtar-ico" id="avatar_img">
                                <div>
                                    <div>{{ user('name') }}</div>
                                    <!--<div class="profile-name mb-1">{{ user('email') }} </div>-->
                                    <div class="profile-name" id="username"><span>User ID</span>{{ user('id') }}</div>
                                </div>
                            </div>
                        </li>


                        <li>
                            <a href="/crash" class="f-12 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined ico f-20">
                                        flight_takeoff
                                    </span>
                                    <img src="../../images/logo.svg" class="side_logo">
                                </div>
                            </a>
                        </li>


                        <li>
                            <a href="/deposit" class="f-12 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined ico f-20">
                                        payments
                                    </span>DEPOSIT FUNDS
                                </div>
                            </a>
                        </li>
                        <!-- <li>-->
                        <!--    <a href="/create" class="f-12 justify-content-between">-->
                        <!--        <div class="d-flex align-items-center">-->
                        <!--            <span class="material-symbols-outlined ico f-20">-->
                        <!--                payments-->
                        <!--            </span>UPLOAD YOUR AD-->
                        <!--        </div>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <!--  <li>-->
                        <!--    <a href="/allAds" class="f-12 justify-content-between">-->
                        <!--        <div class="d-flex align-items-center">-->
                        <!--            <span class="material-symbols-outlined ico f-20">-->
                        <!--                payments-->
                        <!--            </span>MY AD's-->
                        <!--        </div>-->
                        <!--    </a>-->
                        <!--</li>-->
                        
                        <li>
                            <a href="/withdraw" class="f-12 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined ico f-20">
                                        payments
                                    </span>WITHDRAW FUNDS 
                                </div>
                            </a>
                        </li>
                        <!--  <li>-->
                        <!--    <a href="/create" class="f-12 justify-content-between">-->
                        <!--        <div class="d-flex align-items-center">-->
                        <!--            <span class="material-symbols-outlined ico f-20">-->
                        <!--                account_circle-->
                        <!--            </span>SUPPORT -->
                        <!--        </div>-->
                        <!--    </a>-->
                        <!--</li>-->
                        
                        <li>
                            <a href="/profile" class="f-12 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined ico f-20">
                                        account_circle
                                    </span>PROFILE
                                </div>
                            </a>
                        </li>
                        {{--
                        <li>
                            <a href="/amount-transfer" class="f-12 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined ico f-20">
                                        payments
                                    </span>AMOUNT TRANSFER
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="f-12 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined ico f-20">
                                        payments
                                    </span>TRANSFER FUNDS
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/level-management" class="f-12 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined ico f-20">
                                        payments
                                    </span>LEVEL MANAGEMENT
                                </div>
                            </a>
                        </li>
                        --}}
                        <li>
                            <a href="/deposit_withdrawals" class="f-12 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined ico f-20">
                                        payments
                                    </span>TRANSACTION HISTORY
                                </div>
                            </a>
                        </li>
                        
                        <li>
                            <a href="/referal" class="f-12 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined ico f-20">
                                        payments
                                    </span>REFERRAL
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/logout" class="f-12 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined ico f-20">
                                        payments
                                    </span>SIGN OUT
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @else
      
            <div class="header-right d-flex align-items-center">
                <button class="login rounded-pill d-flex align-items-center me-2" data-bs-toggle="modal"
                    data-bs-target="#login-modal" id="login"> LOGIN <span> &nbsp; <span> <i class="fa fa-sign-in" aria-hidden="true"></i>
                      
                </button>
                <!--<button class="login rounded-pill d-flex align-items-center me-2 reg_btn" data-bs-toggle="modal"
                    data-bs-target="#register-modal">
                    Register
                </button>
                <button class="login rounded-pill d-flex align-items-center me-2" data-bs-toggle="modal"
                    data-bs-target="#login-modal" id="login">
                     Demo
                </button>-->
                
            </div>
        @endif
    </div>
    <style>
        .newnavbar{
            width:100%;
            display:flex;
            margin:auto;
            list-style:none;
            overflow: auto;
  white-space: nowrap;
  gap:15px;
  padding:10px;
        }
    </style>
    @if (session()->has('userlogin'))
        <div class="mainhed">
          <div class="hedlis sticky" id="myHeaderr">
                <div class="subbarr">
                    <nav class="navbar navbar-expand-lg">
                        <ul class=" newnavbar">
                                    <li class="nav-item">
                                        <a class=" avitot active" aria-current="page" href="/crash"><img src="images/logo.svg" class="side_logo" style="width: 60px;"></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="avitot" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/col_p.png" class="" style="width: 18px;"> Colour Prediction</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="avitot" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/roulet.png" class="" style="width: 18px;"> Roulet</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="avitot" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal"><img src="images/teenpatti.png" class="" style="width: 18px;">Teen Patti</a>
                                    </li>
                                   
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="display: contents; color: #fff;"> More</a>
                                        <ul class="dropdown-menu drop_1" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal">SPORTS</a></li>
                                            <li><a class="dropdown-item border-0" href="#" data-bs-toggle="modal" data-bs-target="#coming-modal">CASINO</a></li>
                                        </ul>
                                    </li>
                        </ul>
                        
                    </nav>
                </div>
            </div>
        </div>
    @else
        <div class="mainhed">
          <div class="hedlis sticky" id="myHeaderr">
                <div class="subbarr">
                    <nav class="navbar navbar-expand-lg">
                        <ul class=" newnavbar">
                                    <li class="nav-item">
                                        <a class=" avitot active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/logo.svg" class="side_logo" style="width: 60px;"></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="avitot" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/col_p.png" class="" style="width: 18px;"> Colour Prediction</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="avitot" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/roulet.png" class="" style="width: 18px;"> Roulet</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="avitot" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><img src="images/teenpatti.png" class="" style="width: 18px;">Teen Patti</a>
                                    </li>
                                   
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="display: contents; color: #fff;"> More</a>
                                        <ul class="dropdown-menu drop_1" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#login-modal">SPORTS</a></li>
                                            <li><a class="dropdown-item border-0" href="#" data-bs-toggle="modal" data-bs-target="#login-modal">CASINO</a></li>
                                        </ul>
                                    </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    @endif
</header>
<!--====== Header End ======-->
