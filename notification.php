<?php
if (!defined('YBASE')) exit ('Now Allowed');
if (isset($_GET["msg"])) {
	if ($_GET['msg'] == 'error') {
    	$message = 'Failed .. ';
	} else {
		$message = 'Succesfully..';
	}
    $msg = $_GET["msg"];
    ?>
    <script type="text/javascript">
    showNotification({
    message: "<?php echo $message; ?>",
    type: "<?php echo $msg; ?>",
    autoClose: true,
    duration: 4
    });
    </script>
    <?php
}
    ?>