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
    <table style="margin:auto" cellpadding="1" id="key_connector_table" border="1">
        </tr>
            <th style="text-align:center;" colspan="3"><h2>Key Connector</h2></th>
        </tr>
        <tr>
            <th><label for="primary_table" alt="Paghuhugutan ng data">Primary Table</label></th>
            <td><select name="primary_table" id="primary_table"><?php echo optionify($table_names); ?></select></td>
        </tr>
		<tr>
			<td style="text-align:center;" colspan="3"><input type="submit" value="Generate Queries"></td>
		</tr>
	</table>
	<table style="margin:auto" cellpadding="1" id="conditions_table" border="1">
		<tr>
			<th colspan="4"><h3>Primary Table Conditions</h3></th>
		</tr>
		<tr>
			<th colspan="4"><a id="connector_new_condition">Add new condition (+)</a></th>
		</tr>
		<tr class="condition_header">
			<th>Column Name</th>
			<th>Condition Operand</th>
			<th>Required Value</th>
			<th></th>
		</tr>
    </table>
	<table style="margin:auto" cellpadding="1" id="foreign_table" border="1">
		<tr>
			<th colspan="3"><h3>Foreign Table</h3></th>
		</tr>
		<tr>
			<th>Foreign Table</th>
			<td><select name="foreign_table[]"><option>-</option><?php echo optionify($table_names); ?></select></td>
		</tr>
		<tr>
			<th>Primary Table Foreign Key</th>
			<th>Foreign Table Primary Key</th>
		</tr>
		<tr>
			<td><input type="text" name="primary_key[]" /></td>
			<td><input type="text" name="foreign_key[]" value="id" /></td>
		</tr>
	</table>
</form>
<script>
	var condition_ctr = 0;
	$("#connector_new_condition").click(function() {
		new_row =  '<tr id="row_'+condition_ctr+'"><td><input type="text" name="condition_column[]" id="condition_column_'+condition_ctr+'" placeholder="deleted"/></td><td><input type="text" name="condition_operand[]" id="condition_operand_'+condition_ctr+'" placeholder="LIKE / = / <>"/></td><td><input type="text" name="condition_value[]" id="condition_value_'+condition_ctr+'" placeholder="0" /></td><td><a onclick="javascript: deleteRow('+condition_ctr+')">Remove Condition (-)</a></td></tr>';
		condition_ctr++;
		$("#conditions_table").append(new_row);
	});
	function deleteRow(rownum) {
		$("#row_"+rownum).remove();
	}
</script>