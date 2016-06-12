<?php
function cur_url()
{
    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === FALSE ? 'http' : 'https';
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];
    $params = $_SERVER['QUERY_STRING'];
    $currentUrl = $protocol . '://' . $host . $script . '?' . $params;
    return $currentUrl;
}

function cur_server()
{
    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === FALSE ? 'http' : 'https';
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];
    $currentUrl = $protocol . '://' . $host . $script;
    $currentUrl = explode('/', $currentUrl);
    unset($currentUrl[count($currentUrl) - 1]);
    $currentUrl = implode('/', $currentUrl) . '/';
    return $currentUrl;
}

function cur_script()
{
    return basename($_SERVER['PHP_SELF']);
}

function truncate($input, $maxWords, $maxChars)
{
    $words = preg_split('/\s+/', $input);
    $words = array_slice($words, 0, $maxWords);
    $words = array_reverse($words);

    $chars = 0;
    $truncated = array();

    while (count($words) > 0) {
        $fragment = trim(array_pop($words));
        $chars += strlen($fragment);

        if ($chars > $maxChars) break;

        $truncated[] = $fragment;
    }

    $result = implode($truncated, ' ');

    return $result . ($input == $result ? '' : '...');
}

function get_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function DateConversionDB($tmpDate)
{
    $tmpDate = explode('/', $tmpDate);
    $time = mktime(0, 0, 0, $tmpDate[0], $tmpDate[1], $tmpDate[2]);
    $mysqldate = date('Y-m-d H:i:s', $time);
    return $mysqldate;
}

function ReverseDateConversionDB($tmpDate)
{
    $tmpDate = explode('/', $tmpDate);
    $time = mktime(0, 0, 0, $tmpDate[0], $tmpDate[1], $tmpDate[2]);
    $mysqldate = date('Y-m-d H:i:s', $time);
    return $mysqldate;
}

function mysql_real_escape_string_undo($str)
{
    return str_replace("rn", "", str_replace("\\", "", htmlspecialchars_decode(nl2br($str), ENT_COMPAT | ENT_XHTML)));
}


function createThumbnail($image_name, $new_width, $new_height, $uploadDir, $moveToDir)
{
    $path = $uploadDir . '/' . $image_name;
    $mime = getimagesize($path);

    if ($mime['mime'] == 'image/png') {
        $src_img = imagecreatefrompng($path);
    }
    if ($mime['mime'] == 'image/jpg') {
        $src_img = imagecreatefromjpeg($path);
    }
    if ($mime['mime'] == 'image/jpeg') {
        $src_img = imagecreatefromjpeg($path);
    }
    if ($mime['mime'] == 'image/pjpeg') {
        $src_img = imagecreatefromjpeg($path);
    }

    $old_x = imageSX($src_img);
    $old_y = imageSY($src_img);

    if ($old_x > $old_y) {
        $thumb_w = $new_width;
        $thumb_h = $old_y * ($new_height / $old_x);
    }

    if ($old_x < $old_y) {
        $thumb_w = $old_x * ($new_width / $old_y);
        $thumb_h = $new_height;
    }

    if ($old_x == $old_y) {
        $thumb_w = $new_width;
        $thumb_h = $new_height;
    }

    $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);

    imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);


    // New save location
    $new_thumb_loc = $moveToDir . $image_name;

    if ($mime['mime'] == 'image/png') {
        $result = imagepng($dst_img, $new_thumb_loc, 8);
    }
    if ($mime['mime'] == 'image/jpg') {
        $result = imagejpeg($dst_img, $new_thumb_loc, 80);
    }
    if ($mime['mime'] == 'image/jpeg') {
        $result = imagejpeg($dst_img, $new_thumb_loc, 80);
    }
    if ($mime['mime'] == 'image/pjpeg') {
        $result = imagejpeg($dst_img, $new_thumb_loc, 80);
    }

    imagedestroy($dst_img);
    imagedestroy($src_img);

    return $result;
}


function get_insert_id()
{
    $q = mysql_query("SELECT LAST_INSERT_ID()");
    if ($q) {
        $data = mysql_fetch_assoc($q);
        return $data['LAST_INSERT_ID()'];
    } else {
        return false;
    }
}


function mysqli_li_id($con = false)
{
    if ($con) {
        $q = mysqli_query($con, "SELECT LAST_INSERT_ID() AS last");
        if ($q) {
            $data = mysqli_fetch_assoc($q);
            return $data['last'];
        } else {
            return false;
        }
    } else {
        return false;
    }
}


function Slug($string)
{
    return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
}

function notify($msg = false)
{
    if ($msg != false) {
        $_SESSION['msg'] = $msg;
        return true;
    } else {
        unset($_SESSION['msg']);
        return false;
    }
}

function jsGoBack()
{
    ?>
    <script>
        history.go(-1);
    </script>
    <?php
}

function phpGoBack($die = false)
{
    header("Location: " . $_SERVER['HTTP_REFERER']);
    if ($die) {
        die();
    }
}


function go2($url = false)
{
    if ($url) {
        header("Location: " . $url);
    } else {
        return "<strong>ERROR:</strong> Paremeter 'URL' is missing";
    }
}


function str_2_p($str = '')
{
    $str = stripslashes($str);
    $str = str_ireplace("rn", "", $str);
    $str = nl2br($str);

    return $str;
}

function compress_image($src, $dest, $quality)
{
    $info = getimagesize($src);


    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($src);
        imagejpeg($image, $dest, $quality);
    } elseif ($info['mime'] == 'image/gif') {
        $image = imagecreatefromgif($src);
        imagegif($image, $dest);
    } elseif ($info['mime'] == 'image/png') {

        $image = imagecreatefrompng($src);
        imagepng($image, $dest, $quality);
    } else {
        die('Unknown image file format');
    }

    return $dest;
}

//usage
//$compressed = compress_image('Ban2.png', 'destination.png', 4); 

//On Error
//ini_set('memory_limit', '-1');
//ini_set('post_max_size', '1000M');
//ini_set('upload_max_filesize', '1000M');


function make_thumb($src, $dest, $desired_width)
{
    $file_ex = explode(".", $src);
    $ext = end($file_ex);

    if ($ext != "png" and $ext != "PNG") {

        $source_image = imagecreatefromjpeg($src);
        $width = imagesx($source_image);
        $height = imagesy($source_image);

        $desired_height = floor($height * ($desired_width / $width));

        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

        imagejpeg($virtual_image, $dest);
    } else {

        $source_image = imagecreatefrompng($src);
        $width = imagesx($source_image);
        $height = imagesy($source_image);

        $desired_height = floor($height * ($desired_width / $width));

        $newImg = imagecreatetruecolor($desired_width, $desired_height);
        imagealphablending($newImg, false);
        imagesavealpha($newImg, true);
        $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
        imagefilledrectangle($newImg, 0, 0, $desired_width, $desired_height, $transparent);
        imagecopyresampled($newImg, $source_image, 0, 0, 0, 0, $desired_width, $desired_height,
            $width, $height);

        imagepng($newImg, $dest);
    }
}

//usage
//make_thumb('images/image.jpg', 'images/thumb.jpg', 200);

function trim_image($src, $dest)
{
    $img = imagecreatefromjpeg($src);

    $b_top = 0;
    $b_btm = 0;
    $b_lft = 0;
    $b_rt = 0;

    for (; $b_top < imagesy($img); ++$b_top) {
        for ($x = 0; $x < imagesx($img); ++$x) {
            if (imagecolorat($img, $x, $b_top) != 0xFFFFFF) {
                break 2;
            }
        }
    }

    for (; $b_btm < imagesy($img); ++$b_btm) {
        for ($x = 0; $x < imagesx($img); ++$x) {
            if (imagecolorat($img, $x, imagesy($img) - $b_btm - 1) != 0xFFFFFF) {
                break 2;
            }
        }
    }

    for (; $b_lft < imagesx($img); ++$b_lft) {
        for ($y = 0; $y < imagesy($img); ++$y) {
            if (imagecolorat($img, $b_lft, $y) != 0xFFFFFF) {
                break 2;
            }
        }
    }

    for (; $b_rt < imagesx($img); ++$b_rt) {
        for ($y = 0; $y < imagesy($img); ++$y) {
            if (imagecolorat($img, imagesx($img) - $b_rt - 1, $y) != 0xFFFFFF) {
                break 2;
            }
        }
    }

    $newimg = imagecreatetruecolor(imagesx($img) - ($b_lft + $b_rt), imagesy($img) - ($b_top + $b_btm));

    imagecopy($newimg, $img, 0, 0, $b_lft, $b_top, imagesx($newimg), imagesy($newimg));

    imagejpeg($newimg, $dest, 100);
}


function watermark_image($mark, $image)
{
    $stamp = imagecreatefrompng($mark);
    $im = imagecreatefromjpeg($image);

    $marge_right = 10;
    $marge_bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);

    //imagecopy($im, $stamp, ((imagesx($im) - $sx - $marge_right)/100*50), ((imagesy($im) - $sy - $marge_bottom)/100*50), 0, 0, imagesx($stamp), imagesy($stamp));
    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

    imagepng($im, $image, 9);
}

function watermark_text($img, $text)
{
    $chk_img_arr = explode(".", $img);
    $ext = end($chk_img_arr);

    if ($ext != "png" || $ext != "PNG") {
        $my_img = imagecreatefromjpeg($img);
    } else {
        $my_img = imagecreatefrompng($img);
    }

    $water_mark_text_2 = $text;
    $font_path = "../css/font/Calibri_Bold.ttf";
    list($owidth, $oheight) = getimagesize($img);
    $width = imagesx($my_img);
    $height = imagesy($my_img);
    $font_size = ($width / 100) * 3.5;
    $shadow1_size = ($width / 100) * 3.5;
    $shadow2_size = ($width / 100) * 3.5;


    $txt_x = ($width / 100) * 4;

    $txt_y = ($height / 100) * 95;

    $shadow1_x = ($width / 100) * 3.9;

    $shadow1_y = ($height / 100) * 94.9;

    $shadow2_x = ($width / 100) * 4.1;

    $shadow2_y = ($height / 100) * 95.1;

    $image = imagecreatetruecolor($width, $height);

    if ($ext != "png" || $ext != "PNG") {
        $image_src = imagecreatefromjpeg($img);
    } else {
        $image_src = imagecreatefrompng($img);
    }

    imagecopyresampled($image, $image_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
    $txt_color = imagecolorallocate($image, 255, 255, 255);
    $shadow_color = imagecolorallocatealpha($image, 0, 0, 0, 0);
    // imagettftext($image, $font_size, 0, 30, 190, $black, $font_path, $water_mark_text_1);
    imagettftext($image, $shadow1_size, 0, $shadow1_x, $shadow1_y, $shadow_color, $font_path, $water_mark_text_2);
    imagettftext($image, $shadow2_size, 0, $shadow2_x, $shadow2_y, $shadow_color, $font_path, $water_mark_text_2);
    imagettftext($image, $font_size, 0, $txt_x, $txt_y, $txt_color, $font_path, $water_mark_text_2);
    if ($ext != "png" || $ext != "PNG") {
        imagejpeg($image, $img, 100);
    } else {
        imagepng($image, $img, 9);
    }

    imagedestroy($image);
}

function sec2timefull($timestamp, $full = true)
{
    $how_log_ago = '';
    $seconds = time() - $timestamp;
    $minutes = (int)($seconds / 60);
    $hours = (int)($minutes / 60);
    $days = (int)($hours / 24);
    if ($days >= 1) {
        $how_log_ago = $days . ($full ? ' day' : '') . ($days != 1 ? 's' : '');
    } else if ($hours >= 1) {
        $how_log_ago = $hours . ($full ? ' hour' : '') . ($hours != 1 ? 's' : '');
    } else if ($minutes >= 1) {
        $how_log_ago = $minutes . ($full ? ' min' : '') . ($minutes != 1 ? 's' : '');
    } else {
        $how_log_ago = $seconds . ($full ? ' sec' : '') . ($seconds != 1 ? 's' : '');
    }
    return $how_log_ago;
}

function create_html($tag_name = 'a', $attrs = false, $self_close = false, $tag_data = '')
{
    $data = '<' . $tag_name;
    if ($attrs !== false) {
        foreach ($attrs as $attr => $val) {
            $data .= ' ' . $attr . '="' . $val . '"';
        }
    }

    if ($tag_name == "select") {
        $ret_data = '<option value="0">' . $attrs['placeholder'] . '</option>';
        foreach ($tag_data as $opt => $val) {
            if (strpos($val, '|s')) {
                $val = explode('|', $val);
                $ret_data .= '<option value="' . $val[0] . '" selected>' . $opt . '</option>';
            } else {
                $ret_data .= '<option value="' . $val . '">' . $opt . '</option>';
            }
        }
    } else {
        $ret_data = $tag_data;
    }

    if ($self_close) {
        $data .= ' />';
    } else {
        $data .= '>' . $ret_data . '</' . $tag_name . '>';
    }
    return $data;
}


function chk_req($REQ_VAR = false, $strlen_chk = false)
{
    if ($var) {
        if (isset($_REQUEST[$var])) {
            if ($strlen_chk) {
                if (strlen($_REQUEST[$var]) > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function str_db_filter($value = '')
{
    $newVal = htmlspecialchars($newVal);
    $newVal = mysql_real_escape_string($newVal);
    return $newVal;
}

function str_idb_filter($link, $value = '')
{
    $newVal = htmlspecialchars($newVal);
    $newVal = mysqli_real_escape_string($link, $newVal);
    return $newVal;
}

function remove_querystring_var($url, $key)
{
    $url = preg_replace('/(.*)(?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&');
    $url = substr($url, 0, -1);
    return $url;
}

function remove_from_query_string($needle)
{
    $query_string = $_SERVER['QUERY_STRING']; // Work on a seperate copy and preserve the original for now
    $query_string = preg_replace("/\&" . $needle . "=[a-zA-Z0-9].*?(\&|$)/", '', $query_string);
    $query_string = preg_replace("/(&)+/", "", $query_string); // Supposed to pull out all repeating &s, however it allows 2 in a row(&&). Good enough for now
    return $query_string;
}

function chk_strlen_none($str, $none = false)
{
    if ($none) {
        $ret = (strlen(trim($str)) > 0 ? $str : $none);
    } else {
        $ret = (strlen(trim($str)) > 0 ? $str : false);
    }
    return $ret;
}

function get_field_data($type = "sql", $con = false, $tbl, $field, $where)
{
    switch ($type) {
        case "sql":
            $data = mysql_fetch_array(mysql_query("SELECT " . $field . " FROM " . $tbl . " " . $where));
            return $data;
            break;
        case "sqli":
            $data = mysqli_fetch_array(mysqli_query($con, "SELECT " . $field . " FROM " . $tbl . " " . $where));
            return $data;
            break;
        default:
            return "Invalid SQL Type";

    }
}

if (!function_exists('show_404')) {
    function show_404()
    {
        go2(cur_server() . "error/404");
    }
}

function mysql_escstr($str = '', $con = false, $type = 'n')
{

    if (strlen(trim($str)) > 0) {
        if ($type == 'n') {
            if ($con) {
                return mysql_real_escape_string($str, $con);
            } else {
                return mysql_real_escape_string($str);
            }
        } elseif ($type == 'i') {
            if ($con) {
                return mysqli_real_escape_string($con, $str);
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
}

function get_slug($tbl, $title, $id = false)
{
    $slug_temp = Slug($title);
    $sl_check = mysql_query("SELECT slug FROM " . $tbl . " WHERE slug = '" . $slug_temp . "'" . ($id ? " AND id != " . $id : ''));
    if (mysql_num_rows($sl_check) > 0) {
        $ok = 0;
        $si = 1;
        while ($ok == 0) {
            $this_slug = $slug_temp . "-" . $si;
            $siw_q = mysql_query("SELECT slug FROM " . $tbl . " WHERE slug = '" . $this_slug . "'" . ($id ? " AND id != " . $id : ''));
            if (mysql_num_rows($siw_q) == 0) {
                $slug = Slug($this_slug);
                $ok = 1;
                break;
            } else {
                $si++;
            }
        }

    } else {
        $slug = Slug($title);
    }
    return $slug;
}


function removeQueryStringParameter($url, $varname)
{
    $parsedUrl = parse_url($url);
    $query = array();

    if (isset($parsedUrl['query'])) {
        parse_str($parsedUrl['query'], $query);
        unset($query[$varname]);
    }

    $path = isset($parsedUrl['path']) ? $parsedUrl['path'] : '';
    $query = !empty($query) ? '?' . http_build_query($query) : '';

    return $path . $query;
}


function convertCurrency($from = "EUR", $to = "USD", $amount = 0)
{
    $cur = file_get_contents("https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22" . $from . $to . "%22)&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=");

    $cur = json_decode($cur);
    $rate = $cur->query->results->rate->Rate;
    $converted = $amount * $rate;
    return $converted;
}

function check_not_empty($s, $include_whitespace = false)
{
    if ($include_whitespace) {
        // make it so strings containing white space are treated as empty too
        $s = trim($s);
    }
    return (isset($s) && strlen($s)); // var is set and not an empty string ''
}

function array_preview($array = false)
{
    if ($array !== false) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
}

function random_text($type = 'alnum', $length = 8)
{
    switch ($type) {
        case 'alnum':
            $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 'alpha':
            $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 'hexdec':
            $pool = '0123456789abcdef';
            break;
        case 'numeric':
            $pool = '0123456789';
            break;
        case 'nozero':
            $pool = '123456789';
            break;
        case 'distinct':
            $pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
            break;
        default:
            $pool = (string)$type;
            break;
    }


    $crypto_rand_secure = function ($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int)($log / 8) + 1; // length in bytes
        $bits = (int)$log + 1; // length in bits
        $filter = (int)(1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    };

    $token = "";
    $max = strlen($pool);
    for ($i = 0; $i < $length; $i++) {
        $token .= $pool[$crypto_rand_secure(0, $max)];
    }
    return $token;
}

if (!function_exists('get_value')) {
    function get_value($field = '', $default = '')
    {
        if (!isset($_POST[$field])) {
            if (count($_POST) === 0 AND $default !== '') {
                return $default;
            }
            return '';
        }

        return $_POST[$field];
    }
}
?>