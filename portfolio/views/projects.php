<?php
require('../api/db.php');
$stmt = $conn->prepare("SELECT * FROM projects ORDER BY created_at DESC");
$stmt->execute();
$projects = $stmt->fetchAll();
?>

<h2 style="margin-top: 20px;">MY PROJECTS</h2>
<div class="projects-wrapper">
    <?php foreach ($projects as $project): ?>
        <div class="project-card">
            <?php if ($project['Image_URL']): ?>
                <img src="../uploads/projects/<?php echo htmlspecialchars($project['Image_URL']); ?>" alt="Project Image">
            <?php endif; ?>
            <h3><?php echo htmlspecialchars($project['Title']); ?></h3>
            <p><?php echo htmlspecialchars($project['Description']); ?></p>
            <?php if ($project['Project_URL']): ?>
                <a href="<?php echo htmlspecialchars($project['Project_URL']); ?>" target="_blank" class="visit-link">
                    Visit Project <i class="fas fa-external-link-alt"></i>
                </a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

<style>
.projects-wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 25px;
    margin-top: 20px;
}

.project-card {
    background: var(--card-bg);
    color: var(--text-color);
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

.project-card:hover {
    transform: scale(1.03);
}

.project-card img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 15px;
}

.project-card h3 {
    color: var(--highlight);
    margin-bottom: 10px;
    font-size: 1.3em;
}

.project-card p {
    font-size: 0.95em;
    margin-bottom: 10px;
}

.visit-link {
    text-decoration: none;
    color: var(--highlight);
    font-weight: bold;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.visit-link:hover {
    color: var(--text-color);
}
</style>
