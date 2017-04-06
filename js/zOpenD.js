function zOpenD(Url,Title,Width,Height){
	var diag = new Dialog("Diag1");
	diag.Width = Width;//900;
	diag.Height = Height;//400;
//	diag.Title = "弹出窗口示例";
	diag.URL =Url;// "http://www.juheweb.com";
	diag.ShowMessageRow = true;
//	diag.MessageTitle = "弹出窗口示例";
	diag.Message = Title;//"在这儿你可以对这个窗口的内容或功能作一些说明";
//	diag.OKEvent = zAlert;//点击确定后调用的方法
//alert(diag.URL);
	diag.show();
}