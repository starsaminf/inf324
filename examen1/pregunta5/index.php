<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include "./includes/head.inc.php";
include "./includes/isLogin.php";
include "./includes/isDirector.php";
?>

<body>
    <div class="event-schedule-area-two bg-color pad100">
        <div class="container">
            <?php
            include "./includes/title.inc.php";
            ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="home" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Departamento</th>
                                            <th scope="col">Nota</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($_SESSION['notasRow'] as $key => $value) {
                                            echo "<tr class='inner-box'>
                                            <td scope='ro'>
                                                <div class='event-wrap'>
                                                    $key
                                                </div>
                                            </td>
                                            <td>
                                                <div class='inner-boc'>
                                                    $value
                                                </div>
                                            </td>
                                        </tr>";
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?
    include "./includes/head.inc.php";
    ?>
</body>

</html>