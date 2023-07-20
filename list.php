<?php
require 'GetUserData.php';

$host = 'localhost';
$dbname = 'task';
$username = 'root';
$password = '';

$userTable = new UserTable($host, $dbname, $username, $password);
$users = $userTable->getUser();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İstifadəçi Siyahısı</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <a href="index.php" class="btn btn-primary mb-3">Qeydiyyat</a>
        <button class="btn btn-success mb-3" id="exportBtn">Excel Export</button>

        <table id="userTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Müraciət</th>
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>Email</th>
                    <th>Telefon</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . $user['gender'] . "</td>";
                    echo "<td>" . $user['name'] . "</td>";
                    echo "<td>" . $user['surname'] . "</td>";
                    echo "<td>" . $user['email'] . "</td>";
                    echo "<td>" . $user['phone'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable();
        });


        $(document).on('click', '#exportBtn' ,function() {

            $.ajax({
                url: 'ExportToExcel.php',
                type: 'GET',
                success: function(response) {
                    // console.log(response);

                    if (response.success) {
                        var downloadLink = document.createElement('a');
                        downloadLink.href = response.fileUrl;
                        downloadLink.download = response.fileUrl;
                        downloadLink.click();
                    } else {
                        alert('Error exporting data to Excel.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('AJAX Error: ' + textStatus + ' - ' + errorThrown);
                }
            });
        })
    </script>



</body>

</html>