<?php 
	$SqlStr="select Count(*) AS Recs From popupwindow Where date(NOW())>=date(outTime) and date(NOW())<date(stopDate)";
	$rs = mysql_query($SqlStr);
  	$row = mysql_fetch_array($rs);
	$Recs=$row['Recs'];
	mysql_free_result($rs);
	if ($Recs>0) PopWindow();
?>
<?php 
function PopWindow()
{?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/js/std.js"></script>
<SCRIPT LANGUAGE=javascript>
<!--
function PopWin(Id,WindowSize,WindowTop,WindowLeft,IsCloseAuto,TimeDelay)
{
	try
	{
		WindowTop = parseInt(WindowTop);
		WindowLeft = parseInt(WindowLeft);
		var Size = parseInt(WindowSize);
		var Width,Height;
		switch(Size)
		{
			case 1:
				Width = 300;
				Height = 300;
				break;
			case 2:
				Width = 600;
				Height = 600;
				break;
			case 3:
				Width = window.screen.availWidth;
				Height = window.screen.availHeight-80;
				break;
			case 4:
				Width = window.screen.availWidth;
				Height = window.screen.availHeight;
				break;
			default:
				Width = 300;
				Height = 300;
		}
		var popallid = GetCookie("popallid");
		var S_OK = true;
		if (popallid == null || popallid == 'undefined' || popallid == "")
			popallid = Id;
		else
		{
			pop = popallid.split(",")
			for (var i=0;i<pop.length;i++)
			{
				if (pop[i] == Id.toString(10))
					break;
			}
			if (i>=pop.length)
				popallid += "," + Id;
			else
				S_OK = false;
		}	
		if (S_OK)
		{
			var url = "/ShowPopInfo.php?Id=" + Id + "&IsCloseAuto=" + IsCloseAuto + "&TimeDelay=" + TimeDelay;
			window.open (url,"","location=no,menubar=no,scrollbars=no,resizable=yes,toolbar=no,width="+Width+",height="+Height+",top="+WindowTop+",left="+WindowLeft);
		}
		SetCookie("popallid",popallid);
	}
	catch(e)
	{;}
}
-->
</SCRIPT>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<SCRIPT LANGUAGE=javascript>
<!--
<?php

	$SqlStr="select RowID,WindowSize,WindowTop,WindowLeft,isPopUp,isCloseAuto,timeDelay From popupwindow Where date(NOW())>=date(outTime) and date(NOW())<date(stopDate) Order by OutTime Desc";
	$rs = mysql_query($SqlStr);
  	while($row = mysql_fetch_array($rs)) 
	{
		$RowID=$row['RowID'];
		$WindowSize=$row['WindowSize'];
		$WindowTop=$row['WindowTop'];
		$WindowLeft=$row['WindowLeft'];
		$isPopUp=$row['isPopUp'];
		$isCloseAuto=$row['isCloseAuto'];
		$timeDelay=$row['timeDelay'];
		//PopWin(Id,WindowSize,WindowTop,WindowLeft,IsCloseAuto,TimeDelay)
		echo 'PopWin("'.$RowID.'",'.$WindowSize.','.$WindowTop.','.$WindowLeft.','.$isCloseAuto.','.$timeDelay.');';
	}
	mysql_free_result($rs);
?>

//PopWin(8,1,0,0,1,0);

//-->
</SCRIPT>
</body>
</html>

<body>
</body>
</html>
<?php }?>
