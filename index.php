<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login|BHAVI INVOICE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .card{
            background-color: #d4e4f3;
            border-radius: 20px;
        }
        .form-input{
            border-radius: 15px;
        }

        button{
            width: 150px;
            height: 50px;
            
        }
    </style>

</head>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-md-8 col-lg-6">
            <div class="card">
              <div class="card-body p-5">
                <form class="mb-3 mt-md-4" method="post" action="loginform.php">
                  <h2 class=" mb-2 text-uppercase "><strong>Bhavi </strong>Invoice</h2>
                  <p class=" mb-5">we're Here to Help You Shine</p>
                  <div class="mb-3">
                    <label for="email" class="form-label "><b> Username</b></label>
                    <input type="text" class="form-control form-input" id="email" placeholder="username" name="email">
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label "><b>Password</b></label>
                    <input type="password" class="form-control form-input" id="password" placeholder="*******" name="password">
                  </div>
                  <!-- <p class="small"><a class="text-primary" href="forget-password.html">Forgot password?</a></p> -->
                  <div class="d-flex justify-content-center ">
                    <button class="btn btn-primary mt-2 " type="submit" style="border-radius: 22px;">Login</button>
                  </div>
                </form>
                <!-- <div>
                  <p class="mb-0  text-center">Don't have an account? <a href="signup.html" class="text-primary fw-bold">Sign
                      Up</a></p>
                </div> -->

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </body>

</html>