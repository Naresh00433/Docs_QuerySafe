<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../assets/css/page.css">
</head>

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
                <form class="d-flex align-items-center w-75 w-lg-50 mb-3 me-lg-4 mb-lg-0 position-relative" role="search" method="get" action="/Documentation_QuerySafe/search.php">
                    <input
                        class="form-control rounded-pill ps-5 pe-4 py-2 shadow-sm border-1"
                        type="search"
                        name="q"
                        placeholder="Search documentation..."
                        aria-label="Search"
                        style="background-color: #f5f5fa; font-size: 1rem;"
                        value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>" />
                    <button
                        class="btn btn-primary position-absolute end-0 top-50 translate-middle-y me-2 rounded-pill px-3 py-1"
                        type="submit"
                        style="background: linear-gradient(90deg, #8f4be9 0%, #6c2eb7 100%); border: none; font-weight: 500;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242 1.106a5 5 0 1 1 0-10 5 5 0 0 1 0 10z" />
                        </svg>
                    </button>
                    <span class="position-absolute start-0 top-50 translate-middle-y ms-3 text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#8f4be9" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242 1.106a5 5 0 1 1 0-10 5 5 0 0 1 0 10z" />
                        </svg>
                    </span>
                </form>
                <style>
                    @media (max-width: 450px) {
                        .navbar-collapse .form-control[type="search"] {
                            min-width: 0;
                            width: 80vw !important;
                            max-width: 100vw;
                            margin-right: 0.5rem;
                            margin-top: 5.5rem;
                        }

                        .navbar-collapse form.d-flex {
                            width: 75vw !important;
                            justify-content: center;
                        }
                    }
                </style>
                <div class="d-lg-none w-100 px-2">
                    <?php
                    // Use the same $sidebar and renderSidebar as in page.php
                    if (!isset($sidebar)) {
                        $sidebarJson = __DIR__ . '/../docs/sidebar.json';
                        $sidebar = json_decode(file_get_contents($sidebarJson), true);
                    }
                    if (!function_exists('renderSidebar')) {
                        // Paste the renderSidebar function here or require it from a shared file
                    }
                    renderSidebar($sidebar);
                    ?>
                </div>
                <a href="https://querysafe.in/contact/" target="_blank" rel="noopener" class="d-flex align-items-center ms-lg-4 text-decoration-none" style="color: #8f4be9; font-weight: 500;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#8f4be9" class="bi bi-envelope me-2" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.383V5.383zm-.034 6.434-5.396-3.24L8 9.583l-.57-.343-5.396 3.24A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.183zM1 11.383l4.708-2.825L1 5.383v6z" />
                    </svg>
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    /* @media (max-width: 450px) {
        .navbar-collapse .form-control[type="search"] {
            min-width: 0;
            width: 75vw !important;
            max-width: 100vw;
            margin-right: 0.5rem;
            margin-top: 5.5rem;
        }

        .navbar-collapse form.d-flex {
            width: 100% !important;
            justify-content: center;
        }
    } */
</style>