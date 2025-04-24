<?php
include("php/config.php");

// starting session only when $_session is set
session_start();
include("connection.php");

// Check if user is logged in for certain actions
$loggedIn = isset($_SESSION['username']);
$currentUsername = $loggedIn ? $_SESSION['username'] : '';

// Handle user search functionality
if (isset($_GET['search'])) {
    $username = $_GET['search'];
    
    $sql = "SELECT `id`,`username`, `fname`, `lname`, `email` FROM `users` WHERE `username` LIKE '%$username%'OR `fname` LIKE '%$username%' OR `lname` LIKE '%$username%';";
    $result = mysqli_query($connection, $sql);
}

// Handle profile view
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $sql = "SELECT `id`,`username`, `fname`, `lname`, `email` FROM `users` WHERE `username` ='$username';";
    $result = mysqli_query($connection, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
        $username_row = $userData['username'];
        $user_id = $userData['id'];
        $fname = $userData['fname'];
        $lname = $userData['lname'];
        $email = $userData['email'];
        
        // Set default tab if not specified
        if (isset($_GET['tab'])) {
            $tab = $_GET['tab'];
        } else {
            $tab = "feed";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minglr - Get Connected</title>
    
    <!-- Light theme css -->
    <link rel="stylesheet" href="style/lighttheme_css/light_style.css?v=<?php echo time();?>">  
    <link rel="stylesheet" href="style/lighttheme_css/light_account.css?t=<?php echo time();?>" id="theme">  
    <!-- Include main.css from second file -->
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="style_dashboard.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- favicon -->
    <link rel="shortcut icon" href="logo/Minglr logo4.png" type="image/png">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="logo">
                <h2>Minglr</h2>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="dashboard.php"><i class="fas fa-th-large"></i><span>Feed</span></a></li>
                    <li><a href="message.php"><i class="fas fa-comments"></i><span>Messages</span></a></li>
                    <?php if($loggedIn): ?>
                    <li class="active"><a href="account.php?username=<?php echo $currentUsername; ?>"><i class="fas fa-user"></i><span>My Profile</span></a></li>
                    <?php else: ?>
                    <li><a href="account.php"><i class="fas fa-user"></i><span>Account</span></a></li>
                    <?php endif; ?>
                    <li><a href="about-us.php"><i class="fas fa-info-circle"></i><span>About Us</span></a></li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <?php if($loggedIn): ?>
                <a href="back/logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                <?php else: ?>
                <a href="index.php" class="logout-btn"><i class="fas fa-sign-in-alt"></i><span>Login</span></a>
                <?php endif; ?>
            </div>
        </aside>

        <main class="main-content">
            <header class="top-header">
                <div class="header-title">
                    <?php if(isset($userData)): ?>
                    <h1><?php echo htmlspecialchars($fname . " " . $lname); ?>'s Profile</h1>
                    <?php else: ?>
                    <h1>Welcome to Minglr</h1>
                    <?php endif; ?>
                </div>
                <div class="user-area">
                    <div class="theme-toggle">
                        <img src="img/dark_img/MoonIcon.png" alt="Theme Icon" height="19" width="19" id="theme-icon" class="theme-button" onclick="changeAccountTheme()">
                    </div>
                    <?php if($loggedIn): ?>
                    <div class="user-profile">
                        <img src="https://api.dicebear.com/6.x/initials/png?seed=<?php echo $_SESSION['fname']; ?>&size=128" alt="Profile">
                        <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </header>

            <div class="content-wrapper">
                <?php if(isset($_GET['search']) && isset($result)): ?>
                    <!-- Search Results -->
                    <div class="profile-container">
                        <div class="profile-section">
                            <h3>Search Results</h3>
                            <?php if(mysqli_num_rows($result) >= 1): ?>
                                <div class="search-results">
                                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                                        <a href="account.php?username=<?php echo $row['username']; ?>" class="search-result-item">
                                            <div class="user-profile">
                                                <img class="user-avatar" src="https://api.dicebear.com/6.x/initials/png?seed=<?php echo $row['fname']; ?>&size=128" alt="User Avatar">
                                                <div class="user-info">
                                                    <div class="user-username"><?php echo htmlspecialchars($row['username']); ?></div>
                                                    <div class="user-name"><?php echo htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?></div>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endwhile; ?>
                                </div>
                            <?php else: ?>
                                <p>No users found matching your search criteria.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php elseif(isset($_GET['username']) && isset($userData)): ?>
                    <!-- User Profile View -->
                    <div class="profile-container">
                        <div class="profile-header">
                            <div class="profile-avatar">
                                <img src="https://api.dicebear.com/6.x/initials/png?seed=<?php echo $fname; ?>&size=128" alt="Profile Picture">
                                <span class="status-indicator active"></span>
                            </div>

                            <div class="profile-info">
                                <h2><?php echo htmlspecialchars($username_row); ?></h2>
                                <p class="profile-bio"><?php echo htmlspecialchars($fname . " " . $lname); ?></p>
                                <div class="profile-meta">
                                    <span><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($email); ?></span>
                                </div>
                                <?php if(isset($_SESSION['username']) && ($username != $_SESSION['username'])): ?>
                                <div class="profile-actions">
                                    <form action="message.php" method="GET">
                                        <input type="hidden" name="recp2" value="<?php echo $user_id; ?>">
                                        <button class="message-btn"><i class="fas fa-paper-plane"></i> Send Message</button>
                                    </form>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Profile Tabs -->
                        <div class="profile-tabs">
                            <div class="tab <?php echo $tab == 'feed' ? 'active' : ''; ?>" data-tab="feed">
                                <a href="account.php?username=<?php echo $username; ?>&tab=feed">Feed</a>
                            </div>
                            <div class="tab <?php echo $tab == 'info' ? 'active' : ''; ?>" data-tab="info">
                                <a href="account.php?username=<?php echo $username; ?>&tab=info">Info</a>
                            </div>
                            <div class="tab <?php echo $tab == 'photo' ? 'active' : ''; ?>" data-tab="photo">
                                <a href="account.php?username=<?php echo $username; ?>&tab=photo">Photos</a>
                            </div>
                        </div>

                        <!-- Tab Content -->
                        <?php if($tab == "feed"): ?>
                            <div class="tab-content active" id="feed-content">
                                <div class="profile-section">
                                    <h3>Welcome to <?php echo $fname; ?>'s feed...</h3>
                                    
                                    <?php if(isset($_SESSION['username']) && $_SESSION['username'] == $username): ?>
                                        <div class="feed-post-box">
                                            <form action="/post.php" method="post" enctype="multipart/form-data">
                                                <textarea name="post" id="post" wrap="hard" placeholder="What's on your mind, <?php echo $fname; ?>?" class="feed-post-box-textarea"></textarea>
                                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                                <input type="hidden" name="username" value="<?php echo $username; ?>">
                                                <div class="form-actions">
                                                    <input type="file" name="postimage" accept=".jpg, .png, .jpeg" class="postimage">
                                                    <button type="submit" class="post-btn">Post</button>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="feed-posts">
                                        <?php
                                        $postsql = "SELECT `msg`, `image`, `pid`, `dop` FROM `posts` WHERE `uid` = " . $user_id . " ORDER BY `dop` DESC;";
                                        $postresult = mysqli_query($connection, $postsql);
                                        
                                        if(mysqli_num_rows($postresult) > 0):
                                            while($postrow = mysqli_fetch_assoc($postresult)):
                                        ?>
                                            <div class="feed-post-display-box">
                                                <div class="feed-post-display-box-head">
                                                    <div class="post-author">
                                                        <img src="https://api.dicebear.com/6.x/initials/png?seed=<?php echo $fname; ?>&size=128" alt="profile" class="account-profpic">
                                                        <div>
                                                            <a href="account.php?username=<?php echo $username; ?>"><?php echo $fname; ?></a>
                                                            <small>shared a post on <?php echo $postrow['dop']; ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="feed-post-display-box-message">
                                                    <?php echo str_replace("\n", "<br>", $postrow['msg']); ?>
                                                </div>
                                                <?php if($postrow['image'] != NULL): ?>
                                                <div class="feed-post-display-box-image">
                                                    <img src="uploads/<?php echo $postrow['image']; ?>" alt="<?php echo $postrow['image']; ?>">
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php
                                            endwhile;
                                        else:
                                        ?>
                                            <p>No posts found</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php elseif($tab == "info"): ?>
                            <div class="tab-content active" id="info-content">
                                <div class="profile-section">
                                    <h3>Personal Information</h3>
                                    <div class="info-container">
                                        <div class="info-group">
                                            <label>Name</label>
                                            <p><?php echo htmlspecialchars($fname); ?></p>
                                        </div>
                                        <div class="info-group">
                                            <label>Last Name</label>
                                            <p><?php echo htmlspecialchars($lname); ?></p>
                                        </div>
                                        <div class="info-group">
                                            <label>Username</label>
                                            <p><?php echo htmlspecialchars($username); ?></p>
                                        </div>
                                        <div class="info-group">
                                            <label>Email</label>
                                            <p><?php echo htmlspecialchars($email); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php elseif($tab == "photo"): ?>
                            <div class="tab-content active" id="photo-content">
                                <div class="profile-section">
                                    <h3>Photos from <?php echo $fname; ?></h3>
                                    <div class="portfolio-grid">
                                        <?php
                                        $postsqlimg = "SELECT `image`, `msg`, `dop`, `uid` FROM `posts` WHERE `uid` = " . $user_id . " AND `image` IS NOT NULL ORDER BY `dop` DESC;";
                                        $postresultimgs = mysqli_query($connection, $postsqlimg);
                                        
                                        if(mysqli_num_rows($postresultimgs) > 0):
                                            while($postrow = mysqli_fetch_assoc($postresultimgs)):
                                        ?>
                                            <div class="portfolio-item">
                                                <img src="uploads/<?php echo $postrow['image']; ?>" alt="<?php echo $postrow['image']; ?>">
                                                <div class="portfolio-item-overlay">
                                                    <div class="overlay-content">
                                                        <p><?php echo substr(strip_tags($postrow['msg']), 0, 100); ?><?php echo strlen($postrow['msg']) > 100 ? '...' : ''; ?></p>
                                                        <small><?php echo $postrow['dop']; ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                            endwhile;
                                        else:
                                        ?>
                                            <p>No photos found</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <!-- Search Form -->
                    <div class="profile-container">
                        <div class="profile-section">
                            <h3>Find People</h3>
                            <form action="account.php" method="GET" class="search-form">
                                <div class="form-group">
                                    <input type="text" name="search" placeholder="Search by username, first name or last name" required>
                                    <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <div class="footer">
        <p class="footer-title">Minglr</p>
        <ul class="footer-icons">
            <li class="foot-item">
                <a href="https://github.com/Mayuresh-22/Minglr" class="foot-link"><i class="fa-brands fa-github"></i></a>
            </li>
            <li class="foot-item">
                <a href="https://x.com/mayuresh_empire" class="foot-link"><i class="fab fa-twitter"></i></a>
            </li>
            <li class="foot-item">
                <a href="https://www.linkedin.com/in/mayureshchoudhary/" class="foot-link"><i class="fa-brands fa-linkedin"></i></a>
            </li>
        </ul>
        <ul class="footer-links">
            <li class="foot-item"><a href="index.php" class="foot-link">Home</a></li>
            <li class="foot-item"><a href="dashboard.php" class="foot-link">Feed</a></li>
            <li class="foot-item"><a href="account.php" class="foot-link">Account</a></li>
            <li class="foot-item"><a href="about-us.php" class="foot-link">About us</a></li>
        </ul>
        <p class="footer-copyright">This website is only for educational purposes and does not try to replicate any institution/entity/company - by Mayuresh Choudhary</p>
    </div>

    <div id="lightbox-overlay" class="lightbox-overlay" onclick="closeLightbox()">
        <img id="lightbox-image" class="enlarged-photo" src="" alt="Enlarged Photo">
    </div>
    
    <script src="script.js"></script>
</body>
</html>