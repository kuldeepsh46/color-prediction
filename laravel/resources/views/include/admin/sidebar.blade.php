 <!-- partial:partials/_sidebar.html -->

 <nav class="sidebar sidebar-offcanvas" id="sidebar">

     <ul class="nav">

         <li class="nav-item nav-profile">

             <a href="#" class="nav-link">

                 <div class="nav-profile-image">

                     <img src="/aviatoradmin/assets/images/faces/face1.jpg" alt="profile">

                     <span class="login-status online"></span>

                     <!--change to offline or busy as needed-->

                 </div>

                 <div class="nav-profile-text d-flex flex-column">

                     <span class="font-weight-bold mb-2">{{admin('name')}}</span>

                     <span class="text-secondary text-small">Administration</span>

                 </div>

                 <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>

             </a>

         </li>

         <li class="nav-item">

             <a class="nav-link" href="dashboard">

                 <span class="menu-title">Dashboard</span>

                 <i class="mdi mdi-home menu-icon"></i>

             </a>

         </li>

         <li class="nav-item">

             <a class="nav-link" data-bs-toggle="collapse" href="#ui-user" aria-expanded="false"

                 aria-controls="ui-user">

                 <span class="menu-title">Manage User</span>

                 <i class="mdi mdi-account-network menu-icon"></i>

             </a>

             <div class="collapse" id="ui-user">

                 <ul class="nav flex-column sub-menu">

                     <li class="nav-item"> <a class="nav-link" href="user-active">Active</a></li>

                     <li class="nav-item"> <a class="nav-link" href="user-deactive">Deactive</a>

                     </li>

                 </ul>

             </div>

         </li>

         <li class="nav-item">

             <a class="nav-link" data-bs-toggle="collapse" href="#ui-deposit" aria-expanded="false"

                 aria-controls="ui-deposit">

                 <span class="menu-title">Deposit</span>

                 <i class="mdi mdi-account-network menu-icon"></i>

             </a>

             <div class="collapse" id="ui-deposit">

                 <ul class="nav flex-column sub-menu">

                     <li class="nav-item"> <a class="nav-link" href="deposit-pending">Pending</a></li>

                     <li class="nav-item"> <a class="nav-link" href="deposit-apporved">Apporved</a>

                     <li class="nav-item"> <a class="nav-link" href="deposit-rejected">Rejected</a>

                     </li>

                 </ul>

             </div>

         </li>

         <li class="nav-item">

             <a class="nav-link" data-bs-toggle="collapse" href="#ui-withdrawal" aria-expanded="false"

                 aria-controls="ui-withdrawal">

                 <span class="menu-title">Withdrawal</span>

                 <i class="mdi mdi-account-network menu-icon"></i>

             </a>

             <div class="collapse" id="ui-withdrawal">

                 <ul class="nav flex-column sub-menu">

                     <li class="nav-item"> <a class="nav-link" href="withdrawal-pending">Pending</a></li>

                     <li class="nav-item"> <a class="nav-link" href="withdrawal-apporved">Apporved</a>

                     <li class="nav-item"> <a class="nav-link" href="withdrawal-rejected">Rejected</a>

                     </li>

                 </ul>

             </div>

         </li>


         <!-- <li class="nav-item">

             <a class="nav-link" href="amount-setup">

                 <span class="menu-title">Game Setting</span>

                 <i class="mdi mdi-account-network menu-icon"></i>

             </a>

         </li> -->

         <li class="nav-item">

            <a class="nav-link" data-bs-toggle="collapse" href="#ui-amount" aria-expanded="false"

                 aria-controls="ui-amount">

                 <span class="menu-title">Game Setting</span>

                 <i class="mdi mdi-account-network menu-icon"></i>

             </a>

             <div class="collapse" id="ui-amount">

                 <ul class="nav flex-column sub-menu">

                    <li class="nav-item"> <a class="nav-link" href="amount-setup">Aviator</a></li>

                     <li class="nav-item"> <a class="nav-link" href="#">Sports</a></li>

                     <li class="nav-item"> <a class="nav-link" href="#">Casino Games</a>

                 </ul>

             </div>

         </li>




         <li class="nav-item">

             <a class="nav-link" href="bank-detail">

                 <span class="menu-title">Bank Detail</span>

                 <i class="mdi mdi-account-network menu-icon"></i>

             </a>

         </li>
         <li class="nav-item">

             <a class="nav-link" data-bs-toggle="collapse" href="#ui-uploadAd" aria-expanded="false"

                 aria-controls="ui-uploadAd">

                 <span class="menu-title">Video Ad Upload</span>

                 <i class="mdi mdi-account-network menu-icon"></i>

             </a>

             <div class="collapse" id="ui-uploadAd">

                 <ul class="nav flex-column sub-menu">
                     <li class="nav-item"> <a class="nav-link" href="uploadad">Create Video Add</a></li>

                     <li class="nav-item"> <a class="nav-link" href="ads-pending">Pending</a></li>

                     <li class="nav-item"> <a class="nav-link" href="ads-approved">Apporved</a>

                     <li class="nav-item"> <a class="nav-link" href="ads-rejected">Rejected</a>

                     </li>

                 </ul>

             </div>

         </li>
         
         <li class="nav-item">

             <a class="nav-link" href=".\adcostsetup">

                 <span class="menu-title">Add Package Setting</span>

                 <i class="mdi mdi-account-network menu-icon"></i>

             </a>

         </li>
         

     </ul>

 </nav>

 <!-- partial -->

 {{-- <!-- partial:partials/_sidebar.html -->

 <nav class="sidebar sidebar-offcanvas" id="sidebar">

     <ul class="nav">

         <li class="nav-item nav-profile">

             <a href="#" class="nav-link">

                 <div class="nav-profile-image">

                     <img src="/aviatoradmin/assets/images/faces/face1.jpg" alt="profile">

                     <span class="login-status online"></span>

                     <!--change to offline or busy as needed-->

                 </div>

                 <div class="nav-profile-text d-flex flex-column">

                     <span class="font-weight-bold mb-2">David Grey. H</span>

                     <span class="text-secondary text-small">Project Manager</span>

                 </div>

                 <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>

             </a>

         </li>

         <li class="nav-item">

             <a class="nav-link" href="index.html">

                 <span class="menu-title">Dashboard</span>

                 <i class="mdi mdi-home menu-icon"></i>

             </a>

         </li>

         <li class="nav-item">

             <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"

                 aria-controls="ui-basic">

                 <span class="menu-title">Basic UI Elements</span>

                 <i class="menu-arrow"></i>

                 <i class="mdi mdi-crosshairs-gps menu-icon"></i>

             </a>

             <div class="collapse" id="ui-basic">

                 <ul class="nav flex-column sub-menu">

                     <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>

                     <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>

                     </li>

                 </ul>

             </div>

         </li>

         <li class="nav-item">

             <a class="nav-link" href="pages/icons/mdi.html">

                 <span class="menu-title">Icons</span>

                 <i class="mdi mdi-contacts menu-icon"></i>

             </a>

         </li>

         <li class="nav-item">

             <a class="nav-link" href="pages/forms/basic_elements.html">

                 <span class="menu-title">Forms</span>

                 <i class="mdi mdi-format-list-bulleted menu-icon"></i>

             </a>

         </li>

         <li class="nav-item">

             <a class="nav-link" href="pages/charts/chartjs.html">

                 <span class="menu-title">Charts</span>

                 <i class="mdi mdi-chart-bar menu-icon"></i>

             </a>

         </li>

         <li class="nav-item">

             <a class="nav-link" href="pages/tables/basic-table.html">

                 <span class="menu-title">Tables</span>

                 <i class="mdi mdi-table-large menu-icon"></i>

             </a>

         </li>

         <li class="nav-item">

             <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false"

                 aria-controls="general-pages">

                 <span class="menu-title">Sample Pages</span>

                 <i class="menu-arrow"></i>

                 <i class="mdi mdi-medical-bag menu-icon"></i>

             </a>

             <div class="collapse" id="general-pages">

                 <ul class="nav flex-column sub-menu">

                     <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a>

                     </li>

                     <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>

                     <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>

                     <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>

                     <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>

                 </ul>

             </div>

         </li>

         <li class="nav-item sidebar-actions">

             <span class="nav-link">

                 <div class="border-bottom">

                     <h6 class="font-weight-normal mb-3">Projects</h6>

                 </div>

                 <button class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add a project</button>

                 <div class="mt-4">

                     <div class="border-bottom">

                         <p class="text-secondary">Categories</p>

                     </div>

                     <ul class="gradient-bullet-list mt-4">

                         <li>Free</li>

                         <li>Pro</li>

                     </ul>

                 </div>

             </span>

         </li>

     </ul>

 </nav>

 <!-- partial --> --}}

