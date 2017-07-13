@extends( 'sign-in.layout.main' )

@section( 'sign-in.layout.content' )

<div class="session-wrapper">
    <div class="page-height row-equal align-middle">
    <div class="column">
        <div class="card bg-white no-border">
        <div class="card-block">
            <form role="form" class="form-layout" action="extras-signin.html">
            <div class="text-center m-b">
                <h4 class="text-uppercase">Reset Password</h4>
            </div>
            <div class="form-inputs">
                <label class="text-uppercase">Your email address</label>
                <input type="email" class="form-control input-lg" placeholder="Email address" autofocus="" required="">
            </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Reset Password</button>
            </form>
        </div>
        <a href="extras-signin.html" class="bottom-link">Login instead.</a>
        </div>
    </div>
    </div>
</div>

@endsection