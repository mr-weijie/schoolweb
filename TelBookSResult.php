<?PHP include 'Inc/conn.php';?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>校内电话簿</title>
<SCRIPT language=javascript src="js/std.js"></SCRIPT>
<LINK rel=stylesheet type=text/css href="css/style.css">
</head>
<body bgcolor="Lavender" text="#000000">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ManageList">
  <tbody><tr>
    <td>
      <table width="100%" border="0" cellspacing="1" cellpadding="2">
		<tbody><tr>
		  <th>序号</th>
		  <th>姓名或部门名称</th>
		  <th>电话号码</th>
		</tr>
 		<?php 
				$KeyWord= trim($_POST['KeyWord']);
				if($KeyWord=='')
				{
 		  			$SqlStr="SELECT Name,TelePhone from PhoneBook Order by ID";
				}else
				{
 		  			$SqlStr="SELECT Name,TelePhone from PhoneBook where Name like '%".$KeyWord."%' Order by ID";
				}
		  		$rs = mysql_query($SqlStr);
				$XH=0;
 		  		while($row = mysql_fetch_array($rs)) 
						{
							$XH++;
							$Name=$row['Name'];
							$TelePhone=$row['TelePhone'];
            				echo '<tr><td>'.$XH.'</td><td>'.$Name.'</td><td>'.$TelePhone.'</td></tr>';
						}
						mysql_free_result($rs);

 ?>       
        </tbody></table>
    </td>
  </tr>  
  
</tbody></table>


</body></html>