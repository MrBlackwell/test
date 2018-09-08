<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Сократить ссылку</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row" style="margin-top: 60px">
        <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
            <input style="width: 100%" type="text" id="link" placeholder="Вставьте ссылку в это поле">
            <button style="width: 100%; margin-top: 10px" id="shorten">Сократить</button>
            <a id="ready_link" style="margin: 10px auto" href=""></a>
        </div>
    </div>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $('#shorten').click(function () {
        let link = $('#link').val();
        $.ajax({
            type: "post",
            url: "/get_short_link",
            data: {link: link},
            success: function (shortLink) {
                $('#link').val(shortLink);
                $('#ready_link').attr('href', shortLink);
                $('#ready_link').html(shortLink);
            }
        })
    })
</script>
</body>
</html>