<?php
// filepath: c:\wamp64\www\Documentation_QuerySafe\search.php

$jsonPath = __DIR__ . "/docs/documentation.json";
$allDocs = json_decode(file_get_contents($jsonPath), true);

$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';
$results = [];

if ($searchQuery !== '') {
    foreach ($allDocs as $doc) {
        if (stripos($doc['title'], $searchQuery) !== false) {
            $results[] = $doc;
        }
    }
}

require './pre/head.php';
require './pre/header.php';
?>

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
                    <a href="/Documentation_QuerySafe/page.php?slug=<?= urlencode($doc['slug']) ?>">
                        <?= htmlspecialchars($doc['title']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>