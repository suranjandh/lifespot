<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="md-form">
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
               required="require" xplaceholder="Email">
        <small id="emailHelp" class="form-text text-muted"></small>
        <label for="exampleInputEmail1">Email</label>
    </div>
    <div class="md-form">
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" required="require"
               xplaceholder="Password">
        <label for="exampleInputPassword1">Password</label>
    </div>
    <button type="submit" name="login" class="btn blue-gradient btn-block btn-rounded z-depth-1a"><i
                class="fa fa-lock mr-2 white-text" xid="mysignedUp" xvalue="0"></i> <span class="white-text">Log In</span>
    </button>
    <div class="text-center mt-3 mb-1" >
        <small><a href="{{url('/password/reset')}}" xid="forgot_password_open">Forgot password?</a></small>
    </div>
    <div class="text-center mb-3">
        <small><em class="grey-text">By clicking Log In, you agree to our<br>
                <a href="#">License Agreement</a> and <a href="#">Privacy Statement</a></em></small>
    </div>
</form>