<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Responsive Grocery Website Design Tutorial</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/header.css">

</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap');

:root{
    --orange:#ff7800;
    --black:#130f40;
    --light-color:#666;
    --box-shadow:0 .5rem 1.5rem rgba(0,0,0,.1);
    --border:.2rem solid rgba(0,0,0,.1);
    --outline:.1rem solid rgba(0,0,0,.1);
    --outline-hover:.2rem solid var(--black);
}

*{
    font-family: 'Poppins', sans-serif;
    margin:0; padding:0;
    box-sizing: border-box;
    outline: none; border:none;
    text-decoration: none;
    text-transform: capitalize;
    transition: all .2s linear;
}

html{
    font-size: 62.5%;
    overflow-x: hidden;
    scroll-behavior: smooth;
    scroll-padding-top: 7rem;
}



section{
    padding:2rem 9%;
}

.heading{
    text-align: center;
    padding:2rem 0;
    padding-bottom: 3rem;
    font-size: 3.5rem;
    color:var(--black);
}

.heading span{
    background: var(--orange);
    color:#fff;
    display: inline-block;
    padding:.5rem 3rem;
    clip-path: polygon(100% 0, 93% 50%, 100% 99%, 0% 100%, 7% 50%, 0% 0%);
}

.btn{
    margin-top: 1rem;
    display: inline-block;
    padding:.8rem 3rem;
    font-size: 1.7rem;
    border-radius: .5rem;
    border:.2rem solid var(--black);
    color:var(--black);
    cursor: pointer;
    background: none;
}

.btn:hover{
    background: var(--orange);
    color:#fff;
}

.header{
    position: fixed;
    top:0; left:0; right: 0;
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding:2rem 9%;
    background:#fff;
    box-shadow: var(--box-shadow);
}

.header .logo{
    font-size: 2.5rem;
    font-weight: bolder;
    color:var(--black);
}

.header .logo i{
    color:var(--orange);
}

.header .navbar a{
    font-size: 1.7rem;
    margin:0 1rem;
    color:var(--black);
}

.header .navbar a:hover{
    color:var(--orange);
}

.header .icons div{
    height: 4.5rem;
    width: 4.5rem;
    line-height: 4.5rem;
    border-radius: .5rem;
    background: #eee;
    color:var(--black);
    font-size: 2rem;
    margin-left: .3rem;
    cursor: pointer;
    text-align: center;
}

.header .icons div:hover{
    background: var(--orange);
    color:#fff;
}

#menu-btn{
    display: none;
}

.header .search-form{
    position: absolute;
    top:110%; right:-110%;
    width: 50rem;
    height:5rem;
    background: #fff;
    border-radius: .5rem;
    overflow: hidden;
    display: flex;
    align-items: center;
    box-shadow: var(--box-shadow);
}

.header .search-form.active{
    right:2rem;
    transition: .4s linear;
}

.header .search-form input{
    height:100%;
    width:100%;
    background: none;
    text-transform: none;
    font-size: 1.6rem;
    color:var(--black);
    padding:0 1.5rem;
}

.header .search-form label{
    font-size: 2.2rem;
    padding-right: 1.5rem;
    color:var(--black);
    cursor: pointer;
}

.header .search-form label:hover{
    color:var(--orange);
}

.header .shopping-cart{
    position: absolute;
    top:110%; right:-110%;
    padding:1rem;
    border-radius: .5rem;
    box-shadow: var(--box-shadow);
    width:35rem;
    background: #fff;
}

.header .shopping-cart.active{
    right:2rem;
    transition: .4s linear;
}

.header .shopping-cart .box{
    display: flex;
    align-items: center;
    gap:1rem;
    position: relative;
    margin:1rem 0;
}

.header .shopping-cart .box img{
    height:10rem;
}

.header .shopping-cart .box .fa-trash{
    font-size: 2rem;
    position: absolute;
    top:50%; right:2rem;
    cursor: pointer;
    color:var(--light-color);
    transform: translateY(-50%);
}

.header .shopping-cart .box .fa-trash:hover{
    color:var(--orange);
}

.header .shopping-cart .box .content h3{
    color:var(--black);
    font-size: 1.7rem;
    padding-bottom: 1rem;
}

.header .shopping-cart .box .content span{
    color:var(--light-color);
    font-size: 1.6rem;
}

.header .shopping-cart .box .content .quantity{
    padding-left: 1rem;
}

.header .shopping-cart .total{
    font-size: 2.5rem;
    padding:1rem 0;
    text-align: center;
    color:var(--black);
}

.header .shopping-cart .btn{
    display: block;
    text-align: center;
    margin:1rem;
}

.header .login-form{
    position: absolute;
    top:110%; right:-110%;
    width:35rem;
    box-shadow: var(--box-shadow);
    padding:2rem;
    border-radius: .5rem;
    background: #fff;
    text-align: center;
}

.header .login-form.active{
    right:2rem;
    transition: .4s linear;
}

.header .login-form h3{
    font-size: 2.5rem;
    text-transform: uppercase;
    color: var(--black);
}

.header .login-form .box{
    width: 100%;
    margin:.7rem 0;
    background:#eee;
    border-radius: .5rem;
    padding:1rem;
    font-size: 1.6rem;
    color:var(--black);
    text-transform: none;
}

.header .login-form p{
    font-size: 1.4rem;
    padding:.5rem 0;
    color:var(--light-color);
}

.header .login-form p a{
    color:var(--orange);
    text-decoration: underline;
}














/* media queries  */

@media (max-width:991px){

    html{
        font-size: 55%;
    }

    .header{
        padding:2rem;
    }

    section{
        padding:2rem;
    }

}

@media (max-width:768px){

    #menu-btn{
        display: inline-block;
    }

    .header .search-form{
        width:90%;
    }

    .header .navbar{
        position: absolute;
        top:110%; right:-110%;
        width:30rem;
        box-shadow: var(--box-shadow);
        border-radius: .5rem;
        background: #fff;
    }

    .header .navbar.active{
        right:2rem;
        transition: .4s linear;
    }

    .header .navbar a{
        font-size: 2rem;
        margin:2rem 2.5rem;
        display: block;
    }

}

@media (max-width:450px){

    html{
        font-size: 50%;
    }

    .heading{
        font-size: 2.5rem;
    }

    .footer{
        text-align: center;
    }

    .footer .box-container .box .payment-img{
        margin: 2rem auto;
    }

}
</style>
<body>
    
<!-- header section starts  -->

<header class="header">

    <a href="#" class="logo"> <i class="fas fa-shopping-basket"></i> groco </a>

    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#features">features</a>
        <a href="#products">products</a>
        <a href="#categories">categories</a>
        <a href="#review">review</a>
        <a href="#blogs">blogs</a>
    </nav>

    <div class="icons">
        <div class="fas fa-bars" id="menu-btn"></div>
        <div class="fas fa-search" id="search-btn"></div>
        <div class="fas fa-shopping-cart" id="cart-btn"></div>
        <div class="fas fa-user" id="login-btn"></div>
    </div>

    <form action="" class="search-form">
        <input type="search" id="search-box" placeholder="search here...">
        <label for="search-box" class="fas fa-search"></label>
    </form>

    <div class="shopping-cart">
        <div class="box">
            <i class="fas fa-trash"></i>
            <img src="image/cart-img-1.png" alt="">
            <div class="content">
                <h3>watermelon</h3>
                <span class="price">$4.99/-</span>
                <span class="quantity">qty : 1</span>
            </div>
        </div>
        <div class="box">
            <i class="fas fa-trash"></i>
            <img src="image/cart-img-2.png" alt="">
            <div class="content">
                <h3>onion</h3>
                <span class="price">$4.99/-</span>
                <span class="quantity">qty : 1</span>
            </div>
        </div>
        <div class="box">
            <i class="fas fa-trash"></i>
            <img src="image/cart-img-3.png" alt="">
            <div class="content">
                <h3>chicken</h3>
                <span class="price">$4.99/-</span>
                <span class="quantity">qty : 1</span>
            </div>
        </div>
        <div class="total"> total : $19.69/- </div>
        <a href="#" class="btn">checkout</a>
    </div>

    <form action="" class="login-form">
        <h3>login now</h3>
        <input type="email" placeholder="your email" class="box">
        <input type="password" placeholder="your password" class="box">
        <p>forget your password <a href="#">click here</a></p>
        <p>don't have an account <a href="#">create now</a></p>
        <input type="submit" value="login now" class="btn">
    </form>

</header>

<!-- header section ends -->

<!-- home section starts  -->



<!-- blogs section ends -->

<!-- footer section starts  -->



<!-- footer section ends -->















<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>