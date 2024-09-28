<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title></title>

    <link rel="icon" type="image/x-icon" href="{{asset('/favicon.ico')}}" />
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('css/toastify.min.css')}}" rel="stylesheet" />


    <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css')}}" rel="stylesheet" />

    <link href="{{asset('css/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <script src="{{asset('js/jquery-3.7.0.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>


    <script src="{{asset('js/toastify-js.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/config.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>

    {{-- Head Content --}}
    @yield('head')

</head>

<body>

<div id="loader" class="LoadingOverlay d-none">
    <div class="Line-Progress">
        <div class="indeterminate"></div>
    </div>
</div>

<nav class="navbar fixed-top px-0 shadow-sm bg-white">
    <div class="container-fluid">

        <div class="float-left">
            <a class="navbar-brand" >
                <span class="icon-nav m-0 h5" onclick="MenuBarClickHandler()">
                    <img class="nav-logo-sm mx-2"  src="{{asset('images/menu.svg')}}" alt="logo"/>
                </span>
            </a>
            <a href="{{url("/")}}"><img class="nav-logo  mx-2"  src="{{asset('images/logo.png')}}" alt="logo" width="200px"/></a>
        </div>

        <div class="float-right h-auto d-flex">
            <div class="user-dropdown">
                <img class="icon-nav-img" src="{{asset('images/user.webp')}}" alt=""/>
                <div class="user-dropdown-content ">
                    <div class="mt-4 text-center">
                        <img class="icon-nav-img" src="{{asset('images/user.webp')}}" alt=""/>
                        <h6 class="user-name">User Name</h6>
                        <hr class="user-dropdown-divider  p-0"/>
                    </div>
                    <a href="{{url("profile")}}" class="side-bar-item">
                        <span class="side-bar-item-caption">Profile</span>
                    </a>
                    <a href="{{url("logout")}}" class="side-bar-item">
                        <span class="side-bar-item-caption">Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>


<div id="sideNavRef" class="side-nav-open">

    <a href="{{url("/dashboard")}}" class="side-bar-item">
        <i class="fas fa-chart-line"></i>
        <span class="side-bar-item-caption">Dashboard</span>
    </a>

    <a href="{{url("admin/customers")}}" class="side-bar-item">
        <i class="fas fa-user-friends"></i>
        <span class="side-bar-item-caption">Customers</span>
    </a>

    <a href="{{url("admin/cars")}}" class="side-bar-item">
        <i class="fas fa-car-side"></i>
        <span class="side-bar-item-caption">Cars</span>
    </a>
    

    <a href="{{url("admin/rentals")}}" class="side-bar-item">
        <i class="fas fa-sliders-h"></i>
        <span class="side-bar-item-caption">Rentals</span>
    </a>



</div>


<div id="contentRef" class="content">
    @yield('content')
</div>



<script>
    function MenuBarClickHandler() {
        let sideNav = document.getElementById('sideNavRef');
        let content = document.getElementById('contentRef');
        if (sideNav.classList.contains("side-nav-open")) {
            sideNav.classList.add("side-nav-close");
            sideNav.classList.remove("side-nav-open");
            content.classList.add("content-expand");
            content.classList.remove("content");
        } else {
            sideNav.classList.remove("side-nav-close");
            sideNav.classList.add("side-nav-open");
            content.classList.remove("content-expand");
            content.classList.add("content");
        }
    }
    getUser();
    async function getUser(){
        let res=await axios.post("/profile-details")
        if(res.status===200){
            let data=res.data['data'];
            document.querySelector('.user-dropdown-content h6').innerHTML = data['name'];
        }

    }
</script>

</body>
</html>
