<?php
session_start();

// Database configuration
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root";
$password = ""; // No password as per your requirement
$database = "test_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$name = $scholarship_name = $prioritize_course = $benefits = $qualifications_requirements = $application_process = $file_attachment = "";
$delete_id = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete_id"])) {
        // Handle scholarship deletion
        $delete_id = $_POST["delete_id"];

        // Use prepared statements to delete data from the database
        $stmt = $conn->prepare("DELETE FROM scholarship WHERE scholarship_id = ?");
        $stmt->bind_param("i", $delete_id);

        if ($stmt->execute()) {
            echo "<script>alert('Scholarship deleted successfully!');</script>";
        } else {
            echo "Error deleting scholarship: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Handle form submission for inserting scholarship
        $name = $_SESSION['name'];
        $scholarship_name = $_POST["scholarship_name"];
        $prioritize_course = $_POST["prioritize_course"];
        $benefits = $_POST["benefits"];
        $qualifications_requirements = $_POST["qualifications_requirements"];
        $application_process = $_POST["application_process"];

        // Handle file upload
        if ($_FILES["file_attachment"]["error"] == 0) {
        $file_name = $_FILES["file_attachment"]["name"];
        $file_tmp_name = $_FILES["file_attachment"]["tmp_name"];
        $upload_dir = "uploads/"; // Specify the upload directory

        // Move the uploaded file to the "uploads" directory
        if (move_uploaded_file($file_tmp_name, $upload_dir . $file_name)) {
        $file_attachment = $upload_dir . $file_name;
        } else {
        echo "Error moving uploaded file to the uploads directory.";
        }
}



        // Use prepared statements to insert data into the database
        $stmt = $conn->prepare("INSERT INTO scholarship (name, scholarship_name, prioritize_course, benefits, qualifications_requirements, application_process, file_attachment) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $scholarship_name, $prioritize_course, $benefits, $qualifications_requirements, $application_process, $file_attachment);

        if ($stmt->execute()) {
            echo "<script>alert('Scholarship posted successfully!');</script>";
        } else {
            echo "Error posting scholarship: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Retrieve submitted scholarships
$sql = "SELECT scholarship_id, scholarship_name, prioritize_course, benefits, qualifications_requirements, application_process, file_attachment FROM scholarship WHERE name = '" . $_SESSION['name'] . "'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider's Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<style>
    .navbar {
        background-color: #1015A3;
    }
</style>

<body>
    
<nav class="navbar navbar-expand-lg navbar-dark p-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">scholarIN</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto ">
          <li class="nav-item">
            <a class="nav-link mx-2 active" aria-current="page" href="#"><?php echo $_SESSION['name']; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="logout.php">Sign Out</a>
          </li>
        </ul>
      </div>
    </div>
</nav>

<div class="container mt-5">
        <div class="card border-dark">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title text-center">Scholarship Form</h5>
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <input type="hidden" name="name" value="<?php echo $_SESSION['name']; ?>">
                    
                    <div class="form-group">
                        <label for="scholarship_name">Scholarship Name:</label>
                        <input type="text" class="form-control" name="scholarship_name" required>
                    </div>

                    <div class="form-group">
                        <label for="prioritize_course">Prioritize Course:</label>
                        <textarea class="form-control" name="prioritize_course" rows="2" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="benefits">Benefits:</label>
                        <textarea class="form-control" name="benefits" rows="2" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="qualifications_requirements">Qualifications and Requirements:</label>
                        <textarea class="form-control" name="qualifications_requirements" rows="2" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="application_process">Application Process:</label>
                        <textarea class="form-control" name="application_process" rows="2" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="file_attachment">File Attachment (if any):</label>
                        <input type="file" class="form-control-file" name="file_attachment">
                    </div> <br>

                    <div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div> <br>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>