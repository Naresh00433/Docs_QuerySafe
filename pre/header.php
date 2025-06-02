
<!-- Sidebar Toggle Button for Mobile -->
<button class="btn btn-outline-primary d-lg-none ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
    <i class="fa fa-bars"></i>
</button>

<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary px-1 py-4">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="../index.php">
            <img src="../assets/images/Logo/logo-QS.png" alt="QuerySafe Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
            <span style="color:#8f4be9; font-weight: 700; font-size: 24px;">QuerySafe</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="w-100 d-flex justify-content-center">
                <form class="d-flex w-25" role="search" method="get" action="/Documentation_QuerySafe/search.php">
                    <input class="form-control me-2" type="search" name="q" placeholder="Search" aria-label="Search"
                        value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>" />
                </form>
            </div>
        </div>
    </div>
</nav>