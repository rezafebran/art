<?php
require 'function.php';


session_start();


    try {
        
      if(count($_SESSION) == 0){
     echo "<center>Login first<a href='login.php'>Login</a></center>";die;
}
    } catch (\Throwable $th) {
        echo "anda harus login";die;
    }


    $product = query("SELECT * FROM product");
$id = $_SESSION['user'][0]['id'];
$cart = query("SELECT * FROM cart WHERE user_id='$id'");
$total = 0;





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/base/style.css">
    <link rel="stylesheet" href="./css/pages/page.css">
    <title>ART - Shoe</title>
</head>

<body>
    <style>

.search {
  position: relative;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: start;
  -ms-flex-pack: start;
  justify-content: flex-start;
}

.search svg {
  height: 6rem;
  padding: 1.5rem;
  position: absolute;
  cursor: pointer;
}

.search__icon {
  fill: #767b91;
  z-index: 99;
}

.search__close {
  right: 0;
  fill: white;
  -webkit-transition: 500ms fill ease-in;
  transition: 500ms fill ease-in;
}

.search__delete {
  fill: #c7ccdb;
  right: 5rem;
  display: none;
}

.search input {
  /* -webkit-box-shadow: 0 0 10px 5px #e1e5ee; */
  /* box-shadow: 0 0 10px 5px #e1e5ee; */
  border: none;
  border-radius: 50%;
  padding: 1.7rem 3rem;
  font-family: inherit;
  font-size: 2rem;
  color: #767b91;
  outline: none;
  font-weight: inherit;
  width: 2rem;
  -webkit-transition: 500ms width ease-in-out, 500ms padding ease-in-out,
    500ms border-radius ease-in-out;
  transition: 500ms width ease-in-out, 500ms padding ease-in-out,
    500ms border-radius ease-in-out;
}

.search input:not(:placeholder-shown) ~ .search__delete {
  display: block;
}

.search-open input {
  width: 34rem;
  padding: 1.5rem 11rem 1.5rem 6rem;
  border-radius: 0.2rem;
}

.search-open svg.search__close {
  fill: #767b91;
}

.searchwrapper {
    display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
}

    </style>

    <header id="header" class="header">
        <div class="container">
            <div class="flex__navbar">
                <div class="logo"><a href="#">Art - Shoe</a></div>

                <?php if (isset($_SESSION['user'])) { ?>

                    <div class="logo">
                        <a href="">Halo <?= $_SESSION['user'][0]['username'] ?></a>
                        <span>/</span>
                        <a href="logout.php">Logout</a>
                    </div>

                <?php } else { ?>

                    <div class="logo">
                        <a href="login.php">Login</a>
                        <span>/</span>
                        <a href="registration.php">Register</a>
                    </div>

                <?php } ?>

                <div class="shoppping__cart">
                    <ul>
                        <li class="sub__menu">
                            <img src="./css/img/cart.png" alt="">
                            <div id="shopping__list">
                                <table id="cart__content" class="full_width">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>QTY</th>
                                            <th>Price</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody >

                                        <?php foreach ($cart as $key => $value) { ?>
                                            <tr>
                                                <td style="font-size: 20px;"> <?= $value['name_product'] ?></td>
                                                <td style="font-size: 20px;"> <?= $value['qty'] ?></td>
                                                <td style="font-size: 20px;"> <?= $value['price_product'] * $value['qty']?></td>
                                                <td style="display: flex;"> 
                                                    <button style="font-size: 20px;" class="adds" cart-id="<?= $value['id'] ?>">+</button>
                                                 <button style="font-size: 20px;" class="removes" cart-id="<?= $value['id'] ?>">-</button>
                                            </td>
                                                <?php $total += $value['total']?>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td style="font-size: 20px;">Total All</td>
                                                <td></td>
                                                <td></td>
                                                <td style="font-size: 20px;"><?= $total?></td>
                                            </tr>
                                    </tbody>
                                </table>
                                <a href="removecart.php?id=<?= $value["id"]; ?>" id="clear-cart" class="button u-full-width">Clear Cart</a>
                               <br></br>
                                <a href="ChoosePayment/index.html" id="clear-cart" class="button u-full-width">Check out</a>
                                </br> <br>
                                <a href="ChoosePayment/index.html" id="clear-cart" class="button u-full-width">Order List</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        </div> <!-- its for button cart -->

    </header>
    <div id="banner">
        <div class="container">
            <div class="row">
                <div class="banner__container">
                    <div class="banner__content">
                        <h2 id="learn">Good shoe,explore the world</h2>

                        
<div class="searchwrapper">
    <div class="search">
    <svg id="searcher" class="search__icon" viewBox="0 0 512 512" width="95" title="search">
      <path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z" />
    </svg>

    <input type="text" id="search" name="search" class="search__input" autofocus placeholder="Search your shoes" />

    <svg class="search__close" viewBox="0 0 352 512" width="100" title="times">
      <path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" />
    </svg>

    <svg class="search__delete" viewBox="0 0 640 512" width="100" title="backspace">
      <path d="M576 64H205.26A63.97 63.97 0 0 0 160 82.75L9.37 233.37c-12.5 12.5-12.5 32.76 0 45.25L160 429.25c12 12 28.28 18.75 45.25 18.75H576c35.35 0 64-28.65 64-64V128c0-35.35-28.65-64-64-64zm-84.69 254.06c6.25 6.25 6.25 16.38 0 22.63l-22.62 22.62c-6.25 6.25-16.38 6.25-22.63 0L384 301.25l-62.06 62.06c-6.25 6.25-16.38 6.25-22.63 0l-22.62-22.62c-6.25-6.25-6.25-16.38 0-22.63L338.75 256l-62.06-62.06c-6.25-6.25-6.25-16.38 0-22.63l22.62-22.62c6.25-6.25 16.38-6.25 22.63 0L384 210.75l62.06-62.06c6.25-6.25 16.38-6.25 22.63 0l22.62 22.62c6.25 6.25 6.25 16.38 0 22.63L429.25 256l62.06 62.06z" />
      <!-- icon -->
    </svg>
  </div>
  </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section>

        <div style="margin:auto;">
            <!-- <div class="row__content"> -->
                <h1 class="logo" style="margin:40px;">Our product or <a href="create.php" >Costum Your Shoe !</a>  </h1> 
                <div id="dt" style="margin:auto; width:80%;display:flex;justify-content:center;gap:10px;" >


                    <?php foreach ($product as $key => $value) { ?>
                        <div class="card">
                            <img src="./img/<?= $value["thumb"]; ?>" class="course-image_1">
                            <div class="info-card">
                                <h4 style="font-size: 30px;"><?= $value["name"]; ?></h4>
                                <p><?= $value["description"]; ?></p>
                                <img src="./css/img/stars.png">
                                <span class="u-pull-right "><?= $value["price"]; ?></span></p>
                                <button class="u-full-width button-primary button input add-to-cart" data-id="<?= $value["id"]; ?>">Add to Cart</button>
                             <div class="logo"><a href="delete.php?id=<?= $value["id"]; ?>">delete</a></div>
                            </div>
                        </div>



                    <?php } ?>
                </div>



    </section>
    <footer>

        <footer id="footer" class="footer">
          <div class="container">
                <div class="row">
                    <div class="four columns">
                        <nav id="primary" class="menu">
                            <a class="link" href="#">Mobile Applications</a>
                            <a class="link" href="mapssucces/index.php">Service</a>
                        </nav>
                    </div>
                    <div class="four columns">
                        <nav id="secondary" class="menu">
                            <a class="link" href="email/send.php">Contact us</a>
                        </nav>
                    </div>
                </div>
            </div> 


            <div>

            </div>
        </footer>
        
        <!-- Real time search-->
     
       
       <script>
let search = document.querySelector(".search");
let searchIcon = document.querySelector(".search__icon");
let searchInput = document.querySelector(".search__input");
let searchClose = document.querySelector(".search__close");
let searchDelete = document.querySelector(".search__delete");

searchIcon.addEventListener("click", () => {
  search.classList.add("search-open");
  searchIcon.focus();
});

searchClose.addEventListener("click", () => {
  search.classList.remove("search-open");
  
  searchInput.value = "";
  setTimeout(() => {
                            location.reload();
                        }, 2000);
});

searchDelete.addEventListener("click", () => {
  searchInput.value = "";
  searchInput.focus();
});

       </script>
       <script>


var elements = document.getElementsByClassName("add-to-cart");

var myFunction = function() {
    var attribute = this.getAttribute("data-id");
    
    var data = new FormData();
    data.append('productid',attribute);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'addcart.php', true);

    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            alert('item has been added to cart');
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        }
    xhr.send(data);

    
   
};

for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener('click', myFunction, false);

    
}

var item = document.getElementsByClassName("adds");

var myFunction2 = function() {
    var attribute = this.getAttribute("cart-id");
    var data = new FormData();
    data.append('cartid',attribute);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'add.php', true);

    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
           alert('QTY has been added');
                setTimeout(() => {
                    location.reload();
                }, 500);
            }
        }
    xhr.send(data);

   
};

for (var i = 0; i < item.length; i++) {
    item[i].addEventListener('click', myFunction2, false);

    
}
 
var item2 = document.getElementsByClassName("removes");
var myFunction3 = function() {
    var attribute = this.getAttribute("cart-id");
    var data = new FormData();
    data.append('cartid',attribute);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'remove.php', true);
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            alert('QTY has been removed');
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        }
    xhr.send(data);

    
   
};

for (var i = 0; i < item2.length; i++) {
    item2[i].addEventListener('click', myFunction3, false);

}

    
     const log = document.getElementById('searcher');

log.onclick = function() {
        logKey();   
    };

function logKey(e) {
        var value = document.getElementById('search').value;

        if (value.length >= 1) {
  
// return card as product 

    var data = new FormData();
    data.append('search',value);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'search.php', true);

// for create table`
    xhr.onreadystatechange = function(e) {
        if(xhr.readyState == 4 && xhr.status == 200) {
                data = JSON.parse(this.response);
                var htm = "";
                        for (let i = 0; i < data.length; i++) {
                         
                          htm += '<div class="card"><img src="./img/'+data[i]['thumb']+'" class="course-image_1"><div class="info-card"><h4>'+data[i]['name']+'</h4><p>'+data[i]['description']+'</p><img src="./css/img/stars.png"><span class="u-pull-right ">'+data[i]['price']+'</span></p><button class="u-full-width button-primary button input add-to-cart" data-id="'+data[i]['id']+'">Add to Cart</button></div></div>';

                        }

                        var myelement = document.getElementById("dt");
                    myelement.innerHTML= htm;
            }
        }
    xhr.send(data);



        }
}


        </script>
</body>

</html>