<?php
    include_once('./controllers/ClothesCtr.php');
    include_once('./controllers/CartCtr.php');
    include_once('./controllers/AccountCtr.php');
    session_start();
    $ClothesCtr = new ClothesCtr();
    #showlistclothes
    if($_POST['action']=='show'){
        if($_POST['type']!=0){
            $ClothesCtr->getClothesByType($_POST['type'],$_POST['page'],$_POST['num'],$_POST['limit'],$_POST['sort']); 
            $ClothesCtr->getNumRowsById($_POST['type'],$_POST['limit'],$_POST['idType'],$_POST['sort']);  
              
        }
        else{
            $ClothesCtr->getClothes($_POST['page'],$_POST['num'],$_POST['limit'],$_POST['idType'],$_POST['sort']);
            $ClothesCtr->getNumRows($_POST['limit'],$_POST['idType'],$_POST['sort']);
        }
    }#addcart
    else if($_POST['action']=='add'){
        if(isset($_POST['id'])){
            $CartCtr = new CartCtr();
            $CartCtr->addToCart($_POST['id'],$_POST['quantity'],$_POST['size']);
        }
    } #deletecart
    else if($_POST['action']=='delete'){
        if(isset($_POST['index'])){
            $CartCtr = new CartCtr();
            $CartCtr->deleteFromCart($_POST['index']);
        }
    }
    
    else if($_POST['action']=='check-user'){
        $AccountCtr = new AccountCtr();
        $AccountCtr ->checkAccountExist($_POST['username']);
       
    }
    else { #updatecart
        if(isset($_POST['index'])){
            $CartCtr = new CartCtr();
            if(isset($_POST['quantity']))$CartCtr->updateQuantity($_POST['index'],$_POST['quantity']);
            if(isset($_POST['size'])) $CartCtr->updateSize($_POST['index'],$_POST['size']);
        }
    }
    
?>