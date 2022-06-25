@extends('layouts.backend')
@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-colored-form-control">Create Company  </h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                @include('dashboard.parts._error')
                                @include('dashboard.parts._success')
    
                                <form class="form" method="post"
                                    action="{{ route('companies.store_admin') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="la la-add"></i>Company Info</h4>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Image </label>
                                                <input type="file" name="image" class="form-control image">
                                            </div>
                    
                                            <div class="form-group">
                                                <img src="{{ asset('uploads/product_images/default.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                                            </div>
                                        
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                                <input type="text" id="form3" value="{{ old('name') }}" required name="name"  class="form-control validate">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Email</label>
                                                <input type="email" id="form3" value="{{ old('email') }}" required name="email"  class="form-control validate">
                                            </div>

                                            
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                                <input type="text" id="form3"  value="{{ old('phone') }}" required name="phone"  class="form-control validate">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Commical Register</label>
                                                <input type="number" id="form3" value="{{ old('commercial_register') }}" required name="commercial_register"  class="form-control validate">
                                            </div>

                                            
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Longitude</label>
                                                <input type="text" id="form3" value="{{ old('longitude') }}" placeholder="Longitude" name="longitude"  class="form-control validate">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Latitude</label>
                                                <input type="text" id="form3" value="{{ old('latitude') }}" placeholder="Latitude"  name="latitude"  class="form-control validate">
                                            </div>

                                            
                                        </div>
                                        <br>
                                        
                    <h4 class="form-section"><i class="la la-add"></i>Social media</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userinput2">Facebook</label>
                                <input type="url" name="facebook" value="{{ old('faceook') }}" placeholder="Facebook"  id="userinput2" class="form-control border-primary"  >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userinput2">Twitter</label>
                                <input type="url" name="twitter" value="{{ old('twitter') }}" placeholder="Twitter"  id="userinput2" class="form-control border-primary"  >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facebook">Snapchat</label>
                                <input type="url" name="snapchat" value="{{ old('snapchat') }}" placeholder="Snapchat"  id="userinput2" class="form-control border-primary"  >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facebook">Instagram</label>
                                <input type="url" name="instagram" value="{{ old('instagram') }}" placeholder="Instagram"  id="userinput25" class="form-control border-primary"  >
                            </div>
                        </div>
                    </div>
                    </div>

                                      
                                       
                     
                                        
                                    </div>
                                   
    
    
                                    <div class="form-actions left">

                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> {{ __('حفظ') }}
                                        </button>
                                    </div>
    
    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </div>
    </section>

    </div>
@endsection
@section('scripts')
<script>
    function autocomplete(inp, arr, fullarr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function (e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    
                    b = document.createElement("a");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' data-country-id=" + i + " value='" + arr[i] + "'>";
                    b.innerHTML += "<br>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function (e) {
                        // $('#country').data('country-id', 200);

                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        inp.dataset.countryId = this.getElementsByTagName("input")[0].dataset
                            .countryId;

                        var txt = document.getElementById("full_data");
                        txt.innerHTML = '';
                        var country_info = document.getElementById("country_info");
                        country_info.innerHTML = '';


                        txt.innerHTML += "<input type='hidden' name='flag' value='" + fullarr[inp
                            .dataset.countryId].flag + "'>";
                        txt.innerHTML += "<input type='hidden' name='alpha2Code' value='" + fullarr[
                            inp.dataset.countryId].alpha2Code + "'>";
                        txt.innerHTML += "<input type='hidden' name='alpha3Code' value='" + fullarr[
                            inp.dataset.countryId].alpha3Code + "'>";
                        txt.innerHTML += "<input type='hidden' name='callingCodes' value='" +
                            fullarr[inp.dataset.countryId].callingCodes[0] + "'>";
                        txt.innerHTML += "<input type='hidden' name='nativeName' value='" + fullarr[
                            inp.dataset.countryId].nativeName + "'>";
                        txt.innerHTML += "<input type='hidden' name='lat' value='" + parseFloat(
                            fullarr[inp.dataset.countryId].latlng[0]) + "'>";
                        txt.innerHTML += "<input type='hidden' name='lng' value='" + fullarr[inp
                            .dataset.countryId].latlng[1] + "'>";
                        txt.innerHTML += "<input type='hidden' name='name' value='" + fullarr[inp
                            .dataset.countryId].name + "'>";

                        country_info.innerHTML += `
                <div class="card">
                    <div class="header">
                      <h2>Country Info</h2>
                    </div>
                    <div class="body text-center">
                        <div class="circle">
                            <img style="max-width: 150px;" src="` + fullarr[inp.dataset.countryId].flag + `" alt="">
                        </div>
                        <h6 class="mt-3 mb-0">` + fullarr[inp.dataset.countryId].name + ` | ` + fullarr[inp.dataset
                            .countryId].nativeName + `</h6>
                        <div>country code ` + fullarr[inp.dataset.countryId].alpha2Code + `</div>
                        <div>phone code ` + fullarr[inp.dataset.countryId].callingCodes[0] + `</div>
                        <div>lat ` + (fullarr[inp.dataset.countryId].latlng[0]) + `</div>
                        <div>lat ` + fullarr[inp.dataset.countryId].latlng[1] + `</div>
                    </div>
                </div>`;


                        inp.parentNode.insertBefore(txt, inp.nextSibling);

                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function (e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }

</script>

<script type="text/javascript">
    $(document).ready(function () {

        var allData = null;

        $.ajax({
            'type': "GET",
            'dataType': 'json',
            'async': false,
            'url': "https://restcountries.com/v2/all",
            'success': function (data) {
                allData = data;
            }
        });
        console.log(allData);
        countries = [];
        $.each(allData, function (i) {
            countries[i] = allData[i].name;
        });

        // /*An array containing all the country names in the world:*/
        // var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

        // /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("country"), countries, allData);

        $('body form').on('submit', function () {

        });
        var msg = "{{Session::get('success_msg')}}";
        var exist = "{{Session::has('success_msg')}}";
        if (exist) {
            alertify.success(msg);
        }
    });

</script>
@endsection
