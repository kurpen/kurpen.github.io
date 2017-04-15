<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>

<table>
	<tr>
		<td><label for="nazwa">Nazwa</label></td>
		<td><input type="input" name="nazwa" /><br /></td>
	</tr>
	<tr>
		<td><label for="opis">Opis</label></td>
		<td><textarea name="opis"></textarea><br /></td>
	</tr>
	<tr>
		<td><label for="adres1">Adres linia 1</label></td>
		<td><input type="input" name="adres1" /><br /></td>
	</tr>
	<tr>
		<td><label for="adres2">Adres linia 2</label></td>
		<td><input type="input" name="adres2" /><br /></td>
	</tr>
	<tr>
		<td><label for="kod_pocztowy">Kod pocztowy</label></td>
		<td><input type="input" name="kod_pocztowy" /><br /></td>
	</tr>
	<tr>
		<td><label for="miasto">Miasto</label></td>
		<td><input type="miasto" name="miasto" /><br /></td>
	<tr>
	<tr>
		<td><label for="miasto">Zdjęcie</label></td>
		<td><input type="file" name="userfile" size="1000"/><br /></td>
	<tr>
	<tr>
		<td colspan="2" style="text-align:center;"><input type="submit" name="submit" value="Dodaj lokal" /></td>
	</tr>
</table>
</form>


</body>
</html>