<?php
if(isset($_POST['action'])){
	$html='';
	$listitem='';
	$title=array("Title 1","Title 2","Title 3","Title 4","Title 5","Title 6");
	$lattitude=array(-31.563910,-33.718234,-33.727111,-33.848588,-33.851702,-34.671264);
	$longitude=array(147.154312,150.363181,150.371124,151.209834,151.216968,150.863657);
	$projectid=array(1,2,3,4,5,6);

	foreach ($title as $key => $value) {
		$listitem=$key+1;
		$data[]=array('title'=>$value,
			'lattitude'=>$lattitude[$key],
			'longitude'=>$longitude[$key].
			'projectid'=>$projectid[$key]

		);
		$html.='<li class="info-'.$listitem.'">';
		$html.='<div class="condos-info">';
		$html.='<h3>Title Test '.$listitem.'</h3>';
		$html.='</div>';
		$html.='</li>';
	}
	$data_result=array('location'=>$data,'html'=>$html);
	$valuedata=json_encode($data_result);
	echo $valuedata;
	exit;
}