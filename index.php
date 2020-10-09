<?php
include 'book.php';

?>

<!DOCTYPE html>
<html lang="en">
<link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">

<head>
    <meta charset="UTF-8">
    <title>PHP guest book</title>
    <meta name="description" content="php">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <style>
    body {
        background: url(img/space.jpg);
        background-attachment: fixed;
        background-size: cover;
    }

    .container {
        width: 80%;
        margin: 0 auto;
        font-family: sans-serif;
    }

    .content {
        position: relative;
    }

    form,
    input,
    textarea {
        width: 80%;
    }

    .header {
        text-align: center;
        background: #ae7be0;
        color: white;
        font-size: 30px;
        font-family: 'Architects Daughter', cursive;
    }

    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #ae7be0;
        color: white;
        text-align: center;
        font-family: 'Architects Daughter', cursive;
    }

    form {
        margin-top: 20px;
    }

    input,
    textarea {
        border-radius: 5px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        padding: 5px;
    }

    input[type="submit"] {
        background: #ae7be0;
        color: #fff;
        cursor: pointer;
        border: 1px solid #535544;
        padding: 10px;
        font-size: 15px;
        font-family: 'Architects Daughter', cursive;
    }

    input[type="submit"]:hover {
        opacity: 0.8;
    }

    span.date-mess {
        /*background: #4CAF50;*/
        color: #fff;
        margin-right: 10px;
        padding: 0 5px;
        font-size: 13px;
    }

    span.message {
        padding: 5px;
        border-radius: 10px;
        background: #baffb5;
        /*line-height: 1.6;*/
        display: inline-block;
        position: relative;
        top: 8px;

    }

    span.message:before {
        content: "";
        position: absolute;
        border: 8px solid transparent;
        border-bottom: 12px solid #baffb5;
        top: -13px;
        left: 1px;
    }

    @media (max-width: 600px) {
        .container {
            width: 98%;
        }

        form {
            width: 95%;
            margin: 0 auto;
            margin-bottom: 20px;
            width: 90%;
        }

        input,
        textarea {
            width: 100%;

        }

        input[type="submit"] {
            width: 100%;
            font-family: 'Architects Daughter', cursive;
        }
    }
    </style>
</head>

<body>
    <?php require 'header.php'; ?>
    <div class="container">

        <form action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="POST" id="form">
            <input type="text" name="name" placeholder="Name" id="name">
            <input type="text" name="title" placeholder="Title" id="title">
            <textarea name="message" placeholder="Text"></textarea>
            <br>
            <input type="submit" name="add" value="Add your note 😀">
        </form>
    </div>
    <?php foreach ($listMessages as $message) { ?>
    <p style=color:#fff>Title: <?php echo $message['title']; ?></p>
    <p style=color:#fff>Name: <?php echo $message['name']; ?></p>
    <p style=color:#fff>Message: <?php echo $message['message']; ?></p>
    <p style=color:#fff>date: <?php echo $message['postdate']; ?></p>
    <br><br>
    <?php    }    ?>
    <?php require 'footer.php'; ?>
    <script>
    var i2 = document.querySelector('#name');
    i2.value = localStorage.getItem('names');

    i2.oninput = function() {
        localStorage.setItem('names', i2
            .value); //no need to put your name again if page restarts, we save the name in localStorage
    }
    </script>

</body>

</html>