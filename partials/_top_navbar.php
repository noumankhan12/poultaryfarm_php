<nav class="navbar">
        <div class="nav_icon" onclick="toggleSidebar()">
          <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="navbar__left">
          <a href="eggsSummary.php" onclick="toggle()">Eggs</a>
          <a href="birdsSummary.php" onclick="toggle()">Birds</a>
          <a href="feedSummary.php">Feed</a>
          <a href="feedSummary.php">Medicine</a>
          <a href="feedSummary.php">Feul</a>
          <a href="feedSummary.php">Food</a>
        </div>
        <div class="navbar__right">
            <h1 style="font-size: 15px; color: green; color: #2e4a66; margin-right: 10px;"><?php echo 'Logged in as ' . $_SESSION["Username"]; ?></h1>
        </div>
      </nav>