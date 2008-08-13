<?php
require_once(dirname(__FILE__) . '/PHPProxy.class.php');

$url = $_REQUEST[URL_PARAM_NAME];
if ($url == ''):
?>
<html>
<head>
	<title>PHP Proxy</title>
	
</head>

<body>

<h1>Proxy</h1>

<form method="post" action="index.php">
<input type="hidden" name="action" value="new" />

<table>
	<tr>
		<td><label for="url">URL</label></td>
		<td><input id="url" name="<?= URL_PARAM_NAME ?>" size="100" /></td>
	</tr>
	<tr>
		<td colspan="2" align="right">
			<input type="submit" value="Go" />
		</td>
	</tr>
</table>

</form>

</body>
</html>
<?php
else:
	$decoded = base64_decode($url);
	if ($decoded === FALSE) {
		$url = base64_encode($url);
	}
	
	if ($_REQUEST['action'] == 'new') {
		header('Location: ' . INDEX_FILE_NAME . '?' . URL_PARAM_NAME . '=' . base64_encode($url));
		die();
	}
	
	if ($_GET['proxy_password']) {
		$username = base64_decode($_GET['proxy_username']);
		$password = base64_decode($_GET['proxy_password']);
		$proxy = new PHPProxy($url, $username, $password);
	}
	else {
		$proxy = new PHPProxy($url);
	}
	
	$proxy->handleRequest();

endif;
?>