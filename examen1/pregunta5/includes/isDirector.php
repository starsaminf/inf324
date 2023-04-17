<?php
function isDirector() {
    if (empty($_SESSION['rol'])) {
        return false;
    }
    return $_SESSION['rol'] == 'DIRECTOR';
}