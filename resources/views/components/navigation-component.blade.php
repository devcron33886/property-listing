<div class="header header-light">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="#">
                    <img src="{{ asset('assets/img/nextdeals.png') }}" class="logo" alt=""/>
                </a>
                <div class="nav-toggle"></div>
            </div>
            <div class="nav-menus-wrapper" style="transition-property: none;">
                <ul class="nav-menu">
                    <li class="active"><a href="{{ route('welcome') }}">Home</a></li>
                    <li><a href="#">House</a>
                    <li><a href="#">Vehicles</a>
                    <li><a href="#">Land or Plot</a>
                    <li><a href="#">Land or Plot</a>
                    <li><a href="#">Electronics</a>
                    <li><a href="{{ route('about-us') }}">About us</a></li>
                    <li><a href="{{ route('contact-us') }}">Contact us</a></li>


                </ul>

                <ul class="nav-menu nav-menu-social align-to-right">

                    <li>
                        <a href="{{ route('login') }}" class="text-success">
                            <i class="fas fa-user-circle mr-2"></i>Sign in
                        </a>
                    </li>
                    <li class="add-listing theme-bg">
                        <a href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
