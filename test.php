<?php

session_start();

require_once('includes/DB.php');
$pdo = DB();
require_once('includes/codes.php');

$errors = [];
if(isset($_POST['login'])) {
    $errors = login($pdo);
} else if (isset($_POST['register'])) {
    $errors = register($pdo);
}

function location($pdo) {
    foreach ($_GET as $key => $value) {
        if($key == "id") {
            $id = $value;
        }
    }

    $location = basename($_SERVER['PHP_SELF']);
    $currentFile = explode('.', $location)[0];

    switch($currentFile) {
        case 'forum':
            $forum_id = $id;
            $forum = query($pdo, "SELECT * FROM forums WHERE id = :id", ['id' => $forum_id])[0];
            $forum_name = $forum['name'];
            $category_id = $forum['category_id'];
            $category = query($pdo, "SELECT * FROM categories WHERE id = :id", ['id' => $category_id])[0];
            $category_name = $category['name'];

            $objectNames = [$category_name, $forum_name];
            $urls = ['index.php', 'forum.php?id='.$forum_id];           
            break;
        case 'topic':
            $topic_id = $id;
            $topic = query($pdo, "SELECT * FROM topics WHERE id = :id", ['id' => $topic_id])[0];
            $topic_title = $topic['title'];
            $forum_id = $topic['forum_id'];
            $forum = query($pdo, "SELECT * FROM forums WHERE id = :id", ['id' => $forum_id])[0];
            $forum_name = $forum['name'];
            $category_id = $forum['category_id'];
            $category = query($pdo, "SELECT * FROM categories WHERE id = :id", ['id' => $category_id])[0];
            $category_name = $category['name'];

            $objectNames = [$category_name, $forum_name, $topic_title];
            $urls = ['index.php', 'forum.php?id='.$forum_id, 'topic.php?id='.$topic_id];
            break;
        default:
            $currentFileCapitalised = ucfirst($currentFile);
            $objectNames = [$currentFileCapitalised];
            $urls = [$location];
            break;
    }

    $return = [$objectNames, $urls];
    return $return;
}

function navbarr($pdo) {
    $location = location($pdo);
    $currentLocation = $location[0];
    $currentLocationFiles = $location[1];
    $locationSteps = count($currentLocation);

    echo '
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            ';

    for($i = 0; $i < $locationSteps; $i++) {
        echo '
            <span class="navbar-text">/</span>
            <li class="nav-item';
        if($i == $locationSteps - 1) {
            echo ' active';
        }
        echo '"><a class="nav-link" href="'.$currentLocationFiles[$i].'">'.$currentLocation[$i].'
                </a>
            </li>
        ';
    }

    echo '</ul>';

    echo '<ul class="navbar-nav ml-auto">';

    // Check if user is logged in
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ) {
        echo '
            <li class="nav-item">
                <a class="nav-link" href="#">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>
        ';
    } else {
        echo '
            <li class="nav-item">
                <a id="navbarLogin" name="login" onclick="togglePortal(\'login\');" class="nav-link" >Login</a>
            </li>
            <li class="nav-item">
                <a id="navbarRegister" name="register" onclick="togglePortal(\'register\');" class="nav-link" >Register</a>
            </li>
            <li class="nav-item">
                <a id="navbarClose" name="closePortal" onclick="togglePortal(\'close\');" class="nav-link" >X</a>
            </li>';
    }

    echo '
            </ul>
        </div>
    </nav>
    ';

}

?>

<!DOCTYPE HTML>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Functional Forum</title>

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="js/scripts.js" type="text/javascript" ></script>
</head>

<body>

<?php 
    navbarr($pdo);
    portal($errors);
?>

</body>
</html>
