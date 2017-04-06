<?PHP include 'Inc/conn.php';?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<LINK rel=stylesheet type=text/css href="css/style.css">
<script type="text/javascript" src="js/Dialog.js"></script>
<script type="text/javascript" src="js/zOpenD.js"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" scroll="NO">
<?php 
$Nums=25;//每页最多显示信息条数
$Flag= trim($_GET['flag']);
$CurPage= trim($_GET['CurPage']);
if(strlen($Flag)==0) $Flag= trim($_POST['flag']);
if(strlen($CurPage)==0) $CurPage= trim($_POST['CurPage']);

if($CurPage=='') $CurPage=1;
$SearchItem=trim($_POST['SearchItem']);
$SearchType=trim($_POST['SearchType']);
$KeyWord=trim($_POST['KeyWord']);
$ConStr="";
if(strlen($KeyWord)>0)
{
	if($SearchType=="0")
	{
		$ConStr=$SearchItem."='".$KeyWord."'";
	}else
	{
		$ConStr=$SearchItem." like '%".$KeyWord."%'";
	}
}
if(strlen($ConStr)>0)
{
	$SqlStr="SELECT count(*) As Recs from qikan Where ".$ConStr;
	
}else
{
	$SqlStr="SELECT count(*) As Recs from qikan";
}

$rs = mysql_query($SqlStr);
$row = mysql_fetch_array($rs);
$Recs=$row['Recs'];
mysql_free_result($rs);
$pages=round($Recs/$Nums+0.499);//总页数
if($CurPage>$pages) $CurPage=$pages;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ManageList">
  <tbody><tr>
    <td>
      <table width="100%" border="0" cellspacing="1" cellpadding="2">
		<tbody><tr>
		  <th>编号</th>
		  <th>期刊名</th>
		  <th>期刊号</th>
		  <th>出版社</th>
		</tr>
         		<?php 
				if(strlen($ConStr)>0)
				{
 		  			$SqlStr="SELECT RowID,ISDN,Name,KanHao,Publish from qikan Where ".$ConStr." Order by ID limit ".($CurPage-1)*$Nums.",".$Nums;
				}else
				{
 		  			$SqlStr="SELECT RowID,ISDN,Name,KanHao,Publish from qikan Order by ID limit ".($CurPage-1)*$Nums.",".$Nums;
				}
		  		$rs = mysql_query($SqlStr);
				$XH=0;
 		  		while($row = mysql_fetch_array($rs)) 
						{
							$XH++;
							$RowID=$row['RowID'];
							$ISDN=$row['ISDN'];
							$Name=$row['Name'];
							$KanHao=$row['KanHao'];
							$Publish=$row['Publish'];
							
							echo '<tr style="cursor:hand" ><td>'.$ISDN.'</td><td>'.$Name.'</td><td>'.$KanHao.'</td><td>'.$Publish.'</td></tr>';
						}
			    echo '<tr class="ManagePage">';
				if($pages>1)
				{
					if($CurPage==1)
					{
						echo '<td colspan="20" height="22" align="right"><A href="qikanlist.php?flag='.$Flag.'&CurPage=2">下一页</A>&nbsp;|&nbsp;';
					}else 
					{
						echo '<td colspan="20" height="22" align="right"><A href="qikanlist.php?flag='.$Flag.'&CurPage='.($CurPage-1).'">上一页</A>&nbsp;|&nbsp;';
						if($CurPage<$pages) echo '<A href="qikanlist.php?flag='.$Flag.'&CurPage='.($CurPage+1).'">下一页</A>&nbsp;|&nbsp;';
					}
					echo '&nbsp;总共'.$pages.'页</td>';
				}
				mysql_free_result($rs);

 ?>       
      </tbody></table>
    </td>
  </tr>  
  
</tbody></table>


</body></html>