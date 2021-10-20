
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="text" placeholder="inserisci email utente" name="email" id="" required>
        <input type="password" placeholder="inserisci la password" name="pwd" id="" required>
        <input type="submit" name="invioDati" value="invia">
    </form>
    <div id="result">
    <?php
    require 'autoloader.php';
    require "vendor/autoload.php";    
    
    use League\Plates\Engine;

    $template =new Engine("templates");
    
    if (isset($_POST["invioDati"])) {
    // GET DATA FROM POST RESPONSE
    $pwd=$_POST["pwd"];
    $email=$_POST["email"];
    

    $validator=new FormValidator();
    $emailResult= $validator->validateFormField("email",$email);
    $pwdResult= $validator->validateFormField("password",$pwd);

    if ( ($emailResult !="") && ($pwdResult !="") ) {
        
        file_put_contents("access.txt","login:".$email.";pwd:".$pwd);
  /*      
        $accessData=file_get_contents("access.txt");
        $accessDataEmail=explode(";",$accessData);
        $accessEmail=explode(":",$accessDataEmail[0])[1];
*/
        $conn=new DBLogin("mysql:dbname=db_login;host=127.0.0.1","root","");
        
        $conn->insertData($emailResult,$pwdResult);

 // header("Location: home.php");
    echo $template->render("home",["username"=>$emailResult,"password"=>$pwdResult]);
    
    } else if (isset($btnInvioDati) && ($emailResult==false)) {
        echo "Avviso! Controlla che l'indirizzo email sia inserito correttamente.";
    } else if (isset($btnInvioDati) && ($pwdResult==false)) {
        echo "Avviso: Controlla che la password sia inserita correttamewnte.";
    }
            
}
?>
      
    </div>
</body>
</html>

