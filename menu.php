<script type="text/javascript">
  var regions = [
    {
      name: 'FRANKLIN',
      lat: 36.025, 
      lng: -86.668,
      medicalCenters: [
        {
          name: 'Vanderbilt Health and Williamson',
          type: 'Medical Center',
          tel: '(615) 791-737',
          lat: 35.917367,
          lng: -86.841134,
          info: 'Vanderbilt Health and Williamson Info Window1'
        },
        {
          name: 'Vanderbilt Health and Williamson Medical',
          type: 'Center Cool Springs Walk In Clinic',
          tel: '(615) 875-4200',
          lat: 35.935867, 
          lng: -86.825720,
          info: 'Vanderbilt Health and Williamson Info Window2'
        }
      ]
    },
    {
      name: 'Other Region',
      lat: 36.025, 
      lng: -86.668,
      medicalCenters: [
        {
          name: 'Test 2',
          type: 'Medical Center',
          tel: '(615) 791-737',
          lat: 36.197899,
          lng: -86.517850,
          info: 'Vanderbilt Health and Williamson Info Window3'
        }
      ]
    }
  ];
</script>
<link type="text/css" rel="stylesheet" href="sdmenu/sdmenu.css" />
<link type="text/css" rel="stylesheet" href="walkinclinics.css" />
<script src="http://maps.google.com/maps/api/js?sensor=false"
          type="text/javascript"></script>
<script type="text/javascript" src="sdmenu/sdmenu.js"></script>

<script type="text/javascript">
	// <![CDATA[
	var myMenu;
	window.onload = function() {
	};
	// ]]>
</script>

<style>
    body {
        margin:0;
        width:100%;
    }
    .medical-center-info {
      min-width: 100px;
      min-height: 50px;
    }
    .menu-hidden .medical-centers {
      display: none;
    }
    .menu-visible .medical-centers {
      display: block;
    }
</style>
<div style="width: 1134px; margin:0 auto;">
<img src="top_mockup.jpg" style="border:0;">
<br />


<div style="float:left; width:270px; margin:10px 0 0 204px;" id="walkinclinics" class="sdmenu">

<div id="regions"></div>


</div>
<div>
    <div class="map" style="float: left; margin:14px 0 0 20px; border:1px solid #cecece; border-radius:10px; -webkit-border-radius:10px; -moz-border-radius:10px;">
      <!--<input onclick="showOnes();" type=button value="Show Franklin Clinics">
      <input onclick="showTwos();" type=button value="Show Spring Hill Clinics">
      <input onclick="showThree();" type=button value="Show Mt. Juliet Clinics">
      <input onclick="showFour();" type=button value="Show Hendersonville Clinics">
  <br>
  <br>-->
  <div id="map" style="width: 588px; height: 600px; border-radius:10px; -webkit-border-radius:10px; -moz-border-radius:10px;"></div>
    </div>
  <script type="text/javascript">
    var map, infowindow, markers = [];

    function renderRegionMarkers(regionId) {
      var marker;
      var region = regions[regionId];

      for (var i = 0; i < region.medicalCenters.length; i++) {
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(region.medicalCenters[i].lat, region.medicalCenters[i].lng),
          map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent('<div class="medical-center-info">' + region.medicalCenters[i].info + '</div>');
            infowindow.open(map, marker);
          }
        })(marker, i));

        regions[regionId].medicalCenters[i].marker = marker;
        markers.push(marker);
      }
    }

    function showRegion(node, event, regionId) {
      event.preventDefault();
      var visibleMenus = document.querySelectorAll('.menu-visible');
      for (var i = 0; i < visibleMenus.length; i++) {
        visibleMenus[i].classList.remove('menu-visible');
      }
      //$('.menu-visible').removeClass('menu-visible');
      node.parentNode.parentNode.classList.add('menu-visible');

      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
      }
      markers = [];
      renderRegionMarkers(regionId);
    }

    function showInfo(node, event, medicalCenterId, regionId) {
      event.preventDefault();
      infowindow.setContent('<div class="medical-center-info">' + regions[regionId].medicalCenters[medicalCenterId].info + '</div>');
      infowindow.open(map, regions[regionId].medicalCenters[medicalCenterId].marker);
    }

    google.maps.event.addDomListener(window, 'load', function() {
      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: new google.maps.LatLng(35.917367, -86.841134),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      infowindow = new google.maps.InfoWindow();
      for (var regionId = 0; regionId < regions.length; regionId++) {
        renderRegionMarkers(regionId);
      }

      console.log(regions);
    });
  </script>
</div>
</div>

<script src="twig.js"></script>
<script id="medical-center" type="x-html">
    <p class="home-steps-text textspace">
        <strong class="title-text">{{ medicalCenter.name }}<br />{{ medicalCenter.type }}</strong>
        <br />
        <!--<a href="http://www.mc.vanderbilt.edu/root/vumc.php?site=walkinclinics&amp;doc=43216">About Us</a>-->
        <a href="tel:615-791-7373">{{ medicalCenter.tel }}</a>
    </p>

    <a href="#"><img src="sdmenu/tell-us-btn.jpg" style="margin-left:42px; border:0;"></a>

    <p class="home-steps-text">
        919 Murfreesboro Road (Hwy. 96)
        <br />
        Franklin, TN 37064
        <br />
        <a href="#" class="mapLink" onclick="showInfo(this, event, {{ id }}, {{ regionId }})">map</a>
    </p>

    <table width="100%">
        <tr>
            <td width="50%">
                Monday-Friday
                <br />
                7:30 a.m.-7:30 p.m.
            </td>
            <td width="50%">
                Saturday-Sunday
                <br />
                8&nbsp;a.m.-5&nbsp;p.m.
            </td>
        </tr>
    </table>

    <br />
    <hr />
    <br />
</script>

<script id="region" type="x-html">
  <div class="collapsed menu-hidden">
      <span><a href="#" onclick="showRegion(this, event, {{ id }});">{{ region.name }}</a></span>

      <div class="medical-centers">
        {{ medicalCenterHtml }}
      </div>
  </div>
</script>

<script>
var regionTemplate = twig({
    data: document.getElementById('region').innerHTML
});
var medicalCenterTemplate = twig({
    data: document.getElementById('medical-center').innerHTML
});
var wrapper = document.getElementById('regions');

var renderMedicalCenters = function(medicalCenters, regionId) {
  var html = '';
  for (var i = 0; i < medicalCenters.length; i++) {
    html += medicalCenterTemplate.render({
      id: i,
      regionId: regionId,
      medicalCenter: medicalCenters[i]
    });
  }
  return html;
};

var renderRegions = function(regions) {
  var html = '';
  for (var i = 0; i < regions.length; i++) {
    var medicalCenterHtml = renderMedicalCenters(regions[i].medicalCenters, i);
    html += regionTemplate.render({
      id: i,
      region: regions[i],
      medicalCenterHtml: medicalCenterHtml
    });
  }
  return html;
};

wrapper.innerHTML = renderRegions(regions);
</script>
