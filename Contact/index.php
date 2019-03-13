<?php
/* ========================= Get initial information from parameters ============ */
$index = @$_GET['index'];

// option 1:list, 2:add, 3:edit, 4:delete, 5:search
$option = isset($_GET['option']) ? $option = $_GET['option'] : 1;

/* ========================= Get contacts from the file ========================= */
define('FILE_NAME', 'contact.txt');
$create = null;
$read = null;

// Check whether the file exists or not
if (!file_exists(FILE_NAME)) {
    $create = fopen(FILE_NAME, "w") or die('Cannot open the file.');
} else {
    $read = fopen(FILE_NAME, "r+") or die('Cannot open the file.');
}

$contactData = filesize(FILE_NAME) ? fread($read, filesize(FILE_NAME)) : null;
$list = explode("\n", trim($contactData));

// get index of item in file array
$line = isset($index) ? $list[$index] : null;
$data = explode(",", trim($line));

$ctitle = isset($data[0]) ? $data[0] : null;
$fname = isset($data[1]) ? $data[1] : null;
$lname = isset($data[2]) ? $data[2] : null;
$email = isset($data[3]) ? $data[3] : null;
$site = isset($data[4]) ? $data[4] : null;
$cellNo = isset($data[5]) ? $data[5] : null;
$homeNo = isset($data[6]) ? $data[6] : null;
$officeNo = isset($data[7]) ? $data[7] : null;
$twitter = isset($data[8]) ? $data[8] : null;
$facebook = isset($data[9]) ? $data[9] : null;
$picture = isset($data[10]) && file_exists("img/" . $data[10]) ? $data[10] : null;
$oldPicture = isset($data[11]) && file_exists("img/" . $data[11]) ? $data[11] : null;
$comment = isset($data[12]) ? $data[12] : null;

$titleErr = $fnameErr = $lnameErr = $cellNoErr = $homeNoErr = $officeNoErr = $pictureErr = null;

/* ========================= Add or Edit submission ============================== */
if (isset($_POST['add']) || isset($_POST['edit'])) {
    $ctitle = preg_replace("/,|\s+/", "", $_POST['ctitle']);
    $fname = preg_replace("/,|\s+/", "", $_POST['fname']);
    $lname = preg_replace("/,|\s+/", "", $_POST['lname']);
    $email = preg_replace("/,/", "", $_POST['email']);
    $site = preg_replace("/,/", "", $_POST['site']);
    $cellNo = preg_replace("/,/", "", $_POST['cellNo']);
    $homeNo = preg_replace("/,/", "", $_POST['homeNo']);
    $officeNo = preg_replace("/,/", "", $_POST['officeNo']);
    $twitter = preg_replace("/,/", "", $_POST['twitter']);
    $facebook = preg_replace("/,/", "", $_POST['facebook']);
    $comment = commentLine($_POST['comment']);

    // Validation check
    if (emptyCheck($ctitle, $fname, $lname) && numberCheck($cellNo, $homeNo, $officeNo)) {
        // Picture
        $imgFile = explode(",", trim(pictureUpload($_FILES["picture"], $_POST['oldPicture'])));
        $picture = isset($imgFile[0]) ? $imgFile[0] : null;
        $oldPicture = isset($imgFile[1]) ? $imgFile[1] : null;
        $pictureCheck = isset($imgFile[2]) ? $imgFile[2] : null;

        // Make a new line for modify
        $newLine = $ctitle . "," . $fname . "," . $lname . "," . $email . "," . $site . "," . $cellNo . "," . $homeNo . "," . $officeNo . "," . $twitter . "," . $facebook . "," . $picture . "," . $oldPicture . "," . $comment;

        // Add or Modify a contact information
        if (isset($_POST['add']) && $pictureCheck == 1) {
            add($newLine);
        } else if (isset($_POST['edit']) && $pictureCheck == 1) {
            edit($line, $newLine);
        }
    }
}

// Modify comments
function commentLine($comment)
{
    $comment = preg_replace("/\n|,/", "", $comment);
    return $comment;
}

// Upload a picture
function pictureUpload($fileInfo, $oldPicture)
{
    global $pictureErr;
    $fileName = $_FILES["picture"]["name"];
    $value = 1;
    $location = "img/" . basename($fileName);
    $uploadFile = $_FILES["picture"]["tmp_name"];

    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    if ($fileName) {
        // Picture validation check
        if (($fileType != "png" && $fileType != "jpg" && $fileType != "jpeg")) {
            $pictureErr = "Only png, jpg and jepg files are allowed.";
            $fileName = $oldPicture;
            $value = 0;
        } elseif (file_exists("img/" . $fileName)) {
            $pictureErr = "The picture name already exists.";
            $fileName = $oldPicture;
            $value = 0;
        } else {
            // Upload successful
            if (file_exists('img/'.$oldPicture)) {
                @unlink('img/'.$oldPicture);
            }
            move_uploaded_file($uploadFile, $location);
            $oldPicture = $fileName;
        }
    } else {
        $fileName = $oldPicture;
    }

    return $fileName . "," . $oldPicture . "," . $value;
}

/* ========================= Check input values ================================= */
// Number check
function numberCheck($cellNo, $homeNo, $officeNo)
{
    global $cellNoErr, $homeNoErr, $officeNoErr;
    if ($cellNo && (!is_numeric($cellNo) || strlen($cellNo) < 10)) {
        $cellNoErr = "Enter 10 digits number only.";
        return 0;
    } elseif ($homeNo && (!is_numeric($homeNo) || strlen($homeNo) < 10)) {
        $homeNoErr = "Enter 10 digits number only.";
        return 0;
    } elseif ($officeNo && (!is_numeric($officeNo) || strlen($officeNo) < 10)) {
        $officeNoErr = "Enter 10 digits number only.";
        return 0;
    } else {
        return 1;
    }
}

// Mandatory filed check
function emptyCheck($ctitle, $fname, $lname)
{
    global $titleErr, $fnameErr, $lnameErr;
    if (empty($ctitle)) {
        $titleErr = "Title is required.";
        return 0;
    } else if (empty($fname)) {
        $fnameErr = "First Name is required.";
        return 0;
    } else if (empty($lname)) {
        $lnameErr = "Last Name is required.";
        return 0;
    } else {
        return 1;
    }
}

/* ========================= Add a contact ======================================= */
function add($newLine)
{
    file_put_contents(FILE_NAME, $newLine . PHP_EOL, FILE_APPEND);
    header("Location: index.php");
}

/* ========================= Edit a contact ===================================== */
function edit($line, $newLine)
{
    rewriteInfo($line);
    file_put_contents(FILE_NAME, $newLine . PHP_EOL, FILE_APPEND);
    header("Location: index.php");

}

/* ========================= Delete a contact =================================== */
if ($option == 4) {
    global $picture;
    if (file_exists("img/" . $fileName)) {
        @unlink('img/' . $picture);
    }
    rewriteInfo($line);
    header("Location: index.php");
}

/* ========================= Rewrite a file ===================================== */
function rewriteInfo($line)
{
    // get all file elements
    $fileData = file(FILE_NAME);
    // open a file
    $modify = fopen(FILE_NAME, "w") or die('Cannot open the file');

    // rewrite file with an updated value
    foreach ($fileData as $value) {
        $value = trim($value);
        if (trim($line) != $value) {
            file_put_contents(FILE_NAME, $value . PHP_EOL, FILE_APPEND);
        }
    }
    fclose($modify);
}

/* ========================= Search contact information ========================= */
if (isset($_POST['search'])) {
    global $searchErr;
    $searchName = trim($_POST['searchName']);

    if ($searchName) {
        for ($x = 0; $x < sizeof($list); $x++) {
            $data = explode(",", $list[$x]);
            $fname = isset($data[1]) ? $data[1] : null;
            $lname = isset($data[2]) ? $data[2] : null;

            if (strcasecmp($searchName, $fname) == 0 || strcasecmp($searchName, $lname) == 0) {
                $returnValue = 1;
                header("Location: index.php?option=5&index=$x");
                break;
            } else {
                $returnValue = 0;
            }
        }
    }
}

/* ========================= Menu bar =========================================== */
// find the active page
function is_active($page, $current_link)
{
    return $page == $current_link ? 'active' : '';
}

/* ========================= File close ========================================= */
if ($create) {
    fclose($create);
} elseif ($read) {
    fclose($read);
}

?>

<!-------------------------- Delete confirmation message -------------------------->
<script>
    function deleteConfirm() {
        var result = confirm("Delete this contact?");
        return result;
    }
</script>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <title><?php if ($option == 1) echo "Contact list";
        elseif ($option == 2) echo "Add a contact";
        elseif ($option == 3) echo "Edit a contact";
        elseif ($option == 5) echo "Search a contact"; ?></title>
</head>

<body>
<div class="container">
    <!-- Header -->
    <header class="masthead">
        <br>
        <nav class="navbar navbar-expand-md navbar-light bg-light rounded mb-3">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav text-md-center nav-justified w-100">
                    <li class="nav-item <?php echo is_active($option, '1'); ?>">
                        <a class="nav-link" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item <?php echo is_active($option, '2'); ?>">
                        <a class='nav-link' href='?option=2'>ADD</a>
                    </li>
                    <li class="nav-item <?php echo is_active($option, '5'); ?>">
                        <a class="nav-link" href="?option=5">SEARCH</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Body -->
    <main role="main">
        <?php
        if ($option == 1) {
            if ($contactData) {
                include 'contactList.php';
            } else {
                echo "<div><h3>No contact information.</h3></div>";
            }

        } elseif ($option == 2 || $option == 3) {
            include 'contactForm.php';
        } elseif ($option == 5) {
            include 'contactSearch.php';
        }
        ?>
    </main>

    <!-- Footer -->
    <br>
    <footer class="footer">
        <a href="vs.php?s=<?php echo __FILE__ ?>" target="_blank" class='btn btn-info'><?php echo basename(__FILE__) ?>
            Source</a>
    </footer>
    <br>
</div> <!-- /container -->

<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
        crossorigin="anonymous"></script>
</body>
</html>
