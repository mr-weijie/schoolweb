<?PHP include '../Inc/conn.php';?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>系统管理——滚动图片设置</title>
<script language="javascript" src="/js/std.js"></script>
<link rel="stylesheet" href="/css/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0">
<?php 
$Act= trim($_POST['act']);
if($Act==1)//说明是提交来的数据
{
	$ModeName= trim($_POST['ModeName']);
	$MarqueeWidth= trim($_POST['MarqueeWidth']);
	$MarqueeHeight= trim($_POST['MarqueeHeight']);
	$PicWidth= trim($_POST['PicWidth']);
	$PicHeight= trim($_POST['PicHeight']);
	$TextLength= trim($_POST['TextLength']);
	$PicNumber= trim($_POST['PicNumber']);
	$Speed= trim($_POST['Speed']);
	$RecordId= trim($_POST['ID']);
	if(strlen($ModeName)==0)
	{
		echo "<script>alert('模块名称不能为空，请填写模块名称后再提交');history.back(-1);</script>";
		exit;
	}
	if(intval($MarqueeWidth)<=0)
	{
		echo "<script>alert('滚动图片宽度必须大于0，请正确填写滚动图片宽度后再提交');history.back(-1);</script>";
		exit;
	}
	if(intval($MarqueeHeight)<=0)
	{
		echo "<script>alert('滚动图片高度必须大于0，请正确填写滚动图片高度后再提交');history.back(-1);</script>";
		exit;
	}
	if(intval($PicWidth)<=0)
	{
		echo "<script>alert('图片宽度必须大于0，请正确填写图片宽度后再提交');history.back(-1);</script>";
		exit;
	}
	if(intval($PicHeight)<=0)
	{
		echo "<script>alert('图片高度必须大于0，请正确填写图片高度后再提交');history.back(-1);</script>";
		exit;
	}
	if(intval($TextLength)<=0)
	{
		echo "<script>alert('截取文本长度必须大于0，请正确填截取文本长度后再提交');history.back(-1);</script>";
		exit;
	}
	if(intval($PicNumber)<=0)
	{
		echo "<script>alert('图片数量必须大于0，请正确填写图片数量后再提交');history.back(-1);</script>";
		exit;
	}
	if(intval($Speed)<=0)
	{
		echo "<script>alert('滚动速度必须大于0，请正确填写滚动速度后再提交');history.back(-1);</script>";
		exit;
	}
	$SqlStr="Select Count(*) As Recs From Marqueepicsetup";
	$rs = mysql_query($SqlStr);
	if($rs!='')
	{
		$row = mysql_fetch_array($rs); 
		$Recs=$row['Recs'];
		if($Recs==0)
		{
			$RowID=strtoupper(md5($SchoolName.date("Y-m-d H:i:s")));//最后转换成大写
			$SqlStr="Insert Into Marqueepicsetup(RowID) Values('".$RowID."')";
			$rs=mysql_query($SqlStr);
			if(!$rs)//操作失败
			{
				$retstr="<script>alert('滚动图片设置提交失败!');window.location.href='/sygl.php'; </script>";
				exit($retstr);
			}
		}
	}
	$SqlStr="Update Marqueepicsetup Set ModeName='".$ModeName."',MarqueeWidth='".$MarqueeWidth."',MarqueeHeight='".$MarqueeHeight."',PicWidth='".$PicWidth."',PicHeight='".$PicHeight."',TextLength='".$TextLength."',PicNumber='".$PicNumber."',Speed='".$Speed."'";
	$rs=mysql_query($SqlStr);
	if($rs)//操作成功
	{
		$retstr="<script>alert('滚动图片设置提交成功!');window.location.href='/adm/sygl/Marqueepicsetup.php'; </script>";
		exit($retstr);
	}else//操作失败
	{
		$retstr="<script>alert('滚动图片设置提交失败!');window.location.href='/adm/sygl/Marqueepicsetup.php'; </script>";
		exit($retstr);
	}
	exit;
}
$SqlStr="SELECT ID,ModeName,MarqueeWidth,MarqueeHeight,PicWidth,PicHeight,TextLength,PicNumber,Speed From Marqueepicsetup ";
$rs = mysql_query($SqlStr);
if($rs!='')
{
	$row = mysql_fetch_array($rs); 
	$ID=$row['ID'];
	$ModeName=$row['ModeName'];
	$MarqueeWidth=$row['MarqueeWidth'];
	$MarqueeHeight=$row['MarqueeHeight'];
	$PicWidth=$row['PicWidth'];
	$PicHeight=$row['PicHeight'];
	$TextLength=$row['TextLength'];
	$PicNumber=$row['PicNumber'];
	$Speed=$row['Speed'];
}
mysql_free_result($rs);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%" background="../images/ManageBackGround.gif">
                    <TBODY>
                    <TR>
                      <td height="33" background="../images/ManageTop.gif">&nbsp;</td></TR>
                    <TR>
                      <TD height="100%">
                        <TABLE border=0 cellSpacing=0 cellPadding=0 width="96%" align=center height="100%">
                          <TBODY>
                          <TR>
                            <TD>
                              <TABLE class=indicator border=0 cellSpacing=0 cellPadding=0 width="100%" align=center>
                                <TBODY>
                                <TR>
                                <TD class=left></TD>
                                <TD class=center>当前位置 &gt;&gt; 滚动图片设置</TD>
                                <TD class=right></TD></TR></TBODY></TABLE></TD></TR>
                          <TR vAlign=top>
                            <TD height=21 vAlign=top></TD></TR>
                          <TR vAlign=top>
                            <TD height="100%" vAlign=top>
                              <TABLE class=ManageList border=0 cellSpacing=1 cellPadding=0 width="100%">
                                <FORM method=post name=FrmManage action="">
                                <TBODY>
                                <TR>
                                <TH colSpan=2>修改滚动图片设置</TH></TR>
                                <TR>
                                <TD align=right><FONT color=red>*</FONT>模块名称</TD>
                                <TD align="left"><INPUT value="<?php echo $ModeName;?>" maxLength=50 name=ModeName></TD></TR>
                                <TR>
                                <TD align=right><FONT color=red>*</FONT>滚动图片框宽度</TD>
                                <TD align="left"><INPUT value=<?php echo $MarqueeWidth;?> maxLength=11 name=MarqueeWidth></TD></TR>
                                <TR>
                                <TD align=right><FONT color=red>*</FONT>滚动图片框高度</TD>
                                <TD align="left"><INPUT value=<?php echo $MarqueeHeight;?> maxLength=11 name=MarqueeHeight></TD></TR>
                                <TR>
                                <TD align=right><FONT color=red>*</FONT>图片宽度</TD>
                                <TD align="left"><INPUT value=<?php echo $PicWidth;?> maxLength=11 name=PicWidth></TD></TR>
                                <TR>
                                <TD align=right><FONT color=red>*</FONT>图片高度</TD>
                                <TD align="left"><INPUT value=<?php echo $PicHeight;?> maxLength=11 name=PicHeight></TD></TR>
                                <TR>
                                <TD align=right><FONT color=red>*</FONT>截取文本长度</TD>
                                <TD align="left"><INPUT value=<?php echo $TextLength;?> maxLength=11 name=TextLength></TD></TR>
                                <TR>
                                <TD align=right><FONT color=red>*</FONT>图片数量</TD>
                                <TD align="left"><INPUT value=<?php echo $PicNumber;?> maxLength=11 name=PicNumber></TD></TR>
                                <TR>
                                <TD align=right><FONT color=red>*</FONT>滚动速度(越小速度越快)</TD>
                                <TD align="left"><INPUT value=<?php echo $Speed;?> maxLength=11 name=Speed></TD></TR>
                                <TR>
                                <TD width="30%"></TD>
                                <TD width="70%">
                                <INPUT value=ModeName,MarqueeWidth,MarqueeHeight,PicWidth,PicHeight,TextLength,PicNumber,Speed type=hidden name=NotNullFeild> 
                                <INPUT value=模块名称,滚动图片框宽度,滚动图片框高度,图片宽度,图片高度,截取文本长度,图片数量,滚动速度(越小速度越快) type=hidden name=NotNullDesc> 
                                <INPUT value=C,d,d,d,d,d,d,d type=hidden name=EregPattern>
                                <INPUT type=hidden name=Page> 
                                <INPUT value=<?php echo $ID;?> type=hidden name=ID><BR></TD></TR>
                                <TR>
                                <TD height=30 colSpan=2 align=middle>
                                <INPUT style="BACKGROUND-IMAGE: url(/adm/images/save.gif)" class=ManageButtonExt onmouseover=javascript:changebtn(this); onmouseout=javascript:changebtn(this); onclick=javascript:SaveRecord(true); alt=保存 type=button name=save>&nbsp;
                                <INPUT type=hidden name=buttonback vlaue=""><input type="hidden" name="act" value="1"/></TD></TR></FORM></TBODY></TABLE>
                              <TABLE class=ManageList border=0 cellSpacing=0 cellPadding=0 width="100%">
                                <TBODY>
                                <TR>
                                <TD height=25><FONT color=red>注</FONT>：只有所有图片的宽度相加后超过滚动图片框的宽度才能实现滚动功能。</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
</body></html>
