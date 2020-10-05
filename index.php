<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leads</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Formulário</h1>
    <form action="./index.php" method="post">
        <div class="fields">
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name" required />
        </div>
        <div class="fields">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required />
        </div>        
        <div class="fields">
            <label for="phone">Número Telefone:</label>
            <input type="number" name="phone" id="phone" required />
        </div>
        <div class="fields">
            <label for="comments">Comentários:</label>
            <textarea id="comments" name="comments" required></textarea>
        </div>
        <div class="btns">
            <button type="submit">Enviar</button>
            <button type="reset">Resetar formulário</button>
        </div>
    </form>
</body>
</html>

<?php
    $servername = "localhost";
    $database = "example";
    $username = "root";
    $password = "";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // echo "Connected successfully";

    /**
     * store data
     */

    if(isset($_POST['name'])) {
        $sql = "INSERT INTO leads (name, email, phone_number, comments) VALUES ('{$_POST['name']}', '{$_POST['email']}', '{$_POST['phone']}', '{$_POST['comments']}')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    /**
     * show data
     */

    $query = "SELECT * FROM leads";

    $result_query = $conn->query($query);

    if($result_query->num_rows) {
        $print_result = "<h2>Resultados</h2><table><tr><th>Nome</th><th>E-mail</th><th>Número Telefone</th><th>Comentários</th><th>Data</th></tr>";

        while ($row = mysqli_fetch_assoc($result_query)) {
            $print_result .= "<tr><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['phone_number']}</td><td>{$row['comments']}</td><td>{$row['created_at']}</td></tr>";            
        }

        echo $print_result .= "</table>";
    }

    mysqli_close($conn);