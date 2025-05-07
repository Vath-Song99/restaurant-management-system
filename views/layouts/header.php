<?php
// views/layouts/header.php
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Restoran</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="css/style.css" />
    <style>
      header.scrolled .menus > ul > li::after {
        background-color: var(--text-color-white);
      }
      
    </style>
  </head>
  <body>

    <div class="loader">
      <i class="fas fa-utensils loader-icone"></i>
      <p>Restoran</p>
      <div class="loader-ellipses">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>

    <header>
      <div class="container header my-3 d-none d-lg-flex">
        <div class="logo">
          <a href="/">
            <i class="fa fa-utensils me-3"></i>
            <h1 class="mb-0">Restoran</h1>
          </a>
        </div>
        <div class="menus">
          <ul class="d-flex mb-0">
            <li class="list-unstyled py-2">
              <a class="text-decoration-none text-uppercase p-4" href="/"
                >Home</a
              >
            </li>
            <li class="list-unstyled py-2">
              <a class="text-decoration-none text-uppercase p-4" href="/about"
                >About</a
              >
            </li>
            <li class="list-unstyled py-2">
              <a class="text-decoration-none text-uppercase p-4" href="/reservation"
                >Reservation</a
              >
            </li>
            <li class="list-unstyled py-2">
              <a class="text-decoration-none text-uppercase p-4" href="/menu"
                >Menu</a
              >
            </li>
            <li class="list-unstyled py-2">
              <a class="text-decoration-none text-uppercase p-4" href="/contact"
                >Contact</a
              >
            </li>
          </ul>
        </div>
        <div class="icons">
          <a class="text-decoration-none" id="searchBtn" href="#">
            <i class="fa fa-search me-3"></i>
          </a>
          <a class="text-decoration-none" id="shoppingbutton" href="#">
            <i class="fa fa-shopping-bag me-3"></i>
          </a>
        </div>
      </div>

      <div class="d-flex justify-content-around py-3 align-items-center d-lg-none">
        <div id="hamburger">
          <i class="fa fa-2x fa-bars me-3 text-white"></i>
        </div>
        <div class="mobile-nav-logo">
          <div class="logo">
            <a href="/">
              <i class="fa fa-utensils me-3"></i>
              <h1 class="mb-0">Restoran</h1>
            </a>
          </div>
        </div>
        <div class="mobile-nav-icons">
          <div class="icons">
            <a class="text-decoration-none" id="searchBtnMobile" href="#">
              <i class="fa fa-search me-3"></i>
            </a>
            <a class="text-decoration-none" id="shoppingbuttonMobile" href="#">
              <i class="fa fa-shopping-bag me-3"></i>
            </a>
          </div>
        </div>
        <div class="position-fixed w-75 bg-white h-100 top-0 start-0" id="mobile-menu">
          <div id="hamburger-cross" class="d-flex justify-content-end align-items-center py-2">
            <i class="fa fa-2x fa-plus me-3 "></i>
          </div>
          <div class="menus">
            <ul class="d-flex flex-column ps-2 mb-0 mt-4">
              <li class="list-unstyled py-2">
                <a class="text-dark text-decoration-none text-uppercase p-4" href="#"
                  >Home</a
                >
              </li>
              <li class="list-unstyled py-2">
                <a class="text-dark text-decoration-none text-uppercase p-4" href="/about"
                  >About</a
                >
              </li>
              <li class="list-unstyled py-2">
                <a class="text-dark text-decoration-none text-uppercase p-4" href="/reservation"
                  >Reservation</a
                >
              </li>
              <li class="list-unstyled py-2">
                <a class="text-dark text-decoration-none text-uppercase p-4" href="/menu"
                  >Menu</a
                >
              </li>
              <li class="list-unstyled py-2">
                <a class="text-dark text-decoration-none text-uppercase p-4" href="/contact"
                  >Contact</a
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
    </header>

    <div class="search-bar d-none" id="search-container">
      <div class="close-btn" id="search-close-btn">
        <i class="fa fa-close"></i>
      </div>
      <div class="search-bar-wrapper">
        <input type="search" placeholder="Enter any text here..." />
        <div class="search-button">
          <a href="#"><i class="fa fa-search"></i></a>
        </div>
      </div>
    </div>

    <div class="shopping-cart">
      <div class="shopping-cart-header d-flex justify-content-between">
        <h2>Review your Cart</h2>
        <i class="fa fa-close"></i>
      </div>
      <div class="shopping-cart-body">
        <div class="row shopping-cart-item d-flex justify-content-between">
          <div class="col-2 d-flex align-items-center">
            <img src="images/product-2a.jpg" alt="">
          </div>
          <div class="col-8">
            <h3>The Cracker Barrel's Country Boy Breakfast</h3>
            <div class="shopping-cart-counter">
              <i class="fa fa-minus"></i>
              <span>1</span>
              <i class="fa fa-plus"></i>
            </div>
          </div>
          <div class="col-2 item-price d-flex align-items-end">
            <p class="mb-0 text-center">$ 25.0</p>
          </div>
        </div>
        <div class="row shopping-cart-item d-flex justify-content-between">
          <div class="col-2 d-flex align-items-center">
            <img src="images/product-2b.jpg" alt="">
          </div>
          <div class="col-8">
            <h3>Old Timer's Meat Breakfast</h3>
            <div class="shopping-cart-counter">
              <i class="fa fa-minus"></i>
              <span>1</span>
              <i class="fa fa-plus"></i>
            </div>
          </div>
          <div class="col-2 item-price d-flex align-items-end">
            <p class="mb-0 text-center">$ 12.0</p>
          </div>
        </div>
        <div class="row shopping-cart-item d-flex justify-content-between">
          <div class="col-2 d-flex align-items-center">
            <img src="images/product-2c.jpg" alt="">
          </div>
          <div class="col-8">
            <h3>Uncle Herschel's Favorite</h3>
            <div class="shopping-cart-counter">
              <i class="fa fa-minus"></i>
              <span>1</span>
              <i class="fa fa-plus"></i>
            </div>
          </div>
          <div class="col-2 item-price d-flex align-items-end">
            <p class="mb-0 text-center">$ 25.0</p>
          </div>
        </div>
        <div class="row shopping-cart-item d-flex justify-content-between">
          <div class="col-2 d-flex align-items-center">
            <img src="images/product-2d.jpg" alt="">
          </div>
          <div class="col-8">
            <h3>Grandpa's Country Fried Breakfast</h3>
            <div class="shopping-cart-counter">
              <i class="fa fa-minus"></i>
              <span>1</span>
              <i class="fa fa-plus"></i>
            </div>
          </div>
          <div class="col-2 item-price d-flex align-items-end">
            <p class="mb-0 text-center">$ 30.0</p>
          </div>
        </div>
      </div>
      <div class="shopping-cart-footer">
        <div class="d-flex justify-content-between px-3 py-2">
          <div>
            <h2 class="mb-0">Subtotal</h2>
            <p class="mb-0">Shipping & taxes calculated at checkout</p>
          </div>
          <div class="d-flex align-items-end">
            <p class="footet-total-price mb-0">$ 92.0</p>
          </div>
        </div>
          <div class="d-flex justify-content-between px-2">
            <div class="footer-checkout">
              <div class="anim-layer"></div>
              <a href="#">Checkout</a>
            </div>
            <div class="footer-shopping">
              <div class="anim-layer"></div>
              <a href="#">Continue Shopping</a>
            </div>
          </div>
      </div>
    </div>