@extends('layouts.profileLayout')

@section('content2')
    @php
        use App\Models\User;
        //$username = str_replace('/edit-profile-basic','',$_SERVER['REQUEST_URI']);
        //$username = str_replace('/','',$username)
    @endphp

    <section>
        <div class="gap gray-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" id="page-contents">
                            <div class="col-lg-3">

                                <aside class="sidebar static">
                                    @if($username === Auth::user()->username)
                                        <div class="widget">
                                            <h4 class="widget-title">Edit info</h4>
                                            <ul class="naves">
                                                <li>
                                                    <i class="ti-info-alt"></i>
                                                    <a title=""
                                                       href="{{url('/'.Auth::user()->username.'/edit-profile-basic')}}">Basic
                                                        info</a>
                                                </li>
                                                <li>
                                                    <i class="ti-lock"></i>
                                                    <a title="" href="{{url('/'.Auth::user()->username.'/changePassword')}}">change password</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                    <!--<div class="widget">
                                        <h4 class="widget-title">Socials</h4>
                                        <ul class="socials">
                                            <li class="facebook">
                                                <a title="" href="#"><i class="fa fa-facebook"></i> <span>facebook</span> <ins>45 likes</ins></a>
                                            </li>
                                            <li class="twitter">
                                                <a title="" href="#"><i class="fa fa-twitter"></i> <span>twitter</span><ins>25 likes</ins></a>
                                            </li>
                                            <li class="google">
                                                <a title="" href="#"><i class="fa fa-google"></i> <span>google</span><ins>35 likes</ins></a>
                                            </li>
                                        </ul>
                                    </div>-->
                                </aside>
                            </div><!-- sidebar -->
                            <div class="col-lg-6">
                                <div class="central-meta">
                                    <div class="editing-info">
                                        <h5 class="f-title"><i class="ti-info-alt"></i> Edit Basic Information</h5>

                                        <form method="POST" action="{{url('/' . $username . '/updateProfileBasic')}}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" id="input" name="name" value="{{Auth::user()->name}}"/>
                                                <label class="control-label" for="input">Full Name</label><i class="mtrl-select"></i>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="username" value="{{Auth::user()->username}}"/>
                                                <label class="control-label" for="input">Username</label><i class="mtrl-select"></i>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="email" value="{{Auth::user()->email}}"/>
                                                <label class="control-label" for="input"><a href="https://wpkixx.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="4b0e262a22270b">[email&#160;protected]</a></label><i class="mtrl-select"></i>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="phone" value="{{Auth::user()->profile->phone}}"/>
                                                <label class="control-label" for="input">Phone No.</label><i class="mtrl-select"></i>
                                            </div>
                                            <div class="form-group">
                                                <select name="location">
                                                    @php
                                                        $countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Cape Verde","Cayman Islands","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cruise Ship","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kuwait","Kyrgyz Republic","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Mauritania","Mauritius","Mexico","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Namibia","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Satellite","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","South Africa","South Korea","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","St. Lucia","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Uganda","Ukraine","United Arab Emirates","United Kingdom","Uruguay","Uzbekistan","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
                                                    @endphp
                                                    @foreach($countries as $country)
                                                        @if($country === Auth::user()->profile->location)
                                                            <option selected value="{{$country}}">{{$country}}</option>
                                                        @else
                                                            <option value="{{$country}}">{{$country}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <textarea rows="4" id="description" name="description" >{{Auth::user()->profile->description}}</textarea>
                                                <label class="control-label" for="textarea">About Me</label><i class="mtrl-select"></i>
                                            </div>
                                            <div class="form-group">
                                                <textarea rows="2" id="interests" name="interests" >{{Auth::user()->profile->interests}}</textarea>
                                                <label class="control-label" for="textarea">Interests</label><i class="mtrl-select"></i>
                                            </div>
                                            <div class="form-group">
                                                <textarea rows="1" id="languages" name="languages" >{{Auth::user()->profile->languages}}</textarea>
                                                <label class="control-label" for="textarea">Languages</label><i class="mtrl-select"></i>
                                            </div>
                                            <div class="submit-btns">
                                                <button type="button" onclick="this.form.reset();" class="mtr-btn"><span>Cancel</span></button>
                                                <button type="submit" class="mtr-btn"><span>Update</span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="central-meta">
                                    <form method="post" action="{{url('/'.Auth::user()->username.'/deleteAccount')}}">
                                        @csrf
                                        <h5 class="f-title"><i class="ti-info-alt"></i> Delete Account</h5>
                                        <div class="submit-btns mt-0">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- centerl meta -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
