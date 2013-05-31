<?php

require_once('common.inc.php');
require_once('missing.class.php');

if (empty($_POST['mb_name'])) {
	?>
	<!DOCTYPE html>
	<html>
	<head>
	<meta charset="utf-8" />
	<title>Savnet</title>
	<form method="POST" action="form.php">
	Ditt navn: <input type="text" name="mb_name" autofocus required> <br />
	Din epost: <input type="email" name="mb_mail" required> <br />
	Ditt mobilnr: <input type="tel" pattern="[0-9]{8}" name="mb_mobile" required> <br />
	<br />
	Savnedes navn: <input type="text" name="m_name" required> <br />
	Savnedes mobilnr: <input type="tel" pattern="[0-9]{8}" name="m_mobile" required> <br />
	<br />
	<input type="submit" value="Lagre">
	</form>
	<br />
	<?php

	$missing = new Missing();
	$missings = $missing->getAllActiveMissings();

	echo '<h3>Aktive savnede:</h3>';
	foreach ($missings as $key=>$value) {
		echo '<a href="map.php?id='.$key.'">'.$value.'</a><br />';
	}
	echo '</body></html>';
}

else {
	$missing = new Missing();
	$status = $missing->addMissing($_POST['mb_name'], $_POST['mb_mail'], $_POST['mb_mobile'], $_POST['m_name'], $_POST['m_mobile']);
	if ($status) {
		echo 'Savnet registrert!<br />
			Send denne linken til savnede: http://savnet.ntrkh.no/find.php?id='.$missing->missing_id.'&num='.$_POST['m_mobile'].'<br />
			<a href="map.php?id='.$missing->missing_id.'">G&aring; til kart</a><br /><br /><a href="form.php">Tilbake</a>';
	}
	else
		echo 'En feil oppstod ved registrering.';

}
?>