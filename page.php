<!DOCTYPE html>
<html lang="en">

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


<body>
    
    <!-- Breadcrumb for mobile: place it right after header -->
    <div class="breadcrumb-mobile" id="mobileBreadcrumb">
        On This Page / <span id="currentSection"><?= htmlspecialchars($page['title']) ?></span>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-3 pe-0">
                <div class="sidebar bg-white rounded shadow-sm p-3" style="position: fixed; top: 90px; left: 0; height: calc(100vh - 50px); width: 23%; overflow-y: auto; z-index: 1030;">
                    <?php
                    $sidebarJson = __DIR__ . '/docs/sidebar.json';
                    $sidebar = json_decode(file_get_contents($sidebarJson), true);

                    function renderSidebar($items, $level = 0, $parentId = 'sidebar')
                    {
                        global $slug;
                        static $count = 0;
                        if (!$items) return;
                        echo '<ul class="nav flex-column' . ($level ? ' ms-3' : '') . '">';
                        foreach ($items as $item) {
                            $hasChildren = isset($item['children']) && is_array($item['children']);
                            $id = $parentId . '-collapse-' . $count++;
                            echo '<li class="nav-item">';
                            if ($hasChildren) {
                                // Check if this collapse should be open from localStorage
                                $collapseShow = '';
                                $collapseIdJs = htmlspecialchars($id, ENT_QUOTES);
                                echo '<a class="nav-link fw-bold d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#' . $id . '" role="button" aria-expanded="false" aria-controls="' . $id . '">'
                                    . '<span><span class="sidebar-icon"><i class="fa fa-folder"></i></span>' . $item['title'] . '</span>'
                                    . '<span class="float-end">'
                                    . '<span class="collapse-arrow" data-bs-toggle="collapse" data-bs-target="#' . $id . '" aria-expanded="false">&#10095;</span>'
                                    . '</span></a>';
                                echo <<<EOT
                                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var collapseEl = document.getElementById('$collapseIdJs');
                                    var arrow = document.querySelector('a[href="#$collapseIdJs"] .collapse-arrow');
                                    // Restore collapse state from localStorage
                                    var openCollapses = JSON.parse(localStorage.getItem('sidebarOpenCollapses') || '[]');
                                    if (collapseEl && openCollapses.includes('$collapseIdJs')) {
                                        collapseEl.classList.add('show');
                                    }
                                    if (collapseEl && arrow) {
                                        collapseEl.addEventListener('show.bs.collapse', function () {
                                            arrow.innerHTML = '&#9013;';
                                            // Save open state
                                            var openCollapses = JSON.parse(localStorage.getItem('sidebarOpenCollapses') || '[]');
                                            if (!openCollapses.includes('$collapseIdJs')) {
                                                openCollapses.push('$collapseIdJs');
                                                localStorage.setItem('sidebarOpenCollapses', JSON.stringify(openCollapses));
                                            }
                                        });
                                        collapseEl.addEventListener('hide.bs.collapse', function () {
                                            arrow.innerHTML = '&#10095;';
                                            // Remove from open state
                                            var openCollapses = JSON.parse(localStorage.getItem('sidebarOpenCollapses') || '[]');
                                            var idx = openCollapses.indexOf('$collapseIdJs');
                                            if (idx !== -1) {
                                                openCollapses.splice(idx, 1);
                                                localStorage.setItem('sidebarOpenCollapses', JSON.stringify(openCollapses));
                                            }
                                        });
                                        // Set initial arrow state
                                        if (collapseEl.classList.contains('show')) {
                                            arrow.innerHTML = '&#9013;';
                                        }
                                    }
                                });
                                </script>
                                EOT;
                                echo '<div class="collapse" id="' . $id . '">';
                                renderSidebar($item['children'], $level + 1, $id);
                                echo '</div>';
                            } elseif (isset($item['slug'])) {
                                $isActive = ($item['slug'] === $slug) ? ' active' : '';
                                echo '<a class="nav-link' . ($level ? ' small' : ' fw-bold') . $isActive . '" href="/Documentation_QuerySafe/docs/' . $item['slug'] . '">'
                                    . '<span class="sidebar-icon"><i class="fa fa-file-alt"></i></span>'
                                    . $item['title'] . '</a>';
                            } else {
                                echo '<span class="fw-bold">' . $item['title'] . '</span>';
                            }
                            echo '</li>';
                        }
                        echo '</ul>';
                    }
                    renderSidebar($sidebar);
                    ?>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                </div>
            </div>
            <div class="col-6 px-0 mt-5">
                <div class="container-fluid main-content p-5">
                    <h1 class="display-4"><?= htmlspecialchars($page['title']) ?></h1>
                    <hr>
                    <?php
                    if (isset($page['path']) && file_exists($page['path'])) {
                        $content = file_get_contents($page['path']);
                        // Add id to every <h2> if not present
                        $content = preg_replace_callback(
                            '/<h2([^>]*)>(.*?)<\/h2>/i',
                            function ($matches) {
                                $plain = strip_tags($matches[2]);
                                $id = strtolower(str_replace(' ', '-', preg_replace('/[^a-zA-Z0-9\s]/', '', $plain)));
                                // If id already present, don't add again
                                if (strpos($matches[1], 'id=') === false) {
                                    return '<h2 id="' . $id . '"' . $matches[1] . '>' . $matches[2] . '</h2>';
                                } else {
                                    return $matches[0];
                                }
                            },
                            $content
                        );
                        echo $content;
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
                    <?php
                    // Helper to prettify slug: "get-started" => "Get Started"
                    function prettifySlug($slug)
                    {
                        return ucwords(str_replace('-', ' ', $slug));
                    }
                    ?>
                    <?php if ($prevPage): ?>
                        <a class="btn btn-outline-primary nav-btn me-2" href="/Documentation_QuerySafe/docs/<?= urlencode($prevPage['slug']) ?>">
                            &larr; <?= htmlspecialchars(prettifySlug($prevPage['slug'])) ?>
                        </a>
                    <?php else: ?>
                        <span></span>
                    <?php endif; ?>
                    <?php if ($nextPage): ?>
                        <a class="btn btn-primary nav-btn ms-2" href="/Documentation_QuerySafe/docs/<?= urlencode($nextPage['slug']) ?>">
                            <?= htmlspecialchars(prettifySlug($nextPage['slug'])) ?> &rarr;
                        </a>
                    <?php endif; ?>
                </div>
                <?php
                @include './pre/footer.php';
                ?>
            </div>
            <div class="col-3 bg-white rounded shadow-sm">
                <div class="onpage-nav " style="position:fixed; top: 100px;">
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
                                        'text' => '<span style="color: #8f4be9;">' . htmlspecialchars($section['heading']) . '</span>'
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
</body>

</html>

<style>
    /*Sidebar Styles */
    h2 {
        color: #8f4be9;
    }

    .sidebar {
        background: #fff;
        border-right: 1.5px solid #ece6f9;
        border-radius: 1.2rem;
        box-shadow: 0 4px 24px rgba(143, 75, 233, 0.07);
        padding: 2rem 1.2rem 2rem 1.2rem;
        min-height: 90vh;
    }

    .sidebar .nav {
        gap: 0.25rem;
    }

    .sidebar .nav-link {
        color: #6c4bb6;
        font-weight: 500;
        border-radius: 0.7rem;
        padding: 0.6rem 1.1rem;
        margin-bottom: 0.2rem;
        transition: background 0.18s, color 0.18s, box-shadow 0.18s;
        font-size: 1.08rem;
        display: flex;
        align-items: center;
    }

    .sidebar .nav-link.active,
    .sidebar .nav-link:hover,
    .sidebar .nav-link:focus {
        background: #e9d8fd;
        color: #8f4be9;
        box-shadow: 0 2px 8px rgba(143, 75, 233, 0.08);
        text-decoration: none;
    }

    .sidebar .nav-link .sidebar-icon {
        margin-right: 0.7em;
        font-size: 1.1em;
        opacity: 0.7;
    }

    .sidebar .nav-item {
        margin-bottom: 0.15rem;
    }


    @media (max-width: 450px) {
        .sidebar {
            display: none !important;
        }

        .col-3,
        .col-3.bg-white {
            display: none !important;
        }

        .col-6,
        .main-content {
            width: 100% !important;
            max-width: 100vw !important;
            margin: 0 !important;
            padding: 1rem !important;
            padding-top: 0 !important;
            margin-top: 80px !important;
            /* Space for header */
        }

        .d-flex.justify-content-center.mt-4.me-2 {
            flex-direction: column;
            align-items: stretch;
            gap: 0.5rem;
            margin: 1.5rem 0 0 0 !important;
        }

        .nav-btn {
            min-width: unset !important;
            width: 100%;
            font-size: 1rem !important;
            padding: 0.6rem 0.5rem !important;
            border-radius: 1.2rem !important;
        }

        .onpage-nav {
            display: none !important;
        }

        .breadcrumb-mobile {
            display: flex !important;
            position: fixed;
            top: 90px;
            /* Adjust if your header is taller/shorter */
            left: 0;
            width: 100vw;
            z-index: 1040;
            font-size: 1rem;
            background-color: #f7f3fd;
            padding: 15px 1rem 15px 30px !important;
            color: #8f4be9;
            gap: 0.5rem;
            align-items: center;
            border-radius: 0 0 0.7rem 0.7rem;
            box-shadow: 0 2px 8px rgba(143, 75, 233, 0.08);
            margin: 0 !important;
        }
    }

    .breadcrumb-mobile {
        display: none;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.innerWidth <= 450) {
            const headings = Array.from(document.querySelectorAll('.main-content h2[id]'));
            const breadcrumb = document.getElementById('currentSection');
            if (!headings.length || !breadcrumb) return;

            function updateBreadcrumb() {
                let current = headings[0];
                for (const h of headings) {
                    const rect = h.getBoundingClientRect();
                    // Adjust offset for header + breadcrumb height
                    if (rect.top - 120 < 0) current = h;
                }
                if (current && breadcrumb.textContent !== current.textContent) {
                    breadcrumb.textContent = current.textContent;
                }
            }

            window.addEventListener('scroll', updateBreadcrumb, {
                passive: true
            });
            window.addEventListener('resize', updateBreadcrumb);
            updateBreadcrumb();
        }
    });
</script>