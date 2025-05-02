<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<header>
  <nav class="navbar">
    <div class="hamburger" onclick="toggleMenu()">☰</div>
    <ul class="nav-list" id="navList">
      <li><a href="#" data-target="projects.php">Projects</a></li>
      <li><a href="#" data-target="achievements.php">Achievements</a></li>
      <li><a href="#" data-target="contact.php">Contact Me</a></li>

    </ul>
  </nav>
</header>

<script>
  function toggleMenu() {
    const navList = document.getElementById('navList');
    navList.classList.toggle('show');
  }

  // AJAX load function
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.nav-list a').forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        const targetPage = this.getAttribute('data-target');
        if (targetPage) {
          fetch(targetPage)
            .then(res => res.text())
            .then(html => {
              document.querySelector('.right').innerHTML = html;
              toggleMenu(); // close mobile menu if open
            });
        }
      });
    });
  });
</script>

<style>
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
  header {
    background-color:var(--bg-color);
    padding: 15px 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
    border-radius: 10px ;
    color: var(--text-color);
  }

  .navbar {
    display: flex;
    justify-content:right;
    align-items: center;
  }

  .logo {
    color: white;
    font-size: 1.8em;
    font-weight: 600;
  }

  .nav-list {
    list-style: none;
    display: flex;
    gap: 30px;
  }

  .nav-list li a {
    text-decoration: none;
    color: var(--text-color);
    font-size: 1em;
    padding: 8px 12px;
    transition: 0.3s ease;
    border-radius: 4px;
  }

  .nav-list li a:hover {
    background-color: #34495e;
    color: #00cec9;
  }

  .hamburger {
    font-size: 1.8em;
    color: white;
    display: none;
    cursor: pointer;
  }

  @media (max-width: 768px) {
    .nav-list {
      flex-direction: column;
      position: absolute;
      top: 60px;
      right: 30px;
      background-color:var(--bg-color);
      border-radius: 8px;
      display: none;
      padding: 10px 0;
      z-index: 999;
    }

    .nav-list.show {
      display: flex;
    }

    .hamburger {
      display: block;
    }
  }
</style>
