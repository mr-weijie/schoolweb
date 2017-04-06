// JavaScript Document

/*
'**************************************************
'Function		去空格
'Author			Peace
'Create	Date	2004-09-09
'Parameter		Str				需要去空格的字符串
'**************************************************
*/
function KillSpace(Str){
        while((Str.length>0) && (Str.charAt(0)==' '))
                Str = Str.substring(1,Str.length);
        while((Str.length>0) && (Str.charAt(Str.length-1)==' '))
                Str = Str.substring(0,Str.length-1);
        return Str;
}
/*
'**************************************************
'Function		判断FORM TEXT输入是否正确
'Author			Peace
'Create	Date	2004-09-09
'Parameter		Obj				Form object
'				TypeValue		检测类型
'				Msg				提示信息
'**************************************************
*/
function CheckTextB(Obj,TypeValue,Msg)
{
	//TypeValue 2数字类型  8 字符型  100汉字
	//Obj 判断对象
	//Msg 返回内容

	var IsOk=false;
	switch (TypeValue)
	{
		case 2:
			res=/\d{1,}/
			Obj.value=KillSpace(Obj.value);
			if (res.exec(Obj.value))
				IsOk=true;
			else
				IsOk=false;
			if (!IsOk && (Msg.length>0 || Obj.value.length>0))
				{
					if (Obj.style.display == '')
					{
						alert(Msg);
						Obj.focus();
						Obj.select();
					}
					return false;
				}
			else
				return true;
			break;
		case 8:
			Obj.value=KillSpace(Obj.value);
			if (Obj.value.length==0)
				IsOk=true;
			else
				IsOk=false;
			if (IsOk && Msg.length>0)
				{
					alert(Msg);
					if (Obj.style.display == '')
					{
						Obj.focus();
						Obj.select();
					}
					return false;
				}
			else
				return true;
			break;
		case 100:
			Obj.value=KillSpace(Obj.value);
			if (Obj.value.length==0 || !GB_All(Obj.value) )
				IsOk=true;
			else
				IsOk=false;
			if (IsOk && Msg.length>0)
				{
					alert(Msg);
					alert(Obj.style.display);
					if (Obj.style.display == '')
					{
						Obj.focus();
						Obj.select();
					}
					return false;
				}
			else
				return true;
			break;
	
	}
}
/*
'**************************************************
'Function		判断FORM TEXT输入是否正确
'Author			Peace
'Create	Date	2004-09-09
'Parameter		Obj				Form object
'				TypeValue		检测类型
'				Msg				提示信息
'				Necessary		是否是必添字段
'**************************************************
*/
function CheckText(Obj,TypeValue,Msg,Necessary)
{
    /*TypeValue 
    'd': Numeric; 
    'i': All Integer 
    'r': Aeal Number
    'f': Decimal Fraction
    'l': 26 letter
    'ul':[A-Z]
    'll':[a-z]
    'w': [a-zA-Z_0-9]
    'S': Chinese Characters and Special Characters
    'e':email
	'date':
    
    Obj Required. 
    Msg Return Prompt Message
    Necessary is Optional Parameter
    */
    
    if (isNaN(Necessary))
        Necessary=false;
    Obj.value=KillSpace(Obj.value);
    switch (TypeValue)
    {
        case "d":
            res=new RegExp("^[0-9]+$","g");
            break;
        case "i":
            //res=new RegExp("(^[1-9][0-9]*$)|(^[\+\-][1-9][0-9]*$)","g");
			res=new RegExp("^[\+\-]?[0-9]+$","g");
            break
        case "r":
            //res=new RegExp("(^([\+\-]?[1-9])[0-9]*(\.[0-9]+)?[0-9]$)|(^([\+\-]?[0-9]\.)[0-9]+$)","g")
			res=new RegExp("^[\+\-]?[0-9]+(\.)?[0-9]?$","g")
            break;
        case "f":
            //res=new RegExp("(^(0\.)[0-9]+$)|(^[\+\-]0\.[0-9]+$)","g");
			res=new RegExp("^[\+\-]?0\.[0-9]+$","g");
            break;
        case "l":
            res=new RegExp("^[a-z]+$","gi");
            break;
        case "ul":
            res=new RegExp("^[A-Z]+$","g");
            break;
        case "ll":
            res=new RegExp("^[a-z]+$","g");
            break;
        case "w":
            res=new RegExp("^[0-9a-zA-Z_]+$","g")
            break;
        case "S":
            res=new RegExp("[^a-zA-Z0-9\n\r\t\f\v~`!@#$%^&*()\_\+\\/\.,<>\? ]+$","g");
            break;
        case "e":
			res=new RegExp("([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+","g");
			break
		case "date":
			res=new RegExp("^[0-9]{4}\-(0?[1-9]|[1-2][0-2])\-(0?[1-9]|[1-2][0-9]|3[01])$","g");
			break;
		case "ip":
			res=new RegExp("^([1-9]|[1-9][0-9]|[12][0-5][0-9])(\.([0-9]|[1-9][0-9]|[12][0-5][0-9])){3}$","g");
			break;
        default:
            res=new RegExp(".+","g");
    }
    //Main Process
    IsOk=res.exec(Obj.value);
    if ((Necessary && !IsOk)||(!IsOk && Obj.value.length > 0 ))
        {
            alert(Msg);
			if (Obj.style.display == '')
			{
				Obj.focus();
				Obj.select();
			}
            return false;
        }
    else
        return true;

}
/*
'**************************************************
'Function		判断FORM TEXT输入是否正确
'Author			Peace
'Create	Date	2004-09-09
'Parameter		url				xml数据的路径
'								返回XML数据句柄
'**************************************************
*/
function GetXMLData(url)
{
	var objXML = new ActiveXObject("Microsoft.XMLDOM");
	objXML.async = false;

	var bReturn = objXML.load(url);
	if(bReturn == false)
	{
	   var sAlert = url;
	   sAlert += "装载数据失败！";
	   alert(sAlert);
	   return null;
	}
	return objXML;
}
/*
'**************************************************
'Function		管理功能页面按扭
'Author			Peace
'Create	Date	2004-09-13
'Parameter		
'				
'**************************************************
*/
function ManageButton()
{
	var str = "<tr><td colspan=\"10\" height='22'><div align=right>";
	str += "<input name=\"add\" type=\"button\" style=\"BACKGROUND-IMAGE: url(images/add.gif)\" class=\"ManageButton\" alt=\"增加\" onclick=\"javascript:AddRecord();\"  onmouseover=\"javascript:changebtn(this);\" onmouseout=\"javascript:changebtn(this);\">&nbsp;";
	str += "<input name=\"edit\" type=\"button\" style=\"BACKGROUND-IMAGE: url(images/edit.gif)\" class=\"ManageButton\" alt=\"编辑\" onclick=\"javascript:EditRecord();\"  onmouseover=\"javascript:changebtn(this);\" onmouseout=\"javascript:changebtn(this);\">&nbsp;";
	str += "<input name=\"del\" type=\"button\" style=\"BACKGROUND-IMAGE: url(images/del.gif)\" class=\"ManageButton\" alt=\"删除\" onclick=\"javascript:DelRecord();\"  onmouseover=\"javascript:changebtn(this);\" onmouseout=\"javascript:changebtn(this);\">&nbsp;";
	str += "<input name=\"selectall\" type=\"button\" style=\"BACKGROUND-IMAGE: url(images/selectall.gif)\" class=\"ManageButton\" alt=\"全选\" onclick=\"return SelectAll();\"  onmouseover=\"javascript:changebtn(this);\" onmouseout=\"javascript:changebtn(this);\">";
	str += "&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr>";
	return str;
}
/*
'**************************************************
'Function		交换按扭图片
'Author			Peace
'Create	Date	2004-09-13
'Parameter		
'				
'**************************************************
*/
function changebtn(obj)
{
	try
	{
		var src = obj.style.backgroundImage;
		src = src.substring(4,src.length - 1);
		var len = src.length;
		var lidx = src.lastIndexOf("/");
		var url = src.substring(0,lidx+1);
		var fileName = src.substring (lidx+1,len);
		fileName = fileName.toLowerCase ();
		if (fileName.replace("b.","") == fileName)
			fileName = fileName.replace(".","b.");
		else
			fileName = fileName.replace("b.",".");
		obj.style.backgroundImage = 'url(' +url + fileName + ')';
	}
	catch(e)
	{;}
}
/*
'**************************************************
'Function		全选
'Author			Peace
'Create	Date	2004-09-13
'Parameter		
'				
'**************************************************
*/
function SelectAll()
{
	try
	{
		var obj = document.FrmManage.Id;
		if (typeof(obj) == 'undefined')
			return;
		var len = obj.length;
		if (typeof(len) == 'undefined')
		{
			if (document.FrmManage.Id.checked == true)
				document.FrmManage.Id.checked = false;
			else
				document.FrmManage.Id.checked = true;
		}
		else
		{
			var value = true;
			if (document.FrmManage.Id[0].checked == true)
				value = false;
			for (var i=0;i<len;i++)
				document.FrmManage.Id[i].checked = value;
		}
	}
	catch(e)
	{alert(e.description);}
	return;
}
/*
'**************************************************
'Function		分页
'Author			Peace
'Create	Date	2004-09-13
'Parameter		
'				
'**************************************************
*/
function TurnPage(Total,Page)
{
	try
	{	
		Page = parseInt(Page);
		var str = "<tr class=\"ManagePage\"><td colspan=\"20\" height='22' align=right>";
		var url = document.location.href;
		if (url.indexOf("?") > 0 )
			url = url.substring(0,url.indexOf("?"));
		if (Page == 1)
		{
			str += "第一页&nbsp;|&nbsp;上一页";
		}
		else
		{
			str += "<a href=\"" + url + "?Page=1\">第一页</a>&nbsp;|&nbsp;";
			str += "<a href=\"" + url + "?Page="+ (Page-1) +"\">上一页</a>";
		}
		str += "&nbsp;|&nbsp;";
		if (Total == Page)
		{
			str += "下一页&nbsp;|&nbsp;最末页";
		}
		else
		{
			str += "<a href=\"" + url + "?Page="+ (Page+1) +"\">下一页</a>&nbsp;|&nbsp;";
			str += "<a href=\"" + url + "?Page="+ Total +"\">最末页</a>";
		}
		str += "&nbsp;第<Select Name=\"Page\" onChange=\"onTurnPage(this)\">";
		for (var i=1;i<=Total;i++)
			if (i == Page)
				str += "<option selected value=\""+i+"\">" + i + "</option>";
			else
				str += "<option value=\""+i+"\">" + i + "</option>";
		str += "</select>页&nbsp;";
		str += "总共" + Total + "页";
		str += "</td></tr>";
		return str;
	}
	catch(e)
	{return "";}
}
/*
'**************************************************
'Function		跳转页面
'Author			Peace
'Create	Date	2004-09-13
'Parameter		
'				
'**************************************************
*/
function onTurnPage(obj)
{
	try
	{
		var Page = obj.value;
		var url = document.location.href;
		var pos = url.indexOf("?");
		var qStr = ""
		if (pos > 0 )
		{
			qStr = url.substring(pos+1,url.length); 
			url = url.substring(0,pos);
			re = /page=[0-9]*&?/gi;
			qStr = qStr.replace(re,"")
		}
		document.location.href = url + "?Page=" + Page + "&" + qStr;
	}
	catch(e)
	{;}
}
/*
'**************************************************
'Function		增加新的记录
'Author			mr_weijie
'Create	Date	2017-03-01
'Parameter		flag 
'				
'**************************************************
*/
function AddRecord(prg)
{
	//document.location.href=window.location.href;
	document.location.href=prg;
	
}
function AddPopRecord(PopupRowID)
{
	//document.location.href=window.location.href;
	document.location.href="EditPopup.php?PopupRowID="+PopupRowID;
	
}
/*
'**************************************************
'Function		修改记录
'Author			Peace
'Create	Date	2004-09-21
'Parameter		
'**************************************************
*/
function EditRecord()
{
	var Id = judgeCheckBoxChecked(1);
	if (typeof(Id) =='undefined')
		return false;
	if (Id == "")
	{
		alert("请选择需要编辑的记录！");
		return false;
	}
	document.FrmManage.action = "edit.asp";
	document.FrmManage.submit();
}
/*
'**************************************************
'Function		保存内容
'Author			Peace
'Create	Date	2004-09-21
'Parameter		Cmd			是否是编辑
'**************************************************
*/
function SaveRecord(Cmd)
{
	try
	{
		var strNotNullFeild,strNotNullDesc,strEregPattern;
		var arNotNullFeild,arNotNullDesc,arEregPattern;
		var frmlen,i,obj,NeedFeild;
		var PatternPoint;
		strNotNullFeild = document.FrmManage.NotNullFeild.value;	//字段名称
		strNotNullDesc = document.FrmManage.NotNullDesc.value;		//字段描述
		strEregPattern = document.FrmManage.EregPattern.value;		//正则表达式
		arNotNullFeild = strNotNullFeild.split(",");
		arNotNullDesc = strNotNullDesc.split(",");
		arEregPattern = strEregPattern.split(",");
		if (Cmd)
			frmlen = document.FrmManage.length - 7;
		else
			frmlen = document.FrmManage.length - 5;
		for (i=0;i<frmlen;i++)
		{
			obj = document.FrmManage.elements[i];
			var tagName = obj.tagName;
			var tagType = "";
			var Name = obj.name;
			var EditObj;
			NeedFeild = false;
			PatternPoint = -1;
			for (var j=0;j<arNotNullFeild.length;j++)
			{
				if (arNotNullFeild[j] == Name)
				{
					PatternPoint = j;
					//NeedFeild = true;
					break;
				}
			}
			//alert(i)
			//alert(tagName);
			//alert(NeedFeild);
			tagName = tagName.toLowerCase();
			switch (tagName)
			{
				case "input":
					tagType = obj.type;
					tagType = tagType.toLowerCase();
					switch (tagType)
					{
						case "text":
						case "hidden":
							if (PatternPoint!= -1)
							{
								if (!CheckText(obj,arEregPattern[PatternPoint],"请正确输入"+arNotNullDesc[j] + "！",true))
									return false;
							}
							else
								obj.value = KillSpace(obj.value);
							break;
						case "password":
							if (PatternPoint!= -1)
							{
								if (!CheckText(obj,arEregPattern[PatternPoint],"请正确输入"+arNotNullDesc[i] + "！",true))
									return false;
								var objext = document.FrmManage.elements[i+1];
								if (obj.value != objext.value)
								{
									alert("确认密码和密码不一致！");
									objext.focus();
									objext.select();
									return false;
								}
							}
							else
								obj.value = KillSpace(obj.value);
					}
					break;
				case "textarea":
					try
					{
						EditObj = eval(obj.name + 'eWebEditor');
						if (typeof(EditObj) == 'object')
							obj.value = EditObj.getHTML()
						//RegIp = new RegExp("<img.*src=[\"]?");
						obj.value = obj.value.replace(document.frmserverip.ServerIp.value,"");
						obj.value = obj.value.replace(document.frmserverip.ServerIp.value+":"+document.frmserverip.ServerPort.value,"");
					}catch(e){;}
					if (PatternPoint!= -1)
					{
						if (!CheckText(obj,arEregPattern[PatternPoint],"请正确输入"+arNotNullDesc[j] + "！",true))
							return false;
					}
					else
						obj.value = KillSpace(obj.value);
					break;
				case "select":
					if (PatternPoint!= -1)
					{
						if (obj.options[obj.selectedIndex].value == "0")
						{
							alert("请正确选择"+arNotNullDesc[j]);
							obj.focus();
							return false;
						}
					}
			}
			
		}
		//if (Cmd)
		//	document.FrmManage.action = "editsave.asp";
		//else
		//	document.FrmManage.action = "addsave.asp";
		//alert(document.FrmManage.action);
		document.FrmManage.submit();
	}
	catch(e)
	{alert(e.description);return false;}
	
}
/*
'**************************************************
'Function		删除记录
'Author			Peace
'Create	Date	2004-09-22
'Parameter		
'**************************************************
*/
function DelRecord(Cmd)
{
	var Id = judgeCheckBoxChecked(2);
	var sInfo = '';
	if (typeof(Cmd) == 'undefined')
		Cmd = 1;
	switch(Cmd)
	{
		case 1:
			sInfo = "请选择需要删除的记录！";
			break;
		case 2:
			sInfo = "请选择需要推荐的记录！";
			break;
		case 3:
			sInfo = "请选择需要审核的记录！";
			break;
		default:
			alert('不明操作！');
			return false;
	}
	if (typeof(Id) =='undefined')
		return false;
	if (Id == "")
	{
		alert(sInfo);
		return false;
	}
	if (Cmd == 1)
		if (!window.confirm("确定删除？"))
			return false;
	document.FrmManage.Act.value = "del";
	document.FrmManage.DelRowID.value = Id;
	document.FrmManage.submit();
}

/*
'**************************************************
'Function		返回
'Author			Peace
'Create	Date	2004-09-21
'Parameter		
'**************************************************
*/
function Back()
{
	window.history.go(-1);
}
/*
'**************************************************
'Function		放弃增加或修改
'Author			Peace
'Create	Date	2004-09-13
'Parameter		
'				
'**************************************************
*/
function Cancel()
{
	window.history.go(-1);
}
/*
'**************************************************
'Function		开模式窗口
'Author			Peace
'Create	Date	2004-09-13
'Parameter		width
'				height
'				url
'**************************************************
*/
function showModalDialogWindow(width,height,url,scroll)
{
	window.showModalDialog(url,window,"dialogHeight: "+ height+"px; dialogWidth: "+width+"px;edge: Raised; center: Yes; help: No; resizable: Yes; status: No;scroll:"+scroll+";center:yes");
}
/*
'**************************************************
'Function		判断是否有选中
'Author			Peace
'Create	Date	2004-09-14
'Parameter		flag				操作类别
				1					编辑模式
				2					删除模式
'**************************************************
*/
function judgeCheckBoxChecked(flag)
{
	try
	{
		var obj = document.FrmManage.Id;
		var len = obj.length;
		var count = 0;
		var str = "";
		if (typeof(len) == 'undefined')
		{
			if (document.FrmManage.Id.checked == true)
				str = document.FrmManage.Id.value;
		}
		else
		{
			
			for (var i=0;i<len;i++)
			{
				if (document.FrmManage.Id[i].checked == true)
				{			
					switch(flag)
					{
						case 1:
							str = document.FrmManage.Id[i].value;
							count++;
							break;
						case 2:
							count = 1;
							if (str == "")
								str = document.FrmManage.Id[i].value;
							else
								str += "," + document.FrmManage.Id[i].value;
					}
					if (count>1 && flag == 1)
					{
						alert("只能选择一条记录！");
						return;
					}
				}
			}
			
		}
	}
	catch(e)
	{return;}
	return str;
}
function NormalWin(URL,Width,Height,Scroll)
{
	try
	{
		if (Width =="" && Height =="")
		{
			window.open(URL,"","");
			return;
		}
		var top = (window.screen.availHeight - parseInt(Width))/2;
		var left = (window.screen.availWidth - parseInt(Height))/2;
		if (URL =="")
			return;
		window.open(URL, "", "location=no,menubar=no,scrollbars=no,resizeable=no,toolbar=no,width="+Width+",height="+Height+",top="+top+",left="+left);
	}
	catch(e)
	{;}
}
//公告暂停
function Stop()
{document.all("ShowNews").stop();}
//公告继续
function Go()
{document.all("ShowNews").start();}

function GetCookie(sName)
{
  var aCookie = document.cookie.split("; ");
  for (var i=0; i < aCookie.length; i++)
  {
    var aCrumb = aCookie[i].split("=");
    if (sName == aCrumb[0]) 
      return unescape(aCrumb[1]);
  }
  return null;
}
function SetCookie(sName, sValue)
{
  date = new Date(3000,1,1);
  document.cookie = sName + "=" + escape(sValue) + "; expires=" + date.toGMTString() + ";path=/ws2004/";
}

/*************************/
// 2017/03/01
// 添加资源
// sFlag:资源分类ID
/*************************/
function AddResource( sFlag )
{
	if( sFlag=="" || sFlag=="0" )
		return;
	w = 500;
	h = 400;
	var x = getCenterWinX(w);
	var y = getCenterWinY(h);
	var sParam = "left="+x+",top="+y+",height="+h+",width="+w+",status=yes,toolbar=no,menubar=no,location=no,resizable=1,scrollbars=0"
	var str = "/ws2004/sysManage/Resource/add/addResource.asp?FunID="+sFlag;
	window.open(str,"ModDlg",sParam);	
}
/*************************/
// added by zhangxp
// 2007/03/01
// 修改资源
/*************************/
function EditResource( )
{
	var Id = judgeCheckBoxChecked(1);
	if (typeof(Id) =='undefined')
		return false;
	if (Id == "")
	{
		alert("请选择需要编辑的记录！");
		return false;
	}
	w = 500;
	h = 400;
	var x = getCenterWinX(w);
	var y = getCenterWinY(h);
	var sParam = "left="+x+",top="+y+",height="+h+",width="+w+",status=yes,toolbar=no,menubar=no,location=no,resizable=1,scrollbars=1"
	var str = "/ws2004/sysManage/Resource/add/editResource.asp?Id=" +Id;
	window.open(str,"editResource"+Id,sParam);	
}
/*************************/
// added by zhangxp
// 2007/03/01
// 删除资源
/*************************/
function DelResource( sFlag )
{
	if( sFlag=="" || sFlag=="0" )
		return;	
	var Id = judgeCheckBoxChecked(2);
	var sInfo = '请选择需要删除的记录！';

	if (typeof(Id) =='undefined')
		return false;
	if (Id == "")
	{
		alert(sInfo);
		return false;
	}
	if (!window.confirm("确定删除？"))
		return false;
	var objSel=document.FrmManage.Page;
	var nPage = 1;
	if( objSel != null )
	{
		nPage = objSel.value;
	}
	sUrl = "/ws2004/sysManage/resource/add/delete.asp?Flag="+sFlag+"&ID="+Id+"&Page="+nPage;
//	document.FrmManage.action = "/ws2004/sysManage/resource/add/delete.asp?Flag="+sFlag+"&ID="+Id;
document.FrmManage.action = sUrl;
	document.FrmManage.submit();
//	window.open( sUrl,"_blank","left=-1,top=-1");
}

function getCenterWinX( nWidth )
{
	return (window.screen.width-nWidth)/2;
}

function getCenterWinY( nHeight )
{
	return (window.screen.height-nHeight)/2;
}
function ReplaceRnSpace(str)
{
	var re,r;
	
	re = / /g;             // 创建正则表达式模式。
	str = str.replace(re, "&nbsp;");	
		
	re = /\r\n/g;             // 创建正则表达式模式。
	r = str.replace(re, "<br>");	
	
	if( r=="" ) 
		r = "&nbsp;";
	return r;
}
function ReplacePer(str)
{
	var re,r;
		
	re = /%/g;             
	r = str.replace(re, "★");	
	
	return r;
}
function unReplacePer(str)
{
	var re,r;
		
	re = /★/g;             
	r = str.replace(re, "%");	
	
	return r;
}

/*检查form中不允许为空的对象*/
function CheckForm()
{
	oCells = document.forms(0).elements;
	for( var i=0;i<oCells.length;i++)
	{
		var bIsNullAble = oCells[i].IsNullAble;
		if( parseInt(bIsNullAble) == 0 )
		{
			if( oCells[i].value == "" )
			{
				alert( oCells[i].title + "不能为空。" );
				oCells[i].focus();
				return false;
			}
		}
	}
	return true;
}

var bIsSelAll = false;
function SelectAll2()
{
	bIsSelAll = !bIsSelAll;
		
	var chks = document.getElementsByName("CHKID");
	for (i=0;i<chks.length;i++)
	{
		if (!chks[i].disabled)
			if (bIsSelAll)
			{
				chks[i].checked = true;
				hL(chks[i]);
			}
			else
			{
				chks[i].checked = false;
				dL(chks[i]);
			}
	}
	
	CN( );
	return false;
}

//单选函数
function CCA(CB)
{
	var chks = document.getElementsByName("CHKID");
	
	if (CB.checked)
		hL(CB);
	else
		dL(CB);
	var TB=TO=0;
	for (var i=0;i<chks.length;i++)
	{
		var e = chks[i];
		if ((e.type=='checkbox'))
		{
			TB++;
			if (e.checked)
				TO++;
		}
	}	
	if( TB == TO )
	{
		bIsSelAll = true;	
		CN( );		
	}	
	else
	{
		bIsSelAll = false;	
		CN( );		
	}
}

function hL(E)
{
	while (E.tagName!="TR")
	{E=E.parentElement;}

	E.className = "ListTRSel"
}
function dL(E)
{
	while (E.tagName!="TR")
	{
		E=E.parentElement;
	}
	
	E.className=E.rowIndex %2 == 0?"ListTR2":"ListTR"

}
function CN( )
{
	if( bIsSelAll )
	{
		lbSelAll.innerText = "清除";
	}
	else
	{
		lbSelAll.innerText = "全选";
	}
	
}
//得到选择的个数
function getSelectedCount( )
{
	var chks = document.getElementsByName("CHKID");
	var nCount=0;	
	try
	{
		for (var i=0;i<chks.length;i++)
		{
			var e = chks[i];
			if ((e.type=='checkbox') && e.name == "CHKID")
			{
				if(e.checked)
				  nCount ++;			
			}
		}	
	}
	catch(e)
	{
	}
	
	return nCount;
}

//得到选择CheckBox的值，各个值直接使用","隔离
function getSelectedValue( )
{
	var chks = document.getElementsByName("CHKID");
	var sValue = "";
	for (var i=0;i<chks.length;i++)
	{
		var e = chks[i];
		if ((e.type=='checkbox') && e.name == "CHKID")
		{
			if(e.checked)
			{
			  sValue += e.value;
			  sValue += ",";
			}
		}
	}	
	
	sValue = sValue.substr(0,sValue.length-1); //去掉最后一个多余的逗号
	return sValue;
}

function onMoveObj( obj, sColor, bDeco )
{
	obj.style.color = sColor;
	if( bDeco=="0" )
	{
		obj.style.textDecoration = "none";
	}
}
function onOutObj( obj, sColor )
{
	obj.style.color = sColor;
}
