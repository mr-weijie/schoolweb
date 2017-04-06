<?PHP include 'Inc/conn.php';?>
<SCRIPT language=javascript src="js/std.js"></SCRIPT>
<LINK rel=stylesheet type=text/css href="css/style.css">
<style type="text/css">
.title
{
	background: #ffffff url(/SysImages/topbg.gif) repeat-x 0 -3px;
}
.title TD
{
	font-size: 10pt;
	font-family: 宋体;
	color: #333333;
	font-weight:bolder;
}
.LW_TR TD
{
	border-bottom: 1px solid #dddddd;
}
.LW_TR .td1
{
	padding-left: 10px;
	padding-right: 2px;
}
.LW_TR .td2
{
	width:115px;
}
.LW_TR .td3
{
	width:70px;
	text-align: center;
}
TD.LWContent
{
    PADDING-RIGHT:35px;
    LINE-HEIGHT:135%;
}
.NewsPageNo  span
{
	color: cdcdcd;
}
</style>
<?php
	$Nums=10;//每页最多显示信息条数
	$CurPage= trim($_GET['CurPage']);
	if(strlen($CurPage)==0) $CurPage= trim($_POST['CurPage']);
	if($CurPage=='') $CurPage=1;
	$SqlStr="SELECT count(*) As Recs from leaveword";
	$rs = mysql_query($SqlStr);
	$row = mysql_fetch_array($rs);
	$Recs=$row['Recs'];
	mysql_free_result($rs);
	$pages=round($Recs/$Nums+0.499);//总页数
	if($CurPage>$pages) $CurPage=$pages;
?>
<table width="95%" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr height="35">
		<td valign="bottom" align="right" style="padding-bottom:2px;">&nbsp;
		<img height="24" width="24" src="./SysImages/LW.jpg" style="position:relative;top:5px;">&nbsp;<a style="color:#EB713E;font-size:10pt;" href="/yhly.php" title="我要留言">我要留言</a>&nbsp;
		</td>
	</tr>
	<tr>
		<td width="100%" bgcolor="#ffffff" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #dddddd;border-bottom:0;">
			<tbody>
            <tr width="100%" height="32" class="title">
				<td style="padding-left:40px;">主&nbsp;题</td>
				<td>留言人</td>
				<td align="center">时间</td>
			</tr>
		<?php 
	  			$SqlStr="SELECT ID,RowID,Name,title,Content,DateTime from leaveword Order by DateTime DESC limit ".($CurPage-1)*$Nums.",".$Nums;
				$rs = mysql_query($SqlStr);
				$XH=0;
 		  		while($row = mysql_fetch_array($rs)) 
						{
							$XH++;
							$ID=$row['ID'];
							$RowID=$row['RowID'];
							$Name=$row['Name'];
							$title=$row['title'];
							$Content=$row['Content'];
							$DateTime=$row['DateTime'];
				echo '<tr id="question'.$XH.'" class="LW_TR" width="100%" height="40" valign="middle" style="cursor: pointer; background: rgb(255, 255, 255); color: rgb(83, 130, 158);" title="点击展开此留言" onClick="ShowLeaveWord('.$XH.')" onMouseMove="onMoveTR(this)" onMouseOut="this.style.background=&#39;#ffffff&#39;;this.style.color=&#39;#53829e&#39;">';
				echo '<td class="td1"><img width="20" height="20" border="0" id="img'.$XH.'" src="./SysImages/letter1.gif" style="position:relative;top:2px;">&nbsp;'.$title.'</td>';	
				echo '<td class="td2">'.$Name.'</td>';
				echo '<td class="td3" align="center">'.$DateTime.'</td>';
				echo '</tr>';
				echo '<tr width="100%" id="answer'.$XH.'" style="display: none;">';
				echo '<td width="100%" colspan="3" style="BORDER-BOTTOM:1px solid #cccccc;">';
				echo '<div style="padding-left:20px;background-color:#fafafa;padding-top:10px;padding-bottom:10px;"><br />';
				echo '<table width="100%" cellspacing="0" cellpadding="0" border="0" style="color:#393939;">';
				echo '<tbody><tr>';
				echo '			<td width="55"><b>留言人：</b></td>';
				echo '			<td>'.$Name.'</td>';
				echo '		</tr>';
				echo '		<tr>';
				echo '			<td><b>时&nbsp;&nbsp;间：</b></td>';
				echo '			<td>'.$DateTime.'</td>';
				echo '		</tr>';
				echo '		<tr>';
				echo '			<td valign="top"><b>内&nbsp;&nbsp;容：</b></td>';
				echo '			<td valign="top" class="LWContent">'.$Content.'</td>';
				echo '		</tr>';
				echo '	</tbody></table>';
				echo '	</div>';					
				echo '	</td></tr>';
			}
			?>
			</tbody></table>
		</td>
	</tr>
				
	<tr height="9">
		<td colspan="3" align="right">
        <?php 
				if($pages>1)
				{
					if($CurPage==1)
					{
						echo '<A href="LiuYanList.php?CurPage=2">下一页</A>&nbsp;|&nbsp;';
					}else
					{
						echo '<A href="LiuYanList.php?CurPage='.($CurPage-1).'">上一页</A>&nbsp;|&nbsp;';
						if($CurPage<$pages) echo '<A href="LiuYanList.php?CurPage='.($CurPage+1).'">下一页</A>&nbsp;|&nbsp;';
					}
					echo '&nbsp;总共'.$pages.'页</td>';
				}
				mysql_free_result($rs);

 ?> 
  	  </td>
	</tr>				
</tbody></table>
      



<script language="javascript">
<!--
function ShowLeaveWord(id)
{
	obj = document.getElementById("question"+id);
	answerId=document.getElementById("answer"+id);
	imgId=document.getElementById("img"+id)
	{
		if(answerId.style.display=="none")
		{	
			if(document.all)
			{
				answerId.style.display = "block";
			}
			else
			{
				answerId.style.display = "table-row";
			}
			obj.title="点击折叠此留言";
			imgId.src="/SysImages/letter2.gif";
		}
		else
		{
			answerId.style.display="none";
			obj.title="点击展开此留言";
			imgId.src="/SysImages/letter1.gif";
		}
	}
}
function onMoveTR(obj)
{
	obj.style.background='#eeeeee';obj.style.color='#f38401'
}
function checkPageNum()
{	
	var number=document.pageSel.elements["PageNo"].value;
	if(number=="")
	{
		alert("页码不能为空，请输入页码");
		document.pageSel.elements["PageNo"].focus();
		return false;
	}
	for(var i=0;i<number.length;i++)
	{
		if(number.charAt(i)<"0" || number.charAt(i)>"9")
		{
			alert("只能输入数字页码");
			document.pageSel.elements["PageNo"].select();
			return false;
		}
	}
	document.pageSel.submit();	
	return true;
}
-->
</script>