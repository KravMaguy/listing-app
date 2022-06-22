const clearPolygon=()=>{
    try {
        searchedPolygon.setMap(null);
      } catch (e) {
        console.log(e instanceof ReferenceError);
      }
}

function draw_Val(arr,map) {
    if (arr.length <70) {
      arr = arr[0];
    }
    var coordsToDraw = new Array();
    for (var i = 0; i < arr.length; i++) {
        coordsToDraw[i] = new google.maps.LatLng(
          parseFloat(arr[i][1]),
          parseFloat(arr[i][0])
        );
    }
    clearPolygon()
    searchedPolygon = new google.maps.Polygon({
      paths: coordsToDraw,
      strokeColor: "red",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#6666FF",
      fillOpacity: 0.35,
    });
    searchedPolygon.setMap(map);
    state.isPolygon=true;
  }
  
  function Request__drawVal(val,map) {
    //   console.clear()
    $.ajax({
      async: true,
      url: `https://nominatim.openstreetmap.org/search.php?q=${val}&polygon_geojson=1&format=geojson`,
      success: function (result) {
          console.log(result, 'result')
        let polygonArr = result.features[0].geometry.coordinates[0];
        try{
            const length1=result.features[0].geometry.coordinates[0][0].length
            const length2=result.features[0].geometry.coordinates[1][0].length
            console.log(length1, 'l1')
            console.log(length2, 'l2')
            if(length1<length2){
                polygonArr=result.features[0].geometry.coordinates[1][0]
            }
            // const coordinatesArr=result.features[0].geometry.coordinates
            // let greatestIndex=0
            // for(let i=0;i<coordinatesArr.length;i++){
            //     console.log(coordinatesArr[i][0].length, i)
            //     if(coordinatesArr[i][0].length>coordinatesArr[greatestIndex][0].length){
            //         greatestIndex=i
            //     }
            // }
            // console.log(greatestIndex,': greatestIndex')
            // polygonArr=result.features[0].geometry.coordinates[greatestIndex][0]

        }catch(e){
            console.log(e,'err')
        }
        if(!Array.isArray(polygonArr)){
            polygonArr=result.features[1].geometry.coordinates[0];
        } 
        console.log(polygonArr, 'polygonArray')
        document.getElementById("clear_polygon").style.display='block'
        draw_Val(polygonArr,map);

      },
      error: function (err) {
        console.log("error:", err);
      },
    });
  }