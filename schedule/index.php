<?
$db = new mysqli("localhost", "root", "", "proco");
$auds = $db->query("SELECT aud FROM lesson GROUP BY aud ORDER BY aud");
$arAuds = [];
while($a = $auds->fetch_array()) {
	$arAuds[] = $a['aud'];
}
if(isset($_POST['n'])){
	//echo "aud = ".$_POST['aud'];
	$db->query("DELETE FROM lesson WHERE time = '".$_POST['time']."' AND week = '".$_POST['week']."' AND aud = '".$arAuds[$_POST['aud']]."'");
	$db->query("INSERT INTO lesson(time, gruppa, week, aud) VALUES ('".$_POST['time']."', '".$_POST['newgroup']."', '".$_POST['week']."', '".$arAuds[$_POST['aud']]."')");
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php'>";
	die;
}
$groups = $db->query("SELECT * FROM gruppa");
while($g = $groups->fetch_array()) {
	$arGroups[] = $g['name'];
}
$time = $db->query('SELECT id, CONCAT(DATE_FORMAT(time.name, "%H:%i"), " - ", DATE_FORMAT(ADDTIME(time.name, "1:30:00"), "%H:%i")) as name FROM time');
$times = [];
while($t = $time->fetch_array()) {
	$times[] = $t['name'];
}
$lessons = $db->query("SELECT lesson.aud, lesson.week, lesson.time, gruppa.name as gruppa FROM `lesson` JOIN gruppa ON gruppa.name = lesson.gruppa ORDER BY time, aud");
$lessonsSorted = [];
while($l = $lessons->fetch_array()) {
	$lessonsSorted[$l['time']][$l['aud']][$l['week']] = $l['gruppa'];
}
?>
<html>
	<head>
		<script src="js/jquery-1.11.3.min.js"></script>
		
		<meta charset="utf-8">
		<title>Расписание</title>
	</head>
	<body>
		<style>
			table {
				margin-top: 20px;
				margin-bottom: 20px;
				border-collapse: collapse;
				border-spacing: 0;
			}
			table > thead > tr > th,
			table > thead > tr > td,
			table > tbody > tr > th,
			table > tbody > tr > td,
			table > tfoot > tr > th,
			table > tfoot > tr > td {
			  padding: 8px;
			  line-height: 1.5384615385;
			}
			td {
				height: 40px;
				min-width: 100px;
			}
			
			tr {
				min-height: 40px;
			}
			tr:nth-child(odd) {
				background-color: #00ff00;
			}
			form {
				margin: 0;
			}
		</style>
		
		<table id="maintable" border=1>
			<thead id="mainheader">
				<tr>
					<th>Время</th>
					<?foreach($arAuds as $aud):?>
						<th><?=$aud?></th>
					<?endforeach?>
				</tr>
				<?for($j = 0; $j < $time->num_rows * 2; $j++):?>
					<tr id = "<?=$j?>">
						<?if($j%2==0):?><td rowspan=2><?=$times[$j/2]?></td><?endif?>
						<?for($i=0; $i < $auds->num_rows; $i++):?>
							<td name="<?=$i?>" onclick="editGroup(<?=$j?>, <?=$i?>)"><?if(isset($lessonsSorted[($j - $j%2)/2 + 1][$arAuds[$i]][$j%2])) echo $lessonsSorted[($j - $j%2)/2 + 1][$arAuds[$i]][$j%2];?></td>
						<?endfor ?>
					</tr>
				<?endfor?>
			</thead>
		</table>
		<script type="text/javascript">
			var lastX = -1;
			var lastY = -1;
			var grouplist = [<?foreach ($arGroups as $group):?> "<?=$group?>" , <?endforeach?>];
			function editGroup(rowid, cellname) {
				if ((rowid!=lastY) || (cellname!=lastX)){
					var cell = $("#"+rowid+" > td[name=\""+cellname+"\"]");
					cell.html("<form method = 'POST'>" + createSelector(cell.html()) + "<input type='hidden' value='"+(Math.ceil(rowid/2) + (1-rowid%2))+"' name = 'time'><input type='hidden' value='"+cellname+"' name = 'aud'><input type='hidden' value='"+rowid%2+"' name = 'week'><input type='submit' value='OK' name='n'></form>");
					if ((lastY>=0) && (lastX>=0)){
						var lastcell = $("#"+lastY+" > td[name=\""+lastX+"\"]");
						lastcell.html(lastcell.children("select").val());
						lastcell.attr("onclick", "editGroup("+lastY+", "+lastX+")");
					}
					cell.attr("onclick", "");
				}
				lastX = cellname;
				lastY = rowid;
			}
			function createSelector(oldoption) {
				var string = "<select name='newgroup'>";
				if (oldoption!=""){
					string+="<option>"+oldoption+"</options>";
				}
				string+="<option></options>";
				for (var i = 0; i < grouplist.length; i++){
					if (grouplist[i]!=oldoption){
						string+="<option>"+grouplist[i]+"</options>";
					}
				}
				string+="</options>";
				return string;
			}
		</script>
	</body>
</html>
