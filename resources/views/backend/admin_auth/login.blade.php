<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Twitter -->
   <meta name="twitter:site" content="@themepixels">
   <meta name="twitter:creator" content="@themepixels">
   <meta name="twitter:card" content="summary_large_image">
   <meta name="twitter:title" content="Bracket Plus">
   <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
   <meta name="twitter:image" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">

   <!-- Facebook -->
   <meta property="og:url" content="http://themepixels.me/bracketplus">
   <meta property="og:title" content="Bracket Plus">
   <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

   <meta property="og:image" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">
   <meta property="og:image:secure_url" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">
   <meta property="og:image:type" content="image/png">
   <meta property="og:image:width" content="1200">
   <meta property="og:image:height" content="600">

   <!-- Meta -->
   <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
   <meta name="author" content="ThemePixels">

   <title>Admin Login</title>

   <!-- vendor css -->
   <link href="{{ asset('backend/app/lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
   <link href="{{ asset('backend/app/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">

   <!-- Bracket CSS -->
   <link rel="stylesheet" href="{{ asset('backend/app/css/bracket.css') }}">
</head>

<body>

   <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
         <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal"></span> Ghorer <span
               class="tx-info">Dokan</span> <span class="tx-normal"></span></div>
         <div class="tx-center mg-b-60">Admin Login Perfectionist</div>

         <form method="POST" action="{{ route('login') }}" class="customer-form">
            @csrf
            <div class="form-group">
               <input type="text"  name="email"  class="form-control" placeholder="Enter your username"  value="{{ old('email') }}" required >
               @error('email')
                              <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                              </span>
                           @enderror
            </div>
            <div class="form-group">
               <input type="password"  name="password"  class="form-control" placeholder="Enter your password">
               @error('password')
               <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
               </span>
            @enderror
               <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
            </div>
            <button type="submit" class="btn btn-info btn-block">Sign In</button>
         </form>


         <div class="mg-t-60 tx-center">Not yet a member? <a href="{{ route('admin.register') }}" class="tx-info">Sign
               Up</a></div>
      </div><!-- login-wrapper -->
   </div><!-- d-flex -->

   <script src="{{ asset('backend/app/lib/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('backend/app/lib/jquery-ui/ui/widgets/datepicker.js') }}"></script>
   <script src="{{ asset('backend/app/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
