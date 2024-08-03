<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Document</title>
  <style>
   body { 
            background-color: rgb(91, 139, 139);
        }
        /* .container {
            margin-top: 50px;
        } */
    
</style>
</head>
<body>
<?php 
      include "navbar3.php";
    ?>
  <div class="container" id="ajout1">
  <div class="row">
    <div class="offset-4 col-md-4 mt-3">
         <div class="card" style="width: 430px">
          <div class="card-header">
            <h2>ajouter un utilisateur</h2>
          </div>
          <div class="card-body">
            <div >
              <img class=" mx-auto d-block rounded-circle card-img-top" src="admin-user-icon.webp" style="width: 150px; height: 150px;">
            </div>
            <form class="needs-validation" action="sign1.php" method="post" >
              <div class="mb-3">
                <label for="name" class="form-label">USERNAME</label>
                <input type="text" class="form-control form-control-sm" id="name" name="nom" aria-describedby="name" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
                <div class="invalid-feedback">
                  Veuillez taper son username
                </div>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">PASSWORD</label>
                <input type="password" class="form-control form-control-sm" id="password" name="pass" aria-describedby="price" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
                <div class="invalid-feedback">
                  Veuillez taper son mot de passe
                </div>
              </div>

              <div class="mb-3">
                <label for="codeid" class="form-label">CODE A BARRE</label>
                <input type="code" class="form-control form-control-sm" id="codeid" name="code" aria-describedby="codee" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
                <div class="invalid-feedback">
                  Veuillez taper son code a barre
                </div>
              </div>

              <div class="mb-3">
                <label for="Categorie" class="form-label">ROLE</label>
                <select class="form-select" id="Categorie" name="ROLE" aria-describedby="Categorie" required>
                    <option value="" selected disabled hidden>veuillez mentionner son role</option>
                    <option value="1">admin</option>
                    <option value="2">employee</option>
                    <option value="3">client</option>
                </select>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Veuillez sélectionner une catégorie.
                </div>
              </div>


              <div class="mb-3">
                <label for="numero" class="form-label">GSM</label>
                <input type="text" class="form-control form-control-sm" id="numero" name="gsm" aria-describedby="numero" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
                <div class="invalid-feedback">
                  Veuillez taper son numero mobile.
                </div>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">EMAIL</label>
                <input type="email" class="form-control form-control-sm" id="email" name="email" aria-describedby="mail" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
                <div class="invalid-feedback">
                  Veuillez taper son adresse email
                </div>
              </div>

              <div class="row">
                   <div class="col d-grid">
                     <button id="Annul" type="reset" class="btn btn-danger  btn-block text-center">ANNULER</button>
                  </div>

                  <div class="col d-grid">
                    <button id="valid" type="submit" class="btn btn-success   btn-block text-center ">VALIDER</button> 
                  </div>

                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>





<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['nom']) ? $_POST['nom'] : null;
    $code = isset($_POST['code']) ? $_POST['code'] : null;
    $password = isset($_POST['pass']) ? $_POST['pass'] : null;
    $role = isset($_POST['ROLE']) ? $_POST['ROLE'] : null;
    $gsm = isset($_POST['gsm']) ? $_POST['gsm'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;

    // Hash du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $servername = "localhost";
    $dbusername = "root"; 
    $dbpassword = ""; 
    $dbname = "deliver"; // Make sure this is the correct database name

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ensure the form fields are not empty
    if ($username && $password && $role) {
        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM utilisateur WHERE username=? OR email=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // No matching user found, insert new one
            $stmt = $conn->prepare("INSERT INTO utilisateur (username, code, password, role, gsm, email) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $username, $code, $hashed_password, $role, $gsm, $email);

            if ($stmt->execute()) {
                echo "Ajout avec succès d'un user ou employee";
                // header("Location: crew.html");
                exit();
            } else {
                echo "Echec d'ajout: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "user déjà existant.";
            header("Location: error.html");
            exit();
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }

    $conn->close();
}
?>
