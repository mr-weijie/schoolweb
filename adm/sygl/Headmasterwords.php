<?PHP include '../Inc/conn.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公告</title>
<link rel="stylesheet" href="/css/style.css" type="text/css">
<script type="text/javascript" src="/js/std.js"></script>
    <script type="text/javascript" charset="utf-8" src="/adm/editor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/adm/editor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/adm/editor/lang/zh-cn/zh-cn.js"></script>
    <style type="text/css">
        div{
            width:100%;
        }
    </style>
</head>
<body>
<?php 
$Act=$_POST['Act'];
//$PopupRowID=$_GET['PopupRowID'];
//if(strlen($PopupRowID)==0)	$PopupRowID=$_POST['PopupRowID'];
if($Act==1)
{
	$rowid=$_POST['RowId'];
	$Flag=$_POST['Flag'];
	$Title=$_POST['Title'];
	$content=$_POST['content'];
	if(strlen($rowid)==0)
	{
		$rowid=strtoupper(md5($Title.$FromWhere.$Flag.date("Y-m-d H:i:s")));//最后转换成大写
		$SqlStr="Insert Into headmasterwords(RowID,Flag,Title,Content) Values('".$rowid."','".$Flag."','".$Title."','".$content."')";
	}else
	{
		$SqlStr="Update headmasterwords Set Flag='".$Flag."',Title='".$Title."',Content='".$content."' Where RowID='".$rowid."'";
	}
	$rs=mysql_query($SqlStr);
	if($rs)//操作成功
	{
		$retstr="<script>alert('记录提交成功!');window.location.href='Headmasterwords.php'</script>";
	}else//操作失败
	{
		$retstr="<script>alert('记录提交失败!');history.back(-1);</script>";
	}
//	exit($retstr);	
}
	$SqlStr="Select RowID,Flag,Title,Content from headmasterwords ";
	$rs = mysql_query($SqlStr);
	$row = mysql_fetch_array($rs);
	$RowID=$row['RowID'];
	$Flag=$row['Flag'];
	$Title=$row['Title'];
	$Content=$row['Content'];
	mysql_free_result($rs);

?>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%"  background="../images/ManageBackGround.gif">
            <tbody><tr>
              <td height="33" background="../images/ManageTop.gif">&nbsp;</td>
            </tr>
            <tr> 
			  <td height="100%">
				<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" height="100%">
				  <tbody><tr>
				  <td>
				<table class="indicator" cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                <tbody><tr>		
				<td class="left"></td>
				<td align="left" class="center">当前位置 &gt;&gt; <?php echo $Title?></td>
				<td class="right"></td>
                </tr>
                </tbody></table>
                </td>
				  </tr>
				  <tr valign="top">
				    <td height="21" valign="top"></td>
				  </tr>
				  <tr valign="top">
				    <td height="100%" valign="top">
				    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="ManageList">
                    <form name="FrmManage" action="" method="post">
                    <tbody>
                    <tr><th colspan="2">修改<?php echo $Title?></th></tr>
                    <tr><td align="center"><font color="red"> *</font>标题</td><td><input type="text" name="Title" value="<?php echo $Title?>" maxlength="100"></td></tr>
                    <tr><td align="center"><font color="red"> *</font>内容</td><td align="left">&nbsp;<input type="button" id="btnEditContent" value="编辑公告内容" onclick="javascript:editContent();"  onmouseover="javascript:changebtn(this);" onmouseout="javascript:changebtn(this);"></td></tr>
                    <tr><td colspan="2"><div id="div_Content" style="display:block;"><?php echo $Content?></div><div id="div_UE" style="display:none;"><script id="editor" type="text/plain" style="width:<?php echo $width?>;height:<?php echo $height?>;"></script></div></td></tr>
                    <tr><td width="30%"></td><td width="70%"> 			
                    <input type="hidden" name="NotNullFeild" value="Title,Content"> 			
                    <input type="hidden" name="NotNullDesc" value="标题,内容"> 			
                    <input type="hidden" name="EregPattern" value="C,C">
	        		<input type="hidden" name="content" id="content">
			        <input type="hidden" name="Act" id="Act" value="1">
                    <input type="hidden" name="Flag" value="<?php echo $Flag?>"><br></td></tr>
                    <input type="hidden" name="RowId" value="<?php echo $RowID?>"><br></td></tr>
                    <tr><td colspan="2" align="center" height="30">
                    <input name="save" type="button" style="BACKGROUND-IMAGE: url(/adm/images/save.gif)" class="ManageButtonExt" alt="保存" onClick="javascript:submitContent();" onMouseOver="javascript:changebtn(this);" onMouseOut="javascript:changebtn(this);">&nbsp;<input type="hidden" name="buttonback" vlaue=""></td></tr></tbody></table><br><br><br><br>
				    </td>
				  </tr>
				</tbody></form></table>
			  </td>
            </tr>
          </tbody></table>
</div>


<script type="text/javascript">
    //必须先实例化编辑器，否则，会出现对象属性为空或不是对象的错误
    var ue = UE.getEditor('editor');

    function getContent() {
	  return UE.getEditor('editor').getContent();
    }

     function setContent(contentString,isAppendTo) {
        var arr = [];
        UE.getEditor('editor').setContent(contentString, isAppendTo);
    }
   function submitContent() {
		var content=getContent();
		if(content.length==0) content=document.getElementById("div_Content").innerHTML;
		if(content.length==0)
		{
			alert("提交的内容不能为空！");
			return false;
		}
		document.getElementById("content").value=content;
		SaveRecord(true);
		//document.getElementById("FrmManage").submit();
    }
   function editContent() {
		document.getElementById("div_UE").style.display="block";
		ue.execCommand('insertHtml', document.getElementById("div_Content").innerHTML);
		document.getElementById("btnEditContent").disabled=true;
        document.getElementById("div_Content").style.display="none";
		//ue.setContent(document.getElementById("textarea").innerHTML,false);
    }
</script>
</body>
</html>