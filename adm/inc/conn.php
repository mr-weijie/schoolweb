<?php
ini_set('max_execution_time', 100);//最长超时等待时间为100秒
$host='localhost';
$user='root';
$password='root';
$database='ctschool';
$conn=mysql_connect($host,$user,$password);
mysql_query("set names 'utf8'",$conn); //解决乱码 
mysql_select_db($database,$conn); 
?>
<?php 
function DeleteRecord($TableName,$DelID)//删除目标表记录
{
	$arr = explode(',',$DelID);
  	foreach($arr as $RowID)
	{
		$SqlStr="Delete from ".$TableName." where RowID='".$RowID."'";
		$rs = mysql_query($SqlStr);
	}
}              

?>