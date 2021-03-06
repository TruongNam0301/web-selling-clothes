<?php
include_once('./models/ClothesMdl.php');
class ClothesCtr{
    public function getClothes ($page,$num,$limit,$type,$sort){
        $ClothesMdl = new ClothesMdl();
        $Clothes = $ClothesMdl -> getClothes($page,$num,$limit,$type,$sort);
        include_once('./views/productPage/listclothes.php');
    } 
    public function getClothesByType ($val,$page,$num,$limit,$sort){
        $ClothesMdl = new ClothesMdl();
        $Clothes = $ClothesMdl -> getClothesByType($val,$page,$num,$limit,$sort);
        include_once('./views/productPage/listclothes.php');
    }
    public function getNumRows($limit,$type,$sort){
        $ClothesMdl = new ClothesMdl();
        $NumRows = $ClothesMdl -> getNumRows($type,$sort);
        include_once('./views/productPage/pagination.php');
    }
    public function getNumRowsById($val,$limit,$type,$sort){
        $ClothesMdl = new ClothesMdl();
        $NumRows = $ClothesMdl -> getNumRowsById($val,$sort);
        include_once('./views/productPage/pagination.php');
    }
    public function Search($key,$sort){
        $num =3;
        if($key=='')
            echo '<div align="center" class="error-search">NO RESULT</div>';
        else{    
            $ClothesMdl = new ClothesMdl();
            $Clothes = $ClothesMdl -> Search($key,$sort);
            if($Clothes==-1){
                echo '<div align="center" class="error-search">NO RESULT</div>';
            }
            else{
                include_once('./views/productPage/listclothes.php');
            }
        }
    }
    public function getBestSell(){
        $ClothesMdl = new ClothesMdl();
        $Clothes = $ClothesMdl -> getBestSellClothes();
        include_once('./views/productPage/listbestsellclothes.php');
    }
    public function getRelativeClothes($id){
        $ClothesMdl = new ClothesMdl();
        $Clothes = $ClothesMdl -> getRelativeClothes($id);
        include_once('./views/productPage/listbestsellclothes.php');
    }
}

?>