<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login Form</title>
    <script type="text/javascript">
       $(document).ready(function () {
          $("#loginForm").submit(function (e) { 
            e.preventDefault();
            var email = $('#email').val();
            var password = $('#password').val();
            var data = {
                        email:email,
                        password:password
                    };
                   $.ajax({
                    type: "POST",
                    url: "http://127.0.0.1:8000/api/admin/login",
                    data: JSON.stringify(data),
                    contentType: "application/json",
                    success: function(response) {
            
            //console.log(response);
                if(response.status==true){
                   $(".success").html("Login Successfully..");
                   //response.message.token
                   //set token 
                   localStorage.setItem("token",response.message.token);

                     window.location.href='{{ route("dashboard") }}';
                }
            
          },
          error: function(xhr, status, error) {
           
            //console.log(xhr.responseText.message);
               if(xhr.status===422)
               {
                $(".error").html(xhr.responseText);
               }
               //$(".error").html(xhr.responseText.message);
          }
                 });
           });
       });
    </script>
    <style>
            *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
             }
        .heading-main{
            align: center;
        }
        .error{
            color: red;
        }
        .success{
            color: green;
        }
    </style>
  </head>
  <body>
    <div class="container">
    <div class="heading-main">
    <h3>Login Via API</h3>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Login</h5>
                <p class="error"></p><p class="success"></p>
                <form method="POST" action="" enctype="multipart/form-data" id="loginForm">
                    @csrf
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" 
                    placeholder="Enter email" name="email">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" 
                    placeholder="Enter password" name="password">
                  </div>
                  <button type="submit" class="btn btn-primary">Login</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   
  </body>
</html>