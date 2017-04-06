<?PHP include 'Inc/conn.php';?>
<?php checkRowID(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE><?php echo $SchoolName?>校园网站系统</TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="css/style.css">
<SCRIPT language=javascript src="js/std.js"></SCRIPT>
<META name=GENERATOR content="MSHTML 8.00.7601.19038">
<style type="text/css">
body {
	margin-top: 0px;
}
</style>
</HEAD>
<BODY leftMargin=0 bgColor=#ffffff text=#000000>
<TABLE border=0 cellSpacing=0 cellPadding=0 width=984 height="100%" align="center">
  <TBODY>
  <TR>
    <TD style="BACKGROUND: url(images/bodyBg_Left.gif) #ffffff"  width=12></TD>
    <TD><!------------------显示BANNER----------------->
<?php include 'inc/head.php'?>
      <TABLE border=0 cellSpacing=0 cellPadding=0 width=960 align=center celspacing="0">
        <TBODY>
        <TR>
          <TD height="100%" vAlign=top>
		  <SCRIPT language=javascript>
<!--
function StartSearch()
{
	try
	{
		if (document.frmsitesearch.TemplateFunctionMode.selectedIndex < 1)
		{
			alert("选择需要查询的栏目");
			return false;
		}
		if (document.frmsitesearch.TemplateFields.selectedIndex<1)
		{
			alert("选择需要查询的项");
			return false;
		}
		
		
		if (!CheckTextB(document.frmsitesearch.KeyWord,8,"请输入查询关键字！"))
			return false;
		document.frmsitesearch.submit();
	}
	catch(e)
	{alert('StartSearch\n\n' + e.descritpion);}
}
//-->
</SCRIPT>

            <STYLE type=text/css>.SOption {
	COLOR: #000000
}
</STYLE>

            <TABLE border=0 cellSpacing=0 cellPadding=0 width=960 height=37>
              <FORM method=get name=frmsitesearch action=/ws2004/Model/default.asp>
              <TBODY>
              <TR>
                <TD style="PADDING-LEFT: 100px; BACKGROUND: url(images/ZhanNeiSouSuo.gif) #ffffff no-repeat 0px 0px" 
                vAlign=center>
                  <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                    <TBODY>
                    <TR>
                      <TD><SPAN class=SOption nowrap>查询栏目</SPAN> 
                      <SELECT style="POSITION: relative; WIDTH: 98px; TOP: 2px" class=searchbox name=TemplateFunctionMode> 
                        <OPTION selected>选择查询栏目</OPTION> 
                        <?php 
							$SqlStr="SELECT Id,FunctionName from webfunction where IsManage=0 and IsUse=1 and Root>0 order by OrderID";
		  					$rs = mysql_query($SqlStr);
							while($row = mysql_fetch_array($rs)) 
							{
								$ID=$row['Id'];
								$FunctionName=$row['FunctionName'];
								echo '<OPTION value='.$ID.'>'.$FunctionName.'</OPTION>';
							}
							mysql_free_result($rs);
		  				?>
                        </SELECT>&nbsp; <SPAN 
                        class=SOption>查询项</SPAN> 
                        <SELECT style="POSITION: relative; TOP: 2px" class=searchbox name=TemplateFields> 
                        <OPTION selected value="">选择查询项</OPTION>
                        <OPTION value="">文章标题</OPTION>
                        <OPTION value="">作者或出处</OPTION>
                        <OPTION value="">文章内容</OPTION>
                        
                        </SELECT>&nbsp; 
                        <SPAN class=SOption>查询类型</SPAN> 
                        <SELECT style="POSITION: relative; WIDTH: 60px; TOP: 2px" class=searchbox name=SearchType> 
                        <OPTION selected value=1>包含</OPTION> 
                        <OPTION value=0>等于</OPTION></SELECT>&nbsp; 
                        <SPAN class=SOption>关键字</SPAN> 
                        <INPUT style="BORDER-BOTTOM: #576c7e 1px solid; BORDER-LEFT: #576c7e 1px solid; HEIGHT: 18px; BORDER-TOP: #576c7e 1px solid; BORDER-RIGHT: #576c7e 1px solid" class=searchbox name=KeyWord> &nbsp;&nbsp;
                        <BUTTON class="searchBtn1" title="搜索" onClick="javascript:StartSearch();" style="background-image:url(images/SearchBtn1.gif)">
                        <SPAN onMouseOver="this.style.color='#53c62b'" onMouseOut="this.style.color='#ffffff'">搜&nbsp;索</SPAN></BUTTON> 
                      </TD></TR></TBODY></TABLE></TD>
                <TD 
                style="BACKGROUND: url(images/ZhanNeiSouSuo_Right.gif) #ffffff no-repeat 0px 0px" 
                width=4></TD></TR></FORM></TABLE></TD></TR></TBODY></TABLE><!------------------页面结束了----------------------->
      <TABLE border=0 cellSpacing=0 cellPadding=0 width=960 align=center celspacing="0">
        <TBODY>
        <TR>
          <TD height="100%" vAlign=top width=160>
            <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
              <TBODY>
              <TR>
                <TD 
                style="BACKGROUND: url(images/schoolNotes.gif) #ffffff no-repeat 0px 0px">
                  <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                    <TBODY>
                    <TR height=50>
                      <TD class=TPLFourteenTop1>校园公告栏</TD>
                      <TD class=TPLFourteenTop2><A href=#>more</A></TD></TR></TBODY></TABLE></TD></TR>
              <TR>
                <TD style="BORDER-BOTTOM: #1aafff 1px solid; BORDER-LEFT: #1aafff 1px solid; PADDING-BOTTOM: 5px; OVERFLOW: hidden; BORDER-TOP: 0px; BORDER-RIGHT: #1aafff 1px solid; PADDING-TOP: 4px" vAlign=top width="100%">
                  <MARQUEE id=scrollarea onmouseover=scrollarea.stop() onmouseout=scrollarea.start() direction=up height=160  width="100%" scrollAmount=2 scrollDelay=100>
          <?php 
		  $SqlStr="SELECT Title,OutTime from tblcontent where Flag=60 order by OutTime Desc";
		  $rs = mysql_query($SqlStr);
 		  while($row = mysql_fetch_array($rs)) 
		{
			$Title=$row['Title'];
			$OutTime=date('Y-m-d',strtotime($row['OutTime']));
            echo '<TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">';
			echo '<TBODY>';
			echo '<TR class=TPLFourteenTime height=20><TD width=6></TD>';
			echo '<TD>'.$OutTime.'&nbsp;<SPAN>▼</SPAN></TD>';
			echo '<TD width=4></TD></TR>';
			echo '<TR class=TPLFourteenContent><TD width=6></TD>';
			echo '<TD><A  href=# target=_blank><FONT style="FONT-FAMILY: 宋体; FONT-SIZE: 9pt">'.$Title.'</FONT></A></TD>';
			echo '<TD width=4></TD></TR></TBODY></TABLE>';
		}
			mysql_free_result($rs);
		  ?>
</MARQUEE></TD></TR></TBODY></TABLE><!-----------------跑马灯模式2--------------------></TD>
          <TD height="100%" vAlign=top width=10></TD>
          <TD height="100%" vAlign=top width=400><!------------------首页列表模式------------------->
            <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
              <TBODY>
              <TR>
                <TD style="BACKGROUND: url(images/CommonTitleBG_2007329_97944.gif) #ffffff no-repeat 0px 0px">
                  <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                    <TBODY>
                    <TR height=31>
                      <TD class=TPLThirteenTop1>热点新闻</TD>
                      <TD class=TPLThirteenTop2>[<A href="http://jxzxx.org.cn/ws2004/newscenter/redianxinwen/">更多</A>]</TD></TR></TBODY></TABLE></TD></TR>
              		<TR>
                	  <TD style="BORDER-BOTTOM: #cccccc 1px solid; BORDER-LEFT: #cccccc 1px solid; PADDING-BOTTOM: 5px; BORDER-TOP: 0px; BORDER-RIGHT: #cccccc 1px solid; PADDING-TOP: 4px" height=184 vAlign=top width="100%">
                		<?php listInfo(56,175,7)?>
					</TD></TR></TBODY></TABLE><!----------------首页列表模式---------------------></TD>
          <TD height="100%" vAlign=top width=10></TD>
          <TD height="100%" vAlign=top width=400><!------------------首页列表模式------------------->
            <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
              <TBODY>
              <TR>
                <TD style="BACKGROUND: url(images/CommonTitleBG_2007329_97944.gif) #ffffff no-repeat 0px 0px">
                  <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                    <TBODY>
                    <TR height=31>
                      <TD class=TPLThirteenTop1>教育新闻</TD>
                      <TD class=TPLThirteenTop2>[<A href="http://jxzxx.org.cn/ws2004/newscenter/jiaoyuxinwen/">更多</A>]</TD></TR></TBODY></TABLE></TD></TR>
              <TR>
                <TD style="BORDER-BOTTOM: #cccccc 1px solid; BORDER-LEFT: #cccccc 1px solid; PADDING-BOTTOM: 5px; BORDER-TOP: 0px; BORDER-RIGHT: #cccccc 1px solid; PADDING-TOP: 4px" height=184 vAlign=top width="100%">
                <?php listInfo(64,175,7)?>
                </TD></TR></TBODY></TABLE><!----------------首页列表模式---------------------></TD></TR></TBODY></TABLE><!------------------页面结束了----------------------->
      <!---跑马灯模块    -->
      	<?php include 'Model/Marquee.php'?>
      <!---跑马灯模块结束--->
      <TABLE border=0 cellSpacing=0 cellPadding=0 width=960 align=center celspacing="0">
        <TBODY>
        <TR>
          <TD height="100%" vAlign=top width=160>

            <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
              <TBODY>
              <TR>
                <TD height=36><IMG src="images/XinXiChaXunTitle1.gif"></TD></TR>
              <TR>
                <TD>
                  <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                    <TBODY>
                    <TR>
                      <TD class=XinXiChaXun1 noWrap><A href="javascript:NormalWin('./phonebook.php',500,420,'no');">校内电话簿</A></TD></TR>
                      
                    <TR>
                      <TD class=XinXiChaXun1 noWrap><A href="#">课表查询</A></TD></TR>
                    <TR>
                      <TD class=XinXiChaXun1 noWrap><A href="javascript:NormalWin('/','','','no');">成绩查询</A></TD></TR>
                    <TR>
                      <TD class=XinXiChaXun1 noWrap><A href="javascript:NormalWin('/','','','no');">教师课表查询</A></TD></TR>
                    <TR>
                      <TD class=XinXiChaXun1 noWrap><A href="#">图书查询</A></TD></TR>
                    <TR>
                      <TD class=XinXiChaXun1 noWrap><A href="#">期刊检索</A></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
            <SCRIPT language=javascript>
<!--
function OpenLink(obj)
{
	var url = obj.value;
	if( url != "" )
	{
		window.open(url);
	}
}
//-->
</SCRIPT>

            <STYLE type=text/css>.link1 {
	BACKGROUND: url(images/linkBg1.gif) #ffffff no-repeat 0px 0px
}
</STYLE>

            <TABLE border=0 cellSpacing=0 cellPadding=0 width=160>
              <TBODY>
              <TR>
                <TD height=52><IMG border=0 src="images/LinkTitle1.gif" 
                  width=160 height=52></TD></TR>
              <TR>
                <TD 
                style="BACKGROUND: url(images/LinkBG1.gif) #ffffff repeat-y 0px 0px" vAlign=top>
                  <TABLE border=0 cellSpacing=4 cellPadding=3 width="100%">
                    <TBODY>
                    <TR>
                      <TD align=middle>
                      <SELECT class=linkbox onchange=OpenLink(this)>
                      	<OPTION selected>相关校园网系统</OPTION>
                      	<?php listFriendLink(24);?>
					  </SELECT></TD></TR>
                    <TR>
                      <TD align=middle>
                      <SELECT class=linkbox onchange=OpenLink(this)>
                      <OPTION selected>友情链接</OPTION>
                      	<?php listFriendLink(22);?>
					  </SELECT></TD></TR>
                    <TR>
                      <TD align=middle>
                      <SELECT class=linkbox onchange=OpenLink(this)>
                      <OPTION selected>推荐站点</OPTION>
                      	<?php listFriendLink(23);?>
                      </SELECT></TD></TR>
					<?php listPicLink();?>
					</TBODY></TABLE></TD></TR>
              <TR>
                <TD height=4><IMG border=0 src="images/LinkBottom1.gif" 
                  width=160 height=4></TD></TR></TBODY></TABLE></TD>
          <TD height="100%" vAlign=top width=10></TD>
          <TD height="100%" vAlign=top width=400><!------------------首页列表模式------------------->
            <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
              <TBODY>
              <TR>
                <TD 
                style="BACKGROUND: url(images/CommonTitleBG_2007329_97944.gif) #ffffff no-repeat 0px 0px">
                  <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                    <TBODY>
                    <TR height=31>
                      <TD class=TPLThirteenTop1>师生之间</TD>
                      <TD class=TPLThirteenTop2>[<A 
                        href="http://jxzxx.org.cn/ws2004/xueshengpindao/shishengzhijian/">更多</A>]</TD></TR></TBODY></TABLE></TD></TR>
              <TR>
                <TD style="BORDER-BOTTOM: #cccccc 1px solid; BORDER-LEFT: #cccccc 1px solid; PADDING-BOTTOM: 5px; BORDER-TOP: 0px; BORDER-RIGHT: #cccccc 1px solid; PADDING-TOP: 4px" 
                height=209 vAlign=top width="100%">
                <?php listInfo(88,200,8)?>
                  </TD></TR></TBODY></TABLE><!----------------首页列表模式---------------------><!------------------首页列表模式------------------->
            <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
              <TBODY>
              <TR>
                <TD 
                style="BACKGROUND: url(images/CommonTitleBG_2007329_97944.gif) #ffffff no-repeat 0px 0px">
                  <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                    <TBODY>
                    <TR height=31>
                      <TD class=TPLThirteenTop1>家长必读</TD>
                      <TD class=TPLThirteenTop2>[<A 
                        href="http://jxzxx.org.cn/ws2004/jiazhangpindao/jiazhangbidu/">更多</A>]</TD></TR></TBODY></TABLE></TD></TR>
              <TR>
                <TD 
                style="BORDER-BOTTOM: #cccccc 1px solid; BORDER-LEFT: #cccccc 1px solid; PADDING-BOTTOM: 5px; BORDER-TOP: 0px; BORDER-RIGHT: #cccccc 1px solid; PADDING-TOP: 4px" 
                height=209 vAlign=top width="100%">
                <?php listInfo(102,200,8)?>
                  </TD></TR></TBODY></TABLE><!----------------首页列表模式---------------------></TD>
          <TD height="100%" vAlign=top width=10></TD>
          <TD height="100%" vAlign=top width=400><!------------------首页列表模式------------------->
            <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
              <TBODY>
              <TR>
                <TD 
                style="BACKGROUND: url(images/CommonTitleBG_2007329_97944.gif) #ffffff no-repeat 0px 0px">
                  <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                    <TBODY>
                    <TR height=31>
                      <TD class=TPLThirteenTop1>菁菁文苑</TD>
                      <TD class=TPLThirteenTop2>[<A 
                        href="http://jxzxx.org.cn/ws2004/xueshengpindao/wenyuan/">更多</A>]</TD></TR></TBODY></TABLE></TD></TR>
              <TR>
                <TD style="BORDER-BOTTOM: #cccccc 1px solid; BORDER-LEFT: #cccccc 1px solid; PADDING-BOTTOM: 5px; BORDER-TOP: 0px; BORDER-RIGHT: #cccccc 1px solid; PADDING-TOP: 4px" height=209 vAlign=top width="100%">
                <?php listInfo(92,200,8)?>
                </TD>
              </TR></TBODY></TABLE><!----------------首页列表模式---------------------><!------------------首页列表模式------------------->
            <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
              <TBODY>
              <TR>
                <TD 
                style="BACKGROUND: url(images/CommonTitleBG_2007329_97944.gif) #ffffff no-repeat 0px 0px">
                  <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                    <TBODY>
                    <TR height=31>
                      <TD class=TPLThirteenTop1>各科教学</TD>
                      <TD class=TPLThirteenTop2>[<A 
                        href="http://jxzxx.org.cn/ws2004/ketangneiwai/gekejiaoxue/">更多</A>]</TD></TR></TBODY></TABLE></TD></TR>
              <TR>
                <TD style="BORDER-BOTTOM: #cccccc 1px solid; BORDER-LEFT: #cccccc 1px solid; PADDING-BOTTOM: 5px; BORDER-TOP: 0px; BORDER-RIGHT: #cccccc 1px solid; PADDING-TOP: 4px" height=209 vAlign=top width="100%">
                <?php listInfo(114,200,8)?>
                </TD>
              </TR></TBODY></TABLE><!----------------首页列表模式---------------------></TD></TR></TBODY></TABLE><!------------------页面结束了-----------------------></TD>
    <TD style="BACKGROUND: url(images/bodyBg_Right.gif) #ffffff" width=12></TD></TR></TBODY></TABLE>
<?php include '/inc/bottom.php'?>
<?php include 'Popwin.php'?>

</BODY></HTML>

<?php 
function listInfo($Flag,$Height,$Recs)
{
				echo '<TABLE border=0 cellSpacing=0 cellPadding=0 width="100%" height='.$Height.'>';
                echo '<TBODY>';
		  		$SqlStr="SELECT RowID,Title from tblcontent where Flag=".$Flag." order by OutTime Desc limit 0,".$Recs;
		  		$rs = mysql_query($SqlStr);
				$I=0;
 		  		while($row = mysql_fetch_array($rs)) 
						{
							$I++;
							$RowID=$row['RowID'];
							$Title=$row['Title'];
            				echo '<TR class=TPLThirteenContent height=25>';
							echo '<TD width=4></TD>';
							echo '<TD background=images/horizontalDot.gif><IMG align=absMiddle src="images/BlackSquare_2007330_35460.gif">&nbsp;';
							echo '<A title='.$Title.' href="news.php?id='.$RowID.'" target=_blank>';
							echo '<FONT style="FONT-FAMILY: 宋体; FONT-SIZE: 9pt">'.$Title.'</FONT></A>';
							echo '<TD width=4></TD></TR>';
						}
						for($J=0;$J<$Recs-$I;$J++)//补全未满的空行
						{
 		                	echo '<TR class=TPLThirteenContent height=25>';
                      	 	echo '<TD width=4></TD>';
                      		echo '<TD background=images/horizontalDot.gif>&nbsp;</TD>';
                      		echo '<TD width=4></TD></TR>';
						}
						mysql_free_result($rs);
				echo '</TBODY></TABLE>';
}                 
?>
<?php 
function listFriendLink($Flag)
{
		  		$SqlStr="SELECT LinkName,Link from FriendLinks where Flag=".$Flag;
		  		$rs = mysql_query($SqlStr);
 		  		while($row = mysql_fetch_array($rs)) 
						{
							$LinkName=$row['LinkName'];
							$Link=$row['Link'];
            				echo '<OPTION value="'.$Link.'">'.$LinkName.'</OPTION>';
						}
						mysql_free_result($rs);
}                 
?>
<?php 
function listPicLink()
{
		  		$SqlStr="SELECT LinkName,Link,LinkPic from FriendLinks where Flag=100";
		  		$rs = mysql_query($SqlStr);
 		  		while($row = mysql_fetch_array($rs)) 
						{
							$LinkName=$row['LinkName'];
							$Link=$row['Link'];
							$LinkPic=$row['LinkPic'];
            				echo '<TR><TD><A href="'.$Link.'" target=_blank><IMG border=0 src="'.$LinkPic.'" alt="'.$LinkName.'"></A></TD></TR>';
						}
						mysql_free_result($rs);
}                 
?>

<?php 
function checkRowID()//查检目标表中的RowId是否有空值，如果有，则自动填入
{
		$TableArray=array('tblcontent','WebFunction','tushu','phonebook','qikan','tushupingjia','managefunction','friendlinks','popupwindow','headmasterwords','marqueepicsetup','infosearch_class','infosearch_term','infosearch_stukebiao','infosearch_teakebiao','infosearch_scores');
		foreach($TableArray as $TableName)
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
}                 
?>