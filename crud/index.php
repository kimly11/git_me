<?php
$cnn = mysqli_connect("localhost", "root", "", "tblstudent");
if (!$cnn) {
    die("Connection failed: " . mysqli_connect_error());
}

function fetchAllStudents($cnn, $search_term = "") {
    $query = "SELECT * FROM tblstudent";
    if ($search_term != "") {
        $query .= " WHERE std_name LIKE '%$search_term%' OR std_email LIKE '%$search_term%' OR std_add LIKE '%$search_term%'";
    }
    return mysqli_query($cnn, $query);
}

if (isset($_POST['btn-insert'])) {
    insertStudent($cnn);
} elseif (isset($_POST['btn-update'])) {
    updateStudent($cnn);
}

function insertStudent($cnn) {
    $studentname = $_POST['txt-studentname'];
    $studentemail = $_POST['txt-studentemail'];
    $address = $_POST['txt-address'];
    $img = $_FILES['img-file']['name'];
    $tmpName = $_FILES['img-file']['tmp_name'];
    $newfilename = uniqid() . "_" . $img;

    // Check if the uploads directory exists
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }

    if (move_uploaded_file($tmpName, 'uploads/' . $newfilename)) {
        $insert_query = "INSERT INTO tblstudent(std_name, std_email, std_add, img) VALUES('$studentname', '$studentemail', '$address', '$newfilename')";
        if (mysqli_query($cnn, $insert_query)) {
            echo '<script>alert("Data Inserted!");</script>';
        } else {
            echo '<script>alert("Error: ' . mysqli_error($cnn) . '");</script>';
        }
    } else {
        echo '<script>alert("File upload failed.");</script>';
    }
}

function updateStudent($cnn) {
    $id = $_POST['studentid'];
    $studentname = $_POST['txt-studentname'];
    $studentemail = $_POST['txt-studentemail'];
    $address = $_POST['txt-address'];

    $img = $_FILES['img-file']['name'];
    $tmpName = $_FILES['img-file']['tmp_name'];
    $newfilename = uniqid() . "_" . $img;

    // Check if the uploads directory exists
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }

    if (move_uploaded_file($tmpName, 'uploads/' . $newfilename)) {
        $update_query = "UPDATE tblstudent SET std_name='$studentname', std_email='$studentemail', std_add='$address', img='$newfilename' WHERE id='$id'";
        if (mysqli_query($cnn, $update_query)) {
            echo '<script>alert("Data Updated!");</script>';
        } else {
            echo '<script>alert("Error: ' . mysqli_error($cnn) . '");</script>';
        }
    } else {
        echo '<script>alert("File upload failed.");</script>';
    }
}

if (isset($_POST['btn-delete'])) {
    deleteStudent($cnn);
}

function deleteStudent($cnn) {
    $id = $_POST['studentid'];
    $delete_query = "DELETE FROM tblstudent WHERE id='$id'";
    if (mysqli_query($cnn, $delete_query)) {
        echo '<script>alert("Data Deleted!");</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($cnn) . '");</script>';
    }
}

$search_term = "";
if (isset($_POST['btn-search']) && !empty($_POST['search'])) {
    $search_term = mysqli_real_escape_string($cnn, $_POST['search']);
}
$students = fetchAllStudents($cnn, $search_term);

// Handling edit request
$editStudent = [];
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $edit_query = "SELECT * FROM tblstudent WHERE id='$edit_id'";
    $edit_result = mysqli_query($cnn, $edit_query);
    if ($edit_result && mysqli_num_rows($edit_result) > 0) {
        $editStudent = mysqli_fetch_assoc($edit_result);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <title>User</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <h1><?php echo isset($editStudent['id']) ? "Edit Student" : "Insert Student"; ?></h1>
        <input type="hidden" name="studentid" value="<?php echo isset($editStudent['id']) ? $editStudent['id'] : ''; ?>">
        <label>Student Name:</label>
        <input type="text" name="txt-studentname" placeholder="Enter Name" value="<?php echo isset($editStudent['std_name']) ? $editStudent['std_name'] : ''; ?>" required><br><br>
        <label>Student Email:</label>
        <input type="email" name="txt-studentemail" placeholder="Enter Email" value="<?php echo isset($editStudent['std_email']) ? $editStudent['std_email'] : ''; ?>" required><br><br>
        <label>Student Address:</label>
        <input type="text" name="txt-address" placeholder="Enter Address" value="<?php echo isset($editStudent['std_add']) ? $editStudent['std_add'] : ''; ?>" required><br><br>
        <label>Choose Image:</label>
        <input type="file" name="img-file"><br><br>
        <input type="submit" name="<?php echo isset($editStudent['id']) ? 'btn-update' : 'btn-insert'; ?>" value="<?php echo isset($editStudent['id']) ? 'Update' : 'Insert'; ?>">
        <input type="reset" name="btn-clear" value="Clear">
    </form>
    <hr>
    <form method="post">
        <label>Search Student:</label>
        <input type="text" name="search" placeholder="Enter search term">
        <input type="submit" name="btn-search" value="Search">
    </form>
    <h3>Student Information</h3>
    <table style="width:80%">
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Student Email</th>
            <th>Address</th>
            <th>Image</th>
            <th colspan="2">Actions</th>
        </tr>
        <?php
        if ($students && mysqli_num_rows($students) > 0) {
            $i = 1;
            while ($row = mysqli_fetch_assoc($students)) {
                $id = $row['id'];
        ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($row['std_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['std_email']); ?></td>
                    <td><?php echo htmlspecialchars($row['std_add']); ?></td>
                    <td><img src="uploads/<?php echo htmlspecialchars($row['img']); ?>" alt="Student Image" width="100"></td>
                    <td>
                        <a href="index.php?edit_id=<?php echo $id; ?>">Edit</a>
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="studentid" value="<?php echo $id; ?>">
                            <button type="submit" name="btn-delete" onclick="return confirm('Are you sure to delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='7'>No records found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>