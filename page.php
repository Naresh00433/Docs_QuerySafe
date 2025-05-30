<?php
$slug = $_GET['slug'] ?? 'introduction';
$jsonPath = __DIR__ . "/docs/documentation.json";
$allDocs = json_decode(file_get_contents($jsonPath), true);

$page = null;
foreach ($allDocs as $doc) {
    if ($doc['slug'] === $slug) {
        $page = $doc;
        break;
    }
}

if (!$page) {
    http_response_code(404);
    echo "Page not found";
    exit;
}

// Find current page index
$currentIndex = null;
foreach ($allDocs as $i => $doc) {
    if ($doc['slug'] === $slug) {
        $currentIndex = $i;
        break;
    }
}

// Determine previous and next pages
$prevPage = $nextPage = null;
if ($currentIndex !== null) {
    if ($currentIndex > 0) {
        $prevPage = $allDocs[$currentIndex - 1];
    }
    if ($currentIndex < count($allDocs) - 1) {
        $nextPage = $allDocs[$currentIndex + 1];
    }
}


require './pre/head.php';
require './pre/header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-3 pe-0">
            <div class="sidebar bg-white rounded shadow-sm position-sticky p-3" style="top: 50px; height: calc(100vh - 70px); overflow-y: auto;">
                <?php
                $sidebarJson = __DIR__ . '/docs/sidebar.json';
                $sidebar = json_decode(file_get_contents($sidebarJson), true);

                function renderSidebar($items, $level = 0, $parentId = 'sidebar')
                {
                    static $count = 0;
                    if (!$items) return;
                    echo '<ul class="nav flex-column' . ($level ? ' ms-3' : '') . '">';
                    foreach ($items as $item) {
                        $hasChildren = isset($item['children']) && is_array($item['children']);
                        $id = $parentId . '-collapse-' . $count++;
                        echo '<li class="nav-item">';
                        if ($hasChildren) {
                            // Accordion toggle
                            echo '<a class="nav-link fw-bold" data-bs-toggle="collapse" href="#' . $id . '" role="button" aria-expanded="false" aria-controls="' . $id . '">'
                                . $item['title'] .
                                ' <span class="float-end">&#9660;</span></a>';
                            echo '<div class="collapse" id="' . $id . '">';
                            renderSidebar($item['children'], $level + 1, $id);
                            echo '</div>';
                        } elseif (isset($item['slug'])) {
                            echo '<a class="nav-link' . ($level ? ' small' : ' fw-bold') . '" href="/Documentation_QuerySafe/docs/' . $item['slug'] . '">' . $item['title'] . '</a>';
                        } else {
                            echo '<span class="fw-bold">' . $item['title'] . '</span>';
                        }
                        echo '</li>';
                    }
                    echo '</ul>';
                }
                renderSidebar($sidebar);
                ?>
                <style>
                    .sidebar .nav-link {
                        color: #22223b;
                        border-radius: 6px;
                        transition: background 0.2s, color 0.2s;
                        padding-left: 0.5rem;
                        cursor: pointer;
                    }

                    .sidebar .nav-link:hover,
                    .sidebar .nav-link.active {
                        background: #a100d6;
                        color: #fff;
                    }

                    .sidebar .fw-bold {
                        color: var(--primary-color, #7c3aed);
                        margin-top: 0.75rem;
                        margin-bottom: 0.25rem;
                        display: block;
                    }

                    .sidebar ul {
                        margin-bottom: 0.25rem;
                    }

                    .sidebar .collapse .nav-link {
                        font-weight: normal;
                    }

                    
                </style>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            </div>
        </div>
        <div class="col-6 pb-3 px-0 mt-4">
            <div class="container-fluid main-content border p-5" >
                <h1 class="display-4"><?= htmlspecialchars($page['title']) ?></h1>
                <hr>
                <?php
                if (isset($page['path']) && file_exists($page['path'])) {
                    include $page['path'];
                } elseif (isset($page['sections'])) {
                    foreach ($page['sections'] as $section) {
                        echo '<h2 id="' . strtolower(str_replace(' ', '-', preg_replace('/[^a-zA-Z0-9\s]/', '', $section['heading']))) . '">'
                            . htmlspecialchars($section['heading']) . '</h2>';
                        if (isset($section['lead'])) {
                            echo '<p class="lead">' . htmlspecialchars($section['lead']) . '</p>';
                        }
                        echo '<p>' . nl2br(htmlspecialchars($section['content'])) . '</p>';
                    }
                } else {
                    echo "<p>No content available.</p>";
                }
                ?>
            </div>
            <div class="d-flex justify-content-center mt-4 me-2">
                <?php if ($prevPage): ?>
                    <a class="btn btn-outline-primary nav-btn me-2" href="/Documentation_QuerySafe/docs/<?= urlencode($prevPage['slug']) ?>">
                        &larr; <?= htmlspecialchars($prevPage['slug']) ?>
                    </a>
                <?php else: ?>
                    <span></span>
                <?php endif; ?>
                <?php if ($nextPage): ?>
                    <a class="btn btn-primary nav-btn ms-2" href="/Documentation_QuerySafe/docs/<?= urlencode($nextPage['slug']) ?>">
                        <?= htmlspecialchars($nextPage['slug']) ?> &rarr;
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-3">
            <div class="onpage-nav position-sticky" style="top: 80px;">
                <h5 class="mb-3" style="color: var(--primary-color);">On This Page</h5>
                <ul class="nav flex-column">
                    <?php
                    // Collect h2 headings from main content
                    $headings = [];
                    if (isset($page['sections'])) {
                        foreach ($page['sections'] as $section) {
                            if (isset($section['heading'])) {
                                $id = strtolower(str_replace(' ', '-', preg_replace('/[^a-zA-Z0-9\s]/', '', $section['heading'])));
                                $headings[] = [
                                    'id' => $id,
                                    'text' => $section['heading']
                                ];
                            }
                        }
                    } elseif (isset($page['path']) && file_exists($page['path'])) {
                        // Parse headings from included file
                        $content = file_get_contents($page['path']);
                        if (preg_match_all('/<h2[^>]*>(.*?)<\/h2>/i', $content, $matches)) {
                            foreach ($matches[1] as $headingText) {
                                $plain = strip_tags($headingText);
                                $id = strtolower(str_replace(' ', '-', preg_replace('/[^a-zA-Z0-9\s]/', '', $plain)));
                                $headings[] = [
                                    'id' => $id,
                                    'text' => $plain
                                ];
                            }
                        }
                    }
                    foreach ($headings as $heading):
                    ?>
                        <li class="nav-item mb-2 ms-2">
                            <a class="nav-link p-0" href="#<?= $heading['id'] ?>">
                                <?= htmlspecialchars($heading['text']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php

?>