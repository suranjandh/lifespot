<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="md-form form-group">
        <input type="text" id="first-name" name="first_name" required="require" class="form-control"
               xplaceholder="First Name">
        <label for="first-name">First name</label>
    </div>
    <div class="md-form form-group">
        <input type="text" name="last_name" required="require" class="form-control" xplaceholder="Last Name">
        <label for="first-name">Last name</label>

    </div>
    <div class="md-form form-group">
        <input type="email" name="email" required="require" class="form-control" id="exampleInputEmail1"
               aria-describedby="emailHelp" xplaceholder="Email" value="">
        <small id="emailHelp" class="form-text text-muted"></small>
        <label for="exampleInputEmail1">Email</label>

    </div>
    <div class="md-form form-group">
        <input type="password" name="password" id="password" required="require" class="form-control"
               xplaceholder="Password">
        <label for="password">Password</label>

    </div>
    <div class="md-form form-group">
        <input type="password" name="password_confirmation" id="password_confirmation" required="require"
               class="form-control"
               xplaceholder="Confirm Password">
        <label for="confirm_password">Confirm Password</label>

    </div>
    <!-- <button type="submit" name="register"class="btn btn-primary">Create account</button> -->
    <div class="text-center mb-3">
        <!-- <input type="submit"  class="btn blue-gradient btn-block btn-md btn-rounded z-depth-1a" value="Submit"> -->
        <button type="submit" name="register" class="btn blue-gradient btn-block btn-rounded z-depth-1a"><i
                    class="fa fa-lock mr-2 white-text" id="mysignedUp"></i> <span
                    class="white-text">Sign Up</span></button>

        <small><em class="grey-text">By clicking Sign up, you agree to our<br>
                <a href="#">License Agreement</a> and <a href="#">Privacy Statement</a></em></small>
    </div>
</form>

