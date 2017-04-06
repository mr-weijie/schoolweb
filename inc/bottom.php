<TABLE border=0 cellSpacing=0 cellPadding=0 width=984 align="center">
  <TBODY>
  <TR>
    <TD style="BACKGROUND: url(images/bodyBg_Left.gif) #ffffff" width=12></TD>
    <TD>
      <TABLE 
      style="BACKGROUND: url(images/CopyRightBG.gif) #ffffff repeat-x 0px 0px" 
      border=0 cellSpacing=0 cellPadding=0 width=960 align=center height=98>
        <TBODY>
        <TR height=22>
          <TD width="183">&nbsp;</TD>
          <TD width="360">&nbsp;</TD>
          <TD width="417">&nbsp;</TD>
        </TR>
        <TR height=22>
          <TD align=center>&nbsp;&nbsp;</TD>
          <TD align=left>版权所有 © <?php echo $SchoolName?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
          <TD align=left>联系地址：<?php echo $SchoolAddress?></TD>
        </TR>
        <TR height=22>
          <TD align=center>&nbsp;</TD>
          <TD align=left>管理员信箱：<A 
            href="mailto:<?php echo $HeadMasterEmail?>"><?php echo $HeadMasterEmail?></A>&nbsp;&nbsp;</TD>
          <TD align=left><?php if(intval($TechSupport)==1) echo '技术支持：哈尔滨春腾科技有限公司';?></TD>
        </TR>
        <TR height=22>
          <TD colspan="3" align=center>您是第 <SPAN style="COLOR: #ff6600"><?php echo $Counter?></SPAN> 位访问者</TD>
          </TR>
        <TR height=10>
          <TD colspan="3" align="center">&nbsp;</TD>
          </TR>
        <!--0 每个IP访问者加一 1 首页刷新就加一--></TBODY></TABLE></TD>
<TD style="BACKGROUND: url(images/bodyBg_Right.gif) #ffffff" width=12></TD></TR></TBODY></TABLE>