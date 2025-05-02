<?php
require_once('../api/db.php'); // make sure db.php contains a valid $conn (PDO)

$success = false;
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($message)) {
        try {
            $stmt = $conn->prepare("INSERT INTO messages (Name, Email, Message, Received_time, Status) VALUES (?, ?, ?, NOW(), ?)");
            $status = 'unread';
            $stmt->execute([$name, $email, $message, $status]);
            $success = true;
        } catch (PDOException $e) {
            $error = true;
        }
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Me</title>
    <style>
        :root {
            --card-bg: #fff;
            --text-color: #333;
            --highlight: #007bff;
        }

        body {
            margin: 0;
            padding: 0;
            background: var(--bg-color, #f5f5f5);
            font-family: 'Segoe UI', sans-serif;
            color: var(--text-color);
        }

        .contact-container {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            background: var(--card-bg);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
        }

        .contact-container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .contact-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 16px;
        }

        .form-group {
            position: relative;
            display: flex;
            flex-direction: column;
            grid-column: span 1;
            margin-top: 10px;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group input,
        .form-group textarea {
            padding: 14px 12px 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #fff;
            transition: all 0.2s ease;
            font-family: inherit;
            outline: none;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group label {
            position: absolute;
            top: 12px;
            left: 12px;
            background: #fff;
            padding: 0 4px;
            font-size: 14px;
            color: #777;
            transition: 0.2s ease all;
            pointer-events: none;
            border-radius: 2px;
        }

        .form-group input:focus + label,
        .form-group input:not(:placeholder-shown) + label,
        .form-group textarea:focus + label,
        .form-group textarea:not(:placeholder-shown) + label {
            top: -8px;
            left: 10px;
            font-size: 12px;
            color: var(--text-color);
            background: var(--card-bg);
        }

        .contact-form button {
            grid-column: span 2;
            padding: 14px;
            background: var(--highlight);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }

        .contact-form button:hover {
            background: #0056b3;
        }

        @media (max-width: 600px) {
            .contact-form {
                grid-template-columns: 1fr;
            }

            .contact-form button {
                grid-column: span 1;
            }

            .form-group.full-width {
                grid-column: span 1;
            }
        }
    </style>
</head>
<body>

<div class="contact-container">
    <h2>Let your words awaken me 📬</h2>
   <center>
     <small> 
         <strong>
         Note: "Enter valid information so I can reach you with a reply."
         </strong>
     </small>
   </center> 
    <?php if ($success): ?>
        <script>
            alert("✅ Thank you! Your message has been received.");
            window.location.href = 'home.php';
        </script>
    <?php elseif ($error): ?>
        <script>
            alert("❌ Something went wrong! Please check your inputs or try again later.");
        </script>
    <?php endif; ?>

    <form method="POST" action="contact.php" class="contact-form">
        <div class="form-group">
            <input type="text" name="name" placeholder=" " required>
            <label>Your Name</label>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder=" " required>
            <label>Your Email</label>
        </div>
        <div class="form-group full-width">
            <textarea name="message" rows="5" placeholder=" " required></textarea>
            <label>Your Message</label>
        </div>
        <button type="submit">Send Message</button>
    </form>
</div>

</body>
</html>
