<?php
require_once(dirname(__FILE__) . '/PHPProxy.class.php');

if ($_POST['username'] == NULL):
?>
<html>
<head>
<title>Authentication Required</title>
</head>

<body>

<h1>Authentication Required</h1>

<p>Authentication is required before you can access <strong><?= base64_decode($_GET[URL_PARAM_NAME]) ?></strong>.</p>

<p>The realm given is: <strong><?= htmlentities($_REQUEST['realm']) ?></strong></p>

<form method="post" action="basic-auth.php">
<input type="hidden" name="<?= URL_PARAM_NAME ?>" value="<?= $_GET[URL_PARAM_NAME] ?>" />

<fieldset>
	<legend>Login</legend>

	<table>
		<tr>
			<td>Username</td>
			<td><input type="text" name="username" /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password" /></td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<input type="submit" value="Login" />
			</td>
		</tr>
	</table>

</fieldset>

</form>

</body>
</html>
<?
else:

$url = $_POST[URL_PARAM_NAME];
$username = base64_encode($_POST['username']);
$password = base64_encode($_POST['password']);

header('Location: index.php?' . URL_PARAM_NAME . "=$url&proxy_username=$username&proxy_password=$password");

endif;
?>