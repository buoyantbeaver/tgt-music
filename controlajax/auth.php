<?php
if (!$ss->Check() || !isset($_SESSION["username"]) || !$_SESSION["username"])
{
?>
<script>
alert("Bạn vui lòng đăng nhập lại");
parent.location='../login.php';
</script>
<?php
}
?>