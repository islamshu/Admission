@extends('layouts.backend')
@section('css')
    <style>
        input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

/* Style the submit button */
input[type=submit] {
  background-color: #04AA6D;
  color: white;
}

/* Style the container for inputs */
.container {
  background-color: #f1f1f1;
  padding: 20px;
}
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}
#messageconf {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 14px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  content: "✖";
}
    </style>
@endsection
@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-colored-form-control">@lang('Create Client')  </h4>
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
                                    action="{{ route('client_create.update_client',$client->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>@lang('Phone')</label>
                                                <input type="text" name="phone" class="form-control" required value="{{ $client->phone }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>@lang('Name')</label>
                                                <input type="text" name="name" class="form-control" required value="{{ $client->name }}">
                                            </div>
                                           
                                        </div>
                                        <br>
                                     
                                      
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>@lang('Password')</label>
                                                <input type="password" id="psw" name="password" class="form-control" required value="">
                                            </div>
                                            <div class="col-md-6">
                                                <label>@lang('Confirm Password')</label>
                                                <input type="password" id="conf" name="confirm-password" class="form-control" required value="">
                                            </div>
                                          
                                        </div>
                                        <div id="message" style="width: 100%">
                                            <h3>@lang('Password must contain the following:')</h3>
                                            <p id="letter" class="invalid">@lang('A lowercase letter')</p>
                                            <p id="capital" class="invalid">@lang('A capital (uppercase) letter')</p>
                                            <p id="number" class="invalid">@lang('A number')</p>
                                            <p id="length" class="invalid">@lang('Minimum 8 characters')</p>
                                          </div>
                                          <div id="messageconf" style="width: 100%">
                                            <h3>@lang('Password must contain the following:')</h3>
                                            <p id="same" class="invalid">@lang('Password must match')</p>
                                            
                                          </div>
                                          
                                        <br>
                                        
                                        <br>
                                        
                                     
                                        
                                    </div>
                                   
    
    
                                    <div class="form-actions left">

                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> @lang('save')
                                    </button>
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
@section('script')
    				
<script>
    var myInput = document.getElementById("psw");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    var conf = document.getElementById("conf");
    var same = document.getElementById("same");

    
    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
      document.getElementById("message").style.display = "block";
    }
    conf.onfocus = function() {
      document.getElementById("messageconf").style.display = "block";
    }
    
    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
      document.getElementById("message").style.display = "none";
    }
    conf.onblur = function() {
      document.getElementById("messageconf").style.display = "none";
    }
    conf.onkeyup = function() {
        if($("#psw").val() == $("#conf").val() ){
            same.classList.remove("invalid");
            same.classList.add("valid");
        }else{
            same.classList.add("invalid");
            same.classList.remove("valid"); 
        }
    }
    
    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
      // Validate lowercase letters
      var lowerCaseLetters = /[a-z]/g;
      if(myInput.value.match(lowerCaseLetters)) {  
        letter.classList.remove("invalid");
        letter.classList.add("valid");
      } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
      }
      
      // Validate capital letters
      var upperCaseLetters = /[A-Z]/g;
      if(myInput.value.match(upperCaseLetters)) {  
        capital.classList.remove("invalid");
        capital.classList.add("valid");
      } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
      }
    
      // Validate numbers
      var numbers = /[0-9]/g;
      if(myInput.value.match(numbers)) {  
        number.classList.remove("invalid");
        number.classList.add("valid");
      } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
      }
      
      // Validate length
      if(myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
      } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
      }
    }
    </script>
@endsection

