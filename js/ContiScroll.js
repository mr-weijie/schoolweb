/******************************************************/
//������ ContiScroll
//����:��β����ͼƬ(������)����
//����: xwj
//����: 2017/3/30
//����:
//	div: ������div����
//	tb: div���table
//	leftTd: ��ߵ�TD
//	rightTd: �ұߵ�TD
//	speed: �ٶ�(Խ��Խ��)
//	direction: ��������(��������:leftToRight,��������:rightToLeft)ע���Сд
//ʹ�÷���:
//	��һ��:��������html
//	<div id="div1" style="overflow:hidden;width:500px">
//		<table id="tb1">
//			<tr>
//				<td id="td1">����</td>
//				<td id="td2"></td>
//			</tr>
//		</table>
//	</div>
//	�ڶ���:��д���ýű�
//	<script language="javascript" type="text/javascript">
//	    var oScroll = new ContiScroll(GetE('div1'), GetE('tb1'), GetE('td1'), GetE('td2'), 10, 'rightToLeft');
//	    oScroll.start();
//	</script>
/******************************************************/

function ContiScroll(div, tb, leftTd, rightTd, speed, direction)
{
	this.div = div; //div
	this.tb = tb; //table
	this.leftTd = leftTd; //���td
	this.rightTd = rightTd; //�ұ�td
	this.speed = speed; //�����ٶ�(����)
	this.direction = direction; //��������(leftToRight��rightToLeft)
	this.timer = null //��ʱ��

	if(typeof(ContiScroll._initialized) == 'undefined')
	{
		//����
		ContiScroll.prototype.play = function()
		{	
			var _this = this;
			var callBack = function(){eval('_this.'+_this.direction+'()');}
			this.timer = setInterval(callBack, this.speed);
		}

		//��ͣ
		ContiScroll.prototype.pause = function()
		{
			if(this.timer != null)
			{
				clearInterval(this.timer);
			}
		}
		
		//��ʼ
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

		//������
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
		
		//���ҵ���
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

//�˺�����Ϊ�˼��ٴ��뼰���������
function GetE(id) 
{
	return document.getElementById(id);
}