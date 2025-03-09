<?php require '../views/includes/header.php'; ?>
<h1>Restaurant Menu</h1>
<ul>
    <?php foreach ($items as $item): ?>
        <li><?= htmlspecialchars($item['name']) ?> - $<?= htmlspecialchars($item['price']) ?></li>
    <?php endforeach; ?>
</ul>
<?php require '../views/includes/footer.php'; ?>
