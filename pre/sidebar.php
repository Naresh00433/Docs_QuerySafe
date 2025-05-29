<?php
$sidebarJson = __DIR__ . '/../docs/sidebar.json';
$sidebar = json_decode(file_get_contents($sidebarJson), true);

function renderSidebar($items, $level = 0) {
    if (!$items) return;
    echo '<ul class="nav flex-column'.($level ? ' ms-3' : '').'">';
    foreach ($items as $item) {
        $hasChildren = isset($item['children']) && is_array($item['children']);
        echo '<li class="nav-item">';
        if (isset($item['slug'])) {
            echo '<a class="nav-link'.($level ? ' small' : ' fw-bold').'" href="/docs/'.$item['slug'].'">'.$item['title'].'</a>';
        } else {
            echo '<span class="fw-bold">'.$item['title'].'</span>';
        }
        if ($hasChildren) {
            renderSidebar($item['children'], $level + 1);
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
</style>