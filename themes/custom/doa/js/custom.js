function initMap() {

  var input2 = document.getElementById('whattosearch');

  var autocomplete2 = new google.maps.places.Autocomplete(input2);

  autocomplete2.addListener('place_changed', function() {
    var place2 = autocomplete2.getPlace();
    if (!place2.geometry) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place2.name + "'");
      return;
    }
    var address2 = '';
    if (place2.address_components) {
      address2 = [
        (place2.address_components[0] && place2.address_components[0].short_name || ''),
        (place2.address_components[1] && place2.address_components[1].short_name || ''),
        (place2.address_components[2] && place2.address_components[2].short_name || '')
      ].join(' ');

      var address_zip2 = place2.address_components;
      var searchPostalCode2 = "";
      $.each(address_zip2, function(){
          if(this.types[0]=="postal_code"){
              searchPostalCode2=this.short_name;
          }
      });

      if (searchPostalCode2 == "") {
        alert("No post code for the selected address. Please try another");
      }
      else {
        input2.value = searchPostalCode2;
      }
    }
  });

}
