<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function dropnum($id){
    $data['']='';
    for($i=1;$i<=$id;$i++){
        $data[$i]=$i;
    }
    return $data;
}
function menu($id){
    if($id==1){
        $data['user'] = 'User';
    }   
    if($id==1 || $id==2 || $id==3){
        $data['app/add/ID']='Entry Quest Indonesia';
        $data['app/add/EN']='Entry Quest Inggris';
        $data['app']='List';
    }
    if($id==1){
        $data['fee'] = 'Fee';
    }   
    return $data;
}
function tbl_tmp(){
	$data = array(
		'table_open'=>'<table border="0" cellpadding="4" cellspacing="0" class="table table-striped table-bordered">'
	);
	return $data;
}
function pag_tmp(){
	$data = array(
		'page_query_string' => TRUE
		,'query_string_segment' => 'offset'
		,'full_tag_open' => '<ul class="pagination">'
		,'full_tag_close' => '</ul>'	
		,'first_tag_open' => '<li>'
		,'first_tag_close' => '</li>'	
		,'last_tag_open' => '<li>'
		,'last_tag_close' => '</li>'
		,'next_tag_open' => '<li>'
		,'next_tag_close' => '</li>'		
		,'prev_tag_open' => '<li>'
		,'prev_tag_close' => '</li>'	
		,'cur_tag_open' => '<li class="active"><span>'
		,'cur_tag_close' => '</span></li>'
		,'num_tag_open' => '<li>'
		,'num_tag_close' => '</li>'				
	);
	return $data;
}
function get_age($dob){
    $dob = date("Y-m-d",strtotime($dob));

    $dobObject = new DateTime($dob);
    $nowObject = new DateTime();

    $diff = $dobObject->diff($nowObject);

    return $diff->y;
}
function owner($id){
	$data = 'Created by : <strong>'.($id->user_create<>''?$id->user_create:'System').'</strong> '.($id->date_create<>'0000-00-00 00:00:00'?'('.$id->date_create.')':'');
	$data .= ' Updated by : <strong>'.$id->user_update.'</strong> ('.$id->date_update.')';
	return $data;
}
function sort_icon($order_type){
	if($order_type=='asc'){
		return '<span class="glyphicon glyphicon-arrow-up"></span>';
	}else{
		return '<span class="glyphicon glyphicon-arrow-down"></span>';
	}
}
function format_tanggal($date){
	if($date <> '0000-00-00' && $date <> '' && $date <> null){
		return date_format(date_create($date),'d/m/Y');
	}
}
function format_tanggal_barat($date){
	if($date <> '0000-00-00' && $date <> '' && $date <> null){
		$tgl = explode('/',$date);
		return $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
	}else{
		return '0000-00-00';
	}
}
function format_tanggal_excel($date){
	if($date <> '0000-00-00' && $date <> '' && $date <> null){
		$tgl = explode('-',$date);
		return $tgl[1].'/'.$tgl[2].'/'.$tgl[0];
	}
}
function date_to_excel($id){
	if($id<>'0000-00-00'){
		$a = date_create($id);
		$d = date_format($a,'d');
		$m = date_format($a,'m');
		$y = date_format($a,'Y');
		$date = gmmktime(0,0,0,$m,$d,$y); 
	}else{
		$date = '';
	}
	return $date;
}
function excel_to_date($id){
	$value = $id->getValue();
	if($value<>''){
		if(PHPExcel_Shared_Date::isDateTime($id)){
			$data = PHPExcel_Shared_Date::ExcelToPHP($value);
			$date = date('Y-m-d',$data);			
		}else if(date_create($value)){
			$date = date_format(date_create($value),'Y-m-d');
		}else{
			$date = '0000-00-00';
		}
	}else{
		$date = '0000-00-00';
	}
	return $date;
}

function ago($time){
	$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	$lengths = array("60","60","24","7","4.35","12","10");

	$now = time();

	   $difference     = $now - $time;
	   $tense         = "ago";

	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
	   $difference /= $lengths[$j];
	}

	$difference = round($difference);

	if($difference != 1) {
	   $periods[$j].= "s";
	}

	return "$difference $periods[$j] ago ";
}	
function getBrowser($agent = null){
    $u_agent = ($agent!=null)? $agent : $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

	$os_array = array(
        '/windows nt 10/i'     =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );
    foreach ($os_array as $regex => $value) { 
        if (preg_match($regex, $u_agent)) {
            $platform = $value;
        }

    }   

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}
function ex_quesioner($id){
    switch ($id) {
        case '1':
            return '1 - strongly disagree';
            break;
        
        case '2':
            return '2 - disagree';
            break;
        
        case '3':
            return '3- slightly disagree';
            break;
        
        case '4':
            return '4 - slightly agree';
            break;
        
        case '5':
            return '5 - agree';
            break;
        
        case '6':
            return '6 - strongly agree';
            break;
        
        default:
            return '';
            break;
    }
}
function ex_dem_2_id($id){
    switch ($id) {
        case '1':
            return 'I lead people who also lead teams';
            break;
        
        case '2':
            return 'I lead a team';
            break;
        
        case '3':
            return 'I have no direct reports';
            break;
                
        default:
            return '';
            break;
    }
}
function ex_dem_3_id($id){
    switch ($id) {
        case '1':
            return 'less than 6 months';
            break;
        
        case '2':
            return 'more than 6 months but less than 1 year';
            break;
        
        case '3':
            return '1 to 2 years';
            break;
        
        case '4':
            return '2 to 5 years';
            break;
        
        case '5':
            return '6 to 10 years';
            break;
        
        case '6':
            return '11-15 years';
            break;
        
        case '7':
            return '16 -20 years';
            break;
        
        case '8':
            return '21 to 25 years';
            break;
        
        case '9':
            return 'more than 26 years';
            break;
        
        default:
            return '';
            break;
    }
}
function ex_dem_4_id($id){
    switch ($id) {
        case '1':
            return 'Permanent';
            break;
        
        case '2':
            return 'Part time (contract)';
            break;
        
        case '3':
            return 'Casual';
            break;

        default:
            return '';
            break;
    }
}
function ex_dem_5_id($id){
    switch ($id) {
        case '1':
            return 'Male';
            break;
        
        case '2':
            return 'Female';
            break;
            
        default:
            return '';
            break;
    }
}
function ex_dem_6_id($id){
    switch ($id) {
        case '1':
            return '25 or younger';
            break;
        
        case '2':
            return '25 to 34 years old';
            break;
            
        case '3':
            return '35-44 years old';
            break;
            
        case '4':
            return '45-54 years old';
            break;
            
        case '5':
            return '55 years or above';
            break;
            
        default:
            return '';
            break;
    }
}
function ex_dem_2_en($id){
    switch ($id) {
        case '1':
            return 'Alotau';
            break;
        
        case '2':
            return 'Buka';
            break;
        
        case '3':
            return 'Central Warehouse';
            break;
                
        case '4':
            return 'Goroka';
            break;
                
        case '5':
            return 'Hagen';
            break;
                
        case '6':
            return 'Head Office';
            break;
                
        case '7':
            return 'Honiara';
            break;
                
        case '8':
            return 'Kainantu';
            break;
                
        case '9':
            return 'Kavieng';
            break;
                
        case '10':
            return 'Kimbe';
            break;
                
        case '11':
            return 'Kokopo';
            break;
                
        case '12':
            return 'Kundiawa';
            break;
                
        case '13':
            return 'Lae Depot';
            break;
                
        case '14':
            return 'Lae Production';
            break;
                
        case '15':
            return 'Madang';
            break;
                
        case '16':
            return 'Mendi';
            break;
                
        case '17':
            return 'Popendetta';
            break;
                
        case '18':
            return 'Port Moresby';
            break;
                
        case '19':
            return 'Raw Materials';
            break;
                
        case '20':
            return 'Vanimo';
            break;
                
        case '21':
            return 'Wabag';
            break;
                
        case '22':
            return 'Western';
            break;
                
        case '23':
            return 'Wewak';
            break;
                
        default:
            return '';
            break;
    }
}
function ex_dem_3_en($id){
    switch ($id) {
        case '1':
            return 'I report in to the PNG Country Leadership Team for my bussiness';
            break;
        
        case '2':
            return 'I lead people who also lead teams';
            break;
        
        case '3':
            return 'I lead a team';
            break;
        
        case '4':
            return 'I have no direct reports';
            break;
        
        default:
            return '';
            break;
    }
}
function ex_dem_4_en($id){
    switch ($id) {
        case '1':
            return 'Less than 6 months';
            break;
        
        case '2':
            return 'More than 6 months but less than 1 year';
            break;
        
        case '3':
            return '1 to less than 2 years';
            break;

        case '4':
            return '2 to 5 years';
            break;

        case '5':
            return '6 to 10 years';
            break;

        case '6':
            return '11-15 years';
            break;

        case '7':
            return '16 - 20 years';
            break;

        case '8':
            return '21 to 25 years';
            break;

        case '9':
            return '26 years or longer';
            break;

        default:
            return '';
            break;
    }
}
function ex_dem_5_en($id){
    switch ($id) {
        case '1':
            return 'Male';
            break;
        
        case '2':
            return 'Female';
            break;
            
        default:
            return '';
            break;
    }
}
function ex_dem_6_en($id){
    switch ($id) {
        case '1':
            return 'Under 25 years';
            break;
        
        case '2':
            return '25 to 34 years old';
            break;
            
        case '3':
            return '35-44 years old';
            break;
            
        case '4':
            return '45 - 54 years old';
            break;
            
        case '5':
            return '55 years or above';
            break;
            
        default:
            return '';
            break;
    }
}
