<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dhiren</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
   

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 0px, 10px;
            transition: background-color 0.3s, color 0.3s;
            overflow-x: hidden;
        }
         .theme{
            position: absolute;
            top: 10px;
            left: 50px;
            z-index: 1000;
         }
        #themeToggle {
            position:fixed;
            transform: translateX(-50%);
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            z-index: 1000;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            justify-content: center;
        }

        .left {
            padding-left:20px;
            flex: 1;
            min-width: 300px;
            max-width: 400px;
        }

        .right {
            flex: 2;
            min-width: 400px;
            max-width: 800px;
        }

        .main h1 {
            font-size: 2.8em;
            color: var(--text-color);
            margin-bottom: 10px;
        }

        .main h2 {
            font-size: 1.5em;
            margin: 10px 0;
        }

        .prof {
            color: var(--highlight);
            font-weight: bold;
        }
       

        .image img {
            margin-top: 10px;
            min-width: 200px;
            max-width: 250px;
            border-radius: 50%;
            border: 4px solid var(--highlight);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.4s ease;
            cursor:pointer;
        }

        .image img:hover {
            transform: scale(1.05);
        }

        .buttons {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .buttons button {
            padding: 10px 20px;
            background-color: var(--highlight);
            color: var(--text-color);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .buttons button:hover {
            filter: brightness(0.8);
            background-color: var(--bg-color);
           
        }

        .buttons a {
            color: var(--text-color);
            text-decoration: none;
        }
         .social{
            margin-top: 30px;
            display: flex;
            gap: 10%;
            flex-wrap: wrap;
            font-size: 1.5em;
         }
         .social-icons{
            transition: color 0.3s ease;
            font-size: 2.1rem;
            display: flex;
            flex-wrap: wrap;
            gap:30px;
            text-align: center;
            padding:10px;
         }
         .social-icons a{
            color: var(--highlight);
            transition:  0.3s ease;
         }
         .social-icons a:hover{
            color: var(--text-color);
            transition: 0.3s ease;
            transform: scale(1.2);
         }
        .skills {
            margin-top: 30px;
            display:grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            background-color: var(--container-bg);
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .skills h2 {
            font-size: 1.8em;
            margin-bottom: 15px;
            color: var(--text-color);
        }

        .skill-card {
            background: var(--card-bg);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: background-color 0.3s;
            cursor:pointer;
        }
        .skill-card:hover{
            transform:scale(1.05);
            transition: transform 0.3s ease;
        }
        .skill-card h3 {
            margin-bottom: 8px;
            color: var(--highlight);
        }

        .skill-card p {
            margin: 4px 0;
            font-size: 0.95em;
        }
       footer{
        
       }
       .smallfooter{
        display:none;
       }
        @media (max-width: 768px) {
           
            .container {
                flex-direction: column;
                align-items: center;
                width: 100vw;
            }
            .left{
                max-width: 100vw;
                text-align:center;

            }
            .right{
                max-width: 100vw;
                text-align:center;
            }
            .image{
            display: flex;
            justify-content: center;
            }
            .image img {
                max-width: 150px;
            }
            .right{
                max-width: 100vw;
                text-align:center;
            }
             .skills {
                 max-width: 100%;
                
    
             }
             .skill-card{
                max-width: 95%;
             }
             .skills h2{
                 
             }
            .main{
                text-align:center;
                align-items:center;
            }
            .main h1 {
                font-size: 2em;
            }

            .main h2 {
                font-size: 1.2em;
            }
            .footer{
                display:none;
            }
            .smallfooter{
                margin-top: 20px;
                display:Block;
            }
        }
    </style>
</head>
<body>
<?php 
require('../api/db.php');
$stmt = $conn->prepare("SELECT * FROM skills");
$stmt->execute();
$projects = $stmt->fetchAll();
require_once('../requires/header.php');
?>



<div class="container">
    <div class="left">
        <span class="theme"><button id="themeToggle">🌙</button></span>
        <div class="main">
            <h1 style ="margin-top: 10px;">Hi, There!</h1>
            <h2>This is Dhirendra Kathayat.</h2>
            <h2>I am <span class="prof" id="typewriter"></span></h2>
        </div>
        <div class="image">
            <img src="../images/dhiren.png" alt="Dhiren">
        </div>
        <div class="buttons">
             <button>
                  <a href="../assets/cv.pdf" download="Dhirendra_Kathayat_CV.pdf"> <i class="fas fa-download"></i> &nbsp; CV</a>
             </button>
            <button  class="nav-list" ><a  href="#" data-target="contact.php">HIRE ME</a></button>
        </div>
        <div class="social">
            <h5>Follow me on:</h5>
            <div class="social-icons">
                <a href="https://github.com/Dhiren1211" target="_blank"><i class="fab fa-github"></i></a>
                <a href="https://www.linkedin.com/in/dhirendra-kathayat-ba7055319/" target="_blank"><i class="fab fa-linkedin"></i></a>
                <a href="https://www.instagram.com/dhirenkathayat121/" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://www.facebook.com/DhirenKathayat121" target="_blank"><i class="fab fa-facebook"></i></a>
            </div>
        </div>
        <div class="footer">
        <?php require_once('../requires/footer.php'); ?>
        </div>
    </div>

    <div class="right" id="rightContent">
  <h2 style ="margin-top: 10px;">MY SKILLS</h2>
  <div class="skills">
    <?php foreach ($projects as $project) { ?>
      <div class="skill-card">
        <h3><?php echo htmlspecialchars($project['skill_name']); ?></h3>
        <p><?php echo htmlspecialchars($project['proficiency_level']); ?></p>
      </div>
    <?php } ?>
  </div>
  <div class="smallfooter">
    <?php require_once('../requires/footer.php'); ?>
  </div>
</div>

</div>



<script>
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

    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        body.classList.add('dark');
        themeToggle.textContent = '☀️';
    }

    themeToggle.addEventListener('click', () => {
        body.classList.toggle('dark');
        const isDark = body.classList.contains('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        themeToggle.textContent = isDark ? '☀️' : '🌙';
    });
</script>
</body>
</html>
