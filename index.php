<?
include './dbconnect/config.php';
include './dbconnect/opendb.php';

if(isset($_GET['list_name']) && $_GET['list_name'] != ''  && !isset($_GET['user']) && !isset($_GET['item_name']))
{
	$list_name = $_GET['list_name'];
	?>
	Please enter your name.
	<form action="index.php" method="GET">
	<table>
		<input type="hidden" name="list_name" value="<?=$list_name;?>">
		<tr>
			<td>My Name</td>
			<td><input type="text" name="user"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Go"></td>
		</tr>
	</table>	
	</form>
	<?
}
else if(isset($_GET['list_name']) && $_GET['list_name'] != '' && isset($_GET['user']) && $_GET['user'] != '' && !isset($_GET['item_name']))
{
	?>
	<table>
	<?
	$list_name = urldecode($_GET['list_name']);
	$user = urldecode($_GET['user']);
	
	$query = "SELECT * FROM listpicker_list WHERE list_name = '$list_name'";
	$result = mysql_query($query) or die('Error, query failed. ' . mysql_error() . $query);
	while($row = mysql_fetch_array($result)) 
	{
		$list_id = $row['list_id'];
	}
	
	$query = "SELECT * FROM listpicker_item WHERE list_id = '$list_id'";
	$result = mysql_query($query) or die('Error, query failed. ' . mysql_error() . $query);
	while($row = mysql_fetch_array($result)) 
	{
		$item_name = htmlspecialchars($row['item_name']);
		$claimed_by = htmlspecialchars($row['claimed_by']);
		if($claimed_by == '') {
		?>
		<tr><td><?=$item_name;?> <a href="http://mywebsite.com/listpicker/index.php?list_name=<?=urlencode($list_name);?>&item_name=<?=urlencode($item_name);?>&user=<?=urlencode($user);?>">choose it</a></td></tr>
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
else if(isset($_GET['list_name']) && $_GET['list_name'] != '' && isset($_GET['user']) && $_GET['user'] != '' && isset($_GET['item_name']) && $_GET['item_name'] != '')
{
	$list_name = urldecode($_GET['list_name']);
	$item_name = urldecode($_GET['item_name']);
	$user = urldecode($_GET['user']);
	
	$query = "SELECT * FROM listpicker_list WHERE list_name = '$list_name'";
	$result = mysql_query($query) or die('Error, query failed. ' . mysql_error() . $query);
	while($row = mysql_fetch_array($result)) 
	{
		$list_id = $row['list_id'];
	}
	
	$query = "UPDATE listpicker_item SET claimed_by = '' WHERE claimed_by = '$user' AND list_id = '$list_id'";
	$result = mysql_query($query) or die('Error, query failed. ' . mysql_error() . $query);
	
	$query = "UPDATE listpicker_item SET claimed_by = '$user' WHERE item_name = '$item_name' AND claimed_by = '' AND list_id = '$list_id'";
	$result = mysql_query($query) or die('Error, query failed. ' . mysql_error() . $query);
	header('Location: http://mywebsite.com/listpicker/index.php?list_name='.urlencode($list_name).'&user='.urlencode($user));
}

include './dbconnect/closedb.php';
?>
