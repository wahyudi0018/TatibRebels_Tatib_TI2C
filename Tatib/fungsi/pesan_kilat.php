<?php
function set_flashdata($key = "", $value = "")
{
    if (!empty($key) || empty($value)) {
        $_SESSION['_flashdata'][$key] = $value;
        return true;
    }
    return false;
}

function get_flashdata($key = "")
{
    if (!empty($key) && isset($_SESSION['_flashdata'][$key])) {
        $data = $_SESSION['_flashdata'][$key];
        unset($_SESSION['_flashdata'][$key]);
        return $data;
    } else {
        echo "<script>alert(' Flash Message \'{$key}\' is not defined.')</script>";
    }
}

function pesan($key = "", $pesan = "")
{
    if ($key == "success") {
        set_flashdata("success", "<div class='success-pesan' role='alert'>  {$pesan}
        </div>");
    } elseif ($key == "danger") {
        set_flashdata("danger", "<div class='banner-pesan' role='alert'>  {$pesan}
        </div>");
    } elseif ($key == "password") {
        set_flashdata("password", "<div class='password-pesan' role='alert'> {$pesan}
        </div>");
    } elseif ($key == "username") {
        set_flashdata("username", "<div class='username-pesan' role='alert'> {$pesan}
        </div>");
    }
}
?>