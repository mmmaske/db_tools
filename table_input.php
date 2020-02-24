<form action="table_populator.php" method="GET">
	<input type="hidden" name="dbname" value="<?php echo $_GET['dbname']; ?>" />
    <table style="margin:auto" cellpadding="1">
        </tr>
            <th style="text-align:center;" colspan="2"><h2>Row Generator</h3></th>
        </tr>
        <tr>
            <th><label for="quantity">Row count</label></th>
            <td><input type="text" name="quantity" id="quantity" class="selectable" /></td>
        </tr>
            <th><label for="csv_tables">Table Names (comma separated)</label></th>
            <td><input type="text" name="csv_tables" id="csv_tables" class="selectable" /></td>
        </tr>
        <tr>
            <td style="text-align:center;" colspan="2"><input type="submit" value="Generate Queries"></td>
        </tr>
    </table>
</form>