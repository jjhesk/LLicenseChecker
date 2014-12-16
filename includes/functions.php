<?php
function get_user_browser(){
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $ub = '';
    if(preg_match('/MSIE/i',$u_agent))
    {
        $ub = "ie";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $ub = "firefox";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $ub = "safari";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $ub = "chrome";
    }
    elseif(preg_match('/Flock/i',$u_agent))
    {
        $ub = "flock";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $ub = "opera";
    }
    return $ub;
}

function alphamonths(){
	echo ("<option value='00'>Month</option>
<option value='01'>January</option>
<option value='02'>February</option>
<option value='03'>March</option>
<option value='04'>April</option>
<option value='05'>May</option>
<option value='06'>June</option>
<option value='07'>July</option>
<option value='08'>August</option>
<option value='09'>September</option>
<option value='10'>October</option>
<option value='11'>November</option>
<option value='12'>December</option>");
}

function egyptcities(){
	echo ("<option value='Cairo'>Cairo</option>
<option value='Alexandria'>Alexandria</option>
<option value='Giza'>Giza</option>
<option value='Shubra El-Kheima'>Shubra El-Kheima</option>
<option value='Port Said'>Port Said</option>
<option value='Suez'>Suez</option>
<option value='Luxor'>Luxor</option>
<option value='al-Mansura'>al-Mansura</option>
<option value='El-Mahalla El-Kubra'>El-Mahalla El-Kubra</option>
<option value='Tanta'>Tanta</option>
<option value='Asyut'>Asyut</option>
<option value='Ismailia'>Ismailia</option>
<option value='Fayyum'>Fayyum</option>
<option value='Zagazig'>Zagazig</option>
<option value='Aswan'>Aswan</option>
<option value='Damietta'>Damietta</option>
<option value='Damanhur'>Damanhur</option>
<option value='al-Minya'>al-Minya</option>
<option value='Beni Suef'>Beni Suef</option>
<option value='Qena'>Qena</option>
<option value='Sohag'>Sohag</option>
<option value='Hurghada'>Hurghada</option>
<option value='6th of October'>6th of October</option>
<option value='Shibin El Kom'>Shibin El Kom</option>
<option value='Banha'>Banha</option>
<option value='Kafr el-Sheikh'>Kafr el-Sheikh</option>
<option value='Arish'>Arish</option>
<option value='Mallawi'>Mallawi</option>
<option value='10th of Ramadan'>10th of Ramadan</option>
<option value='Bilbais'>Bilbais</option>
<option value='Marsa Matrouh'>Marsa Matrouh</option>
<option value='Idfu'>Idfu</option>
<option value='Mit Ghamr'>Mit Ghamr</option>
<option value='El-Hawamdeyya'>El-Hawamdeyya</option>
<option value='Desouk'>Desouk</option>
<option value='Qalyub'>Qalyub</option>
<option value='Abu Kabir'>Abu Kabir</option>
<option value='Kafr el-Dawwar'>Kafr el-Dawwar</option>
<option value='Girga'>Girga</option>
<option value='Akhmim'>Akhmim</option>
<option value='Matareya'>Matareya</option>");
}

function egyptstates(){
	echo ("<option value='Cairo'>Cairo</option>
<option value='Alexandria'>Alexandria</option>
<option value='Giza'>Giza</option>
<option value='Qalyubia'>Qalyubia</option>
<option value='Helwan'>Helwan</option>
<option value='Port Said'>Port Said</option>
<option value='Suez'>Suez</option>
<option value='Luxor'>Luxor</option>
<option value='Dakahlia'>Dakahlia</option>
<option value='Gharbia'>Gharbia</option>
<option value='Asyut'>Asyut</option>
<option value='Ismailia'>Ismailia</option>
<option value='Faiyum'>Faiyum</option>
<option value='Sharqia'>Sharqia</option>
<option value='Aswan'>Aswan</option>
<option value='Damietta'>Damietta</option>
<option value='Beheira'>Beheira</option>
<option value='Minya'>Minya</option>
<option value='Beni Suef'>Beni Suef</option>
<option value='Qena'>Qena</option>
<option value='Sohag'>Sohag</option>
<option value='Red Sea'>Red Sea</option>
<option value='Monufia'>Monufia</option>
<option value='Kafr el-Sheikh'>Kafr el-Sheikh</option>
<option value='North Sinai'>North Sinai</option>
<option value='Matrouh'>Matrouh</option>
<option value='Saloum'>Saloum</option>");
}
function verificationcode($length = 10) {
    return 'Arb'.substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}
function pincode($length = 4) {
    return substr(str_shuffle("0123456789"), 0, $length);
}

function first_n_words($text, $number_of_words) {
   $text = strip_tags($text);
   $text = preg_replace("/^\W*((\w[\w'-]*\b\W*){1,$number_of_words}).*/ms", '\\1', $text);
   return str_replace("\n", "", $text);
}
function truncate_to_n_words($text, $number_of_words, $url, $readmore = 'read more') {
   $text = strip_tags($text);
   $excerpt = first_n_words($text, $number_of_words);
   if( str_word_count($text) !== str_word_count($excerpt) ) {
      $excerpt .= '... <a href="'.$url.'">'.$readmore.'</a>';
   }
   return $excerpt;
}

function regenerateSession($reload = false)
{
    // This token is used by forms to prevent cross site forgery attempts
    if(!isset($_SESSION['nonce']) || $reload)
        $_SESSION['nonce'] = md5(microtime(true));

    if(!isset($_SESSION['IPaddress']) || $reload)
        $_SESSION['IPaddress'] = $_SERVER['REMOTE_ADDR'];

    if(!isset($_SESSION['userAgent']) || $reload)
        $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];

    //$_SESSION['user_id'] = $this->user->getId();

    // Set current session to expire in 1 minute
    $_SESSION['OBSOLETE'] = true;
    $_SESSION['EXPIRES'] = time() + 60;

    // Create new session without destroying the old one
    session_regenerate_id(false);

    // Grab current session ID and close both sessions to allow other scripts to use them
    $newSession = session_id();
    session_write_close();

    // Set session ID to the new one, and start it back up again
    session_id($newSession);
    session_start();

    // Don't want this one to expire
    unset($_SESSION['OBSOLETE']);
    unset($_SESSION['EXPIRES']);
}

function checkSession()
{
    try{
        if($_SESSION['OBSOLETE'] && ($_SESSION['EXPIRES'] < time()))
            throw new Exception('Attempt to use expired session.');

        if(!is_numeric($_SESSION['user_id']))
            throw new Exception('No session started.');

        if($_SESSION['IPaddress'] != $_SERVER['REMOTE_ADDR'])
            throw new Exception('IP Address mixmatch (possible session hijacking attempt).');

        if($_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT'])
            throw new Exception('Useragent mixmatch (possible session hijacking attempt).');

        if(!$this->loadUser($_SESSION['user_id']))
            throw new Exception('Attempted to log in user that does not exist with ID: ' . $_SESSION['user_id']);

        if(!$_SESSION['OBSOLETE'] && mt_rand(1, 100) == 1)
        {
            $this->regenerateSession();
        }

        return true;

    }catch(Exception $e){
        return false;
    }
}
?>