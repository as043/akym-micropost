<header>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" date-toggle="collapse" date-targetz-"#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Microposts</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                <li><a href="#">Users</a></li>
                <li class="dropdown">
                    <a href="#"　class="dropdown-toggle" date-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name}},span class="caret"></span></a>
                <ul class="dropdown-manu">
                    <li><a href="#">My profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li>{!! link_to_route('login.get','Logout') !!}</li>
                </ul>
                </li>
                @else
                <li>{!! link_to_route('signup.get','Signup') !!}</li>
                <li><a href="#">Login</a></li>
                @endif
            </ul>
        </div>
        </div>
    </nav>
</header>