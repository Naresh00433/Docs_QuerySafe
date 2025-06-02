<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/images/Logo/logo-QS.png">
    <title>QuerySafe Documentation</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="./assets/css/page.css">
    <link rel="stylesheet" href="./assets/css/main.css">
</head>

<body>

    <!-- Header start -->
    <nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary px-1 py-4">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="./assets/images/Logo/logo-QS.png" alt="QuerySafe Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
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
    <!-- Header end -->

    <!-- main content start -->

    <div class="container-fluid">
        <div class="row mt-5 pt-5">
            <div class="col-2"></div>
            <div class="col-5 mt-5 ">
                <h1 class="display-3 fw-bold mb-3">QuerySafe</h1>
                <p>
                    Welcome to the official documentation of <strong>QuerySafe</strong> – a secure and intelligent chatbot platform developed by <strong>Metric Vibes</strong>.
                </p>
                <p>
                    Whether you're a developer, product manager, or tech enthusiast, this documentation offers a full-stack overview — from initial setup to advanced customization — for making the most of QuerySafe’s AI-powered conversational capabilities.
                </p>
                <a href="docs/introduction" class="btn btn-primary custom-doc-btn mt-4">
                    Documentation <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="col-4 my-5 pb-4 ms-5 ">
                <img src="./assets/images/LOGO/logo-QS.png" alt="QuerySafe Logo" class="img-fluid" style="max-width: 320px; width: 90%; min-width: 180px;">
            </div>
        </div>
    </div>

    <!-- main content end -->

    <?php
    @include './pre/footer.php';
    ?>

</body>

</html>