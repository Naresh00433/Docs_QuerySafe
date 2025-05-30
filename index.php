<!DOCTYPE html>
<html lang="en">
<?php
require_once './pre/head.php';
?>

<body>
    <main>
        <!-- Header start -->
        <nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary px-3">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="index.php">
                    <img src="./assets/images/Logo/logo-QS.png" alt="QuerySafe Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                    QuerySafe
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="w-100 d-flex justify-content-center">
                        <form class="d-flex w-25" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Header end -->
        <div class="container-fluid">
            <div class="row mt-5 pt-5">
                <div class="col-2"></div>
                <div class="col-5 mt-5 ">
                    <h1 class="display-3 fw-bold mb-3" style="color: var(--primary-color);">QuerySafe</h1>
                    <p class="lead mb-2" style="font-size:1.25rem;">
                        Welcome to the official documentation of <strong>QuerySafe</strong> – a secure and intelligent chatbot platform developed by <strong>Metric Vibes</strong>.
                    </p>
                    <p class="lead mb-4" style="font-size:1.25rem;">
                        Whether you're a developer, product manager, or tech enthusiast, this documentation offers a full-stack overview — from initial setup to advanced customization — for making the most of QuerySafe’s AI-powered conversational capabilities.
                    </p>
                    <a href="docs/introduction" class="btn btn-primary custom-doc-btn">
                        Documentation <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <div class="col-4 my-5 pb-4 ms-5 ">
                    <img src="./assets/images/LOGO/logo-QS.png" alt="QuerySafe Logo" class="img-fluid" style="max-width: 320px; width: 90%; min-width: 180px;">
                </div>
            </div>
        </div>
        <?php require './pre/footer.php'; ?>
    </main>

</body>

</html>