/******************************************************/
//对象名 ContiScroll
//功能:首尾相联图片(或文字)滚动
//作者: xwj
//日期: 2017/3/30
//参数:
//	div: 最外层的div对象
//	tb: div里的table
//	leftTd: 左边的TD
//	rightTd: 右边的TD
//	speed: 速度(越大越慢)
//	direction: 滚动方向(从左向右:leftToRight,从右向左:rightToLeft)注意大小写
//使用方法:
//	第一步:生成以下html
//	<div id="div1" style="overflow:hidden;width:500px">
//		<table id="tb1">
//			<tr>
//				<td id="td1">内容</td>
//				<td id="td2"></td>
//			</tr>
//		</table>
//	</div>
//	第二步:书写调用脚本
//	<script language="javascript" type="text/javascript">
//	    var oScroll = new ContiScroll(GetE('div1'), GetE('tb1'), GetE('td1'), GetE('td2'), 10, 'rightToLeft');
//	    oScroll.start();
//	</script>
/******************************************************/

function ContiScroll(div, tb, leftTd, rightTd, speed, direction)
{
	this.div = div; //div
	this.tb = tb; //table
	this.leftTd = leftTd; //左边td
	this.rightTd = rightTd; //右边td
	this.speed = speed; //滚动速度(毫秒)
	this.direction = direction; //滚动方向(leftToRight或rightToLeft)
	this.timer = null //定时器

	if(typeof(ContiScroll._initialized) == 'undefined')
	{
		//滚动
		ContiScroll.prototype.play = function()
		{	
			var _this = this;
			var callBack = function(){eval('_this.'+_this.direction+'()');}
			this.timer = setInterval(callBack, this.speed);
		}

		//暂停
		ContiScroll.prototype.pause = function()
		{
			if(this.timer != null)
			{
				clearInterval(this.timer);
			}
		}
		
		//开始
		ContiScroll.prototype.start = function()
		{
			this.tb.style.width = parseInt(this.div.style.width)*2;
			this.leftTd.style.width = this.rightTd.style.width = parseInt(this.div.style.width);
			this.rightTd.innerHTML = this.leftTd.innerHTML;
			this.play();
			
			var _this = this;
			this.div.onmouseout = function(){_this.play();}
			this.div.onmouseover = function(){_this.pause();}
		}

		//从左到右
		ContiScroll.prototype.leftToRight = function()
		{
			if(this.div.scrollLeft==0)
			{
				this.div.scrollLeft = this.rightTd.offsetWidth;
			}
			else
			{
				this.div.scrollLeft --;
			}
		}
		
		//从右到左
		ContiScroll.prototype.rightToLeft = function()
		{
			if(this.rightTd.offsetWidth-this.div.scrollLeft<=0)
			{
				this.div.scrollLeft = 0;
			}
			else
			{
				this.div.scrollLeft ++;
			}
		}

		ContiScroll._initialized = true;
	}
}

//此函数是为了减少代码及兼容浏览器
function GetE(id) 
{
	return document.getElementById(id);
}