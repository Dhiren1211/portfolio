<?php
session_start();
require_once('../api/db.php');
if (!isset($_SESSION['User']) || $_SESSION['User'] != 'Admin') {
    header("Location: login.php");
    exit();
}
// Fetch existing records
$projects = $conn->query("SELECT * FROM projects ORDER BY id DESC")->fetchAll();
$achievements = $conn->query("SELECT * FROM achievements ORDER BY id DESC")->fetchAll();
$skills = $conn->query("SELECT * FROM skills ORDER BY id DESC")->fetchAll();
$messages = $conn->query("SELECT * FROM messages ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
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
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#messages">Messages</a></li>
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
                        <label for="project_image" class="form-label">Upload Project Image</label>
                        <div class="custom-file-upload-wrapper position-relative">
                            <input type="file" name="project_image" id="project_image"
                                class="form-control custom-file-upload" accept="image/*" required>
                        </div>
                    </div>

                    <button type="submit" name="add_project" class="btn btn-primary mt-2">Add Project</button>
                </form>

                <h5>Existing Projects</h5>
                <div class="row">
                    <?php foreach ($projects as $proj): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="../uploads/projects/<?= htmlspecialchars($proj['Image_URL']) ?>"
                                class="card-img-top" alt="Project Image">
                            <div class="card-body">
                                <h5><?= htmlspecialchars($proj['Title']) ?></h5>
                                <p><?= htmlspecialchars($proj['Description']) ?></p>
                                <?php if (!empty($proj['Project_URL'])): ?>
                                <a href="<?= htmlspecialchars($proj['Project_URL']) ?>" target="_blank"
                                    class="btn btn-sm btn-outline-secondary">Visit</a>
                                <?php endif; ?>
                                <a href="admin-handler.php?delete_project=<?= $proj['ID'] ?>"
                                    class="btn btn-sm btn-danger float-end">Delete</a>
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
                    <li class="list-group-item d-grid justify-content-between align-items-center">
                        <div>
                            <Center><strong><?= htmlspecialchars($ach['title']) ?>:</strong></Center>
                            <br> <small><?= htmlspecialchars($ach['description']) ?></small>
                        </div>
                        <center><a href="admin-handler.php?delete_achievement=<?= $ach['id'] ?>"
                                class="btn btn-sm btn-danger" style=" max-width: 100px;">Delete</a>
                        </center>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="tab-pane fade" id="skills">
                <h4 id="skill-form-title">Add Skill</h4>
                <form action="admin-handler.php" method="POST" id="skill-form" class="mb-4">
                    <input type="hidden" name="skill_id" id="skill_id">
                    <div class="mb-2">
                        <label>Skill Name</label>
                        <input type="text" name="skill_name" id="skill_name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Proficiency Level (e.g., Beginner, Intermediate, Advanced)</label>
                        <input type="text" name="skill_level" id="skill_level" class="form-control" required>
                    </div>
                    <button type="submit" name="add_skill" id="skill-submit-btn" class="btn btn-primary">Add
                        Skill</button>
                </form>

                <h5>Existing Skills</h5>
                <ul class="list-group" id="skills-list">
                    <?php foreach ($skills as $skill): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            <?= htmlspecialchars($skill['skill_name']) ?>
                            <small><?= htmlspecialchars($skill['proficiency_level']) ?></small>
                        </span>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-secondary edit-skill-btn" data-id="<?= $skill['id'] ?>"
                                data-name="<?= htmlspecialchars($skill['skill_name']) ?>"
                                data-level="<?= htmlspecialchars($skill['proficiency_level']) ?>">
                                Edit
                            </button>
                            <a href="admin-handler.php?delete_skill=<?= $skill['id'] ?>"
                                class="btn btn-sm btn-danger">Delete</a>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>

            </div>
            <div class="tab-pane fade" id="messages">
                <h5 class="mb-3">Messages</h5>
                <ul class="list-group">
                    <?php foreach ($messages as $message): ?>
                    <li class="list-group-item d-flex flex-column flex-md-row gap-3">
                        <div class="d-flex align-items-start gap-3 flex-grow-1">
                            <img src="../assets/default.jpg" alt="Profile" width="60" height="60"
                                class="rounded-circle">
                            <div>
                                <h6 class="mb-1">
                                    <strong><?= htmlspecialchars($message['Name']) ?></strong>
                                    <?php if ($message['Status'] === 'Read'): ?>
                                    <span class="badge bg-success ms-2">Read</span>
                                    <?php endif; ?>
                                </h6>
                                <small
                                    class="text-muted d-block mb-1">&lt;<?= htmlspecialchars($message['Email']) ?>&gt;</small>
                                <p class="mb-2"><?= nl2br(htmlspecialchars($message['Message'])) ?></p>
                                <small class="text-muted">Received:
                                    <?= htmlspecialchars($message['Received_time']) ?></small>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-sm-row flex-md-column gap-2">
                            <a href="mailto:<?= htmlspecialchars($message['Email']) ?>"
                                class="btn btn-sm btn-outline-primary w-100">
                                <i class="fas fa-reply"></i> Reply
                            </a>
                            <?php if ($message['Status'] !== 'Read'): ?>
                            <a href="admin-handler.php?mark_read=<?= $message['ID'] ?>"
                                class="btn btn-sm btn-outline-success w-100">
                                <i class="fas fa-check-double"></i> Mark as Read
                            </a>
                            <?php endif; ?>
                            <a href="admin-handler.php?delete_message=<?= $message['ID'] ?>"
                                class="btn btn-sm btn-outline-danger w-100">
                                <i class="fas fa-trash-alt"></i> Delete
                            </a>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>


        </div>
    </div>
    <script>
    // Auto-hide alerts after 4 seconds
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => alert.classList.add('fade', 'show'));
        setTimeout(() => alerts.forEach(alert => alert.remove()), 1000); // remove after fade
    }, 4000);

    // Handle Skill Edit
    document.querySelectorAll('.edit-skill-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('skill_id').value = this.dataset.id;
            document.getElementById('skill_name').value = this.dataset.name;
            document.getElementById('skill_level').value = this.dataset.level;
            document.getElementById('skill-form-title').innerText = 'Edit Skill';
            document.getElementById('skill-submit-btn').innerText = 'Update Skill';
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
