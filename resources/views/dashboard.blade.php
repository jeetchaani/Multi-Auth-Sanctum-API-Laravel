<!doctype html>
<html lang="en">

<head>
  <title>Welcome</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <script type="text/javascript">
        $(document).ready(function () {
            var token = localStorage.getItem("token");            
            var headers = {
                            'Authorization': 'Bearer '+token // Replace 'your-token' with your actual bearer token
                            };
                  
                    $.ajax({
                     type: "POST",
                     url: "http://127.0.0.1:8000/api/admin/post/fetch",
                     headers: headers,
                     contentType: "application/json",
                     success: function(response) {
             
             //console.log(response);
                 if(response.status==true){
                    $(".success").html("Login Successfully..");
                    //response.message.token
                    
                 }
             
           },
           error: function(xhr, status, error) {
            
             //console.log(xhr.responseText);
                
                //$(".error").html(xhr.responseText.message);
           }
                  });
           
        });
     </script>

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
     <p class="success"></p>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>