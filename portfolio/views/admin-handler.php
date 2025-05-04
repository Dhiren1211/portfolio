<?php
require_once('../api/db.php');

// Project Add
if (isset($_POST['add_project'])) {
    $name = $_POST['project_name'];
    $desc = $_POST['project_description'];
    $link = $_POST['project_link'];
    $image = $_FILES['project_image'];

    // Check image presence
    if ($image['error'] === 0 && $image['size'] > 0) {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array(strtolower($ext), $allowed)) {
            $newName = uniqid('proj_') . '.' . $ext;
            $target = '../uploads/projects/' . $newName;

            if (move_uploaded_file($image['tmp_name'], $target)) {
                $stmt = $conn->prepare("INSERT INTO projects (Title, Description, Image_URL, Project_URL, Created_at) VALUES (?, ?, ?, ?, NOW())");
                $stmt->execute([$name, $desc, $newName, $link]);
                header("Location: admin.php?success=project_added");
                exit();
            } else {
                header("Location: admin.php?error=upload_failed");
                echo "<script> console.log('Error Occurred during project upload:', " . $image['error'] . ");</script>";
                exit();
            }
        } else {
            header("Location: admin.php?error=invalid_format");
            exit();
        }
    } else {
        header("Location: admin.php?error=image_required");
        exit();
    }
}

// Project Delete
if (isset($_GET['delete_project'])) {
    $id = $_GET['delete_project'];
    $stmt = $conn->prepare("SELECT Image_URL FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($project) {
        $image = $project['Image_URL'];
        $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->execute([$id]);

        $imagePath = '../uploads/projects/' . $image;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        header("Location: admin.php?success=project_deleted");
        exit();
    } else {
        header("Location: admin.php?error=project_not_found"); // Handle case where project doesn't exist
        exit();
    }
}

// Add Achievement
if (isset($_POST['add_achievement'])) {
    $title = $_POST['achievement_title'];
    $desc = $_POST['achievement_description'];
    $stmt = $conn->prepare("INSERT INTO achievements (title, description) VALUES (?, ?)");
    $stmt->execute([$title, $desc]);
    header("Location: admin.php?success=achievement_added");
    exit();
}

// Delete Achievement
if (isset($_GET['delete_achievement'])) {
    $id = $_GET['delete_achievement'];
    $stmt = $conn->prepare("DELETE FROM achievements WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin.php?success=achievement_deleted");
    exit();
}

// Add Skill
if (isset($_POST['add_skill'])) {
    $skill = $_POST['skill_name'];
    $level = $_POST['skill_level'];
    $stmt = $conn->prepare("INSERT INTO skills (skill_name, proficiency_level) VALUES (?, ?)");
    $stmt->execute([$skill, $level]);
    header("Location: admin.php?success=skill_added");
    exit();
}

// Delete Skill
if (isset($_GET['delete_skill'])) {
    $id = $_GET['delete_skill'];
    $stmt = $conn->prepare("DELETE FROM skills WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin.php?success=skill_deleted");
    exit();
}
    if (isset($_GET['mark_read'])) {
    $id = intval($_GET['mark_read']);
    $stmt = $conn->prepare("UPDATE messages SET Status = 'Read' WHERE ID = ?");
    $stmt->execute([$id]);
    header("Location: admin.php?success=Message marked as read");
    exit();
}
if (isset($_GET['delete_message'])) {
    $id = intval($_GET['delete_message']);
    $stmt = $conn->prepare("DELETE FROM messages WHERE ID = ?");
    $stmt->execute([$id]);
    header("Location: admin.php?success=Message deleted successfully");
    exit();
}
?>
