<?php
include("php/config.php");

// starting session only when $_session is set
session_start();
// including root database connection file
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CycloPropane - Get Connected</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="shortcut icon" href="logo/CycloPropane logo4.png" type="image/png">
    <script src="https://kit.fontawesome.com/17a4e5185f.js" crossorigin="anonymous"></script>
    <style>
        :root {
            --dark-bg: #07020F;
            --dark-bg-lighter: #120424;
            --dark-bg-gradient: linear-gradient(135deg, #07020F, #140330);
            --purple: #DC00D3;
            --purple-glow: rgba(220, 0, 211, 0.6);
            --purple-transparent: rgba(220, 0, 211, 0.2);
            --cyan: #0CFAF5;
            --cyan-glow: rgba(12, 250, 245, 0.6);
            --cyan-transparent: rgba(12, 250, 245, 0.2);
            --blend-gradient: linear-gradient(135deg, var(--purple-transparent), var(--cyan-transparent));
            --vibrant-gradient: linear-gradient(to right, var(--purple), var(--cyan));
            --text-white: #f0f0f0;
            --text-light: #dcdcdc;
            --sidebar-width: 240px;
            --header-height: 70px;
            --border-radius: 8px;
            --card-border-radius: 12px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            --glow-shadow: 0 0 15px var(--purple-glow);
            --transition: all 0.3s ease;
        }

        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--dark-bg);
            color: var(--text-white);
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--dark-bg-lighter);
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            border-right: 1px solid var(--purple-transparent);
            box-shadow: var(--box-shadow);
            z-index: 1000;
            transition: var(--transition);
        }

        .sidebar .logo {
            padding: 25px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid var(--purple-transparent);
        }

        .sidebar .logo img {
            height: 40px;
            filter: drop-shadow(0 0 5px var(--purple-glow));
        }

        .sidebar .main-nav {
            flex: 1;
            padding: 20px 0;
            overflow-y: auto;
        }

        .sidebar .main-nav ul {
            list-style: none;
        }

        .sidebar .main-nav li {
            margin-bottom: 5px;
        }

        .sidebar .main-nav a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--text-light);
            text-decoration: none;
            transition: var(--transition);
            border-left: 3px solid transparent;
        }

        .sidebar .main-nav a:hover {
            background: var(--purple-transparent);
            color: var(--cyan);
        }

        .sidebar .main-nav a.active {
            background: var(--blend-gradient);
            border-left: 3px solid var(--cyan);
            color: var(--text-white);
        }

        .sidebar .main-nav i {
            margin-right: 12px;
            font-size: 20px;
            width: 22px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 15px 20px;
            border-top: 1px solid var(--purple-transparent);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            background: var(--dark-bg);
            color: var(--text-light);
            border-radius: var(--border-radius);
            text-decoration: none;
            transition: var(--transition);
        }

        .logout-btn:hover {
            background: var(--purple-transparent);
            color: var(--cyan);
        }

        .logout-btn i {
            margin-right: 8px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 20px;
            width: calc(100% - var(--sidebar-width));
        }

        .top-header {
            height: var(--header-height);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            background: var(--dark-bg-lighter);
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            box-shadow: var(--box-shadow);
        }

        .header-search {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 8px 15px;
            width: 50%;
            position: relative;
            border: 1px solid var(--purple-transparent);
        }

        .header-search input {
            background: transparent;
            border: none;
            color: var(--text-white);
            width: 100%;
            padding: 5px 10px;
            outline: none;
        }

        .header-search input::placeholder {
            color: rgba(220, 220, 220, 0.6);
        }

        .header-search i {
            color: var(--purple);
        }

        .filter-btn {
            display: flex;
            align-items: center;
            background: var(--purple-transparent);
            padding: 5px 12px;
            border-radius: 20px;
            cursor: pointer;
            margin-left: 10px;
            transition: var(--transition);
            font-size: 16px;
        }

        .filter-btn:hover {
            background: var(--purple-glow);
        }

        .filter-btn i {
            margin-right: 5px;
            color: var(--cyan);
        }

        .user-area {
            display: flex;
            align-items: center;
        }

        .notifications {
            position: relative;
            margin-right: 20px;
            cursor: pointer;
        }

        .notifications i {
            font-size: 20px;
            color: var(--text-light);
        }

        .notification-count {
            position: absolute;
            top: -5px;
            right: -8px;
            background: var(--purple);
            color: white;
            border-radius: 50%;
            font-size: 10px;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 16px;
        }

        .user-profile img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid var(--cyan-transparent);
        }

        /* Feed Content */
        .content-wrapper {
            padding: 20px;
        }

        .section-header {
            margin-bottom: 20px;
        }

        .section-header h1 {
            font-size: 26px;
            margin-bottom: 5px;
            color: var(--cyan);
            text-shadow: 0 0 10px var(--cyan-transparent);
        }

        .section-header p {
            color: var(--text-light);
            font-size: 14px;
        }

        .filter-tags {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .tag {
            padding: 8px 16px;
            background: var(--dark-bg-lighter);
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            border: 1px solid var(--purple-transparent);
        }

        .tag:hover {
            background: var(--purple-transparent);
        }

        .tag.active {
            background: var(--vibrant-gradient);
            box-shadow: var(--glow-shadow);
        }

        /* Post Creation Box */
        .feed-posting-box {
            background: var(--dark-bg-lighter);
            border-radius: var(--card-border-radius);
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: var(--box-shadow);
            border: 1px solid var(--purple-transparent);
        }

        .feed-post-box-textarea {
            width: 100%;
            min-height: 100px;
            padding: 15px;
            border-radius: var(--border-radius);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--purple-transparent);
            color: var(--text-white);
            resize: none;
            margin-bottom: 15px;
            outline: none;
            transition: var(--transition);
        }

        .feed-post-box-textarea:focus {
            border-color: var(--cyan);
            box-shadow: 0 0 10px var(--cyan-transparent);
        }

        .post-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .file-input {
            position: relative;
            overflow: hidden;
        }

        .file-input label {
            padding: 8px 15px;
            background: var(--dark-bg);
            border: 1px solid var(--purple-transparent);
            border-radius: var(--border-radius);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            transition: var(--transition);
        }

        .file-input label:hover {
            background: var(--purple-transparent);
        }

        .file-input label i {
            margin-right: 8px;
            color: var(--cyan);
        }

        .file-input input[type="file"] {
            position: absolute;
            font-size: 100px;
            opacity: 0;
            right: 0;
            top: 0;
            cursor: pointer;
        }

        .file-input label.file-selected {
            background: var(--purple-transparent);
            color: var(--cyan);
        }

        .post-btn {
            padding: 8px 25px;
            background: var(--vibrant-gradient);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            box-shadow: var(--box-shadow);
        }

        .post-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 0, 211, 0.4);
        }

        /* Feed Posts */
        .feeds {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .task-card, .post-card {
            background: var(--dark-bg-lighter);
            border-radius: var(--card-border-radius);
            padding: 20px;
            box-shadow: var(--box-shadow);
            border: 1px solid var(--purple-transparent);
            transition: var(--transition);
        }

        .task-card:hover, .post-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
            border-color: var(--cyan-transparent);
        }

        .task-header, .post-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            align-items: center;
        }

        .post-author {
            display: flex;
            align-items: center;
        }

        .post-author img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid var(--purple-transparent);
        }

        .post-author a {
            color: var(--cyan);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .post-author a:hover {
            text-shadow: 0 0 5px var(--cyan-glow);
        }

        .post-time {
            color: var(--text-light);
            font-size: 13px;
        }

        .post-time i {
            margin-right: 5px;
            color: var(--purple);
        }

        .post-content {
            margin-bottom: 15px;
            line-height: 1.6;
            white-space: pre-wrap;
        }

        .post-image img {
            width: 100%;
            max-height: 400px;
            object-fit: contain;
            border-radius: var(--border-radius);
            margin-bottom: 15px;
            border: 1px solid var(--purple-transparent);
            background: rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .post-image img:hover {
            transform: scale(1.02);
        }

        .post-actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            background: var(--dark-bg);
            border: none;
            border-radius: 20px;
            color: var(--text-light);
            cursor: pointer;
            transition: var(--transition);
        }

        .action-btn:hover {
            background: var(--purple-transparent);
            color: var(--cyan);
        }

        .action-btn i {
            margin-right: 8px;
        }

        .like-btn:hover {
            color: #ff3366;
        }

        .comment-btn:hover {
            color: var(--cyan);
        }

        .share-btn:hover {
            color: #3399ff;
        }

        .no-posts {
            text-align: center;
            padding: 40px 0;
            color: var(--text-light);
        }

        .no-posts i {
            font-size: 40px;
            margin-bottom: 10px;
            color: var(--purple);
        }

        /* Lightbox for Images */
        .lightbox-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .enlarged-photo {
            max-width: 90%;
            max-height: 90%;
            border-radius: var(--border-radius);
            box-shadow: 0 0 30px var(--purple-glow);
        }

        /* Filter Modal */
        .filter-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .filter-content {
            background: var(--dark-bg-gradient);
            border-radius: var(--card-border-radius);
            width: 500px;
            max-width: 90%;
            box-shadow: var(--box-shadow);
            border: 1px solid var(--purple);
        }

        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid var(--purple-transparent);
        }

        .filter-header h3 {
            color: var(--cyan);
        }

        .close-filter {
            font-size: 24px;
            cursor: pointer;
            color: var(--text-light);
        }

        .filter-body {
            padding: 20px;
        }

        .filter-section {
            margin-bottom: 20px;
        }

        .filter-section h4 {
            margin-bottom: 10px;
            color: var(--text-white);
        }

        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .checkbox-group label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .checkbox-group input[type="checkbox"] {
            margin-right: 10px;
            appearance: none;
            width: 16px;
            height: 16px;
            border: 1px solid var(--purple);
            border-radius: 3px;
            position: relative;
            cursor: pointer;
        }

        .checkbox-group input[type="checkbox"]:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--cyan);
        }

        .date-inputs {
            display: flex;
            gap: 15px;
        }

        .date-field {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .date-field input[type="date"] {
            padding: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--purple-transparent);
            border-radius: var(--border-radius);
            color: var(--text-white);
        }

        .filter-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 15px 20px;
            border-top: 1px solid var(--purple-transparent);
        }

        .reset-btn, .apply-btn {
            padding: 8px 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
        }

        .reset-btn {
            background: transparent;
            border: 1px solid var(--text-light);
            color: var(--text-light);
        }

        .reset-btn:hover {
            border-color: var(--cyan);
            color: var(--cyan);
        }

        .apply-btn {
            background: var(--vibrant-gradient);
            border: none;
            color: white;
        }

        .apply-btn:hover {
            box-shadow: 0 0 10px var(--purple-glow);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
            }

            .sidebar .logo {
                padding: 15px;
            }

            .sidebar .main-nav a {
                padding: 12px;
                justify-content: center;
            }

            .sidebar .main-nav i {
                margin-right: 0;
                font-size: 22px;
            }

            .sidebar .main-nav span, 
            .logout-btn span {
                display: none;
            }

            .sidebar-footer {
                padding: 10px;
            }
            
            .logout-btn {
                justify-content: center;
                padding: 10px;
            }
            
            .logout-btn i {
                margin-right: 0;
            }

            .main-content {
                margin-left: 70px;
                width: calc(100% - 70px);
            }
        }

        @media (max-width: 768px) {
            .top-header {
                flex-direction: column;
                height: auto;
                padding: 15px;
                gap: 15px;
            }

            .header-search {
                width: 100%;
            }

            .user-area {
                width: 100%;
                justify-content: space-between;
            }

            .filter-tags {
                overflow-x: auto;
                padding-bottom: 10px;
            }

            .tag {
                white-space: nowrap;
            }

            .post-actions {
                flex-wrap: wrap;
            }

            .action-btn {
                flex: 1;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="logo">
            <img src="logo/CycloPropane logo1.png" alt="CycloPropane Logo">
        </div>
        <nav class="main-nav">
            <ul>
                <li>
                    <a href="dashboard.php" class="active">
                        <i class="fas fa-th-large"></i>
                        <span>Feed</span>
                    </a>
                </li>
                <li>
                    <a href="messages.php">
                        <i class="fas fa-comments"></i>
                        <span>Messages</span>
                    </a>
                </li>
                <?php if (isset($_SESSION['username']) && isset($_SESSION['id'])) : ?>
                <li>
                    <a href="account.php?username=<?php echo $_SESSION['username']; ?>">
                        <i class="fas fa-user"></i>
                        <span>Account</span>
                    </a>
                </li>
                <?php else : ?>
                <li>
                    <a href="account.php">
                        <i class="fas fa-user"></i>
                        <span>Account</span>
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="about-us.php">
                        <i class="fas fa-users"></i>
                        <span>About Us</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="sidebar-footer">
            <?php if (isset($_SESSION['username'])) : ?>
                <a href="back/logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            <?php else : ?>
                <a href="index.php" class="logout-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login</span>
                </a>
            <?php endif; ?>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="main-content">
        <header class="top-header">
            <div class="header-search">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search for posts...">
                <div class="filter-btn">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </div>
            </div>
            <div class="user-area">
                <div class="notifications">
                    <i class="fas fa-bell"></i>
                    <span class="notification-count">3</span>
                </div>
                <div class="user-profile">
                    <?php if (isset($_SESSION['username']) && isset($_SESSION['id'])) : ?>
                        <img src="https://api.dicebear.com/6.x/initials/png?seed=<?php echo $_SESSION['username']; ?>&size=128" alt="Profile">
                        <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <?php else : ?>
                        <img src="https://api.dicebear.com/6.x/initials/png?seed=Guest&size=128" alt="Profile">
                        <span>Guest</span>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <div class="content-wrapper">
            <div class="section-header">
                <h1>Feed</h1>
                <p>See what others are sharing</p>
            </div>

            <div class="filter-tags">
                <div class="tag active">All Posts</div>
                <div class="tag">Popular</div>
                <div class="tag">Recent</div>
                <div class="tag">My Posts</div>
            </div>

            <?php if (isset($_SESSION['username']) && isset($_SESSION['id'])) : ?>
                <div class="feed-posting-box">
                    <form action="post.php?redirect=dashboard.php" method="post" enctype="multipart/form-data">
                        <textarea name="post" id="post" wrap="hard" placeholder="What's on your mind, <?php echo htmlspecialchars($_SESSION['username']); ?>?" class="feed-post-box-textarea"></textarea>
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id']; ?>">
                        <input type="hidden" name="username" id="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
                        <input type="hidden" name="redirect" id="redirect" value="dashboard.php">
                        <div class="post-actions">
                            <div class="file-input">
                                <label for="postimage"><i class="fas fa-image"></i> Add Image</label>
                                <input type="file" name="postimage" id="postimage" accept=".jpg, .png, .jpeg" class="postimage">
                            </div>
                            <button type="submit" class="post-btn">Post</button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>

            <!-- Feed posts display -->
            <div class="feeds">
                <?php
                // Posts fetching query which orders rows returned by query in descendin form (Old post -> New post)
                $postsql = "SELECT `msg`, `image`, `uid`, `dop` FROM `posts` ORDER BY `dop` DESC;";
                // executing query
                $postresult = mysqli_query($connection, $postsql);
                // counting number of rows return by query and only show post box
                // if number posts are greater than zero

                if (mysqli_num_rows($postresult) > 0) {
                    // fetching rows returned by query
                    $postrows = mysqli_fetch_all($postresult);

                    foreach ($postrows as $postrow) {
                        // getting usernames for every posts as usernames are not stored in same table
                        $usrsql = "SELECT `username`, `fname` FROM `users` WHERE `id` = " . $postrow[2] . ";";
                        $usrresult = mysqli_query($connection, $usrsql);
                        $usrrow = mysqli_fetch_assoc($usrresult);
                        $displayName = !empty($usrrow['fname']) ? $usrrow['fname'] : $usrrow['username'];

                        echo '<div class="post-card">
                                <div class="post-header">
                                    <div class="post-author">
                                        <img src="https://api.dicebear.com/6.x/initials/png?seed=' . htmlspecialchars($displayName) . '&size=128" alt="Author">
                                        <a href="account.php?username=' . htmlspecialchars($usrrow['username']) . '">' . htmlspecialchars($displayName) . '</a>
                                    </div>
                                    <span class="post-time"><i class="fas fa-clock"></i> ' . $postrow[3] . '</span>
                                </div>
                                <div class="post-content">
                                    ' . nl2br(htmlspecialchars($postrow[0])) . '
                                </div>';
                                
                        if (!empty($postrow[1])) {
                            echo '<div class="post-image">
                                    <img src="uploads/' . htmlspecialchars($postrow[1]) . '" alt="Post image" class="post-img">
                                  </div>';
                        }
                        
                        
                    }
                } else {
                    echo '<div class="no-posts">
                            <i class="fas fa-exclamation-circle"></i>
                            <p>No posts found. Be the first to post something!</p>
                          </div>';
                }
                ?>
            </div>
        </div>
    </main>

    <!-- Filter Modal (Hidden by Default) -->
    <div class="filter-modal" id="filterModal">
        <div class="filter-content">
            <div class="filter-header">
                <h3>Filter Posts</h3>
                <span class="close-filter">&times;</span>
            </div>
            <div class="filter-body">
                <div class="filter-section">
                    <h4>Post Type</h4>
                    <div class="checkbox-group">
                        <label><input type="checkbox" checked> All</label>
                        <label><input type="checkbox"> With Images</label>
                        <label><input type="checkbox"> Text Only</label>
                    </div>
                </div>
                <div class="filter-section">
                    <h4>Date Range</h4>
                    <div class="date-inputs">
                        <div class="date-field">
                            <label>From</label>
                            <input type="date" name="from_date">
                        </div>
                        <div class="date-field">
                            <label>To</label>
                            <input type="date" name="to_date">
                        </div>
                    </div>
                </div>
                <div class="filter-section">
                    <h4>Users</h4>
                    <div class="checkbox-group">
                        <label><input type="checkbox" checked> All Users</label>
                        <label><input type="checkbox"> Following Only</label>
                    </div>
                </div>
            </div>
            <div class="filter-footer">
                <button class="reset-btn">Reset</button>
                <button class="apply-btn">Apply Filters</button>
            </div>
        </div>
    </div>

    <!-- Lightbox for Enlarged Images -->
    <div id="lightbox-overlay" class="lightbox-overlay">
        <img id="lightbox-image" class="enlarged-photo" src="" alt="Enlarged Photo">
    </div>

   <script src="script.js"></script>
</body>
</html>