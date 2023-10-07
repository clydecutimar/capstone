<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>scholarIN - Scholarship Portal</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Bootslander
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style>
   .truncate-text {
      max-height: 100px;
      overflow: hidden;
    }
    .full-text {
      display: none;
    }
    table.custom-table {
      border: 1px solid #ccc; /* Adjust the color as needed */
    }
    table.custom-table th {
      background-color: #f5f5f5; /* Adjust the background color as needed */
      text-align: center; /* Center-align the text within header cells */
      border-top: 1px solid white; /* Horizontal border */
      border-left: 1px solid #ccc; /* Vertical border */
    }
    table.custom-table td {
      border-top: 1px solid #ccc; /* Horizontal border */
      border-left: 1px solid #ccc; /* Vertical border */
    }
    /* Custom style for the search input */
    .custom-search-input {
      width: 350px; /* Adjust the width as needed */
    }
  </style>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="main.php"><span>scholarIN</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">Search</a></li>
          <li><a class="nav-link scrollto" href="index.php">Sign In</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">

    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
          <div data-aos="zoom-out">
            <h1>Scholarship Search Made Easy With <span>scholarIN</span></h1>
            <h2>Simplify your scholarship search in Caraga, making it easier for you to find the financial support you need for your education.</h2>
            <div class="text-center text-lg-start">
              <a href="#about" class="btn-get-started scrollto">Get Started</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
          <img src="assets/img/studying.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section><!-- End Hero -->

  <?php
// Function to truncate text to 300 characters
function truncateText($text, $limit = 300) {
    if (strlen($text) <= $limit) {
        return $text;
    } else {
        $shortened_text = substr($text, 0, $limit);
        return $shortened_text;
    }
}

// Initialize searchQuery
$searchQuery = '';

// Database connection 
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "test_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Calculate the total number of scholarships posted
$sqlCountScholarships = "SELECT COUNT(*) AS totalScholarships FROM scholarship";
$resultCountScholarships = $conn->query($sqlCountScholarships);
$rowCountScholarships = $resultCountScholarships->fetch_assoc();
$numScholarships = $rowCountScholarships['totalScholarships'];

// Calculate the total number of scholarship providers
$sqlCountProviders = "SELECT COUNT(*) AS totalProviders FROM users";
$resultCountProviders = $conn->query($sqlCountProviders);
$rowCountProviders = $resultCountProviders->fetch_assoc();
$numUsers = $rowCountProviders['totalProviders'];

// Number of scholarships per page
$scholarshipsPerPage = 10;

// Check if search query is provided
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $searchCondition = "WHERE 
        name LIKE '%$searchQuery%' OR 
        scholarship_name LIKE '%$searchQuery%' OR 
        prioritize_course LIKE '%$searchQuery%' OR 
        benefits LIKE '%$searchQuery%' OR 
        qualifications_requirements LIKE '%$searchQuery%' OR 
        application_process LIKE '%$searchQuery%' OR 
        file_attachment LIKE '%$searchQuery%'";
} else {
    $searchCondition = '';
}

// Calculate the total number of scholarships based on the search condition
$sqlCount = "SELECT COUNT(*) AS total FROM scholarship $searchCondition";
$resultCount = $conn->query($sqlCount);
$rowCount = $resultCount->fetch_assoc();
$totalScholarships = $rowCount['total'];

// Calculate the total number of pages
$totalPages = ceil($totalScholarships / $scholarshipsPerPage);

// Get the current page number from the query parameter
if (isset($_GET['page'])) {
    $currentPage = max(1, min($totalPages, intval($_GET['page'])));
} else {
    $currentPage = 1;
}

// Calculate the starting scholarship index for the current page
$startIndex = ($currentPage - 1) * $scholarshipsPerPage;

// Modify your SQL query to retrieve scholarships for the current page
$sql = "SELECT name, scholarship_name, prioritize_course, benefits, qualifications_requirements, application_process, file_attachment FROM scholarship $searchCondition LIMIT $startIndex, $scholarshipsPerPage";

$result = $conn->query($sql);
?>


<div class="container mt-5">

      <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <section id="counts" class="counts">
      <div class="container">
  <div class="row justify-content-center" data-aos="fade-up">
    <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
      <div class="count-box">
        <i class="bi bi-journal-richtext"></i>
        <span data-purecounter-start="0" data-purecounter-end="<?php echo $numScholarships; ?>" data-purecounter-duration="1" class="purecounter"></span>
        <p>Scholarships</p>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
      <div class="count-box">
        <i class="bi bi-people"></i>
        <span data-purecounter-start="0" data-purecounter-end="<?php echo $numUsers; ?>" data-purecounter-duration="1" class="purecounter"></span>
        <p>Providers</p>
      </div>
    </div>
  </div>
</div> <br><br>

  <div class="form-group">
    <form class="form-inline">
      <div class="row">
        <div class="col-auto">
          <input class="form-control custom-search-input" type="text" placeholder="Search scholarships..." name="search" value="<?php echo $searchQuery; ?>">
        </div>
        <div class="col-auto">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </div>
        <div class="col-auto">
          <button class="btn btn-outline-secondary my-2 my-sm-0" type="button" onclick="window.location.href='?';">Refresh</button>
        </div>
      </div>
    </form>
  </div>

  <?php if ($totalScholarships > 0) { ?>
    <div class="table-responsive mt-4">
      <table class="table custom-table table-striped">
        <thead>
          <tr>
            <th class="bg-secondary text-white">Provider</th> 
            <th class="bg-secondary text-white">Name</th>
            <th class="bg-secondary text-white">Prioritize Course</th>
            <th class="bg-secondary text-white">Benefits</th>
            <th class="bg-secondary text-white">Qualifications & Requirements</th>
            <th class="bg-secondary text-white">Application Process</th>
            <th class="bg-secondary text-white">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $row["name"]; ?></td>
              <td><?php echo $row["scholarship_name"]; ?></td>
              <td><?php echo $row["prioritize_course"]; ?></td>
              <td><?php echo $row["benefits"]; ?></td>
              <td>
                <div class="text-content">
                  <div class="truncate-text">
                    <?php echo truncateText($row["qualifications_requirements"]); ?>
                  </div>
                  <div class="full-text">
                    <?php echo $row["qualifications_requirements"]; ?>
                  </div>
                </div>
                <?php if (strlen($row["qualifications_requirements"]) > 300) { ?>
                  <a href="#" class="toggle-text">Read More</a>
                <?php } ?>
              </td>
              <td>
                <div class="text-content">
                  <div class="truncate-text">
                    <?php echo truncateText($row["application_process"]); ?>
                  </div>
                  <div class="full-text">
                    <?php echo $row["application_process"]; ?>
                  </div>
                </div>
                <?php if (strlen($row["application_process"]) > 300) { ?>
                  <a href="#" class="toggle-text">Read More</a>
                <?php } ?>
              </td>
              <td>
                <button class="btn btn-primary file-details-button" data-file-url="<?php echo $row["file_attachment"]; ?>">Details</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="text-center mt-3">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $searchQuery; ?>"><?php echo $i; ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
    
  <?php } else { ?>
    <div class="alert alert-info mt-5">
      No records found.
    </div>
  <?php } ?>
</div>           


      </section><!-- End Counts Section -->
    </section><!-- End About Section -->



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        <strong><span>scholarIN</span></strong>. 2023
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
  const toggleTextLinks = document.querySelectorAll('.toggle-text');

  toggleTextLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const textContent = this.parentElement.querySelector('.text-content');
      const truncateText = textContent.querySelector('.truncate-text');
      const fullText = textContent.querySelector('.full-text');
      
      if (truncateText.style.display === 'none') {
        truncateText.style.display = 'block';
        fullText.style.display = 'none';
        this.textContent = 'Read More';
      } else {
        truncateText.style.display = 'none';
        fullText.style.display = 'block';
        this.textContent = 'Less View';
      }
    });
  });

  const fileDetailsButtons = document.querySelectorAll('.file-details-button');

  fileDetailsButtons.forEach(button => {
    button.addEventListener('click', function () {
      const fileUrl = this.getAttribute('data-file-url');
      window.open(fileUrl, '_blank'); // Open the file in a new tab or window
    });
  });
</script>


</body>

</html>