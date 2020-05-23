<?php require("header.php");
if (isset($_SESSION["user_id"])) {
    if ($_SESSION["user_id"] == "admin") {
?>
        <h5 class="mt-3 mb-2 text-center">Student List View</h5>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td>Reg No</td>
                    <td>Name</td>
                    <td>Email ID</td>
                    <td>DOB</td>
                    <td>Contact #</td>
                </tr>
            </thead>
            <tbody>

                <?php
                require('../controller/db.con.php');
                $sql = "SELECT * FROM `registration`";
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><a href="./students.php?user_id=<?php echo $row['user_id'] ?>"><?php echo $row['registration_no'] ?></a></td>
                            <td><?php echo $row['user_name'] ?></td>
                            <td><?php echo $row['user_email_address'] ?></td>
                            <td><?php echo $row['dob'] ?></td>
                            <td><?php echo $row['user_contact_no'] ?></td>
                        </tr>
                <?php }
                }
                ?>
            </tbody>
        </table>
<?php
    } else {
        header("LOCATION: ./home.php");
    }
} else {
    header("LOCATION: ../admin_login.php");
}
require("footer.php"); ?>
<?php if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $sql = "SELECT * FROM `result` WHERE `user_id`=$user_id";
    $result = mysqli_query($connection, $sql);
    $dataPoints = array();
    $index = 1;
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $temp = array();
            $temp['x'] = $index;
            $temp['y'] = $row['user_result'];
            $index++;
            //$temp = array("x" => $line['exam_date'], "y" => $line['user_result']);
            array_push($dataPoints, $temp);
        }
    } ?>
    <script>
        setTimeout(function() {
            $('#myModal').modal('show');
        }, 500)
    </script>
<?php
} ?>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- <h4 class="modal-title"></h4> -->
            </div>
            <div class="modal-body">
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="../app-assets/js/chart.js"></script>
<script>
    window.onload = function() {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Student Progress"
            },
            data: [{
                type: "column", //change type to bar, line, area, pie, etc
                //indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
</script>