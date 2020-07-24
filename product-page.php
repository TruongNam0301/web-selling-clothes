<!DOCTYPE html>
<html>
<head>
	<title>product</title>
	<meta charset="utf-8">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js">
	</script>
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<script src="https://kit.fontawesome.com/65adf3fa6d.js">
	</script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="./css/product-page.css" rel="stylesheet" type="text/css">
	<link href="./css/menubar.css" rel="stylesheet" type="text/css">
	<link href="./css/menu-mobile.css" rel="stylesheet" type="text/css">
	
</head>
<body>
	<?php include_once('menu_header.php');?>
	<section class="section1">
		<div class="background">
			<div class="wall">
				<div class='name-link' style='font-size:50px'>
					<?php 
                        include_once('./controllers/TypeClothesCtr.php');
                        $TypeClothesCtr = new TypeClothesCtr();
                        $TypeClothesCtr->getOneTypeClothes( $_GET['idType']);
                    ?>
				</div>
				<div class='link'>
					<a href='#'>Home /</a> 
                    <a href='#'>Clothing /</a> 
                    <a href='#'><?php 
                                    include_once('./controllers/TypeCtr.php');
                                    $TypeCtr = new TypeCtr();
                                    $TypeCtr->getOneType( $_GET['type']);
					            ?>/</a> 
                    <a href='#'><?php 
                                    $TypeClothesCtr = new TypeClothesCtr();
                                    $TypeClothesCtr->getOneTypeClothes( $_GET['idType']);
                                ?></a>
				</div>
			</div>
		</div>
	</section>
	<div class="container">
		<div class="view-swap">
				<div class="choice-display">
                            <div class="icon grid-icon">
                                <a href='product-page.php?type=<?php echo $_GET['type']?>&&idType=<?php echo $_GET['idType']?>&&sort=0'><button class='btn-promote btn btn-primary'><i class="fas fa-arrow-up"></i></button></a>
                            </div>
                            <div class= "icon list-icon">
                                <a href='product-page.php?type=<?php echo $_GET['type']?>&&idType=<?php echo $_GET['idType']?>&&sort=1'><button class='btn-promote btn btn-primary'><i class="fas fa-arrow-down"></i></button></a>
                            </div>
                </div>
			<!--grid-view-->
			<div class="product-gridview"></div>
		</div>
	</div>
        <?php          
            include_once('footer.php');
	    ?>
	<script>
	       function loadData (val=0,page=1,type){
			sort=<?php if(isset($_GET['sort'])) 
                            echo $_GET['sort']; 
                        else 
                            echo -1;
                    ?>;
            $.ajax({
                url:'../views/action.php',
                data: {type:val,page:page,action:'show',num:3,limit:12,idType:type,sort:sort},
                type: 'POST',
                success: function (value){
                    $('.product-gridview').html(value);
                }
             })
	   }  
	   $(document).ready(function(){
		   let val = <?php if(isset($_GET['idType'])){
			   echo $_GET['idType'];
		   }
		   else {
			   echo 0;
		   }
		   ?>;
		   let page = <?php if(isset($_GET['page'])){
			   echo $_GET['page'];
		   }
		   else {
			   echo 1;
		   }
		   ?>;
		   let type = <?php if(isset($_GET['type'])){
			   echo $_GET['type'];
		   }
		   else {
			   echo 1;
		   }
		   ?>;
		  
		   loadData(val,page,type);
	   })
	</script> 
	<script src="./javascript/home.js">
	</script>
</body>
</html>
<?php 
    include ("viewbillmodal.php");
?>