<?php

    include '../php/database.php';
    include '../php/variables.php';

    $c = $db->prepare("SELECT COUNT(message) as nbrMess FROM `chat` WHERE id_user_send = :send or id_user_received = :send");

    $c->execute([
        'send' => $_SESSION['unique'],
    ]);
    
    $result = $c -> rowCount();
    $countTour = 0;

    $data['mess'] = 0;
    $data['like'] = 0;
    $data['vu'] = 0;
    
    if($result != 0)
    {
        
        while($chat = $c -> fetch())
        {

            $countTour++;

            $data['mess'] = $chat['nbrMess'];

            $d = $db->prepare("SELECT COUNT(`like`) as nbrLike FROM `chat` WHERE (id_user_send = :send or id_user_received = :send) and `like` <> ''");

            $d->execute([
                'send' => $_SESSION['unique'],
            ]);
            
            $resultLike = $d -> rowCount();
            
            if($resultLike != 0)
            {
                
                while($like = $d -> fetch())
                {

                    $data['like'] = $like['nbrLike'];

                }
                
            }

            $d = $db->prepare("SELECT COUNT(vu) as nbrVu FROM `chat` WHERE (id_user_send = :send or id_user_received = :send) and vu <> 0");

            $d->execute([
                'send' => $_SESSION['unique'],
            ]);
            
            $resultVu = $d -> rowCount();
            
            if($resultVu != 0)
            {
                
                while($vu = $d -> fetch())
                {
                    if($countTour == $result){

                        $data['vu'] = $vu['nbrVu'];

                    }

                }
                
            }

        }
    }

    echo json_encode($data);