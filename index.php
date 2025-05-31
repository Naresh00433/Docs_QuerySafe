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
</head>

<body>
    <!-- Header start -->
    <nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary px-3 py-4">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="./assets/images/Logo/logo-QS.png" alt="QuerySafe Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                <span style="color:#8f4be9; font-weight: 700; font-size:24px;">QuerySafe</span>
            </a>
        </div>
    </nav>
    <!-- Header end -->
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


    <?php
    @include './pre/footer.php';
    ?>

    <style>

        .row.mt-5 {
            margin-top: 100px !important;
            margin-bottom: 135px !important;
        }

        @media (max-width: 450px) {
            .row.mt-5.pt-5 {
                flex-direction: column;
                align-items: center;
                margin-top: 2.5rem !important;
                padding-top: 2.5rem !important;
            }

            .col-2,
            .col-5,
            .col-4 {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 1rem !important;
            }

            .col-4.my-5.pb-4.ms-5 {
                margin: 0 !important;
                display: flex;
                justify-content: center;
                order: -1;
                margin-top: 50px !important;
            }

            .col-5.mt-5 {
                margin-top: 0 !important;
                text-align: center;
            }

            .custom-doc-btn {
                width: 100%;
                font-size: 1.1rem;
                margin-top: 1.5rem !important;
            }

            .display-3 {
                font-size: 2rem;
            }

            .navbar-brand span {
                font-size: 1.3rem !important;
            }

        }
    </style>
</body>

</html>