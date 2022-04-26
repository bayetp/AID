<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/chatbox.css">
    <title>Document</title>
</head>
<body>
    
    <?php
    include 'header.php';
    ?>

    <h1>Messages</h1>

    <div class="block" id="block_chatbox">

        <script>actuChatBox()</script>

    </div>

    <script>

        var nbrMess = 0;
        var nbrLike = 0;
        var nbrVu = 0;

        function checkMess() {
        
            $.ajax({
                
                type: "GET",
                dataType: 'json',
                url: "../ajax/checkMess.php",
                async: false,
                success: function(data) {

                    if(nbrMess != data['mess'] || nbrVu != data['vu'] || nbrLike != data['like']){

                        actuChatBox();

                        nbrMess = data['mess'];
                        nbrVu = data['vu'];
                        nbrLike = data['like'];

                    }

                }

            });

        }

        setInterval(checkMess,1000);

    </script>

</body>
</html>