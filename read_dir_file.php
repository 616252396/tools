<?php
//遍历当前目录下所有文件的和目录，并以树装形式显示
//1.打开目录句柄，获取句柄资源
//2.读取句柄资源，并显示当前和子目录下的（目录和文件名称）
function href($url,$name,$count=''){
    $url=urlencode("http://".$_SERVER['HTTP_HOST']."/".str_replace("/data/code/md/","",$url));
    echo $count."<a href=/api.php?url=".$url.">".$name."</a>";
}

function getDirFile($path){
    if($file_handler=opendir($path)){
        while(false !== ($file=readdir($file_handler))){

            if($file!="." && $file!=".."){
                if(is_dir("$path/$file")){

                    if(substr_count("$path/$file","/")>1){
                        $count=str_repeat("&nbsp&nbsp&nbsp&nbsp",substr_count("$path/$file","/"));
                        echo $count.$file;

                    }else{
                        echo $file;

                    }
                    echo "<br/>";
                    getDirFile("$path/$file");

                }else{
                    if(strpos($file,'.md') !== false && $file != 'readme.md'){
                        if(substr_count("$path/$file","/")>1){
                            $count=str_repeat("&nbsp&nbsp&nbsp&nbsp",substr_count("$path/$file","/"));
//                            href ("$path/$file",$file,$count);
                            echo "$path/$file";
                        }else{
                            echo $file;

                        }
                        echo "<br/>";

                    }



                }

            }
        }
    }
}


$arr=getDirFile("/data/git/RenZhengfei");
print_r($arr);die;