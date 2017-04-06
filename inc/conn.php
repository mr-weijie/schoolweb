<?php
ini_set('max_execution_time', 100);//最长超时等待时间为100秒
session_start();//启用session
$host='localhost';
$user='root';
$password='root';
$database='ctschool';
$conn=mysql_connect($host,$user,$password);
mysql_query("set names 'utf8'",$conn); //解决乱码 
mysql_select_db($database,$conn); 
Counter();//调用计数器
$SqlStr="SELECT SchoolName,SchoolAddress,HeadMasterEmail,Counter,TechSupport from schoolinfo ";
$rs = mysql_query($SqlStr);
if($rs!='')
{
	$row = mysql_fetch_array($rs); 
	$SchoolName=$row['SchoolName'];
	$SchoolAddress=$row['SchoolAddress'];
	$HeadMasterEmail=$row['HeadMasterEmail'];
	$Counter=$row['Counter'];
	$TechSupport=$row['TechSupport'];
}
mysql_free_result($rs);


function WriteRowID($TableName)//查检目标表中的RowId是否有空值，如果有，则自动填入
{
  		$SqlStr="SELECT RowID,Id from ".$TableName." Where ISNULL(RowID) OR RowID=''";
  		$rs = mysql_query($SqlStr);
		$I=0;
  		while($row = mysql_fetch_array($rs)) 
			{
				$Id=$row['Id'];
				$RowID=strtoupper(md5(strval($Id)));//最后转换成大写
				$SqlStr="Update ".$TableName." set RowID='".$RowID."' where Id='".$Id."'";
				mysql_query($SqlStr);
			}
		mysql_free_result($rs);
}                 

function getIP() 
{ 
	if (getenv('HTTP_CLIENT_IP')) 
	{ 
		$ip = getenv('HTTP_CLIENT_IP'); 
	}elseif (getenv('HTTP_X_FORWARDED_FOR')) 
	{ 
		$ip = getenv('HTTP_X_FORWARDED_FOR'); 
	}elseif (getenv('HTTP_X_FORWARDED')) 
	{ 
		$ip = getenv('HTTP_X_FORWARDED'); 
	}elseif (getenv('HTTP_FORWARDED_FOR')) 
	{ 
		$ip = getenv('HTTP_FORWARDED_FOR'); 
	}elseif (getenv('HTTP_FORWARDED')) 
	{ 
		$ip = getenv('HTTP_FORWARDED'); 
	}else 
	{ 
		$ip = $_SERVER['REMOTE_ADDR']; 
	}
	
	return $ip; 
} 
function Counter()//记数器
{
	if(strlen($_SESSION['Visitor'])==0)//同一个人只计算一次来访
	{
		$SqlStr="Update Schoolinfo Set Counter=Counter+1 ";
		$rs = mysql_query($SqlStr);
		mysql_free_result($rs);
		$_SESSION['Visitor']='guest';
	}
}
?>