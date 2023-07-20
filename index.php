<!DOCTYPE html>
<html>

<head>
    <title>Qeydiyyat Forması</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div id="resultMessage" class="mt-3"></div>
        <form id="registration">
            <div class="form-group">
                <label for="gender">Müraciət:</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="" selected disabled>Seçin</option>
                    <option value="kişi">Kişi</option>
                    <option value="qadın">Qadın</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Ad:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="surname">Soyad:</label>
                <input type="text" class="form-control" id="surname" name="surname" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Telefon:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>

            <button type="button" class="btn btn-primary" onclick="validateForm()">Submit</button>
           <a href="list.php" class="btn btn-success" >Siyahı</a>

        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script src="script.js">
    </script>
</body>

</html>