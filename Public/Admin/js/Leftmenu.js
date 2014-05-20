<!--
function showHide(objname)
{
	var obj = document.getElementById(objname);
	var objsun = document.getElementById('sun'+objname);
	
  	//设置cookie
	var ckstr = getCookie('menuitems');
	var ckstrs = null;
	var okstr ='';
	var ischange = false;
	if(ckstr==null) ckstr = '';
	ckstrs = ckstr.split(',');
	objname = objname.replace('items','');

	if(obj.style.display == 'block' || obj.style.display =='')
	{
		obj.style.display = 'none';
		for(var i=0; i < ckstrs.length; i++)
		{
			if(ckstrs[i]=='') continue;
			if(ckstrs[i]==objname){  ischange = true;  }
			else okstr += (okstr=='' ? ckstrs[i] : ','+ckstrs[i] );
		}
		if(ischange) setCookie('menuitems',okstr,7);
        objsun.className = 'bitem2';
	}
	else
	{
		obj.style.display = 'block';
		ischange = true;
		for(var i=0; i < ckstrs.length; i++)
		{
			if(ckstrs[i]==objname) {  ischange = false; break; }
		}
		if(ischange)
		{
			ckstr = (ckstr==null ? objname : ckstr+','+objname);
			setCookie('menuitems',ckstr,7);
		}
        objsun.className = 'bitem';
	}
}
//读写cookie函数
function getCookie(c_name)
{
	if (document.cookie.length > 0)
	{
		c_start = document.cookie.indexOf(c_name + "=")
		if (c_start != -1)
		{
			c_start = c_start + c_name.length + 1;
			c_end   = document.cookie.indexOf(";",c_start);
			if (c_end == -1)
			{
				c_end = document.cookie.length;
			}
			return unescape(document.cookie.substring(c_start,c_end));
		}
	}
	return null
}
function setCookie(c_name,value,expiredays)
{
	var exdate = new Date();
	exdate.setDate(exdate.getDate() + expiredays);
	document.cookie = c_name + "=" +escape(value) + ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString()); //使设置的有效时间正确。增加toGMTString()
}

//检查以前用户展开的菜单项
var totalitem = 10;//最多展开五个选项卡
function CheckOpenMenu()
{

	var ckstr = getCookie('menuitems');
	var curitem = '';
	var curobj = null;
	
	if(ckstr==null || ckstr=='')
	{
		ckstr='0';
		setCookie('menuitems',ckstr,7);
	}
	ckstr = ','+ckstr+',';
	for(i=0;i<totalitem;i++)
	{
		curobj = document.getElementById('items'+i);
		sunobj = document.getElementById('sunitems'+i);
		if(ckstr.indexOf(i) > 0 && curobj != null)
		{
			curobj.style.display = 'block';
			sunobj.className = 'bitem';
		}
		else
		{
			if(curobj != null) curobj.style.display = 'none';
		}
	}
}
-->