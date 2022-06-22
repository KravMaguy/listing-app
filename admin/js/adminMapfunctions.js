function initAutocomplete() {
  var map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 42.02815, lng: -87.7197 },
    zoom: 8,
    mapTypeId: "roadmap",
  });




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


  var tour = new Tour({
    steps: [
      {
        element: "#add-building-input",
        title: "add building searchbar",
        content: `${fname}, you can type an adress in here to add a building`,
        placement: "bottom"
      },
      {
        element: "#admin-map-card",
        title: `${fname}'s Map`,
        content: `This map will display your buildings. ${fname}, after you add a listing using the searchbar, a pin will appear on this map, tap it to enter the details of the building you'd like to add`,
        placement: "top"
      },
      {
        element: "#collapseMenu",
        title: "Your Profile links",
        content: "Here you will see your profile links",
        placement: "right",
        // onShow: function(){$(".collapsed-sidebar").trigger("click")},
        onHide: function(){$(".nav-link").trigger("click")}

      },
      {
        element: "#buildingsProfileLink",
        title: "Your Buildings link",
        content: "Here you can see all of your listed buildings, similarly, you can also click on a map icon to see the details of a particular building",
        placement: "right",
      },
      {
        element: "#tourtest",
        title: "Re-open the tour",
        content: "You can always come back here if you wish to see the instructions again for listing your buildings and spaces",
        placement: "left",
        onShow: function(){$(".dropdown-toggle").trigger("click")},
        // onHide: function(){$(".dropdown-menu-right").toggle()}

      }
    ],
    storage: false,
    backdrop:true,
  });

  $("#tourtest").click(function() {
    console.log('tour btn was clicked open tour')
    tour.restart();
  });
  let defaultSize = [28, 43];	
  let selectedSize = [38, 48];
  var defaultIcon = makeMarkerIcon("4e73df", defaultSize);	
  var highlightedIcon = makeMarkerIcon("f4623a", selectedSize);

  const svgMarker = {
    path:
      "M0-48c-9.8 0-17.7 7.8-17.7 17.4 0 15.5 17.7 30.6 17.7 30.6s17.7-15.4 17.7-30.6c0-9.6-7.9-17.4-17.7-17.4z",
    fillColor: "#4e73df",
    fillOpacity: 1,
    strokeWeight: 0,
    rotation: 0,
    scale: .5,
    anchor: new google.maps.Point(15, 30),
  };

  const svgMarker2 = {
    path:
      "M0-48c-9.8 0-17.7 7.8-17.7 17.4 0 15.5 17.7 30.6 17.7 30.6s17.7-15.4 17.7-30.6c0-9.6-7.9-17.4-17.7-17.4z",
    fillColor: "red",
    fillOpacity: 1,
    strokeWeight: 0,
    rotation: 0,
    scale: .7,
    anchor: new google.maps.Point(15, 30),
  };

  if(markers.length>0){
    for (var x in markers) {
      name = markers[x].name;
      lat = parseFloat(markers[x].lat);
      lng = parseFloat(markers[x].lng);
      description = markers[x].description;
      id = markers[x].id;
      featuredImg = markers[x].image;
  
      let marker = new google.maps.Marker({
        position: { lat: lat, lng: lng },
        name: name,
        description: description,
        building_id: id,
        map: map,
        featuredImg: featuredImg,
        icon: defaultIcon,	
        // icon: svgMarker,
      });

      		
    marker.addListener("mouseover", function () {	
      this.setIcon(highlightedIcon);	
    });	
    marker.addListener("mouseout", function () {	
      this.setIcon(defaultIcon);	
    });	

  
      var infowindow = new google.maps.InfoWindow();
      google.maps.event.addListener(marker, "click", function (e) {
        console.log("marker now clicked");
        console.log(marker, "marker");
        $("p").css("color", "red");
        $("#building-image").css(
          "background-image",
          "url('images/" + marker.featuredImg + "')"
        );
        $("#building-name").html(marker.name);
        $("#building-description").html(marker.description);
        $("#infoWindowModal").modal("show");
  
        $("#edit-building-link").html(
          "<a href='edit_building.php?id=" +
            marker.building_id +
            "'>edit building</a>"
        );
      });
    }
  } else {
    console.log('open modal')

    
    $("#noListingsModal").modal("show");

    // tour.init();
		// tour.start();

$("#startTourBtn").click(function() {
  // tour.restart();
  console.log('tour btn was clicked open tour')
  $("#noListingsModal").modal("toggle");
	tour.start();

});

  }


  var input = document.getElementById("pac-input");
  var searchBox = new google.maps.places.SearchBox(input);
  map.addListener("bounds_changed", function () {
    searchBox.setBounds(map.getBounds());
  });

  searchBox.addListener("places_changed", function () {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    var bounds = new google.maps.LatLngBounds();
    places.forEach(function (place) {
      if (!place.geometry) {
        return;
      }
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25),
      };
      marker = new google.maps.Marker({
        map: map,
        title: place.name,
        position: place.geometry.location,
      });

      marker.addListener("click", function (e) {
        map.setCenter(this.position);
        $("#bldname").val(this.title);
        $("#bldaddress").val(place.formatted_address);
        $("#bldLat").val(place.geometry.location.lat());
        $("#bldLng").val(place.geometry.location.lng());
        $("#myModal").modal("show");
      });
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
}

$(document).ready(function (e) {
  // submit and process the form
  $("#bldForm").on("submit", function (e) {
    e.preventDefault();
    console.log("trying to submit");
    // process the form
    $.ajax({
      url: "scripts/add_building_handler.php", // Url to which the request is send
      type: "POST", // Type of request to be send, called as method
      data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
      contentType: false, // The content type used when sending data to the server.
      cache: false, // To disable request pages to be cached
      processData: false, // To send DOMDocument or non processed data file it is set to false
    })
      // using the done promise callback
      .done(function (data) {
        console.log("1");
        var j = JSON.parse(data);
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
          for (var n in j.message) {
            $("#notification").append(j.message[n]);
          }
        }
      })
      .fail(function () {
        console.log("2");
        $("#myModal").modal("hide");
        $("#failModal").modal("show");
      });
  });
});
