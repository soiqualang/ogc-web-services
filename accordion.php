<div class="infocollapse">	
	<div class="panel panel-default">
		<div id="r2" class="panel-collapse in" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: auto;">
		  <div class="panel-body">
		  <!---body--->
			<div class="col-xs-7">
				<input list="urlservice2" name="urlservice2" id="urlservice" class="form-control col-md-7 col-xs-12 input-sm" placeholder="http://localhost:8080/geoserver/dothanhlong/wms?service=WMS&version=1.1.0&request=GetMap&layers=dothanhlong:tram_khitruong&styles=&bbox=103.485,7.558611111,111.7444444,11.85416667&width=768&height=399&srs=EPSG:4326&format=application/openlayers">
				<datalist id="urlservice2">
					<option value="http://portal.hcmgis.vn/geoserver/wms?">
					<option value="http://maps.vnforest.gov.vn:802/geoserver/FRMS/ows?">
					<option value="https://maps.hcmgis.vn/geoserver/ows">
					<option value="https://www.gebco.net/data_and_products/gebco_web_services/web_map_service/mapserv?">
					<option value="https://pcd.hcmgis.vn/geoserver/gwc/service/wms?">
					<option value="http://tools.geofabrik.de/osmi/view/water/wxs?">
					<option value="http://tools.geofabrik.de/osmi/view/addresses/wxs?">
					<option value="http://tools.geofabrik.de/osmi/view/geometry/wxs?">
<option value="http://geoweb.hft-stuttgart.de/cgi-bin/mapserv?map=/home/fjbehr/SRTM/test.map">
<option value="https://maps.omniscale.net/v2/mapsosc-b697cf5a/map?">
<option value="http://tools.geofabrik.de/osmi/view/places/wxs?">
<option value="http://tools.geofabrik.de/osmi/view/pubtrans_stops/wxs?">
<option value="http://tools.geofabrik.de/osmi/view/tagging/wxs?">
				</datalist>
				<button type="button" class="btn btn-default btn-sm" onclick="get_layers();">Get Layer</button>
			</div>
			<div class="col-xs-5">
				<select name="layerSelection" id="layerSelection" class="form-control col-md-7 input-sm">
					<option value="none">Choose layer</option>
				</select>					
				<button type="button" class="btn btn-default btn-sm" onclick="addmap();">Add</button>
				<button type="button" class="btn btn-default btn-sm" 
				onclick="removemap();">Remove</button>
				<button type="button" class="btn btn-default btn-sm" 
				onclick="downloadmap();">Get Map</button>
			</div>
			<!---endbody--->
		  </div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingOne">
		  <h4 class="panel-title">
			<a role="button" data-toggle="collapse" data-parent="#accordion" href="#r5" aria-expanded="false" aria-controls="r5" class="collapsed">
				Service Info
			</a>
		  </h4>
		</div>
		<div id="r5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: auto;">
		  <div class="panel-body">
		  <!---body--->
			<div class="col-xs-12">
				<pre id="serviceinfo" height="auto">Nothing here :p</pre>
			</div>
			<!---endbody--->
		  </div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingOne">
		  <h4 class="panel-title">
			<a role="button" data-toggle="collapse" data-parent="#accordion" href="#r6" aria-expanded="false" aria-controls="r6" class="collapsed">
				Track logs
			</a>
		  </h4>
		</div>
		<div id="r6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: auto;">
		  <div class="panel-body">
		  <!---body--->
			<div class="col-xs-12">
				<pre id="tracklogs" height="auto">
Author:Đỗ Thành Long (soiqualang_chentreu)
---
13/07/2018 (Thứ 6 ngày 13 :p )
App version 1;
Cho phép nhập địa chỉ service và get các WMS layers về;
Hiển thị WMS layers;
Cho phép download dữ liệu shapefile, KML, GeoJson, CSV nếu dịch vụ cung cấp WFS.
---
14/07/2018
Thêm vào danh sách một số nguồn Open WMS Service.
Nguồn:
https://www.gebco.net/data_and_products/gebco_web_services/web_map_service/
---
23/07/2018
Thêm nguồn down dữ liệu rừng Việt Nam
vnforest.gov.vn
Tích hợp chức năng get link download để bỏ vào các phần mềm download như IDM, Flashget,.. (Dùng download dữ liệu lớn)
Thêm chức năng download 50 features đầu tiên (để kiểm tra services hoạt động không)
				</pre>				
			</div>
			<!---endbody--->
		  </div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingOne">
		  <h4 class="panel-title">
			<a role="button" data-toggle="collapse" data-parent="#accordion" href="#r7" aria-expanded="false" aria-controls="r7" class="collapsed">
				User manual
			</a>
		  </h4>
		</div>
		<div id="r7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: auto;">
		  <div class="panel-body">
		  <!---body--->
			<div class="col-xs-12">
				<iframe width="100%" height="360" src="https://www.youtube.com/embed/0fh3eANkTGs" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</div>
			<!---endbody--->
		  </div>
		</div>
	</div>
</div>