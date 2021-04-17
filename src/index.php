<html>

<head>
    <title>Spotify</title>
    <!-- CSS only -->
    <link href="../css/styleIndex.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<!--HTML form for Spotify -->
<body class="container">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <div class="logo-image">
                    <img src="spotify.png" class="img-fluid">
                </div>
            </a>
            <form class="d-flex" action="get-artists.php" method="POST">
                <input type="hidden" name="submitted" value="true" />
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search by Nationality" name="nationality" value="">
                <button class="btn btn-outline-success" type="submit" name="submit">Search</button>
            </form>
        </div>
    </nav>
</body>

</html>