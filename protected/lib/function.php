<?php

//将对象转换为数组
function object_to_array($obj){

    $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
    foreach ($_arr as $key => $val){
        $val = (is_array($val) || is_object($val)) ? object_to_array($val) : $val;
        $arr[$key] = $val;
    }
    return $arr;
}

function dump($var, $exit = false){
    $output = print_r($var, true);
    if(!$GLOBALS['debug'])return error_log(str_replace("\n", '', $output));
    echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"></head><body><div align=left><pre>" .htmlspecialchars($output). "</pre></div></body></html>";
    if($exit) exit();
}

function is_available_classname($name){
    return preg_match('/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $name);
}

function arg($name = null, $default = null, $trim = false) {
    if($name){
        if(!isset($_REQUEST[$name]))return $default;
        $arg = $_REQUEST[$name];
        if($trim)$arg = trim($arg);
    }else{
        $arg = $_REQUEST;
    }
    return $arg;
}
/*
 * 输出标题处理
*/
function tsTitle($title) {
    $title = stripslashes($title);
    $title = htmlspecialchars($title);
    return $title;
}

/*
 * 输出内容截取
*/
function tsCutContent($text, $length = 50) {
    $text = cututf8(t(tsDecode($text)), 0, $length);
    return $text;
}
/**
 * 处理时间的函数
 * @param unknown $btime
 * @param unknown $etime
 * @return string
 */
function getTime($btime, $etime = null) {
    if ($etime == null)
        $etime = time();
    if ($btime < $etime) {
        $stime = $btime;
        $endtime = $etime;
    } else {
        $stime = $etime;
        $endtime = $btime;
    }
    $timec = $endtime - $stime;
    $days = intval($timec / 86400);
    $rtime = $timec % 86400;
    $hours = intval($rtime / 3600);
    $rtime = $rtime % 3600;
    $mins = intval($rtime / 60);
    $secs = $rtime % 60;
    if ($days >= 1) {
        return $days . ' 天前';
    }
    if ($hours >= 1) {
        return $hours . ' 小时前';
    }

    if ($mins >= 1) {
        return $mins . ' 分钟前';
    }
    if ($secs >= 1) {
        return $secs . ' 秒前';
    }
}
/**
 * ThinkSAAS专用图片截图函数
 * @param unknown $file	数据库里的图片url
 * @param unknown $app	app名称
 * @param unknown $w	缩略图片宽度
 * @param unknown $h	缩略图片高度
 * @param string $path
 * @param string $c	1裁切,0不裁切
 * @return void|string
 */
function tsXimg($file, $app, $w, $h, $path = '', $c = '0') {

    if (!$file) {
        return false;
    } else {

        //$info = explode ( '.', $file );
        //$name = md10 ( $file ) . '_' . $w . '_' . $h . '.' . $info [1];

        $info = explode('/', $file);
        $name = $info[2];

        if ($path == '') {
            $cpath = 'cache/' . $app . '/' . $w . '/' . $name;
        } else {
            $cpath = 'cache/' . $app . '/' . $path . '/' . $w . '/' . $name;
        }
        
        if (!is_file($cpath)) {
            createFolders('cache/' . $app . '/' . $path . '/' . $w);
            $dest = 'upload/' . $app . '/' . $file;
            $arrImg = getimagesize($dest);
            if ($arrImg[0] <= $w) {
                copy($dest, $cpath);
            } else {
                $resizeimage = new tsImage("$dest", $w, $h, $c, "$cpath");
            }
        }

        return APP_DIR . '/'. $cpath;

    }
}
function createFolders($path) {
    // 递归创建
    if (!file_exists($path)) {
        createFolders(dirname($path));
        // 取得最后一个文件夹的全路径返回开始的地方
        mkdir($path, 0777);
    }
}
/*
 * @text 内容
* @tp 内容分页
* @url URL
*/
function tsDecode($text, $tp = 1) {
    $text = trim($text);
    $text = html_entity_decode(stripslashes($text), ENT_NOQUOTES, "utf-8");
    $text = str_replace('<br /><br />', '<br />', $text);

    //分页处理
    $arrText = explode('_ueditor_page_break_tag_', $text);

    if ($arrText) {
        $tp = $tp - 1;
        $text = $arrText[$tp];
    }

    return $text;
}
/*
 * tpCount()
*/
function tpCount($text) {
    $arrText = explode('_ueditor_page_break_tag_', $text);
    return count($arrText);
}/**
* 纯文本输入
* @param unknown $text
* @return mixed
*/
function t($text) {
    $text = tsDecode($text);
    $text = @preg_replace('/\[.*?\]/is', '', $text);
    $text = cleanJs($text);
    // 彻底过滤空格BY QINIAO
    $text = @preg_replace('/\s(?=\s)/', '', $text);
    $text = @preg_replace('/[\n\r\t]/', ' ', $text);
    $text = str_replace('  ', ' ', $text);
    // $text = str_replace ( ' ', '', $text );
    $text = str_replace('&nbsp;', '', $text);
    $text = str_replace('&', '', $text);
    $text = str_replace('=', '', $text);
    $text = str_replace('-', '', $text);
    $text = str_replace('#', '', $text);
    $text = str_replace('%', '', $text);
    $text = str_replace('!', '', $text);
    $text = str_replace('@', '', $text);
    $text = str_replace('^', '', $text);
    $text = str_replace('*', '', $text);
    $text = str_replace('amp;', '', $text);

    $text = str_replace('position', '', $text);

    $text = strip_tags($text);
    $text = htmlspecialchars($text);
    $text = str_replace("'", "", $text);
    return $text;
}/**
* 过滤脚本代码
* @param unknown $text
* @return mixed
*/
function cleanJs($text) {
    $text = trim($text);
    //$text = stripslashes ( $text );
    // 完全过滤注释
    $text = @preg_replace('/<!--?.*-->/', '', $text);
    // 完全过滤动态代码
    $text = @preg_replace('/<\?|\?>/', '', $text);
    // 完全过滤js
    $text = @preg_replace('/<script?.*\/script>/', '', $text);
    // 过滤多余html
    $text = @preg_replace('/<\/?(html|head|meta|link|base|body|title|style|script|form|iframe|frame|frameset|math|maction|marquee)[^><]*>/i', '', $text);
    // 过滤on事件lang js
    while (preg_match('/(<[^><]+)(data|onmouse|onexit|onclick|onkey|onsuspend|onabort|onactivate|onafterprint|onafterupdate|onbeforeactivate|onbeforecopy|onbeforecut|onbeforedeactivate|onbeforeeditfocus|onbeforepaste|onbeforeprint|onbeforeunload|onbeforeupdate|onblur|onbounce|oncellchange|onchange|onclick|oncontextmenu|oncontrolselect|oncopy|oncut|ondataavailable|ondatasetchanged|ondatasetcomplete|ondblclick|ondeactivate|ondrag|ondragend|ondragenter|ondragleave|ondragover|ondragstart|ondrop|onerror|onerrorupdate|onfilterchange|onfinish|onfocus|onfocusin|onfocusout|onhelp|onkeydown|onkeypress|onkeyup|onlayoutcomplete|onload|onlosecapture|onmousedown|onmouseenter|onmouseleave|onmousemove|onmouseout|onmouseover|onmouseup|onmousewheel|onmove|onmoveend|onmovestart|onpaste|onpropertychange|onreadystatechange|onreset|onresize|onresizeend|onresizestart|onrowenter|onrowexit|onrowsdelete|onrowsinserted|onscroll|onselect|onselectionchange|onselectstart|onstart|onstop|onsubmit|onunload)[^><]+/i', $text, $mat)) {
        $text = str_replace($mat[0], $mat[1], $text);
    }
    while (preg_match('/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i', $text, $mat)) {
        $text = str_replace($mat[0], $mat[1] . $mat[3], $text);
    }
    return $text;
}/**
* 把数组转换为,号分割的字符串
* @param unknown $arr
* @return Ambigous <string, unknown>
*/
function arr2str($arr) {
    $str = '';
    $count = 1;
    if (is_array($arr)) {
        foreach ($arr as $a) {
            if ($count == 1) {
                $str .= $a;
            } else {
                $str .= ',' . $a;
            }
            $count++;
        }
    }
    return $str;
}
/**
 * utf-8截取
 * @param unknown $string
 * @param number $start
 * @param unknown $sublen
 * @param string $append
 * @return string
 */
function cututf8($string, $start = 0, $sublen, $append = true) {
    $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
    preg_match_all($pa, $string, $t_string);
    if (count($t_string[0]) - $start > $sublen && $append == true) {
        return join('', array_slice($t_string[0], $start, $sublen)) . "...";
    } else {
        return join('', array_slice($t_string[0], $start, $sublen));
    }
}
function is404($id){
    //内容不存在 返回404
    $id = intval($id);
    if ($id == 0) {
        header ( "HTTP/1.1 404 Not Found" );
        header ( "Status: 404 Not Found" );
        $title = '404';
        include_once '404.html';
        exit ();
    }
}

/**
 * 生成随机数(1数字,0字母数字组合)
 * @param unknown $length
 * @param number $numeric
 * @return string
 */
function random($length, $numeric = 0) {
    PHP_VERSION < '4.2.0' ? mt_srand(( double ) microtime() * 1000000) : mt_srand();
    $seed = base_convert(md5(print_r($_SERVER, 1) . microtime()), 16, $numeric ? 10 : 35);
    $seed = $numeric ? (str_replace('0', '', $seed) . '012340567890') : ($seed . 'zZ' . strtoupper($seed));
    $hash = '';
    $max = strlen($seed) - 1;
    for ($i = 0; $i < $length; $i++) {
        $hash .= $seed[mt_rand(0, $max)];
    }
    return $hash;
}
// 弹出信息返回
function msgBack($msg)
{
    echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>function sptips(){alert(\"{$msg}\");window.history.back();}</script></head><body onload=\"sptips()\"></body></html>";
    exit();
}
// 弹出信息跳转
function msgJump($msg, $url, $parent = 0)
{
    if ($parent == 1) {
        echo "<html><head><script>" . "function go(){alert(\"{$msg}\");window.top.document.location.href = '$url';}" . "</script></head><body onload='go();'></body></html>";
    } else {
        echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>function sptips(){alert(\"{$msg}\");location.href=\"{$url}\";}</script></head><body onload=\"sptips()\"></body></html>";
    }
    exit();
}

//$count为总条目数，$page为当前页码，$page_size为每页显示条目数<br />
function show_page($count,$page,$page_size)
{
    $page_count  = ceil($count/$page_size);  //计算得出总页数

    $init=1;
    $page_len=7;
    $max_p=$page_count;
    $pages=$page_count;

    //判断当前页码
    $page=(empty($page)||$page<0)?1:$page;
    //获取当前页url
    $url = $_SERVER['REQUEST_URI'];
    //去掉url中原先的page参数以便加入新的page参数
    $parsedurl=parse_url($url);
    $url_query = isset($parsedurl['query']) ? $parsedurl['query']:'';
    if($url_query != ''){
        $url_query = preg_replace("/(^|&)page=$page/",'',$url_query);
        $url = str_replace($parsedurl['query'],$url_query,$url);
        if($url_query != ''){
            $url .= '&';
        }
    } else {
        $url .= '?';
    }
     
    //分页功能代码
    $page_len = ($page_len%2)?$page_len:$page_len+1;  //页码个数
    $pageoffset = ($page_len-1)/2;  //页码个数左右偏移量

    $navs='';
    if($pages != 0){
        if($page!=1){
            $navs.="<a href=\"".$url."page=1\">首页</a> ";        //第一页
            $navs.="<a href=\"".$url."page=".($page-1)."\">上页</a>"; //上一页
        } else {
            $navs .= "<a>首页</a>";
            $navs .= "<a>上页</a>";
        }
        if($pages>$page_len)
        {
            //如果当前页小于等于左偏移
            if($page<=$pageoffset){
                $init=1;
                $max_p = $page_len;
            }
            else  //如果当前页大于左偏移
            {
                //如果当前页码右偏移超出最大分页数
                if($page+$pageoffset>=$pages+1){
                    $init = $pages-$page_len+1;
                }
                else
                {
                    //左右偏移都存在时的计算
                    $init = $page-$pageoffset;
                    $max_p = $page+$pageoffset;
                }
            }
        }
        for($i=$init;$i<=$max_p;$i++)
        {
            if($i==$page){$navs.="<a ><font color='#FF0000'>".$i.'</font></a>';}
            else {$navs.=" <a href=\"".$url."page=".$i."\">".$i."</a>";}
        }
        if($page!=$pages)
        {
            $navs.=" <a href=\"".$url."page=".($page+1)."\">下页</a> ";//下一页
            $navs.="<a href=\"".$url."page=".$pages."\">末页</a>";    //最后一页
        } else {
            $navs .= "<a class='disabled'>下页</a>";
            $navs .= "<a class='disabled'>末页</a>";
        }
        return "$navs";
    }
}
//$count为总条目数，$page为当前页码，$page_size为每页显示条目数<br />
function page($count,$page,$page_size)
{
    $page_count  = ceil($count/$page_size);  //计算得出总页数

    $init=1;
    $page_len=7;
    $max_p=$page_count;
    $pages=$page_count;

    //判断当前页码
    $page=(empty($page)||$page<0)?1:$page;
    //获取当前页url
    $url = $_SERVER['REQUEST_URI'];
    //去掉url中原先的page参数以便加入新的page参数
    $parsedurl=parse_url($url);
    $url_query = isset($parsedurl['query']) ? $parsedurl['query']:'';
    if($url_query != ''){
        $url_query = preg_replace("/(^|&)page=$page/",'',$url_query);
        $url = str_replace($parsedurl['query'],$url_query,$url);
        if($url_query != ''){
            $url .= '&';
        }
    } else {
        $url .= '?';
    }
     
    //分页功能代码
    $page_len = ($page_len%2)?$page_len:$page_len+1;  //页码个数
    $pageoffset = ($page_len-1)/2;  //页码个数左右偏移量

    $navs='';
    if($pages != 0){
        if($page!=1){
            $navs.="<a href=\"".$url."page=1\">首页</a> ";        //第一页
            $navs.="<a href=\"".$url."page=".($page-1)."\">上页</a>"; //上一页
        } else {
            $navs .= "<a>首页</a>";
            $navs .= "<a>上页</a>";
        }
        if($pages>$page_len)
        {
            //如果当前页小于等于左偏移
            if($page<=$pageoffset){
                $init=1;
                $max_p = $page_len;
            }
            else  //如果当前页大于左偏移
            {
                //如果当前页码右偏移超出最大分页数
                if($page+$pageoffset>=$pages+1){
                    $init = $pages-$page_len+1;
                }
                else
                {
                    //左右偏移都存在时的计算
                    $init = $page-$pageoffset;
                    $max_p = $page+$pageoffset;
                }
            }
        }
        for($i=$init;$i<=$max_p;$i++)
        {
            if($i==$page){$navs.="<span>".$i.'</span>';}
            else {$navs.=" <a href=\"".$url."page=".$i."\">".$i."</a>";}
        }
        if($page!=$pages)
        {
            $navs.=" <a href=\"".$url."page=".($page+1)."\">下页</a> ";//下一页
            $navs.="<a href=\"".$url."page=".$pages."\">末页</a>";    //最后一页
        } else {
            $navs .= "<a class='disabled'>下页</a>";
            $navs .= "<a class='disabled'>末页</a>";
        }
        return "$navs";
    }
}