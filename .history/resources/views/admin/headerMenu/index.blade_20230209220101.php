<!-- <header role="banner">
    <ul class="utilities">
        <li class="users"><a href="#"></a></li>
        <li class="logout warn"><a href=""><i class="fa-solid fa-right-from-bracket" id="logOut"></i> Log Out</a></li>
    </ul>
</header> -->
<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="/admin/overview"><img
                src="/assets/images/LogoAdmin.png" alt="logo" />
            <span class="content">&nbsp;</span>
        </a>
        <a class="navbar-brand brand-logo-mini" href="/admin/overview"><img
                style="width:50px;height:auto;border-radius:999px;"
                src="/assets/images/logoPhiPhi.png" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button"
            data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
                <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                        <i class="input-group-text border-0 mdi mdi-magnify"></i>
                    </div>
                    <input type="text" class="form-control bg-transparent border-0"
                        placeholder="Search projects">
                </div>
            </form>
        </div>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="/admin/overview"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">
                        <img src="https://thumbs.dreamstime.com/b/user-icon-trendy-flat-style-isolated-grey-background-user-symbol-user-icon-trendy-flat-style-isolated-grey-background-123663211.jpg"
                            alt="image">
                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">Admin</p>
                    </div>
                </a>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
                <a class="nav-link" href="/logout">
                    <i class="mdi mdi-power"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- partial -->