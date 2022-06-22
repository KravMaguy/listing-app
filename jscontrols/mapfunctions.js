const state = {
  isPolygon: false,
};
var w = window.innerWidth;
var input = document.getElementById("pac-input");
if (w < 600) {
  input.style.width = "300px";
}
input.style.borderRadius = "2px";
input.style.height = "50px";

var chicago = { lat: 41.85, lng: -87.65 };
function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
}

function closeSearch() {
  document.getElementById("myOverlay").style.display = "none";
}

function makeMarkerIcon(markerColor, size, point) {
  var markerImage = new google.maps.MarkerImage(
    "http://chart.googleapis.com/chart?chst=d_map_spin&chld=1.15|0|" +
      markerColor +
      "|40|_|%E2%80%A2",
    null,
    null,
    null,
    new google.maps.Size(...size)
  );
  return markerImage;
}

function clearPolygonControl(controlDiv) {
  var controlUI = document.createElement("div");
  controlUI.style.backgroundColor = "#fff";
  controlUI.style.border = "2px solid #fff";
  controlUI.style.borderRadius = "3px";
  controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
  controlUI.style.cursor = "pointer";
  controlUI.style.marginTop = "0px";
  controlUI.style.marginBottom = "22px";
  controlUI.style.marginLeft = "10px";

  controlUI.style.textAlign = "center";
  controlUI.title = "Click to clear the polygon area";
  controlDiv.appendChild(controlUI);
  controlUI.id = "clear_polygon";
  controlUI.style.display = "none";
  var controlText = document.createElement("div");
  controlText.style.color = "rgb(25,25,25)";
  controlText.style.fontFamily = "Roboto,Arial,sans-serif";
  controlText.style.fontSize = "16px";
  controlText.style.lineHeight = "38px";
  controlText.style.paddingLeft = "5px";
  controlText.style.paddingRight = "5px";
  controlText.innerHTML = "Clear Border";
  // controlText.style.color = "white";
  controlUI.appendChild(controlText);
  controlUI.addEventListener("click", function () {
    clearPolygon();
    this.style.display = "none";
  });
}

function CenterControl(controlDiv) {
  var controlUI = document.createElement("div");
  controlUI.className = "control-ui";
  controlUI.id="open-search";
  controlUI.style.backgroundColor = "#f4623a";
  controlUI.style.border = "2px solid #fff";
  controlUI.style.borderRadius = "3px";
  controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
  controlUI.style.cursor = "pointer";
  controlUI.style.marginTop = "10px";
  controlUI.title = "Click to search the map";
  controlDiv.appendChild(controlUI);
  var controlText = document.createElement("div");
  controlText.style.color = "rgb(25,25,25)";
  controlText.style.fontWeight = "bold";
  controlText.style.fontSize = "28px";
  controlText.style.lineHeight = "38px";
  controlText.style.paddingLeft = "5px";
  controlText.style.paddingRight = "5px";
  controlText.innerHTML = "Search " + '<i class="fas fa-search"/>';
  controlText.style.color = "white";
  controlUI.appendChild(controlText);
  controlUI.addEventListener("click", function () {
    openSearch();
  });
}

function initAutocomplete() {
  var map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 42.02815, lng: -87.7197 },
    zoom: 8,
    mapTypeId: "roadmap",
    // styles: redStyle,
  });
  console.log('markers', markers)
  var latitude1 = 41.8789;
  var longitude1 = -87.6359;
  var latitude2 = 42.0278;
  var longitude2 = -87.720006;

  let pointA = new google.maps.LatLng(latitude1, longitude1);
  let pointB = new google.maps.LatLng(latitude2, longitude2);
  var rad = function (x) {
    return (x * Math.PI) / 180;
  };

  var getDistance = function (p1, p2) {
    var R = 6378137; // Earth’s mean radius in meter
    var dLat = rad(p2.lat() - p1.lat());
    var dLong = rad(p2.lng() - p1.lng());
    var a =
      Math.sin(dLat / 2) * Math.sin(dLat / 2) +
      Math.cos(rad(p1.lat())) *
        Math.cos(rad(p2.lat())) *
        Math.sin(dLong / 2) *
        Math.sin(dLong / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c;
    return console.log((d / 1609.34).toFixed(2), "the D"); // returns the distance in meter
  };
  getDistance(pointA, pointB);
  var clearPolygonDiv = document.createElement("div");
  var centerControlDiv = document.createElement("div");
  new CenterControl(centerControlDiv, map);
  new clearPolygonControl(clearPolygonDiv, map);
  // centerControlDiv.index = 1;
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(centerControlDiv);
  map.controls[google.maps.ControlPosition.LEFT_TOP].push(clearPolygonDiv);

  let defaultSize = [28, 43];
  let selectedSize = [38, 48];
  var defaultIcon = makeMarkerIcon("f4623a", defaultSize);
  var highlightedIcon = makeMarkerIcon("007bff", selectedSize);
  map.markers = []; // ADD THIS LIN
  var bounds = new google.maps.LatLngBounds();
  for (var x in markers) {
    title = markers[x].name;
    lat = parseFloat(markers[x].lat);
    lng = parseFloat(markers[x].lng);
    description = markers[x].description;
    id = markers[x].id;
    userId=markers[x]['user_id'];
    featuredImg = markers[x].image;
    console.log(featuredImg, "featured img");
    let marker = new google.maps.Marker({
      position: { lat: lat, lng: lng },
      icon: defaultIcon,
      title,
      userId,
      description: description,
      building_id: id,
      map: map,
      featuredImg: featuredImg,
    });
    bounds.extend(marker.position);

    marker.addListener("mouseover", function () {
      this.setIcon(highlightedIcon);
    });
    marker.addListener("mouseout", function () {
      this.setIcon(defaultIcon);
    });

    google.maps.event.addListener(marker, "click", function (e) {
      console.log(marker, "marker");
      console.log("**************************!!!!!!!!!!!!!!!!!!!");
      console.log(marker.position.lat(), marker.position.lng());
      $("#building-image").css(
        "background-image",
        "url('admin/images/" + marker.featuredImg + "')"
      );
      $("#building-name").html(marker.title);
      $("#building-description").html(marker.description);
      $("#units-link").html(
        "<a href='building_units.php?id=" +
          marker.building_id +
          "'>Units and floor plans</a>"
      );
      $("#building-photos").html(
        "<a href='building_images.php?id=" +
          marker.building_id +
          "'>View building photos</a>"
      );
      $("#directions-link").html(
        `<a target="new" href="https://www.google.com/maps/dir/?api=1&destination=${marker.position.lat()},${marker.position.lng()}">Get Directions to this building</a>`
      );

      $("#contact-link").html(
        `<button class="btn btn-primary" data-title="${marker.title}" data-userid="${marker.userId}" id="contact-agent-button">Contact Agent</button>`
      );
      $("#infoWindowModal").modal("show");
    });
    map.markers.push(marker);
  }



  // var markers = [];//some array
// var bounds = new google.maps.LatLngBounds();
// for (var i = 0; i < markers.length; i++) {
//  bounds.extend(markers[i]);
// }

map.fitBounds(bounds);



  $("#contact-link").click(function(){
    console.log(this.firstChild.attributes, 'attributes')
    const buildingTitle=this.firstChild.attributes['data-title'].value
    const userId=this.firstChild.attributes['data-userid'].value
    console.log(userId, buildingTitle)
    $("#contact-modal-building-title").html(
      `<h3>${buildingTitle}</h3>`
    );
    $("#contact_user_id").val(userId);
    
    $("#contact-agent-modal").modal("show");
  });

  const cluster = new MarkerClusterer(map, map.markers, {
    imagePath:
      "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
  });

  var input = document.getElementById("pac-input");
  var searchBox = new google.maps.places.SearchBox(input);
  console.log('maerkers here')
  searchBox.setBounds(map.getBounds());
  searchBox.addListener("places_changed", function () {
    var places = searchBox.getPlaces();
    if (places.length == 0) {
      console.log("no places listed");
      return;
    } else {
      // console.log("there are places returned");
    }
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function (place) {
      if (!place.geometry) {
        return;
      }
      if (place.geometry.viewport) {
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    closeSearch();
    map.fitBounds(bounds);
    Request__drawVal(input.value, map);
    showVisibleMarkers(map);
  });
  console.log(state.isPolygon, "is polygon??");
 
}

function showSwal(count) {
  if (count > 0) {
    return setTimeout(function () {
      swal(
        "Awesome",
        `You found <b style="color:green;">${count}</b> listings! Click on one to see more details`,
        "success"
      );
    }, 1700);
  }
  return setTimeout(function () {
    swal(
      "No Results!",
      `Your search returned <b style="color:red;">${count}</b> buildings, maybe sign up and add some listings? its free, why not?`,
      "error"
    );
  }, 1700);
}

function showVisibleMarkers(map) {
  let buildingCount = 0;
  let j;
  var bounds = map.getBounds();
  for (j = 0; j < map.markers.length; j++) {
    if (bounds.contains(map.markers[j].getPosition()) === true) {
      buildingCount++;
    } else {
    }
    // console.log(map.markers[j], 'map.markers at index')
  }
  // console.log("the search component returned " + buildingCount + " listings");
  showSwal(buildingCount);
  buildingCount = 0;
}


$(document).ready(function () {
  // submit and process the form
  $("#contact-agent-form").on("submit", function (e) {
    e.preventDefault();
    console.log("trying to submit");

    $.ajax({
      url: "scripts/contact_agent.php",
      type: "POST",
      data: new FormData(this), 
      contentType: false,
      cache: false,
      processData: false,
    })
    .done(function (data) {
      console.log("1");
      console.log(data,'data')
      var j = JSON.parse(data);
      console.log(j,'j')
      $("#successMessage").empty();
      $("#notification").empty();
      // here we will handle errors and validation messages
      //show a success message
      if (j.ajaxerror == true) {
        //hide the form
        $("#myModal").modal("hide");
        //show success modal
        $("#successModal").modal("show");
        //initAutocomplete();
        //display notification messages
        for (var n in j.message) {
          $("#successMessage").append(j.message[n]);
        }
      } else {
        //notification messages
        // for (var n in j.message) {
        //   $("#notification").append(j.message[n]);
        // }
      }
    })
    .fail(function () {
      console.log("2");
      $("#myModal").modal("hide");
      $("#failModal").modal("show");
    });

  });
});