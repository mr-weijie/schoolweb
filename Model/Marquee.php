<?PHP include '../Inc/conn.php';?>
<?php 
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

<TABLE border=0 cellSpacing=0 cellPadding=0 width=<?php echo $MarqueeWidth?> align=center celspacing="0">
        <TBODY>
        <TR>
          <TD height="100%" vAlign=top>
            <SCRIPT language=javascript type=text/javascript src="js/ContiScroll.js"></SCRIPT>
           <div style="overflow:hidden;height:<?php echo $MarqueeHeight?>;width:<?php echo $MarqueeWidth?>;color:#ffffff;border-top:4px solid #017FD6;border-right:2px solid #017FD6;border-left:1px solid #017FD6;border-bottom:1px solid #017FD6;display:block;">
<div style="clear:left;float:left;width:45px;height:<?php echo $MarqueeHeight?>;background:#ffffff url(images/MarqueePicLeft1.jpg);font-family:宋体;font-size:11pt;font-weight:bolder;text-align:center;letter-spacing:5px;cursor:default;margin-top:auto;margin-left:auto;margin-bottom:auto;">
            <TABLE>
              <TBODY>
              <TR>
                <TD style="TEXT-ALIGN: center; WIDTH: 25px; FONT-FAMILY: 宋体; HEIGHT: <?php echo $MarqueeHeight?>px; COLOR: #ffffff; FONT-SIZE: 11pt; VERTICAL-ALIGN: middle; FONT-WEIGHT: bolder">
                  <DIV style="TEXT-ALIGN: center; WRITING-MODE: tb-rl; MARGIN: auto; WIDTH: 25px; HEIGHT: auto"><?php echo $ModeName?></DIV></TD></TR></TBODY></TABLE></DIV>
            <DIV style="PADDING-BOTTOM: 3px; WIDTH: <?php echo ($MarqueeWidth-65)?>px; FLOAT: right; HEIGHT: <?php echo $MarqueeHeight?>px; COLOR: #ffffff; CLEAR: right; OVERFLOW: hidden; MARGIN-RIGHT: 10px; PADDING-TOP: 4px" id=demo>
            <TABLE id=tb1 border=0 cellSpacing=0 cellPadding=0 width=<?php echo $MarqueeWidth?> align=left>
              <TBODY>
              <TR>
                <TD id=demo1 vAlign=top>
                  <TABLE border=0 cellSpacing=0 cellPadding=0>
                    <TBODY>
                    <TR>
                    <?php 
		  				//$SqlStr="SELECT Title,Content from tblcontent where Flag=38 order by OutTime Desc limit 0,".$PicNumber;
						$SqlStr="SELECT webfunction.RowID as funid,B.* from (SELECT webfunction.RowID ,webfunction.FunctionName,webfunction.FunId as flag,webfunction.Root, A.Title,A.Content FROM webfunction INNER JOIN (SELECT Title,Content,Flag from TblContent where Flag='38') A ON webfunction.FunId=A.Flag) B INNER JOIN webfunction on webfunction.FunId=B.root";
		  				$rs = mysql_query($SqlStr);
						while($row = mysql_fetch_array($rs)) 
						{
						    $PicName="";
							$funid=trim($row['funid']);
							$rowid=trim($row['RowID']);
							$flag=trim($row['flag']);
							$FunctionName=trim($row['FunctionName']);
							$FunctionName=urlencode($FunctionName);
							$Title=trim($row['Title']);
							$Title=substr($Title,0,$TextLength);//按设置参数截取字串长度
							$Content=$row['Content'];
							if(preg_match("/\/ueditor\/php\/upload\/image\/(.*?)\.jpg/i", $Content, $matches))//利用正则查找内容中的图片
							{
							    $PicName=$matches[0];
							} 
							else if(preg_match("/\/ueditor\/php\/upload\/image\/(.*?)\.gif/i", $Content, $matches))
							{
							    $PicName=$matches[0];
							}
							if($PicName!="")
							{
								echo '<TD vAlign=top>';
                        		echo '<TABLE border=0 cellSpacing=0 cellPadding=0>';
                            	echo '<TBODY>';
                            	echo '<TR>';
                            	echo '<TD vAlign=top>';
								echo '<A href="/InfoList.php?funid='.$funid.'&rowid='.$rowid.'&flag='.$flag.'&FN='.$FunctionName.'" target=_blank >';
								echo '<IMG title='.$Title.' border=0 src="'.$PicName.'"'; 
                              	echo 'width='.$PicWidth.' height='.$PicHeight.'></A></TD>';
                          		echo '<TR>';
                            	echo '<TD style="PADDING-LEFT: 2px; PADDING-RIGHT: 2px; WORD-WRAP: break-word; FONT-SIZE: 9pt; WORD-BREAK: break-all; PADDING-TOP: 2px" height=25 width='.$PicWidth.' align=middle>';
								echo '<A style="COLOR: #265fd4; TEXT-DECORATION: none" onmouseover="this.style.color=\'#f38401\'"';
								echo 'title='.$Title.' onMouseOut="this.style.color=\'#265FD4\';" href="#" target=_blank>'.$Title.'</A></TD></TR></TBODY></TABLE></TD>';
                      			echo '<TD>&nbsp;&nbsp;&nbsp;</TD>';
							}
						}
						mysql_free_result($rs);
		  			?>
					</TR></TBODY></TABLE></TD>
                <TD id=demo2 vAlign=top 
            width=0></TD></TR></TBODY></TABLE></DIV></DIV>
            <SCRIPT language=javascript>
var speed=<?php echo $Speed?>;//速度数值越大速度越慢
//speed = 1000;
var oScroll = new ContiScroll(GetE('demo'), GetE('tb1'), GetE('demo1'), GetE('demo2'), speed, 'rightToLeft');
oScroll.start();
</SCRIPT>
          </TD></TR></TBODY></TABLE>