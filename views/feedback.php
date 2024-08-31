<?php
include 'includes/header.php';
require_once '../classes/Database.php';
require_once '../classes/User.php';
if (!isset($_SESSION['user_id'])) {
    echo "Please log in first.";
    exit;
}
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$query = "SELECT * FROM feedback WHERE user_id = :user_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="main-content">
    <section class="section">
        <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
                <h4 class="page-title m-b-0">Manage Feedback</h4>
            </li>
            <li class="breadcrumb-item">
                <a href="dashboard.php"><i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Manage Feedback</li>
        </ul>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manage Feedback</h4>
                            <a style="margin-left: 80%;" title="Add" data-toggle="tooltip" href="feedback_add.php" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Feedback</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $key = 0;
                                        foreach ($feedbacks as $feedback) {
                                            $key++;
                                        ?>
                                            <tr id="row_<?php echo $feedback['id']; ?>">
                                                <td><?php echo $key; ?></td>
                                                <td><?php echo htmlspecialchars($feedback['feedback']); ?></td>
                                                <td><?php echo date('Y-m-d H:i:s', strtotime($feedback['created_at'])); ?></td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="First group">
                                                        <a class="btn btn-danger" data-toggle="tooltip" title="Remove" href="javascript:void(0)" onclick="deleteFeedback('<?php echo $feedback['id']; ?>');"> <i class="fa fa-trash"></i> </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
function deleteFeedback(feedback_id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then(function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: 'POST',
                url: '../public/delete_feedback.php',
                data: { id: feedback_id },
                success: function(res) {
                    if (res == 'success') {
                        $('#row_' + feedback_id).remove();
                        swal("Feedback Deleted Successfully", { icon: "success", });
                    } else {
                        swal("Error While Performing Operation.", { icon: "error", });
                    }
                }
            });
        }
    });
}
</script>
