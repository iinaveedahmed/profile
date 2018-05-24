<?php
$tree_node=['c'=>["d"=>0,"e"=>["j","k"]],"p"=>["a"=>["f"=>["g"=>["h","i"]],"l"=>["m","n"]],"x"=>["y"=>["z"]]]];
$tree_node2=['c'=>["d"=>0,"e"=>["j"=>0,"k"=>0]],"p"=>["a"=>["f"=>0,"l"=>["m","n"]]],"x"=>["y"=>["z"]]];

function treeDepth($tree){
	
	$depth = 1;
	
	foreach($tree as $item){
		$t_depth = is_array($item) ? treeDepth($item) + 1 : 1;
		$depth = ($t_depth > $depth) ? $t_depth : $depth;
	}
	
	return $depth;
	
}

shortestPath($tree_node2, 'j', 'd');

function shortestPath($tree, $a, $b){
	
	function parentArray($tree, $v, &$arr = array()){
		
		foreach($tree as $item => $val){
				if(is_array($val)){
					if(isset($val[$v])) {
					$arr[] = $v;
					$arr[] = (string)$item;
					} else {
						parentArray($val,$v, $arr);
						if(isset($val[end($arr)]) && !empty($arr)) $arr[] = key($tree);
					}
				}
		}
		return $arr;   
	}
	
	$a_struct 	= parentArray($tree,$a);
	$a_struct[]	= 'root*';
	$b_struct 	= parentArray($tree, $b);
	$b_struct[]	= 'root*';
	$common		= array_intersect($a_struct,$b_struct);
	var_dump($tree);
	echo "<br>======================================================================<br>";
	echo "<br> TREE DEPTH OF STRUCT === '".treeDepth($tree)."' <br>";
	echo "<br>======================================================================<br>";
	echo "<br> NODE STRUCT OF '".$a."' <br>";
	var_dump($a_struct);
	echo "<br>======================================================================<br>";
	echo "<br> NODE STRUCT OF '".$b."' <br>";
	var_dump($b_struct);
	echo "<br>======================================================================<br>";
	echo "RESULTING PARENTS";
	var_dump($common);
	
	return (!empty($common)) ? $common[0] : 'NaN';
}