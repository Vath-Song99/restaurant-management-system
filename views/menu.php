<main class="menu-page">
  <section class="page-banner d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="banner-content">
          <h2 class="text-white display-3 text-center" data-aos="fade-right" data-aos-delay="3000">Menu</h2>
          <div class="divider" data-aos="fade-up-right" data-aos-delay="3000">
            <div class="dot mb-2"></div>
          </div>
          <p class="text-center">The various dishes are waiting for your coming to enjoy its</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Menu Sections -->
  <section class="our-menu py-5 my-5">
    <div class="container">
      <div class="row" data-aos="fade-right">
        <div class="section-title text-center">
          <h5>Our Menu</h5>
          <h2 class="display-5 fw-bold">Tasty And Good Price</h2>
        </div>
      </div>
      <div class="row position-relative">
        <div data-aos="fade-left" class="slider slider-indicators-wrapper justify-content-center">
          <?php foreach ($categories as $category): ?>
            <div class="slider-indicators">
              <div class="indicators-icon text-center">
                <i class="fas fa-utensils fa-2x"></i>
              </div>
              <div class="indicators-title text-center">
                <h5>
                  <?= htmlspecialchars($category->name) ?>
                </h5>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div id="our-menus" class="slider" data-aos="fade-up">
        <?php foreach ($categories as $category): ?>
          <div>
            <div class="row my-5 py-3">
              <div class="col-lg-5">
                <div class="pb-5 pb-lg-0">
                  <img width="90%" src="images/<?= htmlspecialchars(strtolower($category->name . '.png')) ?>"
                    alt="<?= htmlspecialchars($category->name) ?>">
                </div>
              </div>
              <div class="col-lg-7">
                <?php
                $count = 0;
                foreach ($menuItems as $menu):
                  if ($menu->category_id == $category->id):
                    if ($count >= 5)
                      break;
                    $count++;
                    ?>
                    <div class="item-wrapper d-flex justify-content-between">
                      <div class="item-left">
                        <h5><?= htmlspecialchars($menu->name) ?></h5>
                        <p><?= htmlspecialchars($menu->description) ?></p>
                      </div>
                      <div class="item-right">
                        <span class="item-price">
                          <span class="price-symbol">$</span>
                          <?= number_format($menu->price, 2) ?>
                        </span>
                        <div class="item-btn">
                          <a href="#">Order</a>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
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
<script src="js/script.js">
</script>
<script>

  document.addEventListener('DOMContentLoaded', function () {
    const categoryIndicators = document.querySelectorAll('.category-indicator');

    categoryIndicators.forEach(indicator => {
      indicator.addEventListener('click', function () {
        const categoryId = this.dataset.categoryId;

        // Remove active class from all indicators
        categoryIndicators.forEach(ind => {
          ind.querySelector('.indicators-icon').classList.remove('active');
        });

        // Add active class to clicked indicator
        this.querySelector('.indicators-icon').classList.add('active');

        // Fetch menu items for selected category
        fetch(`<?= BASE_URL ?>/menu/getMenuByCategory/${categoryId}`)
          .then(response => response.json())
          .then(data => {
            // Update menu items in the DOM
            updateMenuItems(data);
          })
          .catch(error => console.error('Error:', error));
      });
    });

    // Add to cart functionality
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
      button.addEventListener('click', function (e) {
        e.preventDefault();
        const menuId = this.dataset.id;
        document.getElementById('menu_id').value = menuId;
        document.getElementById('add-to-cart-form').submit();
      });
    });

    // Cart quantity update
    const cartUpdateButtons = document.querySelectorAll('.cart-update');
    cartUpdateButtons.forEach(button => {
      button.addEventListener('click', function () {
        const itemId = this.dataset.id;
        const action = this.dataset.action;
        const quantityElement = this.parentElement.querySelector('span');
        let quantity = parseInt(quantityElement.textContent);

        if (action === 'increase') {
          quantity++;
        } else if (action === 'decrease' && quantity > 1) {
          quantity--;
        } else if (action === 'decrease' && quantity === 1) {
          // Confirm before removing
          if (confirm('Remove this item from cart?')) {
            quantity = 0;
          } else {
            return;
          }
        }

        // Update quantity in form and submit
        document.getElementById('update_item_id').value = itemId;
        document.getElementById('update_quantity').value = quantity;

        // Use AJAX to update
        const formData = new FormData(document.getElementById('update-cart-form'));

        fetch('<?= BASE_URL ?>/menu/updateCart', {
          method: 'POST',
          body: formData
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // Update cart display
              if (quantity === 0) {
                // Remove item from cart display
                this.closest('.shopping-cart-item').remove();
              } else {
                // Update quantity display
                quantityElement.textContent = quantity;
              }

              // Update total price
              document.querySelector('.footet-total-price').textContent = '$ ' + data.cartTotal.toFixed(2);
            }
          })
          .catch(error => console.error('Error:', error));
      });
    });
  });

  // Function to update menu items in the DOM
  function updateMenuItems(items) {
    const menuContainer = document.querySelector('#our-menus .col-lg-7');
    menuContainer.innerHTML = '';

    items.slice(0, 6).forEach(item => {
      const itemHtml = `
          <div class="item-wrapper d-flex justify-content-between">
              <div class="item-left">
                  <h5>${item.name}</h5>
                  <p>${item.description}</p>
              </div>
              <div class="item-right">
                  <span class="item-price">
                      <span class="price-symbol">$</span>
                      ${parseFloat(item.price).toFixed(1)}
                  </span>
                  <div class="item-btn">
                      <a href="#" class="add-to-cart" data-id="${item.id}">Order</a>
                  </div>
              </div>
          </div>
      `;

      menuContainer.innerHTML += itemHtml;
    });

    // Reattach event listeners to new add-to-cart buttons
    document.querySelectorAll('.add-to-cart').forEach(button => {
      button.addEventListener('click', function (e) {
        e.preventDefault();
        const menuId = this.dataset.id;
        document.getElementById('menu_id').value = menuId;
        document.getElementById('add-to-cart-form').submit();
      });
    });
  }
</script>
</body>

</html>