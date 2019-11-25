<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Email Verification</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>

  </head>
  <body>
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12 bg-dark text-white text-center py-5">
          <h2>Email Verification - Metrasys Ticket Service</h2>
        </div>
        <div class="col-md-12 text-center py-5">
          @if ($status)
            <div class="card text-white bg-success mb-3">
              <div class="card-body">
                <h5 class="card-title">Email Verification Succeed</h5>
                <p class="card-text">Your email has been verified. Please wait for further email granting you access to our service.</p>
              </div>
            </div>
          @else
            <div class="card text-white bg-danger mb-3">
              <div class="card-body">
                <h5 class="card-title">Email Verification Failed</h5>
                <p class="card-text">We cannot verify your email. Please contact Metrasys.</p>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </body>
</html>
