
/*
'**************************************************
'Function		ȥ�ո�
'Author			Peace
'Create	Date	2004-09-09
'Parameter		Str				��Ҫȥ�ո���ַ���
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
'Function		�ж�FORM TEXT�����Ƿ���ȷ
'Author			Peace
'Create	Date	2004-09-09
'Parameter		Obj				Form object
'				TypeValue		�������
'				Msg				��ʾ��Ϣ
'**************************************************
*/
function CheckTextB(Obj,TypeValue,Msg)
{
	//TypeValue 2��������  8 �ַ���  100����
	//Obj �ж϶���
	//Msg ��������

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
'Function		�ж�FORM TEXT�����Ƿ���ȷ
'Author			Peace
'Create	Date	2004-09-09
'Parameter		Obj				Form object
'				TypeValue		�������
'				Msg				��ʾ��Ϣ
'				Necessary		�Ƿ��Ǳ����ֶ�
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
'Function		�ж�FORM TEXT�����Ƿ���ȷ
'Author			Peace
'Create	Date	2004-09-09
'Parameter		url				xml���ݵ�·��
'								����XML���ݾ��
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
	   sAlert += "װ������ʧ�ܣ�";
	   alert(sAlert);
	   return null;
	}
	return objXML;
}
/*
'**************************************************
'Function		������ҳ�水Ť
'Author			Peace
'Create	Date	2004-09-13
'Parameter		
'				
'**************************************************
*/
function ManageButton()
{
	var str = "<tr><td colspan=\"10\" height='22'><div align=right>";
	str += "<input name=\"add\" type=\"button\" style=\"BACKGROUND-IMAGE: url(images/add.gif)\" class=\"ManageButton\" alt=\"����\" onclick=\"javascript:AddRecord();\"  onmouseover=\"javascript:changebtn(this);\" onmouseout=\"javascript:changebtn(this);\">&nbsp;";
	str += "<input name=\"edit\" type=\"button\" style=\"BACKGROUND-IMAGE: url(images/edit.gif)\" class=\"ManageButton\" alt=\"�༭\" onclick=\"javascript:EditRecord();\"  onmouseover=\"javascript:changebtn(this);\" onmouseout=\"javascript:changebtn(this);\">&nbsp;";
	str += "<input name=\"del\" type=\"button\" style=\"BACKGROUND-IMAGE: url(imagesdel.gif)\" class=\"ManageButton\" alt=\"ɾ��\" onclick=\"javascript:DelRecord();\"  onmouseover=\"javascript:changebtn(this);\" onmouseout=\"javascript:changebtn(this);\">&nbsp;";
	str += "<input name=\"selectall\" type=\"button\" style=\"BACKGROUND-IMAGE: url(images/selectall.gif)\" class=\"ManageButton\" alt=\"ȫѡ\" onclick=\"return SelectAll();\"  onmouseover=\"javascript:changebtn(this);\" onmouseout=\"javascript:changebtn(this);\">";
	str += "&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr>";
	return str;
}
/*
'**************************************************
'Function		������ŤͼƬ
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
'Function		ȫѡ
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
'Function		��ҳ
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
			str += "��һҳ&nbsp;|&nbsp;��һҳ";
		}
		else
		{
			str += "<a href=\"" + url + "?Page=1\">��һҳ</a>&nbsp;|&nbsp;";
			str += "<a href=\"" + url + "?Page="+ (Page-1) +"\">��һҳ</a>";
		}
		str += "&nbsp;|&nbsp;";
		if (Total == Page)
		{
			str += "��һҳ&nbsp;|&nbsp;��ĩҳ";
		}
		else
		{
			str += "<a href=\"" + url + "?Page="+ (Page+1) +"\">��һҳ</a>&nbsp;|&nbsp;";
			str += "<a href=\"" + url + "?Page="+ Total +"\">��ĩҳ</a>";
		}
		str += "&nbsp;��<Select Name=\"Page\" onChange=\"onTurnPage(this)\">";
		for (var i=1;i<=Total;i++)
			if (i == Page)
				str += "<option selected value=\""+i+"\">" + i + "</option>";
			else
				str += "<option value=\""+i+"\">" + i + "</option>";
		str += "</select>ҳ&nbsp;";
		str += "�ܹ�" + Total + "ҳ";
		str += "</td></tr>";
		return str;
	}
	catch(e)
	{return "";}
}
/*
'**************************************************
'Function		��תҳ��
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
'Function		�����µļ�¼
'Author			Peace
'Create	Date	2004-09-13
'Parameter		
'				
'**************************************************
*/
function AddRecord()
{
	document.location.href="add.asp";
}
/*
'**************************************************
'Function		�޸ļ�¼
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
		alert("��ѡ����Ҫ�༭�ļ�¼��");
		return false;
	}
	document.FrmManage.action = "edit.asp";
	document.FrmManage.submit();
}
/*
'**************************************************
'Function		��������
'Author			Peace
'Create	Date	2004-09-21
'Parameter		Cmd			�Ƿ��Ǳ༭
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
		strNotNullFeild = document.FrmManage.NotNullFeild.value;	//�ֶ�����
		strNotNullDesc = document.FrmManage.NotNullDesc.value;		//�ֶ�����
		strEregPattern = document.FrmManage.EregPattern.value;		//������ʽ
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
								if (!CheckText(obj,arEregPattern[PatternPoint],"����ȷ����"+arNotNullDesc[j] + "��",true))
									return false;
							}
							else
								obj.value = KillSpace(obj.value);
							break;
						case "password":
							if (PatternPoint!= -1)
							{
								if (!CheckText(obj,arEregPattern[PatternPoint],"����ȷ����"+arNotNullDesc[i] + "��",true))
									return false;
								var objext = document.FrmManage.elements[i+1];
								if (obj.value != objext.value)
								{
									alert("ȷ����������벻һ�£�");
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
						if (!CheckText(obj,arEregPattern[PatternPoint],"����ȷ����"+arNotNullDesc[j] + "��",true))
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
							alert("����ȷѡ��"+arNotNullDesc[j]);
							obj.focus();
							return false;
						}
					}
			}
			
		}
		if (Cmd)
			document.FrmManage.action = "editsave.asp";
		else
			document.FrmManage.action = "addsave.asp";
		document.FrmManage.submit();
	}
	catch(e)
	{alert(e.description);return false;}
	
}
/*
'**************************************************
'Function		ɾ����¼
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
			sInfo = "��ѡ����Ҫɾ���ļ�¼��";
			break;
		case 2:
			sInfo = "��ѡ����Ҫ�Ƽ��ļ�¼��";
			break;
		case 3:
			sInfo = "��ѡ����Ҫ��˵ļ�¼��";
			break;
		default:
			alert('����������');
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
		if (!window.confirm("ȷ��ɾ����"))
			return false;
	document.FrmManage.action = "del.asp?Cmd="+Cmd;
	document.FrmManage.submit();
}

/*
'**************************************************
'Function		����
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
'Function		�������ӻ��޸�
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
'Function		��ģʽ����
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
'Function		�ж��Ƿ���ѡ��
'Author			Peace
'Create	Date	2004-09-14
'Parameter		flag				�������
				1					�༭ģʽ
				2					ɾ��ģʽ
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
						alert("ֻ��ѡ��һ����¼��");
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
//������ͣ
function Stop()
{document.all("ShowNews").stop();}
//�������
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
// added by zhangxp
// 2007/03/01
// �����Դ
// sFlag:��Դ����ID
/*************************/
function AddResource( sFlag )
{
	if( sFlag=="" || sFlag=="0" )
		return;
//	window.open("/ws2004/sysManage/Resource/addResource.asp?Flag="+sFlag);
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
// �޸���Դ
/*************************/
function EditResource( )
{
	var Id = judgeCheckBoxChecked(1);
	if (typeof(Id) =='undefined')
		return false;
	if (Id == "")
	{
		alert("��ѡ����Ҫ�༭�ļ�¼��");
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
// ɾ����Դ
/*************************/
function DelResource( sFlag )
{
	if( sFlag=="" || sFlag=="0" )
		return;	
	var Id = judgeCheckBoxChecked(2);
	var sInfo = '��ѡ����Ҫɾ���ļ�¼��';

	if (typeof(Id) =='undefined')
		return false;
	if (Id == "")
	{
		alert(sInfo);
		return false;
	}
	if (!window.confirm("ȷ��ɾ����"))
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
	
	re = / /g;             // ����������ʽģʽ��
	str = str.replace(re, "&nbsp;");	
		
	re = /\r\n/g;             // ����������ʽģʽ��
	r = str.replace(re, "<br>");	
	
	if( r=="" ) 
		r = "&nbsp;";
	return r;
}
function ReplacePer(str)
{
	var re,r;
		
	re = /%/g;             
	r = str.replace(re, "��");	
	
	return r;
}
function unReplacePer(str)
{
	var re,r;
		
	re = /��/g;             
	r = str.replace(re, "%");	
	
	return r;
}

/*���form�в�����Ϊ�յĶ���*/
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
				alert( oCells[i].title + "����Ϊ�ա�" );
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

//��ѡ����
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
		lbSelAll.innerText = "���";
	}
	else
	{
		lbSelAll.innerText = "ȫѡ";
	}
	
}
//�õ�ѡ��ĸ���
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

//�õ�ѡ��CheckBox��ֵ������ֱֵ��ʹ��","����
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
	
	sValue = sValue.substr(0,sValue.length-1); //ȥ�����һ������Ķ���
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
