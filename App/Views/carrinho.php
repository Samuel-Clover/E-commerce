{% extends "template/ecommerce.html" %}

{% block content %}

<div class="product-big-title-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="product-bit-title text-center">
          <h2>Produtos no Carrinho</h2>
        </div>
      </div>
    </div>
  </div>
</div> <!-- End Page title area -->


<div class="single-product-area">
  <div class="zigzag-bottom"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="single-sidebar">
          <h2 class="sidebar-title">Pesquisa de Produtos</h2>
          <form method="POST" class="busca">
            <input type="text" name="busca" placeholder="Pesquisa de Produtos...">
            <input type="submit" value="Pesquisar">
          </form>
        </div>
  
        <div class="single-sidebar">
            <div id="produto">
              <h2 class="sidebar-title">Produtos</h2>
            </div>
          {% for genericProduct in genericProducts %}
          <div class="thubmnail-recent">
            <img src="{{constant('BASE_URL')}}/assets/img/{{genericProduct.image}}" class="recent-thumb" alt="{{genericProduct.name}}">
            <h2><a href="{{constant('BASE_URL')}}/detalhes/{{genericProduct.id}}">{{ genericProduct.name }}</a></h2>
            <div class="product-sidebar-price">
              <ins>{{genericProduct.price_from}}</ins> <del>{{genericProduct.price}}</del>
            </div>
          </div>
          {% endfor %}
        </div>

        <div class="single-sidebar">
          <h2 class="sidebar-title">Postagem Recentes</h2>
          <ul>
            {% for newProduct in newProducts %}
            <li><a href="{{constant('BASE_URL')}}/detalhes/{{newProduct.id}}">{{newProduct.name}}</a></li>
            {% endfor %}
          </ul>
        </div>
      </div>

      <div class="col-md-8">
        <div class="product-content-right">
          <div class="woocommerce">
            <form name="cartForm" method="post" action="#">
              <table cellspacing="0" class="shop_table cart">
                <thead>
                  <tr>
                    <th class="product-remove">&nbsp;</th>
                    <th class="product-thumbnail">&nbsp;</th>
                    <th class="product-name">Produto</th>
                    <th class="product-price">Preço</th>
                    <th class="product-quantity">Qts</th>
                    <th class="product-subtotal">Total</th>
                  </tr>
                </thead>
                <tbody>
                  {% for product in products %}
                  <tr data-id="{{ product.id }}" class="cart_item">
                    <td class="product-remove">
                      <a title="Remove this item" class="remove" href="#" onclick="deleteProduct('{{ product.id }}'); deleteProductFromCart('{{ product.price_from }}')">
                        <i class="fa fa-trash"></i> </a>
                    </td>

                    <td class="product-thumbnail">
                      <a href="{{constant('BASE_URL')}}/detalhes/{{product.id}}"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="{{ constant('BASE_URL') }}/assets/img/{{ product.image }}"></a>
                    </td>

                    <td class="product-name">
                      <a href="{{constant('BASE_URL')}}/detalhes/{{product.id}}">{{ product.name }}</a>
                    </td>

                    <td class="product-price">
                      <span class="amount">{{ product.price_from }}</span>
                    </td>

                    <td class="product-quantity">
                      <div class="quantity buttons_added">
                        <input type="button" class="minus" value="-">
                        <input type="number" size="4" class="input-text qty text" title="Qty" value="1" min="0" step="1">
                        <input type="button" class="plus" value="+">
                      </div>
                    </td>

                    <td class="product-subtotal">
                      <span class="amount">{{ product.price_from }}</span>
                    </td>
                  </tr>
                  {% endfor %}
                  <tr>
                    <td class="actions" colspan="6">
                      <div class="coupon">
                        <label for="coupon_code">Cupom:</label>
                        <input type="text" placeholder="Coupon code" value="" id="coupon_code" class="input-text" name="coupon_code">
                        <input type="submit" value="Aplicar Cupon" name="apply_coupon" class="button">
                      </div>
                      <input type="submit" value="Atual. Carrinho" name="update_cart" class="button">
                      <input type="submit" value="Finalizar" name="proceed" class="checkout-button button alt wc-forward">
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>

            <div class="cart-collaterals">

              <!--
              <div class="cross-sells">
                  <h2>You may be interested in...</h2>
                  <ul class="products">
                      <li class="product">
                          <a href="single-product.html">
                              <img width="325" height="325" alt="T_4_front" class="attachment-shop_catalog wp-post-image" src="img/product-2.jpg">
                              <h3>Ship Your Idea</h3>
                              <span class="price"><span class="amount">£20.00</span></span>
                          </a>

                          <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="22" rel="nofollow" href="single-product.html">Select options</a>
                      </li>

                      <li class="product">
                          <a href="single-product.html">
                              <img width="325" height="325" alt="T_4_front" class="attachment-shop_catalog wp-post-image" src="img/product-4.jpg">
                              <h3>Ship Your Idea</h3>
                              <span class="price"><span class="amount">£20.00</span></span>
                          </a>

                          <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="22" rel="nofollow" href="single-product.html">Select options</a>
                      </li>
                  </ul>
              </div>
              -->

              <div class="cart_totals ">
                <h2>Carrinho Total</h2>

                <table cellspacing="0">
                  <tbody>
                    <tr class="cart-subtotal">
                      <th>Carrinho Subtotal</th>
                      <td><span class="amount">R$1500.00</span></td>
                    </tr>

                    <tr class="shipping">
                      <th>Frete</th>
                      <td>R$ 0,00</td>
                    </tr>

                    <tr class="order-total">
                      <th>Total da Venda</th>
                      <td><strong><span class="amount">R$1500.00</span></strong> </td>
                    </tr>
                  </tbody>
                </table>
              </div>


              <form method="post" action="#" class="shipping_calculator">
                <h2><a class="shipping-calculator-button" data-toggle="collapse" href="#calcalute-shipping-wrap" aria-expanded="false" aria-controls="calcalute-shipping-wrap">Calculo do Frete</a></h2>

                <section id="calcalute-shipping-wrap" class="shipping-calculator-form collapse">

                  <p class="form-row form-row-wide"><input type="text" id="calc_shipping_postcode" name="calc_shipping_postcode" placeholder="Postcode / Zip" value="" class="input-text"></p>


                  <p><button class="button" value="1" name="calc_shipping" type="submit">Atualizar Total</button></p>

                </section>
              </form>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{% endblock %}

{% block script %}

<script type="module" src="{{ constant('BASE_URL') }}/assets/js/carrinho.js"></script>
<script type="module" src="{{ constant('BASE_URL') }}/assets/js/toAllPages.js"></script>
<script type="module" src="{{ constant('BASE_URL') }}/assets/js/busca.js"></script>
{% endblock %}
