<?php
session_start();
include_once('../controllers/AccountCtr.php');
$AccountCtr = new AccountCtr();
$AccountCtr->register();   
$AccountCtr->updateUserInfor();   
$AccountCtr->updatePass();
?>
<?php
  if(isset($_POST['yes'])){
      $id = $_SESSION['user']['id'];
      $sdt = $_POST['sdt'];
      $address = $_POST['address'];
      date_default_timezone_set('Asia/Ho_Chi_Minh');
      $date = date('m/d/Y h:i:s a', time());
      $total = $_POST['total'];
      $tinhtrang = 0;
      include_once("../models/DataProvider.php");
      $db= new DataProvider();
      $sql="INSERT INTO `hoadon` (`MaHD`, `id_user`, `sdt`, `address`, `tinhtrang`, `date`,`total` ) VALUES(null,$id,'$sdt','$address',$tinhtrang,'$date',$total)";
      $lastId=$db->ExecuteQueryInsert($sql);
      foreach( $_SESSION['cart'] as $item){
          $id=$item['id'];
          $soluong = $item['quantity'];
          $size= $item['size'];
          $maHD = $lastId;
          $sql2="INSERT INTO `chitiet_hoadon` (`SoHD`, `MaHD`, `id_cloth`, `soluong`, `size`) VALUES (null, $maHD, $id, $soluong, '$size')";
          $db->ExecuteQuery($sql2);  
      }
      unset($_SESSION['cart']);
     
  }
?>    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/65adf3fa6d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 
    <link rel="stylesheet" type="text/css" href="../css/product-page.css">
    <link rel="stylesheet" type="text/css" href="../css/menubar.css">
    <link rel="stylesheet" type="text/css" href="../css/menu-mobile.css">
    <link rel="stylesheet" type="text/css" href="../css/main-home.css">
    <script src="../javascript/home.js"></script>
    <html>  
    <div class="header" >
    <div class="mg-left-right " >
        <div class="row">
            <div class="col-lg-2 col-5">
                <div class="logo">
                <img src="../image/Untitled.png" width="100px" height="100px" style="float:left">
                </div>
                <div class="icon-menu2">
                    <a href="#"><i id="menu-click" onclick="menuActive()" class="fas fa-bars fa-lg" ></i></a>
                </div>
            </div>
            <div class="col-lg-8 d-none d-lg-block">
                <div class="menu-bar">
                    <ul class="menu">
                        <li class="menu-item home"><a href="home.php"> HOME</a></li>
                        <li class="menu-item clothing">CLOTHING <i class="fas fa-angle-down"></i></a>
                            <div class="list-clothing">
                                <ul class="item-clothing">
                                    <?php
                                        include_once('../controllers/TypeCtr.php');
                                        $Type = new TypeCtr();
                                        $Type->getType();
                                    ?>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item accessories"><a class="hov" href="#">ACCESSORIES<i class="fas fa-angle-down"></i></a>
                            <div class="dropdown-menu list-accessories">
                                <ul class=" item-accessories">
                                    <li> <a href="#">HATS</a></li>
                                    <li><a href="#"> JEWERLS</a></li>
                                    <li><a href="#"> </a></li>
                                    <li> <a href="#"></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item about"><a href="../templates/about.php">ABOUT US</a></li>
                        <li class="menu-item contact"><a href="../templates/contact.php">CONTACT</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-7">
            
                <div class="icon-menu">
                    <div class="icon-search">
                    <i onclick="displayONOFF('search-swapper')" class="fas fa-search fa-lg"></i>
                    <div class="search-swapper" style="display: none;">
                    <form  method='POST' class="search-content" action="search.php">
                            <div class="search">
                                <input type="text" name="search-key"style="height:30px;" >
                                <button type="submit" id="search-button" class="btn btn-danger" >SEARCH</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    <div class="icon-bag">
                    
                        <a href="cart.php"><i class="fas fa-shopping-bag fa-lg"></i></a>
                       <div class= 'count'>
                       
                       </div>
                    </div>
                    <div class="icon-login">
                        <div class="icon-login">
                           <i class="fas fa-lock-open fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  <!--modal-->  

<!--login-->
<div class="login-regis-swapper">
    <div class="login-regis">
        <div class="lg-rg-button">
            <div class="login">Login</div>
            <div class="register"> Register</div>
            <div class="exit-form-login"><i class="fas fa-times fa-lg"></i></div>
        </div>
        <div class="login-form">
            <div class="login-swapper">
                <form  method='POST' class="login-content">
                    <input type="text" name="username" class='text-input' placeholder="USERNAME">
                    <input type="password"  name="password" class='text-input' placeholder="PASSWORD">
                    <div class='error-login'></div>
                    <div class="forgot-pass"> Forgot your password</div>
                    <input type="submit" class='login-button' name="btn_submit" value="login">
                </form>
            </div>
        </div>
    
        <div class="regis-form" style="display:none">
            <div class="regis-swapper">
                <form class="regis-content" method="post" >
                    <input type="text"  name="name" class='text-name' placeholder="name">
                    <input type="text"  name="username" class='text-input' placeholder="USERNAME">
                    <input type="password"  name="password" class='text-input ' id='password' placeholder="PASSWORD">
                    <input type="password"  name="re-password" class='text-input' id='re-password' class="cf-password" placeholder="PASSWORD">
                    <input type="submit"  name="regis_submit" class="regis_button" value="register">
                    <div class="error_signup"></div>
                </form>
            </div>
        </div>

        <div class="forgot-form" style="display:none">
            <div class="forgot-swapper">
                <div class="forgot-content">
                    <input type="text" name="username" class='check-user' placeholder="USERNAME">
                    <div class='error-user'></div>
                    <input type="submit" class='forgot-button' name="btn_submit" value="Next">
                </div>
            </div>
        </div>
    </div>
    <div class='user'>
        <?php
            if(isset($_SESSION['user'])){
                $user=$_SESSION['user'];
                include_once('../views/homePage/user.php');
            }
            else {
                $AccountCtr = new AccountCtr();
                $AccountCtr->checkLogin(1,1);   
            }
        ?>
    </div>
</div>
<!--menu-mobile-->
<div class="main-swap">
    <div id="menu-exit"><i onclick="menuExit()" class="fas fa-times fa-lg"></i></div>
    <div id="swapper">
        <div class="menu2">
            <ul >
                <li class="mb-list mb-list-home"><a href="#"> Home </a></li>
                <li class="mb-list title-main"> <a href="#">Clothing  <span onclick="displayONOFF('mb-clothing')"><i class="fas fa-angle-down"></i></span></a>
                    <div class="mb-clothing" style="display:none;">
                        <ul class="mb-list-clothing">
                            <li><a href="#">item1</a>
                                <div class="mb-item">
                                    <ul>
                                        <li><a href="#">aaaaaa</a></li>
                                        <li><a href="#">aaaaaa</a></li>
                                        <li><a href="#">aaaaaa</a></li>
                                        <li><a href="#">aaaaaa</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="#">item2</a>
                                <div class="mb-item">
                                    <ul>
                                        <li><a href="#">bbbb</a></li>
                                        <li><a href="#">bbbb</a></li>
                                        <li><a href="#">bbb</a></li>
                                        <li><a href="#">bbbb</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="#">item3</a>
                                <div class="mb-item">
                                    <ul>
                                        <li><a href="#">ddd</a></li>
                                        <li><a href="#">dddd</a></li>
                                        <li><a href="#">ddd</a></li>
                                        <li><a href="#">ddd</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-list title-main"><a href="#">accessories <span onclick="displayONOFF('mb-accessories')"><i class="fas fa-angle-down"></i></span></a>
                    <div class="mb-accessories" style="display:none;">
                        <ul class="mb-list-clothing">
                            <li><a href="#">item1</a>  
                            </li>
                            <li><a href="#">item2</a>
                            </li>
                            <li><a href="#">item3</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-list"><a href="../html/about.php">about us</a></li></li>
                <li class="mb-list"><a href="../html/contact.php">contact</a></li>
            </ul>
        </div>
    </div>  
</div>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    $(document).ready(function() {
    $('#dataTable').DataTable();
    });

</script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
</html>
<div id="ViewModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="classInfo" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <h3 class="modal-title" id="classModalLabel">
              YOUR BILL
            </h3>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
     
      </div>
    
      <div class="modal-body">
        <table id="classTable" class="table table-bordered">
          <thead>
          </thead>
          <tbody>
            <tr>
              <th>STT</th>
              <th>YOUR PRODUCT</th>
              <th>COUNT(S)</th>
              <th>PRICES</th>
              <th>SIZE</th>
              <th>STATUS</th>
              <th>BOUGHT AT</th>
            </tr>
            <?php
                $user=$_SESSION['user']['id'];
                $db=new DataProvider;
                $sql="SELECT clothes.id, clothes.name, clothes.price, chitiet_hoadon.soluong, chitiet_hoadon.size,hoadon.tinhtrang,hoadon.date  FROM chitiet_hoadon INNER JOIN clothes ON chitiet_hoadon.id_cloth=clothes.id INNER JOIN hoadon ON chitiet_hoadon.MaHD=hoadon.MaHD
                WHERE hoadon.id_user=$user";
                $array=$db->FetchAll($sql);
                $i=1;
                foreach($array as $bill){
                    $bill['tinhtrang']==0 ? $status="unpaid" : $status="unpaid";
                    $bill_money=number_format($bill['price'],0,",",".");
                   
                    echo "<tr>";
                        echo "<td>$i</td>";
                        echo "<td>$bill[name]</td>";
                        echo "<td>$bill[soluong]</td>";
                        echo "<td>$bill_money</td>";
                        echo "<td>$bill[size]</td>";
                        echo "<td>$status</td>";
                        echo "<td>$bill[date]</td>";          
                    echo "</tr>";
                    $i++;
                }                 
            ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
          CLOSE
        </button>
      </div>
    </div>
  </div>
</div>

