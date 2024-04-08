<?php
$from = 'sidorkinalex19@outlook.com';
$subject = 'My Subject';

function clear_data($data)
{

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$name = isset($_POST['name']) ? clear_data($_POST['name']) : '';
$email = isset($_POST['email']) ? clear_data($_POST['email']) : '';
$recipients = explode(',', $email);
$text = isset($_POST['message']) ? clear_data($_POST['message']) : '';


$message = " 
<html>
    <center>
        <table width='700px' border='1' cellpadding='6' cellspacing='0' width='90%' bordercolor ='#DBDBDB' >
            <tr>
                <h3 alin='center'><b>Информация о пользователе</b></h3>
            </tr>

";


$message .= "
<tr>
                <td colspan='2' align='center' bgcolor='#E4E4E4'><b>Имя пользователя</b></td>
                <td>" . $name . "</td>
            </tr>
            <tr>
                <td colspan='2' align='center' bgcolor='#E4E4E4'><b>Email</b></td>
                <td>" . $from . "</td>
            </tr>
            <tr>
                <td colspan='2' align='center' bgcolor='#E4E4E4'><b>Текст сообщения</b></td>
                <td>'.$text.'</td>
            </tr>
        </table>
    </center>
</html>


";


$headers = [
    "From" => $from,
    "Reply-To" => $from,
    "X-Mailer" => "PHP/" . phpversion(),
    "Content-type" => "text/html; charset=utf-8",
];

if (isset($_POST['submit'])) {

    foreach ($recipients as $to) {
        mail($to, $subject, $message, $headers);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

<body>
    <div class="container">
        <div class="row justity-content-center">
            <div class="col-10">
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="col-5" method="post">
                    <div class="form-group">
                        <label for="">Имя</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="email" placeholder="введите нужное количество email через запятую">
                    </div>
                    <div class="form-group">
                        <label for="">Сообщение</label>
                        <textarea type="text" class="form-control" name="message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>