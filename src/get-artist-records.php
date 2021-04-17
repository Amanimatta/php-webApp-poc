<html>

<head>
    <title>Spotify</title>
    <!-- CSS only -->
    <link href="../css/styleArtist.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<table id="editableTable" class="table table-bordered table-responsive">
    <thead class="table-dark">
        <tr>
            <th>Song</th>
            <th>Language</th>
            <th>Style</th>
            <th>Duration</th>
            <th>Release Time</th>
        </tr>
    </thead>
    <?php
    // Connecting, selecting database
    include('dbConnect.php');
    //get value from input.php

    $artists = $_GET["artistName"];

    //sql query to get the records with Artist Name
    $sql = "SELECT sname,[language],style,duration,releaseTime FROM 
            Song JOIN Artist 
            ON Artist.artistId=Song.artistId 
            WHERE Artist.artistName='" . $artists . "'
            ORDER BY releaseTime DESC, sname ASC;";

    $stmt = sqlsrv_query($conn, $sql);
    $stmt1 = sqlsrv_query($conn, $sql);
    //DISPLAY ON HTML
    $row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC);?>
    <?php
    if($row1 == null) {?>
        <div class="child"><?php echo ' No records found for "<b>' . $artists . '<b>"';
                        } 
    else{?></div>
    <tbody>
        <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { ?>
            <tr id="<?php echo $row['sname']; ?>">
                <td ><?php echo $row['sname']; ?></td>
                <td><?php echo $row['language']; ?></td>
                <td><?php echo $row['style']; ?></td>
                <td><?php echo $row['duration']; ?></td>
                <td><?php echo $row['releaseTime']->format(DATE_ATOM); ?></td>
            </tr>
        <?php } }?>
    </tbody>
</table>
</html>