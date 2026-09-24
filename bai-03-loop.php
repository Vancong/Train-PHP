<?php 
    $orders = ['DH001', 'DH002', 'DH003', 'DH004', 'DH005'];    
    for ($i=0 ; $i< count($orders); $i++){
        echo ($i+1) . ". " . $orders[$i] . "\n";
    }
    foreach ($orders as $order) {
        echo $order . "\n";
    } 

    echo "While \n";

    $i=0;
    while ($i<count($orders)){
        echo $orders[$i] . "\n";
        $i++;
    }

    foreach($orders as $order) {
        if($order==='DH003') {
            echo "Da tim thay don hang DH003";
            break;
        }
       
    }
    

?>