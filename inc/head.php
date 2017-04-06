      <TABLE border=0 cellSpacing=0 cellPadding=0 width=960 align=center height=80>
        <TBODY>
        <TR>
          <TD background=images/suyaxingweb.jpg>
            <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
              <TBODY>
              <TR>
                <TD width=30></TD>
                <TD></TD></TR></TBODY></TABLE>
          </TD>
        </TR></TBODY></TABLE>
      <TABLE border=0 cellSpacing=0 cellPadding=0 width=960 background=images/MenuBG1_2007329_55755.gif align=center height=30>
        <TBODY>
        <TR>
          <TD width=16><IMG border=0 src="images/MenuLeft1_2007329_16867.gif" height=30></TD>
          <TD style="WIDTH: 6px"></TD>
          <?php 
//		  $SqlStr="SELECT RowID,root,FunctionName,FunctionDir,ManageFunId,Deep,IsManage,IsUse from webfunction where Deep = 2 and IsManage=1 and IsUse = 1 AND ManageFunId>0 order by OrderID";
		  $SqlStr="SELECT RowID,FunctionName,image from webfunction where Deep = 2 and IsManage=1 and IsUse = 1 AND ManageFunId>0 order by OrderID";
		  $rs = mysql_query($SqlStr);
			if($rs=='')
			{
				echo '对不起，没有找相应的系统菜单数据';
				return;
			}
			echo '<TD style="PADDING-TOP: 0px" align=middle>';
			echo '<A href="/"><FONT style="FONT-FAMILY: 宋体; COLOR: #ffffff; FONT-SIZE: 9pt" onmousemove="this.style.color=\'#f38401\';this.style.textDecoration=\'none\'" onmouseout="this.style.color=\'#ffffff\'">首页</FONT></A></TD>';
		while($row = mysql_fetch_array($rs)) 
		{
			$FunctionName=$row['FunctionName'];
			$RowID=$row['RowID'];
			echo '<TD style="PADDING-TOP: 0px" align=middle>';
			echo '<A href="/InfoList.php?funid='.$RowID.'"><FONT style="FONT-FAMILY: 宋体; COLOR: #ffffff; FONT-SIZE: 9pt" onmousemove="this.style.color=\'#f38401\';this.style.textDecoration=\'none\'" onmouseout="this.style.color=\'#ffffff\'">'.$FunctionName.'</FONT></A></TD>';
}
			mysql_free_result($rs);
		  ?>

		<TD style="WIDTH: 6px"></TD>
        <TD width=16><IMG border=0 src="images/MenuRight1_2007329_52507.gif" height=30></TD></TR></TBODY></TABLE><!------导航------->
      <TABLE border=0 cellSpacing=0 cellPadding=0 width=960 align=center celspacing="0">
        <TBODY>
        <TR>
          <TD height="100%" vAlign=top>
            <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
              <TBODY>
              <TR>
                <TD>
                  <DIV style="WIDTH: 100%; BACKGROUND: url(images/flashPic.jpg) no-repeat; HEIGHT: 185px; OVERFLOW: hidden">&nbsp;</DIV></TD></TR></TBODY></TABLE></TD></TR></TABLE>