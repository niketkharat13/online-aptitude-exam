<?php require("header.php");
if (isset($_SESSION["user_id"])) {
    if ($_SESSION["user_id"] == "admin") {
?>
        <div class="container mt-3">
            <h4>Graph</h4>
            <div class="row">
                <div class="col">
                   
                    
                </div>
            </div>
        </div>
        <?php require("footer.php");
        ?>
<?php
    }
} else {
    header("LOCATION: ../admin_login.php");
}
?>