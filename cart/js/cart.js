(function () {
  // Add to Cart Interaction - by CodyHouse.co
  var cart = document.getElementsByClassName('js-cd-cart');
  if (cart.length > 0) {
    var cartAddBtns = document.getElementsByClassName('js-cd-add-to-cart'),
      cartBody = cart[0].getElementsByClassName('cd-cart__body')[0],
      cartList = document.getElementById('cart-list'),
      cartTotal = document.getElementById('cart-total'),
      cartCount = cart[0].getElementsByClassName('cd-cart__count')[0],
      cartCountItems = cartCount.getElementsByTagName('li'),
      cartUndo = cart[0].getElementsByClassName('cd-cart__undo')[0],
      productId = 1, // this is a placeholder -> use your real product ids instead
      cartTimeoutId = false,
      animatingQuantity = false;

    initCartEvents();





    function initCartEvents() {
      // Check if cart is not empty and show it
      var savedCart = localStorage.getItem('cart');
      if (savedCart && savedCart !== '') {
        Util.removeClass(cart[0], 'cd-cart--empty');
        cartList.innerHTML = savedCart;
        quickUpdateCart();
      }

      // Add products to cart
      for (var i = 0; i < cartAddBtns.length; i++) {
        (function (i) {
          cartAddBtns[i].addEventListener('click', addToCart);
        })(i);
      }

      // Open/close cart
      cart[0].getElementsByClassName('cd-cart__trigger')[0].addEventListener('click', function (event) {
        event.preventDefault();
        toggleCart();
      });

      cart[0].addEventListener('click', function (event) {
        if (event.target == cart[0]) {
          // Close cart when clicking on background layer
          toggleCart(true);
        } else if (event.target.closest('.cd-cart__delete-item')) {
          // Remove product from cart
          event.preventDefault();
          removeProduct(event.target.closest('.cd-cart__product'));
        }
      });

      // Update product quantity inside cart
      cart[0].addEventListener('change', function (event) {
        if (event.target.tagName.toLowerCase() == 'select') quickUpdateCart();
      });

      // Reinsert product deleted from the cart
      cartUndo.addEventListener('click', function (event) {
        if (event.target.tagName.toLowerCase() == 'a') {
          event.preventDefault();
          if (cartTimeoutId) clearInterval(cartTimeoutId);
          // Reinsert deleted product
          var deletedProduct = cartList.getElementsByClassName('cd-cart__product--deleted')[0];
          Util.addClass(deletedProduct, 'cd-cart__product--undo');
          deletedProduct.addEventListener('animationend', function cb() {
            deletedProduct.removeEventListener('animationend', cb);
            Util.removeClass(deletedProduct, 'cd-cart__product--deleted cd-cart__product--undo');
            deletedProduct.removeAttribute('style');
            quickUpdateCart();
          });
          Util.removeClass(cartUndo, 'cd-cart__undo--visible');
        }
      });

      // Save cart to local storage whenever cart content changes
      cart[0].addEventListener('change', function () {
        saveCartToLocalStorage();
      });
    }





    function addToCart(event) {
      event.preventDefault();
      if (animatingQuantity) return;
      var cartIsEmpty = Util.hasClass(cart[0], 'cd-cart--empty');
      // Update cart product list
      addProduct(this);
      // Update number of items
      updateCartCount(cartIsEmpty);
      // Update total price
      updateCartTotal(this.getAttribute('data-price'), true);
      // Show cart
      Util.removeClass(cart[0], 'cd-cart--empty');
    }





    function toggleCart(bool) { // toggle cart visibility
			var cartIsOpen = ( typeof bool === 'undefined' ) ? Util.hasClass(cart[0], 'cd-cart--open') : bool;
		
			if( cartIsOpen ) {
				Util.removeClass(cart[0], 'cd-cart--open');
				//reset undo
				if(cartTimeoutId) clearInterval(cartTimeoutId);
				Util.removeClass(cartUndo, 'cd-cart__undo--visible');
				removePreviousProduct(); // if a product was deleted, remove it definitively from the cart

				setTimeout(function(){
					cartBody.scrollTop = 0;
					//check if cart empty to hide it
					if( Number(cartCountItems[0].innerText) == 0) Util.addClass(cart[0], 'cd-cart--empty');
				}, 500);
			} else {
				Util.addClass(cart[0], 'cd-cart--open');
			}
		};



    function addProduct(target) {
      var productId = target.getAttribute('data-product-id');
      var productName = target.getAttribute('data-product-name');
      var productPrice = target.getAttribute('data-product-price');
      var productImage = target.getAttribute('data-product-image');

      var productIdAttr = 'product-' + productId;
      var productAdded = '<li class="cd-cart__product" data-product-id="' + productId + '"><div class="cd-cart__image"><a href="#0"><img src="' + productImage + '" alt="' + productName + '"></a></div><div class="cd-cart__details"><h3 class="truncate"><a href="#0">' + productName + '</a></h3><span class="cd-cart__price">' + productPrice + '</span><div class="cd-cart__actions"><a href="#0" class="cd-cart__delete-item">Delete</a><div class="cd-cart__quantity"><label for="' + productIdAttr + '">Qty</label><span class="cd-cart__select"><select class="reset" id="' + productIdAttr + '" name="quantity"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option></select><svg class="icon" viewBox="0 0 12 12"><polyline fill="none" stroke="currentColor" points="2,4 6,8 10,4 "/></svg></span></div></div></div></li>';

      cartList.insertAdjacentHTML('beforeend', productAdded);

      // Save cart to local storage
      localStorage.setItem('cart', cartList.innerHTML);
    }
    
    
    
    

function removeProduct(product) {
  if (cartTimeoutId) clearInterval(cartTimeoutId);
  removePreviousProduct(); // Product previously deleted -> definitively remove it from the cart

  var topPosition = product.offsetTop;
  var productQuantity = Number(product.getElementsByTagName('select')[0].value);
  var productTotPrice = Number(product.getElementsByClassName('cd-cart__price')[0].innerText.replace('$', '')) * productQuantity;

  product.style.top = topPosition + 'px';
  Util.addClass(product, 'cd-cart__product--deleted');

  // Update items count + total price
  updateCartTotal(productTotPrice, false);
  updateCartCount(true, -productQuantity);
  Util.addClass(cartUndo, 'cd-cart__undo--visible');

  // Wait 8 seconds before completely remove the item
  cartTimeoutId = setTimeout(function () {
    Util.removeClass(cartUndo, 'cd-cart__undo--visible');
    removePreviousProduct();

    // Check if cart is empty and hide it
    if (cartList.children.length === 0) {
      toggleCart(true);
    }
  }, 8000);

  // Save cart to local storage
  localStorage.setItem('cart', cartList.innerHTML);

  // Check if cart is empty and hide it when "X" button is clicked
  if (cartList.children.length === 0) {
    toggleCart(true);
  }
}







    function removePreviousProduct() {
      // Definitively remove a product from the cart (undo not possible anymore)
      var deletedProduct = cartList.getElementsByClassName('cd-cart__product--deleted');
      if (deletedProduct.length > 0) deletedProduct[0].remove();

      // Save cart to local storage
      localStorage.setItem('cart', cartList.innerHTML);
    }

    function updateCartCount(emptyCart, quantity) {
      if (typeof quantity === 'undefined') {
        var actual = Number(cartCountItems[0].innerText) + 1;
        var next = actual + 1;

        if (emptyCart) {
          cartCountItems[0].innerText = actual;
          cartCountItems[1].innerText = next;
          animatingQuantity = false;
        } else {
          Util.addClass(cartCount, 'cd-cart__count--update');

          setTimeout(function () {
            cartCountItems[0].innerText = actual;
          }, 150);

          setTimeout(function () {
            Util.removeClass(cartCount, 'cd-cart__count--update');
          }, 200);

          setTimeout(function () {
            cartCountItems[1].innerText = next;
            animatingQuantity = false;
          }, 230);
        }
      } else {
        var actual = Number(cartCountItems[0].innerText) + quantity;
        var next = actual + 1;

        cartCountItems[0].innerText = actual;
        cartCountItems[1].innerText = next;
        animatingQuantity = false;
      }

      // Save cart to local storage
      localStorage.setItem('cart', cartList.innerHTML);
    }





    function updateCartTotal(price, bool) {
      var actualTotal = Number(cartTotal.innerText.replace('$', ''));

      if (bool) {
        cartTotal.innerText = '$' + (actualTotal + Number(price)).toFixed(2);
      } else {
        cartTotal.innerText = '$' + (actualTotal - Number(price)).toFixed(2);
      }

      // Save cart to local storage
      localStorage.setItem('cart', cartList.innerHTML);
    }

    function quickUpdateCart() {
      var quantity = 0;
      var price = 0;

      for (var i = 0; i < cartList.children.length; i++) {
        var singleQuantity = Number(cartList.getElementsByClassName('cd-cart__quantity')[i].getElementsByTagName('select')[0].value);
        quantity += singleQuantity;
        price += singleQuantity * Number(cartList.getElementsByClassName('cd-cart__price')[i].innerText.replace('$', ''));
      }

      cartTotal.innerText = '$' + price.toFixed(2);
      cartCountItems[0].innerText = quantity;
      cartCountItems[1].innerText = quantity + 1;
    }




    function saveCartToLocalStorage() {
      localStorage.setItem('cart', cartList.innerHTML);
    }
  }
  window.addEventListener('DOMContentLoaded', function () {
    var cart = document.getElementsByClassName('js-cd-cart')[0];
    var cartList = document.getElementById('cart-list');

    // Check if the cart is empty
    if (cartList.children.length === 0) {
      // Add a class to hide the cart
      cart.classList.add('cd-cart--empty');
    }
  });
})();
