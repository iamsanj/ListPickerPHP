<?
include './dbconnect/config.php';
include './dbconnect/opendb.php';
	
if(isset($_GET['list_name']) && $_GET['list_name'] != '' && isset($_GET['password']) && $_GET['password'] != '')
{
	$list_name = urldecode($_GET['list_name']);
	$password = urldecode($_GET['password']);
	$hash = md5($room_name.$password);
	
	?>
	Add items to your list.
	<form action="admin.php" method="POST">
	<table>
		<input type="hidden" name="list_name" value="<?=$list_name;?>">
		<input type="hidden" name="password" value="<?=$password;?>">
		<input type="hidden" name="hash" value="<?=$hash;?>">
		<tr>
			<td>Item Name</td>
			<td><input type="text" name="item_name"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Add"></td>
		</tr>
	</table>	
	</form>
	
	<table>
		<tr><td>Existing Items</td></tr>
	<?
	$query = "SELECT * FROM listpicker_list WHERE list_name = '$list_name' AND password = '$password' and hash = '$hash'";
	$result = mysql_query($query) or die('Error, query failed. ' . mysql_error() . $query);
	while($row = mysql_fetch_array($result)) 
	{
		$list_id = $row['list_id'];
	}
	
	$query = "SELECT * FROM listpicker_item WHERE list_id = '$list_id'";
	$result = mysql_query($query) or die('Error, query failed. ' . mysql_error() . $query);
	while($row = mysql_fetch_array($result)) 
	{
		$item_name = htmlspecialchars(stripslashes($row['item_name']));
		$claimed_by = $row['claimed_by'];
		if($claimed_by == '') {
		?>
		<tr><td><?=$item_name;?> still unclaimed</td></tr>
		<?
		} else {
		?>
		<tr><td><?=$item_name;?> chosen by <?=$claimed_by;?></td></tr>
		<?	
		}
	}
	?>
	</table>
	<?
}
else if (isset($_POST['list_name']) && isset($_POST['password']) && isset($_POST['hash']) && isset($_POST['list_name']))
{
	$list_name = urldecode($_POST['list_name']);
	$password = urldecode($_POST['password']);
	$hash = md5($room_name.$password);
	
	$item_name = addslashes(htmlspecialchars($_POST['item_name']));
	$now = time();
	
	$query = "SELECT * FROM listpicker_list WHERE list_name = '$list_name' AND password = '$password' and hash = '$hash'";
	$result = mysql_query($query) or die('Error, query failed. ' . mysql_error() . $query);
	while($row = mysql_fetch_array($result)) 
	{
		$list_id = $row['list_id'];
		
		$query = "INSERT INTO listpicker_item (list_id, item_name, updated, added) VALUES ('$list_id','$item_name','$now','$now')";
		mysql_query($query) or die('Error, query failed. ' . mysql_error() . $query);
		header('Location: http://mywebsite.com/listpicker/admin.php?list_name='.urlencode($list_name).'&password='.urlencode($password));
	}
}
include './dbconnect/closedb.php';
?>