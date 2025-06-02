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
            <div class="w-100 d-flex flex-column flex-lg-row align-items-center justify-content-center">
                <form class="d-flex w-25 w-lg-25 mb-3 me-5 mb-lg-0" role="search" method="get" action="/Documentation_QuerySafe/search.php">
                    <input class="form-control me-2" type="search" name="q" placeholder="Search" aria-label="Search"
                        value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>" />
                </form>
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
            </div>
        </div>
    </div>
</nav>

<style>
    @media (max-width: 450px) {
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
    }
</style>