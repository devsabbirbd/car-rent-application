<nav class="navbar sticky-top shadow-sm navbar-expand-lg navbar-light py-2">
    <div class="container">
        <a class="navbar-brand" href="{{url("/")}}">
            <img class="img-fluid" src="{{asset('/images/logo.png')}}" alt="" width="200px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header01" aria-controls="header01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="header01">
            <ul class="navbar-nav ms-auto mt-3 mt-lg-0 mb-3 mb-lg-0 me-3">
                <li class="nav-item me-3"><a class="nav-link" href="{{url("/cars")}}">Cars</a></li>
                @if (Cookie::get('token')!==null)
                    <li class="nav-item me-3"><a class="nav-link" href="{{url("/rental-history")}}">Rental History</a></li>
                @else
                @endif
                <li class="nav-item me-3"><a class="nav-link" href="{{url("/about")}}">About</a></li>
                <li class="nav-item me-3"><a class="nav-link" href="{{url("/company")}}">Company</a></li>
                <li class="nav-item me-3"><a class="nav-link" href="{{url("/services")}}">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url("/testimonials")}}">Testimonials</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url("/contact")}}">Contact</a></li>
            </ul>
            <div>
                @if (Cookie::get('token')!==null)
                    @if (session('user_role') === 'admin')
                        <a class="btn mt-3 bg-gradient-info" href="{{ url('/dashboard') }}">Admin Dashboard</a>
                        <a class="btn mt-3 bg-gradient-danger" href="{{ url('/logout') }}">Logout</a>
                    @else
                    <a class="btn mt-3 bg-gradient-info" href="{{ url('/customer-profile') }}">Profile</a>
                    <a class="btn mt-3 bg-gradient-danger" href="{{ url('/logout') }}">Logout</a>
                    @endif
                @else
                    <a class="btn mt-3 bg-gradient-info" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#login-modal">Login</a>  
                @endif

            

            </div>
        </div>
    </div>
</nav>

@if (Cookie::get('token')!==null)
@else
@include('components.auth.login-form')
@include('components.auth.registration-form')
@endif