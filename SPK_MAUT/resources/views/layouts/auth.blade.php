<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .auth-container {
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container auth-container d-flex justify-content-center align-items-center">
        <div class="col-md-5">
            @yield('content')
        </div>
    </div>
</body>
</html>
