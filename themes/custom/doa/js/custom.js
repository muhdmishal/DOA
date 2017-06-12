function initMap() {

  var input = document.getElementById('edit-town');

  var autocomplete = new google.maps.places.Autocomplete(input);

  autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      console.log("No details available for input: '" + place.name + "'");
      return;
    }
    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
      var address_zip = place.address_components;
      var searchPostalCode = "";
      jQuery.each(address_zip, function(){
          if(this.types[0]=="locality"){
              searchPostalCode=this.short_name;
          }
      });

      if (searchPostalCode == "") {
        alert("No post code for the selected address. Please try another");
        input.value = "";
      }
      else {
        input.value = searchPostalCode;
      }
    }
  });

  var input2 = document.getElementById('edit-locality');

  var autocomplete2 = new google.maps.places.Autocomplete(input2);

  autocomplete2.addListener('place_changed', function() {
    var place2 = autocomplete2.getPlace();
    if (!place2.geometry) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      console.log("No details available for input: '" + place2.name + "'");
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
      jQuery.each(address_zip2, function(){
          if(this.types[0]=="locality"){
              searchPostalCode2=this.short_name;
          }
      });

      if (searchPostalCode2 == "") {
        alert("No post code for the selected address. Please try another");
        input2.value = "";
      }
      else {
        input2.value = searchPostalCode2;
      }
    }
  });
}
