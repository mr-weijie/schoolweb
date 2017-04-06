<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <script type="text/javascript" charset="utf-8" src="ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="lang/zh-cn/zh-cn.js"></script>
    <style type="text/css">
        div{
            width:100%;
        }
    </style>
</head>
<body>
<?php 
$width=$_GET['width'];
$height=$_GET['height'];
$action=$_GET['action'];
if(strlen($width)==0) $width='100%';
if(strlen($height)==0) $height='300px';

?>
<div>
        <form id="form1" action="<?php echo $action?>" method="post">
 		<input type="text" name="date" value="2017-03-18">
<div>
    <script id="editor" type="text/plain" style="width:<?php echo $width?>;height:<?php echo $height?>;"></script>
</div>
        <input type="hidden" name="content" id="content">
        <button onClick="submitContent()" >提交</button>
        </form>
</div>

<!--div id="btns">
    <div>
        <button onclick="getContent()">获得内容</button>
    </div>
    <div>
        <button onclick=" UE.getEditor('editor').setHeight(300)">设置高度为300默认关闭了自动长高</button>
    </div>
</div-->

<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');

    function getContent() {
      // var arr = [];
      // arr.push("使用editor.getContent()方法可以获得编辑器的内容");
      // arr.push("内容为：");
      // arr.push(UE.getEditor('editor').getContent());
      // alert(arr.join("\n"));
	  return UE.getEditor('editor').getContent();
    }

    function submitContent() {
		var content=getContent();
		if(content.length==0)
		{
			alert("提交的内容不能为空！");
			return false;
		}
		document.getElementById("content").value=getContent();
		document.getElementById("form1").submit();
    }

</script>
</body>
</html>