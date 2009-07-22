<?php
//Get the options
$caption=get_option('peb_caption');
$before=get_option('peb_before');
$after=get_option('peb_after');

for ($i=0;$i<count($caption);$i++) {
?>

edButtons[edButtons.length]=new edButton("peb_<?php echo $i; ?>","<?php echo str_replace('"','&quot;',$caption[$i]); ?>","<?php echo str_replace('"','\"',$before[$i]); ?>","<?php echo str_replace('"','\"',$after[$i]); ?>","<?php echo str_replace('"','&quot;',$caption[$i]); ?>");
<?php } ?>


function peb_deleteRow(id) {
	document.getElementById('row'+id).innerHTML='';

	return false;
}
function peb_addMore(){
	var tbody = document.getElementById('op_table').getElementsByTagName("TBODY")[0];

	var row = document.createElement("TR");

	var td1 = document.createElement("TD");
	td1.innerHTML='<input type="text" name="peb_caption[]" />';

	var td2 = document.createElement("TD");
	td2.innerHTML='<input type="text" name="peb_before[]" />';

	var td3 = document.createElement("TD");
	td3.innerHTML='<input type="text" name="peb_after[]" />';

	row.appendChild(td1);
	row.appendChild(td2);
	row.appendChild(td3);

	tbody.appendChild(row);

	return false;
  }