<?php 
header("Content-Type: text/html;charset=utf-8");
include_once("../../conn.php");
include_once("../../function.php");
if($_POST['import']=="导入数据"){
    
    $leadExcel=$_POST['leadExcel'];

    if($leadExcel == "true")
    {
       // var_dump($_FILES["file"]["error"] );die;
        if ($_FILES["file"]["error"] > 0){
            echo "<script language=javascript>alert('请选择导入的表格！');window.location.href='../daorushuju.php?'</script>";
            return ;
        }
        $string = strrev($_FILES['file']['name']);
        $array = explode('.',$string);//后缀
        if ($array[0] <> "xslx"){
            echo "<script language=javascript>alert('上传失败，请选择xlsx后缀的表格重试！');window.location.href='../daorushuju.php?'</script>";
            return ;
        }
        //echo "OK";die();
        //获取上传的文件名
       
        $file = $_FILES["file"]["name"];
    
        // var_dump($file);die;
        //上传到服务器上的临时文件名
        $filetempname = $_FILES['file']['tmp_name'];
       // var_dump($filetempname);die;
       
        //自己设置的上传文件存放路径
        $filePath = 'upFile/';
        $str = "";
        //下面的路径按照你PHPExcel的路径来修改
        set_include_path('.'. PATH_SEPARATOR .dirname(__FILE__). PATH_SEPARATOR .get_include_path());
        require_once 'PHPExcel.php';
        require_once 'PHPExcel\IOFactory.php';
        //require_once 'PHPExcel\Reader\Excel5.php';//excel 2003
        require_once 'PHPExcel\Reader\Excel2007.php';//excel 2007
        
        $filename=explode(".",$file);//把上传的文件名以“.”好为准做一个数组。
        $time=date("y-m-d-H-i-s");//去当前上传的时间
        $filename[0]=$time;//取文件名t替换
        $name=implode(".",$filename); //上传后的文件名
        $uploadfile=$filePath.$name;//上传后的文件名地址
        
        
        //move_uploaded_file() 函数将上传的文件移动到新位置。若成功，则返回 true，否则返回 false。
        $result=move_uploaded_file($filetempname,$uploadfile);//假如上传到当前目录下
        if($result) //如果上传文件成功，就执行导入excel操作
        {
            //$objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2003
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2003 和 2007 format
            //$objPHPExcel = $objReader->load($uploadfile); //这个容易造成httpd崩溃
            $objPHPExcel = PHPExcel_IOFactory::load($uploadfile);//改成这个写法就好了
            
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
            
           
            //循环读取excel文件,读取一条,插入一条
            for($j=2;$j<=$highestRow;$j++)
            {
                for($k='A';$k<=$highestColumn;$k++)
                {
                    $str .= iconv('utf-8','utf-8',$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue()).'\\';//读取单元格
                }
                //explode:函数把字符串分割为数组。
                $strs = explode("\\",$str);
                
                $in= getOne("select id from inorders where ordersnumber='{$strs[0]}'");
                if($in){
                    edit_delete_cl('inorders',$in['id']);
                }
                $sql = "INSERT INTO inorders(ordersnumber,lx,logistics,logisticsno) VALUES('".$strs[0]."','".$strs[1]."','".$strs[2]."','".$strs[3]."')";
                
//                @mysql_connect("localhost", "root","123456") //选择数据库之前需要先连接数据库服务器
//                or die("数据库服务器连接失败");
//                @mysql_select_db("20190405")                    //选择数据库mydb
//                or die("数据库不存在或不可用");
//                //$query = @mysql_query($sql)
//                //or die("SQL语句执行失败");
//        
//                mysql_query("set names 'UTF8'");//这就是指定数据库字符集，一般放在连接数据库后面就系了
                
                if(!mysql_query($sql)){
                    return false;
                }
                //echo $str;
                echo "<br>";
                $str = "";
            }
            
            unlink($uploadfile); //删除上传的excel文件
            $msg = "导入成功！";
            
           
             echo "<script language=javascript>alert('导入成功.');window.location.href='../daorushuju.php?'</script>";
              
        }else{
            $msg = "导入失败！";
            echo "<script language=javascript>alert('导入失败.');window.location.href='../daorushuju.php?'</script>";
        }
       
        
    }
}
?>

