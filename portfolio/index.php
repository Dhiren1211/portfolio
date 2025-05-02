<?php  
require_once('./api/db.php');
session_start();
$_SESSION['User'] = 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dhiren - Portfolio</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        :root {
            --bg-color: #f0f0f0;
            --text-color: #333;
            --card-bg: #fff;
            --highlight: #3498db;
        }
       body.dark {
            --bg-color: #1e1e1e;
            --text-color: #f4f4f4;
            --card-bg: #2c2c2c;
            --highlight: #f39c12;
        }
        body {
            background-color:var(--bg-color);
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        main {
            text-align: center;
        }

        .main h1 {
            font-size: 3em;
            color:var(--text-color);
        }

        .main h2 {
            margin: 10px 0;
            font-size: 1.8em;
        }

        .prof {
            color:var(--highlight);
            font-weight: bold;
        }

        .image img {
            margin-top: 20px;
            max-width: 300px;
            border-radius: 50%;
            border: 3px solid var(--highlight);
            box-shadow: 0 4px 10px var(--card-bg);
            transition:  0.5s ease;
        }

        .buttons {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .buttons button {
            padding: 10px 20px;
            font-size: 1em;
            background-color:var(--highlight);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .buttons button:hover {
            background-color: #005e99;
        }

        .buttons a {
            color: var(--text-color);
            text-decoration: none;
        }

        @media (max-width: 600px) {
            .main h1 {
                font-size: 2.2em;
            }

            .main h2 {
                font-size: 1.2em;
            }

            .image img {
                max-width: 150px;
            }
        }
    </style>
</head>
<body>
    <main>
        <div class="main">
            <h1>Hi, There!</h1>
            <h2>This is Dhirendra Kathayat.</h2>
            <h2>I am <span class="prof" id="typewriter"></span></h2> 
        </div>
        <div class="image">
            <img src="./images/dhiren.png" alt="Dhiren">
        </div>
        <div class="buttons">
            <button><a href="./views/home.php">MY PROFILE</a></button>
            <button>  <a href="./assets/cv.pdf" download="Dhirendra_Kathayat_CV.pdf">MY CV</a></button>
        </div>
    </main>

    <script>
        // Typing animation effect
        const professions = ["a Software Developer", "a Web Developer", "a Computer Engineer","a Solo Learner", "a Lifelong Explorer"];
        let index = 0;
        let charIndex = 0;
        const typewriter = document.getElementById("typewriter");

        function type() {
            if (charIndex < professions[index].length) {
                typewriter.textContent += professions[index].charAt(charIndex);
                charIndex++;
                setTimeout(type, 100);
            } else {
                setTimeout(erase, 1500);
            }
        }

        function erase() {
            if (charIndex > 0) {
                typewriter.textContent = professions[index].substring(0, charIndex - 1);
                charIndex--;
                setTimeout(erase, 50);
            } else {
                index = (index + 1) % professions.length;
                setTimeout(type, 500);
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            setTimeout(type, 1000);
        });
    </script>
</body>
</html>
