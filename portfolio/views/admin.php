<?php
require_once('../api/db.php');

// Fetch existing records
$projects = $conn->query("SELECT * FROM projects ORDER BY id DESC")->fetchAll();
$achievements = $conn->query("SELECT * FROM achievements ORDER BY id DESC")->fetchAll();
$skills = $conn->query("SELECT * FROM skills ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h2 class="mb-4">Admin Panel</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">✅ <?= htmlspecialchars($_GET['success']) ?></div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger">❌ <?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <ul class="nav nav-tabs mb-3" id="adminTabs" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#projects">Projects</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#achievements">Achievements</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#skills">Skills</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="projects">
            <h4>Add Project</h4>
            <form action="admin-handler.php" method="POST" enctype="multipart/form-data" class="mb-4">
                <div class="mb-2">
                    <label>Project Name</label>
                    <input type="text" name="project_name" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Description</label>
                    <textarea name="project_description" class="form-control" rows="2" required></textarea>
                </div>
                <div class="mb-2">
                    <label>Link (optional)</label>
                    <input type="url" name="project_link" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Image (required)</label>
                    <input type="file" name="project_image" class="form-control" accept="image/*" required>
                </div>
                <button type="submit" name="add_project" class="btn btn-primary">Add Project</button>
            </form>

            <h5>Existing Projects</h5>
            <div class="row">
                <?php foreach ($projects as $proj): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="../uploads/projects/<?= htmlspecialchars($proj['Image_URL']) ?>" class="card-img-top" alt="Project Image">
                            <div class="card-body">
                                <h5><?= htmlspecialchars($proj['Title']) ?></h5>
                                <p><?= htmlspecialchars($proj['Description']) ?></p>
                                <?php if (!empty($proj['Project_URL'])): ?>
                                    <a href="<?= htmlspecialchars($proj['Project_URL']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary">Visit</a>
                                <?php endif; ?>
                                <a href="admin-handler.php?delete_project=<?= $proj['ID'] ?>" class="btn btn-sm btn-danger float-end">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="tab-pane fade" id="achievements">
            <h4>Add Achievement</h4>
            <form action="admin-handler.php" method="POST" class="mb-4">
                <div class="mb-2">
                    <label>Title</label>
                    <input type="text" name="achievement_title" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Description</label>
                    <textarea name="achievement_description" class="form-control" rows="2" required></textarea>
                </div>
                <button type="submit" name="add_achievement" class="btn btn-primary">Add Achievement</button>
            </form>

            <h5>Existing Achievements</h5>
            <ul class="list-group">
                <?php foreach ($achievements as $ach): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?= htmlspecialchars($ach['title']) ?>:</strong> <?= htmlspecialchars($ach['description']) ?>
                        </div>
                        <a href="admin-handler.php?delete_achievement=<?= $ach['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="tab-pane fade" id="skills">
            <h4>Add Skill</h4>
            <form action="admin-handler.php" method="POST" class="mb-4">
                <div class="mb-2">
                    <label>Skill Name</label>
                    <input type="text" name="skill_name" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Proficiency Level (e.g., Beginner, Intermediate, Advanced)</label>
                    <input type="text" name="skill_level" class="form-control" required>
                </div>
                <button type="submit" name="add_skill" class="btn btn-primary">Add Skill</button>
            </form>

            <h5>Existing Skills</h5>
            <ul class="list-group">
                <?php foreach ($skills as $skill): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($skill['skill_name']) ?> (<?= htmlspecialchars($skill['proficiency_level']) ?>)
                        <a href="admin-handler.php?delete_skill=<?= $skill['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>