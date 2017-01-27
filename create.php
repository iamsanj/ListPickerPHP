<?
if(isset($_POST['list_name']) && $_POST['list_name'] != '' && isset($_POST['password']) && $_POST['password'] != '')
{
	include './dbconnect/config.php';
	include './dbconnect/opendb.php';
	
	$list_name = addslashes(htmlspecialchars($_POST['list_name']));
	$password = addslashes($_POST['password']);
	$hash = md5($room_name.$password);
	
	$query = "INSERT INTO listpicker_list (list_name, password, hash) VALUES ('$list_name','$password','$hash')";
	mysql_query($query) or die('Error, query failed. ' . mysql_error() . $query);
	
	echo 'Administer your list at <a target="_balnk" href="http://mywebsite.com/listpicker/admin.php?list_name='.urlencode($list_name).'&password='.urlencode($password).'">http://mywebsite.com/listpicker/admin.php?list_name='.urlencode($list_name).'&password='.urlencode($password).'</a><br>';
	echo 'Get users to select their choices at <a target="_balnk" href="http://mywebsite.com/listpicker/?list_name='.urlencode($list_name).'">http://mywebsite.com/listpicker/?list_name='.urlencode($list_name).'</a><br>';
	
	include './dbconnect/closedb.php';
}
else 
{
?>
<form action="create.php" method="POST">
Create a new list. You will be able to add list items in the next step.
<table>
	<tr>
		<td>List Name</td>
		<td><input type="text" name="list_name"></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="text" name="password"></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="Submit"></td>
	</tr>
</table>	
</form>
<? 
} 
?>