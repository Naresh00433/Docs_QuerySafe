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
                <form class="d-flex w-25" role="search" method="get" action="/Documentation_QuerySafe/search.php">
                    <input class="form-control me-2" type="search" name="q" placeholder="Search" aria-label="Search"
                        value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>" />
                </form>
            </div>
        </div>
    </div>  
</nav>

<div class="container mt-5 pt-5">
    <h2>Search Results for "<?= htmlspecialchars($searchQuery) ?>"</h2>
    <?php if ($searchQuery === ''): ?>
        <p class="text-muted">Please enter a search term.</p>
    <?php elseif (empty($results)): ?>
        <div class="alert alert-warning mt-4">No page found matching your search.</div>
    <?php else: ?>
        <ul class="list-group mt-3">
            <?php foreach ($results as $doc): ?>
                <li class="list-group-item">
                    <a href="/Documentation_QuerySafe/docs/documentation.php?slug=<?= urlencode($doc['slug']) ?>">
                        <?= htmlspecialchars($doc['title']) ?> / <?= htmlspecialchars($doc['slug']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>