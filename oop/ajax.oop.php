<?php 
include 'autoloader.php';


$obj = new Fetch;

if($_POST['type'] == 'filter'){
	$gender = $_POST['gen'];
	$term = $_POST['trm'];
	$lt = $_POST['lt'];

	$query = "SELECT * FROM student WHERE";
	$val = 0;
	if ($gender != 0) {
		$val = 1;
		$query .= " gender = '$gender'";
	}
	if ($term != 0) {
		if ($val == 1) {
			$query .= "AND term_lic = '$term'";
		}else{
			$val = 1;
			$query .= " term_lic = '$term'";
		}
	}
	if($lt != 0){
		if ($val == 1) {
			$query .= "AND lt = '$lt'";
		}else{
			$val = 1;
			$query .= " lt = '$lt'";
		}
	}

	$out = $obj->fetcFilter($query);
	$cnt = 1;
	foreach ($out as $key ) {
	if($key['gender'] == 1){
        $gen_show = "Male";
    }elseif($key['gender'] == 2){
        $gen_show = "Female";
    }
    $trm_show = $obj->fetchTermId($key['term_lic']);
    $lt_show = $obj->fetchLicenseId($key['lt']);
	echo "
         <tr>
            <td>".$cnt."</td>
            <td style='text-transform: capitalize;'>".$key['name']." ".$key['fname']." ".$key['gname']."</td>
            <td>".htmlspecialchars($gen_show)."</td>
            <td style='text-transform: capitalize;'>".htmlspecialchars($trm_show['name'])."</td>
            <td style='text-transform: capitalize;'>".htmlspecialchars($lt_show['name'])."</td>
            <td><a href='x.php?id=".htmlspecialchars($key['id'])."'><i class='fa fa-eye'></i></a></td>
            </tr>
                 
	";
	$cnt=$cnt+1;}
}

if ($_POST['type'] == 'yes') {
	$array = $obj->fetchStudent();
    $cnt = 1;
    foreach ($array as $key ) {
    if($key['gender'] == 1){
        $gen_show = "Male";
    }elseif($key['gender'] == 2){
        $gen_show = "Female";
    }
	$trm_show = $obj->fetchTermId($key['term_lic']);
    $lt_show = $obj->fetchLicenseId($key['lt']);

    echo "
    
    	<tr>
            <td>".$cnt."</td>
            <td style='text-transform: capitalize;'>".$key['name']." ".$key['fname']." ".$key['gname']."</td>
            <td>".htmlspecialchars($gen_show)."</td>
            <td style='text-transform: capitalize;'>".htmlspecialchars($trm_show['name'])."</td>
            <td style='text-transform: capitalize;'>".htmlspecialchars($lt_show['name'])."</td>
            <td><a href='x.php?id=".htmlspecialchars($key['id'])."'><i class='fa fa-eye'></i></a></td>
            </tr>
    ";
$cnt=$cnt+1;}
}