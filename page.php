<?php
$slug = $_GET['slug'] ?? 'introduction';
$jsonPath = __DIR__ . "/docs/$slug.json";
if (!file_exists($jsonPath)) {
    http_response_code(404);
    echo "Page not found";
    exit;
}
$data = json_decode(file_get_contents($jsonPath), true);
require './pre/head.php';
require './pre/header.php';
?>
<div class="container">

    <div class="row">
        <div class="col-3">
            <?php require './pre/sidebar.php'; ?>
        </div>
        <div class="col-6">
            <div class="container-fluid main-content border">
                <h1 class="display-4"><?= htmlspecialchars($data['title']) ?></h1>
                <?php foreach ($data['sections'] as $section): ?>
                    <h2 id="<?= strtolower(str_replace(' ', '-', preg_replace('/[^a-zA-Z0-9\s]/', '', $section['heading']))) ?>">
                        <?= htmlspecialchars($section['heading']) ?>
                    </h2>
                    <?php if (isset($section['lead'])): ?>
                        <p class="lead"><?= htmlspecialchars($section['lead']) ?></p>
                    <?php endif; ?>
                    <p><?= nl2br(htmlspecialchars($section['content'])) ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-3">
            <div class="onpage-nav p-3 bg-white rounded shadow-sm">
                <h5 class="mb-3" style="color: var(--primary-color);">On This Page</h5>
                <ul class="nav flex-column">
                    <?php foreach ($data['sections'] as $section): ?>
                        <?php if (isset($section['heading'])): ?>
                            <li class="nav-item mb-2">
                                <a class="nav-link p-0" href="#<?= strtolower(str_replace(' ', '-', preg_replace('/[^a-zA-Z0-9\s]/', '', $section['heading']))) ?>">
                                    <?= htmlspecialchars($section['heading']) ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php require './pre/footer.php'; ?>