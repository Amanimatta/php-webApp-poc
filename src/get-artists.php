<html>

<head>
    <title>Spotify</title>
    <!-- CSS only -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<table id="editableTable" class="table table-bordered center">
    <thead class="table-dark">
        <tr>
            <th>Artist Name</th>
            <th>Nationality</th>
            <th>Album Name</th>
            <th>Release Time</th>
        </tr>
    </thead>
    <?php
    //Db Connection
    include('dbConnect.php');
    //Get nationality from webApp php file
    $nationality = $_POST["nationality"];

    //Sql query to get latest release time album of artist of the input nationality
    $sql = "SELECT DISTINCT artistName,nationality,albumName,releaseTime FROM
    ((SELECT * FROM Artist WHERE nationality='".$nationality."')selectArtist
     LEFT OUTER JOIN 
    (SELECT albumName,artistId,sname,Album.releaseTime 
                          FROM 
                          Song JOIN SongInAlbum 
                          ON Song.sid=SongInAlbum.sid 
                          JOIN Album 
                          ON Album.albumId=SongInAlbum.albumId
                        )AlbumsWartists 
                        ON
                        selectArtist.artistId=AlbumsWartists.artistId)
                        WHERE
                        (AlbumsWartists.releaseTime)
                        IN 
                        (SELECT max(AlbumsWartists.releaseTime) FROM
    (SELECT * FROM Artist WHERE nationality='".$nationality."')selectArtist
     LEFT OUTER JOIN 
    (SELECT albumName,artistId,sname,Album.releaseTime 
                          FROM 
                          Song JOIN SongInAlbum 
                          ON Song.sid=SongInAlbum.sid 
                          JOIN Album 
                          ON Album.albumId=SongInAlbum.albumId
                        )AlbumsWartists 
                        ON 
                        selectArtist.artistId = AlbumsWartists.artistId
                        GROUP BY selectArtist.artistName)
                        OR
                        AlbumsWartists.releaseTime IS NULL;";
    $sql1 = $sql;
    $stmt = sqlsrv_query($conn, $sql);
    $stmt1 = sqlsrv_query($conn, $sql1);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }//Render with HTML, the output from the SQL query
    if ($nationality == null  || (sqlsrv_num_rows($stmt1) === null) || !($rowDummy = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC))) { ?>
        <div class="child"><?php echo ' No records found for <b>"' . $nationality . '"<b>';
                        } else { ?></div>
        <tbody>
            <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { ?>
                <tr id="<?php echo $row['albumName']; ?>">
                    <td class="hovering-cell"><?php echo '<a href="get-artist-records.php?artistName=' . $row['artistName'] . '" target="_blank">' . $row['artistName'] . '</a>'; ?></td>
                    <td><?php echo $row['nationality']; ?></td>
                    <?php if ($row['albumName'] != null) { ?>
                        <td><?php echo $row['albumName']; ?></td>
                        <td><?php echo $row['releaseTime']->format(DATE_ATOM); ?></td>

                    <?php } else { ?>
                        <td><?php echo 'NO DATA'; ?></td>
                        <td><?php echo 'NO DATA'; ?></td>
                    <?php } ?>
                </tr>
        <?php }
                        } ?>


        </tbody>
</table>

</html>