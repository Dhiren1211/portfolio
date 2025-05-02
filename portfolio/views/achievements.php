<?php
require('../api/db.php');
$stmt = $conn->prepare("SELECT * FROM achievements ORDER BY achieved_date DESC");
$stmt->execute();
$achievements = $stmt->fetchAll();
?>

<h2 style="margin-top: 20px;">MY ACHIEVEMENTS</h2>
<div class="achievements-wrapper">
    <?php foreach ($achievements as $achievement): ?>
        <div class="achievement-card">
            <div class="achievement-icon">
                <i class="<?php echo htmlspecialchars($achievement['icon'] ?? 'fas fa-award'); ?>"></i>
            </div>
            <h3><?php echo htmlspecialchars($achievement['title']); ?></h3>
            <p><?php echo htmlspecialchars($achievement['description']); ?></p>
            <?php if ($achievement['achieved_date']): ?>
                <small class="date"><?php echo date('F Y', strtotime($achievement['achieved_date'])); ?></small>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

<style>
.achievements-wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 25px;
    margin-top: 20px;
}

.achievement-card {
    background: var(--card-bg);
    color: var(--text-color);
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s;
}

.achievement-card:hover {
    transform: scale(1.03);
}

.achievement-icon i {
    font-size: 2.5em;
    color: var(--highlight);
    margin-bottom: 10px;
}

.achievement-card h3 {
    margin: 10px 0 5px;
    color: var(--highlight);
}

.achievement-card p {
    font-size: 0.95em;
    margin-bottom: 10px;
}

.achievement-card .date {
    font-size: 0.8em;
    color: var(--text-muted);
}
</style>
