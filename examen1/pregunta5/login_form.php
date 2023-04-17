<!DOCTYPE html>
<html lang="en">

<?php
include "./includes/head.inc.php";
?>

<body>
    <div class="event-schedule-area-two bg-color pad100">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content">
                        <fieldset>
                            <legend>Datos del usuario</legend>
                            <form action="login.php" method="POST">
                                Usuario:
                                <input type="text" name="usuario">
                                <br>
                                Password:
                                <input type="password" name="password">
                                <br>
                                <button>Login</button>
                            </form>
                        </fieldset>
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