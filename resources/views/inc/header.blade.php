<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">HairTrans</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="{{ route('home') }}">Main</a>
        <a class="p-2 text-dark" href="{{ route('blog.posts') }}">Blog</a>
        <a class="p-2 text-dark" href="{{ route('about') }}">About</a>
        <a class="p-2 text-dark" href="{{ route('contact') }}">Contact</a>
    </nav>

    @if(Auth::check())
        <div class="dropdown text-end">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://www.securityindustry.org/wp-content/uploads/sites/3/2018/05/noimage.png" alt="mdo" width="32" height="32" class="rounded-circle">
            </a>
            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
                @if(auth()->user()->role_id === 1)
                    <li><a class="dropdown-item" href="{{ route('blog.admin.posts.index') }}">Dashboard</a></li>
                @endif
                <li><hr class="dropdown-divider"></li>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <input class="dropdown-item" type="submit" value="Logout">
                </form>
            </ul>
        </div>
    @else
        <a class="btn btn-outline-primary" href="{{ route('login') }}">Sign up</a>
    @endif


</div>