function zOpenD(Url,Title,Width,Height){
	var diag = new Dialog("Diag1");
	diag.Width = Width;//900;
	diag.Height = Height;//400;
//	diag.Title = "��������ʾ��";
	diag.URL =Url;// "http://www.juheweb.com";
	diag.ShowMessageRow = true;
//	diag.MessageTitle = "��������ʾ��";
	diag.Message = Title;//"���������Զ�������ڵ����ݻ�����һЩ˵��";
//	diag.OKEvent = zAlert;//���ȷ������õķ���
//alert(diag.URL);
	diag.show();
}