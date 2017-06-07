
(function($) {
    // plugin code here, can use $ because it refers to our argument,
    // not the global symbol that may not be there
})(jQuery);
function initMap() {

  var input = document.getElementById('edit-postcode');

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
          if(this.types[0]=="postal_code"){
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
}
