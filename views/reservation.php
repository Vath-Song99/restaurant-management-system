<main class="reservation-page">
  <section class="page-banner d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="banner-content">
          <h2 class="text-white display-3 text-center" data-aos="fade-right" data-aos-delay="3000">Reservation</h2>
          <div class="divider" data-aos="fade-up-right" data-aos-delay="3000">
            <div class="dot mb-2"></div>
          </div>
          <p class="text-white mb-0 text-center" data-aos="fade-left" data-aos-delay="3000">Just a few click to make
            the reservation online for saving your time and money</p>
        </div>
      </div>
    </div>
  </section>

  <section class="reservation-form my-5 py-5">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="text-center display-6 fw-bold" data-aos="fade-right">Reservation Form</h2>
          <div data-aos="fade-right" class="reservation-line d-flex justify-content-center align-items-center">
            <span></span>
          </div>
          <form id="reservationForm" action="<?= BASE_URL; ?>/reservation" method="POST" class="position-relative">
            <img data-aos="fade-down-left" class="d-none d-lg-block" src="images/reservation-showcase.png" alt="">
            <p class="text-center" data-aos="fade-up-right">We are willing to help you make the reservation online to
              save your time and money or you can call us directly through the customer service hotline: 225-88888</p>
            <div class="row mt-5">
              <div data-aos="fade-right" class="col-md-6">
                <div class="input-group">
                  <div class="icon-wrapper d-flex align-items-center position-relative">
                    <i class="fa fa-user py-2 px-3"></i>
                  </div>
                  <input class="form-control bg-transparent border-0 px-3" id="username" name="username" type="text"
                    placeholder="Username">
                </div>
                <div class="input-group">
                  <div class="icon-wrapper d-flex align-items-center position-relative">
                    <i class="fa fa-phone py-2 px-3"></i>
                  </div>
                  <input class="form-control bg-transparent border-0 px-3" id="phone" name="phone" type="text"
                    placeholder="Phone">
                </div>
                <div class="input-group">
                  <div class="icon-wrapper d-flex align-items-center position-relative">
                    <i class="fa fa-calendar py-2 px-3"></i>
                  </div>
                  <input class="form-control bg-transparent border-0 px-3" id="reservation_date" name="reservation_date"
                    type="date" placeholder="Date">
                </div>
              </div>
              <div data-aos="fade-left" class="col-md-6">
                <div class="input-group">
                  <div class="icon-wrapper d-flex align-items-center position-relative">
                    <i class="fa fa-envelope py-2 px-3"></i>
                  </div>
                  <input class="form-control bg-transparent border-0 px-3" id="email" name="email" type="email"
                    placeholder="Email">
                </div>
                <div class="input-group">
                  <div class="icon-wrapper d-flex align-items-center position-relative">
                    <i class="fa fa-user py-2 px-3"></i>
                  </div>
                  <select class="form-select bg-transparent border-0 ps-3" name="guest" id="guest">
                    <option value="">Select Number of Guests</option>
                    <option value="1">1 Person</option>
                    <option value="2">2 Person</option>
                    <option value="3">3 Person</option>
                    <option value="4">4 Person</option>
                    <option value="5">5 Person</option>
                    <option value="6">6 Person</option>
                    <option value="7">7 Person</option>
                    <option value="8">8 Person</option>
                    <option value="9">9 Person</option>
                    <option value="10">10 Person</option>
                  </select>
                </div>
                <div class="input-group">
                  <div class="icon-wrapper d-flex align-items-center position-relative">
                    <i class="fa fa-clock py-2 px-3"></i>
                  </div>
                  <select type="text" placeholder="Time" id="reservation_time" name="reservation_time" required
                    class="ps-3 form-select bg-transparent border-0">
                    <option value="">Select Time</option>
                    <option value="7:00">7:00 AM</option>
                    <option value="8:00">8:00 AM</option>
                    <option value="9:00">9:00 AM</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="12:00">12:00 PM</option>
                    <option value="1:00">1:00 PM</option>
                    <option value="2:00">2:00 PM</option>
                    <option value="3:00">3:00 PM</option>
                    <option value="4:00">4:00 PM</option>
                    <option value="5:00">5:00 PM</option>
                    <option value="6:00">6:00 PM</option>
                    <option value="7:00">7:00 PM</option>
                    <option value="8:00">8:00 PM</option>
                    <option value="9:00">9:00 PM</option>
                    <option value="10:00">10:00 PM</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="input-group" data-aos="fade-up-right">
                  <textarea class="form-control bg-transparent border-0 px-3" name="description" id="description"
                    placeholder="Special Requirements or Comments"></textarea>
                </div>
              </div>
            </div>
            <div class="text-center" data-aos="fade-up-left">
              <div class="book-a-table contact-button">
                <div class="anim-layer"></div>
                <button type="submit">Book Table</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>


  <section class="reservation-services py-5">
    <div class="container py-5">
      <div class="row">
        <h2 data-aos="fade-right" class="position-relative text-center display-6 text-white fw-bold">Fooday Best
          Service</h2>
        <div data-aos="fade-right" class="reservation-line d-flex justify-content-center align-items-center">
          <span></span>
        </div>
      </div>
      <div class="row">
        <div data-aos="fade-right"
          class="position-relative col-sm-12 col-md-6 col-lg-3 d-flex justify-content-center align-items-center flex-column">
          <div class="icon-box">
            <i class="fas fa-utensils fa-2x"></i>
            <span class="number">1</span>
          </div>
          <h4>Reservation</h4>
          <p class="text-center">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et
          </p>
        </div>
        <div data-aos="fade-down"
          class="position-relative col-sm-12 col-md-6 col-lg-3 d-flex justify-content-center align-items-center flex-column">
          <div class="icon-box">
            <i class="fas fa-wine-glass-alt fa-2x"></i>
            <span class="number">2</span>
          </div>
          <h4>Private Event</h4>
          <p class="text-center">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et
          </p>
        </div>
        <div data-aos="fade-up"
          class="position-relative col-sm-12 col-md-6 col-lg-3 d-flex justify-content-center align-items-center flex-column">
          <div class="icon-box">
            <i class="fas fa-laptop-house fa-2x"></i>
            <span class="number">3</span>
          </div>
          <h4>Online Order</h4>
          <p class="text-center">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et
          </p>
        </div>
        <div data-aos="fade-left"
          class="position-relative col-sm-12 col-md-6 col-lg-3 d-flex justify-content-center align-items-center flex-column">
          <div class="icon-box">
            <i class="fas fa-motorcycle fa-2x"></i>
            <span class="number">4</span>
          </div>
          <h4>Fast Delivery</h4>
          <p class="text-center">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et
          </p>
        </div>
      </div>
    </div>
  </section>


  <section class="reservation-events my-5 py-5 ">
    <div class="container mb-5">
      <div class="row">
        <h2 class="text-center display-6 fw-bold" data-aos="fade-right">Upcoming Events</h2>
        <div data-aos="fade-right" class="reservation-line d-flex justify-content-center align-items-center">
          <span></span>
        </div>
      </div>
      <div class="row">
        <div data-aos="fade-right" class="col-lg-6 mb-5 pb-5 mb-lg-0 pb-lg-0">
          <div class="event-card position-relative">
            <div class="event-heading d-flex py-2">
              <div class="event-date px-3 d-flex flex-column">
                <h5 class="event-day">12</h5>
                <h6 class="event-month">JUN</h6>
              </div>
              <div class="heading ps-3 d-flex align-items-center">
                <p class="mb-0">Hong Kong Tasty Food Cooking Event</p>
              </div>
            </div>
            <div class="image">
              <img class="img-fluid" src="images/event-01.jpg" alt="">
            </div>
            <div class="event-info position-absolute">
              <ul class="d-flex justify-content-around ps-lg-0 position-relative my-3">
                <li class="list-unstyled">
                  <span class="num">03</span>
                  <span class="cap">/days</span>
                </li>
                <li class="list-unstyled">
                  <span class="num">50</span>
                  <span class="cap">/foods</span>
                </li>
                <li class="list-unstyled">
                  <span class="num">290</span>
                  <span class="cap">/guests</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div data-aos="fade-left" class="col-lg-6">
          <div class="event-card position-relative">
            <div class="event-heading d-flex py-2">
              <div class="event-date px-3 d-flex flex-column">
                <h5 class="event-day">12</h5>
                <h6 class="event-month">JUN</h6>
              </div>
              <div class="heading ps-3 d-flex align-items-center">
                <p class="mb-0">Hong Kong Tasty Food Cooking Event</p>
              </div>
            </div>
            <div class="image">
              <img class="img-fluid" src="images/event-02.jpg" alt="">
            </div>
            <div class="event-info position-absolute">
              <ul class="d-flex justify-content-around ps-lg-0 position-relative my-3">
                <li class="list-unstyled">
                  <span class="num">03</span>
                  <span class="cap">/days</span>
                </li>
                <li class="list-unstyled">
                  <span class="num">50</span>
                  <span class="cap">/foods</span>
                </li>
                <li class="list-unstyled">
                  <span class="num">290</span>
                  <span class="cap">/guests</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="subscribe-us pb-5 mb-5">
    <img class="d-none d-lg-block" src="images/subscribe-us.png" alt="" data-aos="fade-down-right">
    <div class="container">
      <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8 d-flex flex-column flex-md-row align-items-lg-center">
          <div class="content" data-aos="fade-right">
            <h5 class="display-6 text-black">Subcribe Us Now</h5>
            <p>
              Get more news and delicious dishes everyday from us
            </p>
          </div>
          <div class="subscribe-form d-flex ps-0 ms-0 ps-lg-5 ms-lg-5" data-aos="fade-left">
            <div class="input-form w-100">
              <input class="border-0 px-3 w-100" type="email" placeholder="Email">
            </div>
            <div class="input-button">
              <a class="text-decoration-none" href="#">
                <i class="fa fa-paper-plane"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="js/script.js"></script>
</body>

</html>