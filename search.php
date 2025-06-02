<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/images/Logo/logo-QS.png">
    <title>QuerySafe - Documentation</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
    <link rel="stylesheet" href="./assets/css/page.css">
</head>

<?php
// filepath: c:\wamp64\www\Documentation_QuerySafe\search.php

$jsonPath = __DIR__ . "/docs/documentation.json";
$allDocs = json_decode(file_get_contents($jsonPath), true);

$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';
$results = [];

if ($searchQuery !== '') {
    $searchWords = preg_split('/\s+/', $searchQuery);
    foreach ($allDocs as $doc) {
        $title = strtolower($doc['title']);
        $slug = strtolower($doc['slug']);
        $matched = false;
        foreach ($searchWords as $word) {
            $word = strtolower($word);
            if (
                ($word && strpos($title, $word) !== false) ||
                ($word && strpos($slug, $word) !== false)
            ) {
                $matched = true;
                break;
            }
        }
        if ($matched) {
            $results[] = $doc;
        }
    }
}
?>

<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary px-1 py-4">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="./assets/images/Logo/logo-QS.png" alt="QuerySafe Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
            <span style="color:#8f4be9; font-weight: 700; font-size: 24px; font-family:sans-serif;">QuerySafe</span>
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
                <!-- <a href="https://querysafe.in/contact/" target="_blank" rel="noopener" class="d-flex align-items-center ms-lg-4 text-decoration-none" style="color: #8f4be9; font-weight: 500;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#8f4be9" class="bi bi-envelope me-2" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.383V5.383zm-.034 6.434-5.396-3.24L8 9.583l-.57-.343-5.396 3.24A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.183zM1 11.383l4.708-2.825L1 5.383v6z" />
                    </svg>
                    Contact Us
                </a> -->
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5 pt-5">
    <?php if ($searchQuery !== ''): ?>
        <div class="text-center my-5">
            <h2 class="fw-bold" style="color: #8f4be9;">
                <i class="fas fa-search me-2"></i>
                Results for "<?= htmlspecialchars($searchQuery) ?>"
            </h2>
        </div>
    <?php endif; ?>
    <?php if ($searchQuery === ''): ?>
        <p class="text-muted">Please enter a search term.</p>
    <?php elseif (empty($results)): ?>
        <div class="d-flex flex-column align-items-center shadow-lg justify-content-center my-5 py-5">
            <img src="./assets/images/Logo/logo-QS.png" alt="No Results" width="80" height="80" class="mb-4" style="opacity:0.7;">
            <h4 class="fw-bold mb-2" style="color: #8f4be9;">
                <i class="fas fa-search-minus me-2"></i>
                No documentation found
            </h4>
            <p class="text-muted text-center mb-0" style="font-size: 1.1rem;">
                We couldn't find any documentation matching your search.<br>
                Please try different keywords or check your spelling.
            </p>
        </div>
    <?php else: ?>
        <div class="row mt-3">
            <?php foreach ($results as $doc): ?>
                <div class="col-md-12 col-lg-12 mb-4 mx-auto d-flex justify-content-center">
                    <a href="/Documentation_QuerySafe/docs/documentation.php?slug=<?= urlencode($doc['slug']) ?>" class="text-decoration-none text-dark" style="display:block; height:100%;">
                        <div class="card h-100 shadow-lg border-0 search-result-card" style="transition: box-shadow 0.2s, transform 0.2s;">
                            <div class="card-header " style="background-color:rgb(217, 185, 253); border-bottom: 1px solid #dee2e6;">
                                <?php
                                if (!function_exists('prettifySlug')) {
                                    function prettifySlug($slug)
                                    {
                                        return ucwords(str_replace('-', ' ', $slug));
                                    }
                                }
                                ?>
                                <?= htmlspecialchars(prettifySlug($doc['slug'])) ?> / <?= htmlspecialchars($doc['title']) ?>
                            </div>
                            <div class="card-body ">
                                <?php
                                // Fetch content from the file path specified in documentation.json
                                $content = '';
                                if (isset($doc['path'])) {
                                    $docPath = __DIR__ . '/' . ltrim($doc['path'], '/');
                                    if (file_exists($docPath)) {
                                        $content = file_get_contents($docPath);
                                        // Optionally strip HTML tags if needed
                                        $content = strip_tags($content);
                                    }
                                }
                                // Get content preview (first 15 words)
                                $words = preg_split('/\s+/', $content);
                                $preview = implode(' ', array_slice($words, 0, 15));
                                if (count($words) > 15) {
                                    $preview .= '...';
                                }
                                ?>
                                <p class="card-text mb-2"><?= htmlspecialchars($preview) ?></p>
                            </div>
                        </div>
                    </a>
                    <style>
                        .search-result-card {
                            width: 100%;
                            /* Ensure all cards take the same width */
                            max-width: 750px;
                            /* Set a maximum width for consistency */
                            word-wrap: break-word;
                            /* Break long words to the next line */
                            white-space: normal;
                            /* Allow text to wrap to the next line */
                            text-align: left;
                            /* Align text to the left for better readability */
                        }

                        .search-result-card .card-header {
                            word-wrap: break-word;
                            /* Ensure long words in the header wrap */
                            white-space: normal;
                            text-align: left;
                            padding: 35px;
                            font-size: 20px;
                            font-weight: bolder;
                        }

                        .search-result-card .card-body {
                            word-wrap: break-word;
                            /* Ensure long words in the body wrap */
                            white-space: normal;
                            text-align: left;
                            padding: 20px 35px;
                        }

                        .search-result-card:hover {
                            box-shadow: 0 8px 24px rgba(143, 75, 233, 0.18), 0 1.5px 6px rgba(0, 0, 0, 0.08);
                            transform: translateY(-4px) scale(1.03);
                            border-color: #8f4be9;
                            cursor: pointer;
                        }
                    </style>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>