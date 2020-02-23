<?php
include("dblib.php");
$tables = quickquery("SHOW TABLES");
$table_names = array();
foreach($tables as $table) {
	$table_names[] = $table['Tables_in_'.$_GET['dbname']];
}
?>
<form action="key_connector.php" method="GET">
	<input type="hidden" name="dbname" value="<?php echo $_GET['dbname']; ?>" />
    <table style="margin:auto" cellpadding="1">
        </tr>
            <th style="text-align:center;" colspan="3"><h2>Key Connector</h2></th>
        </tr>
        <tr>
            <th><label for="primary_table" alt="Paghuhugutan ng data">Primary Table</label></th>
            <td><select name="primary_table" id="primary_table"><?php echo optionify($table_names); ?></select></td>
        </tr>
		<tr>
			<th colspan="3"><h3>Conditions</h3></th>
		</tr>
		<tr>
			<th>Column Name</th>
			<th>Required Value</th>
			<th>Remove Condition</th>
		</tr>
		<tr>
            <td><input type="text" name="condition_column[]" id="" /></td>
            <td><input type="text" name="condition_value[]" id="" /></td>
            <td>(-)</td>
        </tr>
		<tr>
			<th colspan="3">Add new condition (+)</th>
		</tr>
        <tr>
            <td style="text-align:center;" colspan="3"><input type="submit" value="Generate Queries"></td>
        </tr>
    </table>
</form>