<?php
$sidebarJson = __DIR__ . '/../docs/sidebar.json';
$sidebar = json_decode(file_get_contents($sidebarJson), true);

function renderSidebar($items, $level = 0, $parentId = 'sidebar') {
    static $count = 0;
    if (!$items) return;
    echo '<ul class="nav flex-column'.($level ? ' ms-3' : '').'">';
    foreach ($items as $item) {
        $hasChildren = isset($item['children']) && is_array($item['children']);
        $id = $parentId . '-collapse-' . $count++;
        echo '<li class="nav-item">';
        if ($hasChildren) {
            // Accordion toggle
            echo '<a class="nav-link fw-bold" data-bs-toggle="collapse" href="#'.$id.'" role="button" aria-expanded="false" aria-controls="'.$id.'">'
                . $item['title'] . 
                ' <span class="float-end">&#9660;</span></a>';
            echo '<div class="collapse" id="'.$id.'">';
            renderSidebar($item['children'], $level + 1, $id);
            echo '</div>';
        } elseif (isset($item['slug'])) {
            echo '<a class="nav-link'.($level ? ' small' : ' fw-bold').'" href="/docs/'.$item['slug'].'">'.$item['title'].'</a>';
        } else {
            echo '<span class="fw-bold">'.$item['title'].'</span>';
        }
        echo '</li>';
    }
    echo '</ul>';
}
?>
<nav class="sidebar bg-white rounded shadow-sm p-3" id="docSidebar">
    <?php renderSidebar($sidebar); ?>
</nav>

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

<!-- In your head or before </body> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>