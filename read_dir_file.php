<?php
//遍历当前目录下所有文件的和目录，并以树装形式显示
//1.打开目录句柄，获取句柄资源
//2.读取句柄资源，并显示当前和子目录下的（目录和文件名称）
function href($url, $name, $count = '')
{
    $url = urlencode("http://" . $_SERVER['HTTP_HOST'] . "/" . str_replace("/data/code/md/", "", $url));
    echo $count . "<a href=/api.php?url=" . $url . ">" . $name . "</a>";
}

function out($path = "/data/git/RenZhengfei/2013/20131105_在GTS网规网优业务座谈会上的讲话.md")
{
    $cmd = "say -o 1.m4a -f " . $path;
    system($cmd);
    $arr=explode('/',$path);
    $cmd = "mkdir /data/code/tools/ren/".$arr[4];
    system($cmd);
    $path = str_replace('git/RenZhengfei', 'code/tools/ren', $path);
    $path = str_replace('.md', '.mp3', $path);
    $cmd = "ffmpeg -i 1.m4a " . $path;
    print_r($cmd);
    system($cmd);
    system("rm -rf 1.m4a");


}

function getDirFile($path)
{
    if ($file_handler = opendir($path)) {
        while (false !== ($file = readdir($file_handler))) {

            if ($file != "." && $file != "..") {
                if (is_dir("$path/$file")) {

                    if (substr_count("$path/$file", "/") > 1) {
                        $count = str_repeat("&nbsp&nbsp&nbsp&nbsp", substr_count("$path/$file", "/"));
                        echo $count . $file;

                    } else {
                        echo $file;

                    }
                    echo "<br/>";
                    getDirFile("$path/$file");

                } else {
                    if (strpos($file, '.md') !== false) {
                        if (substr_count("$path/$file", "/") > 1) {
                            $count = str_repeat("&nbsp&nbsp&nbsp&nbsp", substr_count("$path/$file", "/"));
//                            href ("$path/$file",$file,$count);
                            out("$path/$file");
                        } else {
//                            echo $file;

                        }
                        echo "<br/>";

                    }


                }

            }
        }
    }
}

$arr=getDirFile("/data/git/RenZhengfei");
