<!DOCTYPE html>
<html>
  <head>
	<title>GET Map OGC WMS, WFS, WCS services by Đỗ Thành Long (soiqualang_chentreu)</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
	<!--khai bao jquery-ui--->
	<link rel="stylesheet" href="../lib/jquery-ui-1.10.3.custom/development-bundle/themes/base/jquery.ui.all.css">
	<script src="../lib/jquery-ui-1.10.3.custom/development-bundle/jquery-1.9.1.js"></script>
	<script src="../lib/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../lib/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.widget.js"></script>
	<!-------------------------------dialog------------------------------------------------------------->
	<script src="../lib/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.mouse.js"></script>
	<script src="../lib/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.draggable.js"></script>
	<script src="../lib/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.position.js"></script>
	<script src="../lib/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.resizable.js"></script>
	<script src="../lib/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.dialog.js"></script>
	<script src="../lib/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.effect.js"></script>
	<script src="../lib/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.effect-blind.js"></script>
	<script src="../lib/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.effect-explode.js"></script>
	<!----------------------------------------------------------------------------------------------->
	<script src="../lib/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.tabs.js"></script>
	<script src="../lib/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<script src="../lib/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.accordion.js"></script>
	<script src="../lib/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.button.js"></script>
	<!--<link rel="stylesheet" href="../lib/jquery-ui-1.10.3.custom/development-bundle/demos/demos.css">-->
	<!--ket thuc khai bao jquery-ui--->
	
    <link rel="stylesheet" href="../lib/OpenLayers/theme/default/style.css" type="text/css">
    <link rel="stylesheet" href="../lib/OpenLayers/examples/style.css" type="text/css">
    <script src="../lib/OpenLayers/OpenLayersdev.js"></script>
	
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	
	<style>
	.switchery {
		width: 32px;
		height: 20px;
	}
	.switchery>small {
		width: 20px;
		height: 20px;
	}
	.infocollapse {
		padding: 6px 8px;
		font: 14px/16px Arial, Helvetica, sans-serif;
		background: white;
		background: rgba(255,255,255,0.8);
		box-shadow: 0 0 15px rgba(0,0,0,0.2);
		border-radius: 5px;
		/*margin-left: 10px;
		margin-bottom: 70px;
		float: right;
		position: absolute;*/
		z-index: 1000;
		left: 0;
		bottom: 0;
	}
	.panel {
		margin-bottom: 10px;
	}
	.h4, .h5, .h6, h4, h5, h6 {
		margin-bottom: 0px;
	}
	#sldbody{
		z-index: 9999;
	}
	pre {outline: 1px solid #ccc; padding: 5px; margin: 5px; height:300px; background-color: #ffffff;}
	.string { color: green; }
	.number { color: darkorange; }
	.boolean { color: blue; }
	.null { color: magenta; }
	.key { color: red; }

	</style>
    <script type="text/javascript">
	geomtype='';
	curtab='';
	classifyobjarr=new Array;
	arrvalue=new Array;
	sldarr=new Array();
	
	OpenLayers.ProxyHost = "proxy.php?url=";
	var extent='102.145,8.56655,109.468,23.3931';
	var arr=extent.split(',');
	var a=eval(arr[0]);
	var b=eval(arr[1]);
	var c=eval(arr[2]);
	var d=eval(arr[3]);		
	
	function init() {
	map = new OpenLayers.Map("map", {
		controls: [
			new OpenLayers.Control.Navigation(),
			new OpenLayers.Control.PanZoomBar({'zoomWorldIcon': true}),
			new OpenLayers.Control.ScaleLine(),
			new OpenLayers.Control.MousePosition(),
			new OpenLayers.Control.Permalink(),
			new OpenLayers.Control.OverviewMap({
			div: document.getElementById('layer_overviewMap_control'),
			roundedCorner: false
			}),
			new OpenLayers.Control.KeyboardDefaults(),
			new OpenLayers.Control.LayerSwitcher({
			div: document.getElementById('layer_switcher_control'),
			roundedCorner: false
			})
		],
		maxExtent: new OpenLayers.Bounds(a,b,c,d).transform(new OpenLayers.Projection("EPSG:4326"), new OpenLayers.Projection("EPSG:3857")),//can tinh lai cho rong mot xiu
		maxResolution: "auto", 
		//projection:"EPSG:3857", 
		numZoomLevels: 6,
		units: 'm',
		projection: new OpenLayers.Projection("EPSG:3857"),
		displayProjection: new OpenLayers.Projection("EPSG:4326")
		//allOverlays: true
	});
	
	var urlmapfile = 'http://localhost:8080/geoserver/test/wms';
			 
			 var format="image/png";
			 var opacity = 0.5;
			 
			var URLBASEMAP = 'http://g1.cloudgis.vn/services/rest/maps';
			var gcloud = new OpenLayers.Layer.OSM("gcloud", URLBASEMAP + "/roadmap/tile/${z}/${x}/${y}.png", {numZoomLevels: 19});
			map.addLayer(gcloud);
			
			var cycle = new OpenLayers.Layer.OSM("OpenCycleMap",
			["http://a.tile.thunderforest.com/cycle/${z}/${x}/${y}.png",
			 "http://b.tile.thunderforest.com/cycle/${z}/${x}/${y}.png",
			 "http://c.tile.thunderforest.com/cycle/${z}/${x}/${y}.png"]);
		   map.addLayer(cycle);
		   
		   var osm = new OpenLayers.Layer.OSM();
				map.addLayers([osm]);
						
			var customweatherwms = new OpenLayers.Layer.WMS(
			"Bản đồ mây",
			"http://maps.customweather.com/image?client=ucl_test&client_password=t3mp",
			{
				transparent: 'TRUE',
				layers: 'global_ir_satellite_10km'
			},
				{singleTile: true, ratio: 1, isBaseLayer: false, displayInLayerSwitcher: true, visibility: false} 
			);
			
			forecasts = new OpenLayers.Layer.WMS(
				"Thời tiết", "http://maps.customweather.com/image?client=ucl_test&client_password=t3mp",
				{
					LAYERS: 'forecasts',
					transparent:"true",
					format: format
				},
				{singleTile: false, ratio: 1, isBaseLayer: false, displayInLayerSwitcher: true, visibility: false} 
			);
			
			map.addLayers([forecasts,customweatherwms]);
			
			extent = new OpenLayers.Bounds(a,b,c,d).transform(new OpenLayers.Projection("EPSG:4326"), new OpenLayers.Projection("EPSG:3857"));
			map.zoomToExtent(extent);
		
		map.events.on({
			moveend: function(evt) {
				//console.log(map.getScale());
				//$('#scalediv').val(map.getScale());
				$('#scalediv').html('Current Scale: '+map.getScale());
			}       
		});
		
	};
	//------------end init----------------
/********************************
beauti json
*********************************/
function output(inp) {
    //document.body.appendChild(document.createElement('pre')).innerHTML = inp;
	//$('#serviceinfo').innerHTML = inp;
	
}

function syntaxHighlight(json) {
    json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
        var cls = 'number';
        if (/^"/.test(match)) {
            if (/:$/.test(match)) {
                cls = 'key';
            } else {
                cls = 'string';
            }
        } else if (/true|false/.test(match)) {
            cls = 'boolean';
        } else if (/null/.test(match)) {
            cls = 'null';
        }
        return '<span class="' + cls + '">' + match + '</span>';
    });
}

//var obj = {a:1, 'b':'foo', c:[false,'false',null, 'null', {d:{e:1.3e5,f:'1.3e5'}}]};
//var str = JSON.stringify(obj, undefined, 4);

//output(str);
//output(syntaxHighlight(str));

/**********************************
Map Process
**********************************/
function get_layers(){
	//http://localhost:8080/geoserver/dothanhlong/wfs?request=GetCapabilities&service=WFS&AcceptFormats=application/json,text/xml
	//http://localhost:8080/geoserver/dothanhlong/wms??request=GetCapabilities&service=WMS&&AcceptFormats=application/json,text/xml&_=1531459249358
	//alert($('#urlservice2').val());
	
	var url=urlparam($('#urlservice').val(),'layers');
	var urlservice=url['url'];
	var typename=url['param'];
	dataString='urlservice='+urlservice+'&btn=get_layers&request=GetCapabilities&service=WMS&AcceptFormats=application/json,text/xml';
	$.ajax({
		url: 'ajax.php',
		type: 'GET',
		cache: false,
		data: dataString,
		success: function(string){
			//console.log(string.capability.layer.layer[0].name);
			var getjson=JSON.parse(string);
			//console.log(getjson.capability.layer.layer[0].name);
			
			var getlayer=getjson.capability.layer.layer;
			//console.log(getlayer);
			//alert(getlayer.length);
			var i=0;
			var opt='';
			for(i;i<getlayer.length;i++){
				var lyrname=getlayer[i].name
				var uniname='redrose'+Math.floor((Math.random() * 1000) + 1);
				opt+='<option value="'+lyrname+','+urlservice+','+uniname+'" id="id'+uniname+'">'+lyrname+'</option>';
			}
			//console.log(opt);
			$('#layerSelection').html(opt);
			//$('#sldbody').val(syntaxHighlight(string));
			var str = JSON.stringify(getjson, undefined, 4);
			//console.log(syntaxHighlight(str));
			document.getElementById('serviceinfo').innerHTML=syntaxHighlight(str);
			
		},
		error: function (){
			alert('Có lỗi xảy ra');
		}
	});
}


function addmap(){
	//getgeomtype();
	//get_layers();
	var arr=$('#layerSelection').val().split(',');
	var layer=arr[0];
	var urlmap=arr[1];
	var uniname=arr[2];
	
	//var uniname='redrose'+Math.floor((Math.random() * 1000) + 1);
	var layername=layer;
	
			
	// add script
	var script   = document.createElement("script");
	script.type  = "text/javascript";
	//script.src   = "path/to/your/javascript.js";
	script.id='layer'+uniname;
	
	script.text=uniname+' = new OpenLayers.Layer.WMS("'+layername+'", "'+urlmap+'",{LAYERS: "'+layer+'",transparent:"true",format:format},{singleTile: true, ratio: 1, isBaseLayer: false, displayInLayerSwitcher: true});map.addLayers(['+uniname+']);';
		
	console.log(script);
	document.body.appendChild(script);
	
	
};

function downloadmap(){
	var arr=$('#layerSelection').val().split(',');
	var layer=arr[0];
	var urlmap=arr[1];
	
	//console.log($('#layerSelection').val());
	downdata(layer,urlmap);
	
}

function check50features(){
	var is50features=document.getElementById('maxFeatures').checked;
	if(is50features==true){
		var maxFeatures='&maxFeatures=50';
	}else{
		var maxFeatures='';
	}
	return maxFeatures;
	//alert(is50features);
}

function downdata(layername,urldowndata){
	var dialogdowndata=document.getElementById('dialogdowndata');
	var noidungdowdata='Chọn định dạng dữ liệu bạn muốn tải về';
	noidungdowdata+="\n"+'<select name="formatdowndata" id="formatdowndata" onchange="javascript:makeurldownload(\''+layername+'\',\''+urldowndata+'\');">';
	
	noidungdowdata+="\n"+'<option value="">--Chọn--</option>';
	noidungdowdata+="\n"+'<option value="?service=WFS&version=1.0.0&request=GetFeature&outputFormat=application%2Fvnd.google-earth.kml%2Bxml">KML</option>';
	noidungdowdata+="\n"+'<option value="?service=WFS&version=1.0.0&request=GetFeature&outputFormat=csv">CSV</option>';
	noidungdowdata+="\n"+'<option value="?service=WFS&version=1.0.0&request=GetFeature&outputFormat=application/json">GeoJson</option>';
	noidungdowdata+="\n"+'<option value="?service=WFS&version=1.0.0&request=GetFeature&outputFormat=SHAPE-ZIP">Shapefile</option>';
	
	noidungdowdata+="\n"+'</select>';
	noidungdowdata+="\n"+'<input type="checkbox" name="maxFeatures" id="maxFeatures" value="" checked="true" onclick="javascript:makeurldownload(\''+layername+'\',\''+urldowndata+'\');">50 features first<br>';
	noidungdowdata+="\n"+'</br>';
	noidungdowdata+="\n"+'<textarea id="txt_urldownload"></textarea>';
	noidungdowdata+="\n"+'<br><br>';
	noidungdowdata+="\n"+'<input type="button" value="Download" onclick="javascript:OpenInNewTab(\''+layername+'\',\''+urldowndata+'\');"/>';
	dialogdowndata.innerHTML=noidungdowdata;
	$(function() {
			$( "#dialogdowndata" ).dialog({
				height:250,
				width:400
			});
		});
}

function OpenInNewTab(layername,urldowndata){
	var formatdownload=document.getElementById('formatdowndata').value;
	if(formatdownload!=''){
		var urldown=urldowndata+formatdownload+check50features()+'&typeName='+layername;
		var win=window.open(urldown, '_blank');
		win.focus();
	}else{
		alert('Chưa chọn format!');
	}
}

function makeurldownload(layername,urldowndata){
	var formatdownload=document.getElementById('formatdowndata').value;
	if(formatdownload!=''){
		var urldown=urldowndata+formatdownload+check50features()+'&typeName='+layername;
		document.getElementById('txt_urldownload').value=urldown;
		//check50features();
	}else{
		document.getElementById('txt_urldownload').value='...'
	}
	
	//var win=window.open(urldown, '_blank');
	//win.focus();
}

function addinfo(valueinfo){
	if(document.getElementById('scriptinfo')){
		//--deactive info control
		for (var key in infoControls) {
			var control = infoControls[key];
				infoControls.click.deactivate();
		}
		//---remove control
		for (var i in infoControls) { 
			infoControls[i].events.register("getfeatureinfo", this, showInfo);
			map.removeControl(infoControls[i]); 
		}
		//remove script
		var element = document.getElementById('scriptinfo');
		element.parentNode.removeChild(element);
	}
//---------
	//alert(valueinfo.value);
	
	var arr=valueinfo.value.split(',');
	var uniname=arr[0];
	var urlmap=arr[1];

	//alert(uniname + '|' + urlmap);
	
	var script   = document.createElement("script");
	script.type  = "text/javascript";
	script.id='scriptinfo';
	script.text+="\n"+'var urlmapfile = "'+urlmap+'";';
	script.text+="\n"+'infoControls = {';
	script.text+="\n"+'click: new OpenLayers.Control.WMSGetFeatureInfo({';
	script.text+="\n"+'url: urlmapfile,';
	script.text+="\n"+'title: \'Lấy thông tin đối tượng\',';
	script.text+="\n"+'layers: ['+uniname+'],';
	script.text+="\n"+'queryVisible: true';
	script.text+="\n"+'}),';
	script.text+="\n"+'hover: new OpenLayers.Control.WMSGetFeatureInfo({';
	script.text+="\n"+'url: urlmapfile,';
	script.text+="\n"+'title: \'Lấy thông tin đối tượng\',';
	script.text+="\n"+'layers: ['+uniname+'],';
	script.text+="\n"+'hover: true,';
	script.text+="\n"+'formatOptions: {';
	script.text+="\n"+'typeName: \'water_bodies\',';
	script.text+="\n"+'featureNS: \'http://www.openplans.org/topp\'';
	script.text+="\n"+'},';
	script.text+="\n"+'queryVisible: true';
	script.text+="\n"+'})';
	script.text+="\n"+'};';
	script.text+="\n"+'//info2';
	script.text+="\n"+'for (var i in infoControls) {';
	script.text+="\n"+'infoControls[i].events.register("getfeatureinfo", this, showInfo);';
	script.text+="\n"+'map.addControl(infoControls[i]);';
	script.text+="\n"+'}';
	script.text+="\n"+'//info3';
	script.text+="\n"+'function showInfo(evt) {';
	script.text+="\n"+'var dialoginfo=document.getElementById(\'dialog\');';
	script.text+="\n"+'if (evt.features && evt.features.length) {';
	script.text+="\n"+'highlightLayer.destroyFeatures();';
	script.text+="\n"+'highlightLayer.addFeatures(evt.features);';
	script.text+="\n"+'highlightLayer.redraw();';
	script.text+="\n"+'} else {';
	script.text+="\n"+'dialoginfo.innerHTML=evt.text;';
	script.text+="\n"+'$(function() {';
	script.text+="\n"+'$( "#dialog" ).dialog({';
	script.text+="\n"+'height:200,';
	script.text+="\n"+'width:450';
	script.text+="\n"+'});';
	script.text+="\n"+'});';
	script.text+="\n"+'}';
	script.text+="\n"+'}';
	script.text+="\n"+'//active  info layer';
	script.text+="\n"+'for (var key in infoControls) {';
	script.text+="\n"+'var control = infoControls[key];';
	script.text+="\n"+'control.layers = ['+uniname+'];';
	script.text+="\n"+'infoControls.click.activate();';
	script.text+="\n"+'}';
	document.body.appendChild(script);
	
}

function removemap(){
	var arr=$('#layerSelection').val().split(',');
	var uniname=arr[2];
	var urlmap=arr[1];
	
	console.log(uniname);	
	
	var element = document.getElementById('layer'+uniname);
	//console.log(element);
	if(element){
		element.parentNode.removeChild(element);
	
		/* //remove option info
		var element = document.getElementById('id'+uniname);
		element.parentNode.removeChild(element); */
		
		//remove script info
		if(document.getElementById('scriptinfo')){
			//---remove control
			for (var i in infoControls) { 
				infoControls[i].events.register("getfeatureinfo", this, showInfo);
				map.removeControl(infoControls[i]); 
			}
			//remove script
			var element = document.getElementById('scriptinfo');
			element.parentNode.removeChild(element);
		}
		
		map.removeLayer(eval(uniname));
	}
	
}

function urlparam(urlstr,param){
	
	var res=urlstr.split('?');
	//console.log(res[0]);
	var url = new URL(urlstr);
	if(param==''){
		paramvalue='';
	}else{
		var paramvalue = url.searchParams.get(param);
	}
	
	var arr=new Array();
	arr['url']=res[0];
	arr['param']=paramvalue;
	return arr;
	
}

$('.collapse').collapse();
//tabs
$(document).ready(function(){
	//$('.nav-tabs a[href="#menu2"]').tab('show')
	$('.nav-tabs a').on('shown.bs.tab', function(event){
	tabnew=(event.target.hash).replace("#", "");
	tabpre=(event.relatedTarget.hash).replace("#", "");
	//console.log(tabpre);
	//console.log(tabnew);
	curtab=tabnew;
	console.log(curtab);
});
});


    </script>
	<style type="text/css">
	html, body{
			height: 100%; 
		} 
		#mapn {
			margin: 0;
			width: 100%;
			height: 100%;
			border: 1px solid #ccc;
		}
		#text {
			position: absolute;
			top: 5em;
			left: 7em;
			/*width: 512px;*/
			z-index: 20000;
			/*background-color: white;*/
			background: rgb(255, 255, 255);
			background: rgba(255, 255, 255, 0.7);
			padding: 0 0.5em 0.5em 0.5em;
		}
	</style>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-45248164-12"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-45248164-12');
</script>

  </head>
	<body id="body" onload="init();">
	<div id="dialogdowndata" title="Loại dữ liệu cần down là..."></div>
	<div class="col-md-12" style="height:100%;">
		<div class="row" style="height:100%;">
			<div class="col-sm-6">
				<h1 id="title">GET Map OGC WMS, WFS, WCS services by <a href="https://dothanhlong.org/" target="_blank">soiqualang_chentreu</a></h1>
				<?php
					include('accordion.php');
				?>
			</div>
			<div class="col-sm-6" style="height:100%;">
				<div id="map" style="height:100%;"></div>	
				<div id="dialog" title="Thông tin vị trí"></div>
			</div>
		</div>
	</div>
	</body>
<script>
format="image/png";
</script>
</html>