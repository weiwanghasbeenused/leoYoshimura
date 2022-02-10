<?
function getVisibleList(){
	global $db;
	$output = array();

	$sql = 'SELECT objects.* FROM objects, wires WHERE objects.active = "1" AND wires.active = "1" AND wires.toid = objects.id AND wires.fromid = "0" AND objects.name1 NOT LIKE ".%" AND objects.name1 NOT LIKE "\_%" ORDER BY objects.begin DESC';

	$res = $db->query($sql);
	if(!$res)
		throw new Exception("I can't read German: " . $db->error);
	if($res->num_rows == 0)
		return $output;	
	while ($obj = $res->fetch_assoc())
		$output[] = $obj;

	$res->close();

	return $output;
}
?>