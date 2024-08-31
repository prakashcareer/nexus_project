<?php
include 'includes/header.php';
require_once '../classes/Database.php';
require_once '../classes/User.php';

if (!isset($_SESSION['user_id'])) {
    echo "Please log in first.";
    exit;
}

// Fetch user details
$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$query = "SELECT * FROM students WHERE id = :user_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$feedbacks = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="main-content">
    <section class="section">
        <ul class="breadcrumb breadcrumb-style">
            <li class="breadcrumb-item">
                <h4 class="page-title m-b-0">Add Feedback</h4>
            </li>
            <li class="breadcrumb-item">
                <a href="dashboard.php"><i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Add Feedback</li>
        </ul>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form class="needs-validation" novalidate="" id="Feedbackform" method="post">
                            <div class="card-header">
                                <h4>Add Feedback</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Student Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" required="" name="name" value="<?php echo $feedbacks['name']; ?>" readonly>
                                        <div class="error_name text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Course Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" required="" name="course" value="<?php echo $feedbacks['course_name']; ?>" readonly>
                                        <div class="error_course text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Semester</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" required="" name="semester" value="<?php echo $feedbacks['semester']; ?>" readonly>
                                        <div class="error_semester text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="date" value="<?php echo date('Y-m-d'); ?>" readonly>
                                        <div class="error_date text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Feedback</label>
                                    <div class="col-sm-9">
                                        <textarea name="feedback" class="form-control" required></textarea>
                                        <div class="error_feedback text-danger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-primary" type="submit">Submit Feedback</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include 'includes/footer.php'; ?>
