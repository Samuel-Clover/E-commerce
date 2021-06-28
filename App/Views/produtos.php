{% extends "template/ecommerce.html" %}

{% block content %}

<div class="product-big-title-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="product-bit-title text-center">
          <h2>Produtos</h2>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="single-product-area">
  <div class="zigzag-bottom"></div>
  <div class="container">
    <div class="row">
      {% for product in products %}
      <div class="col-md-3 col-sm-6">
        <div class="single-shop-product">
          <div class="product-upper">
            <img src="{{ constant('BASE_URL') }}/assets/img/{{ product.image }}" alt="">
          </div>
          <h2><a href="{{ constant('BASE_URL') }}/detalhes/{{ product.id }}">{{ product['name'] }}</a></h2>
          <div class="product-carousel-price">
            <ins>{{ product['price_from'] }}</ins> <del>{{ product['price'] }}</del>
          </div>
          <div data-id="{{ product['id'] }}" class="product-option-shop">
            {% if userId %}
            <a
              onclick="addProductToTheCart(
                {id: '{{ product.id }}', name: '{{ product.name }}', price: '{{ product.price_from }}'}
              )"
              class="add_to_cart_button"
              data-quantity="{{ product['stock'] }}"
              data-product_sku=""
              data-product_id="{{ product['id'] }}"
              rel="nofollow"
              href="#"
            >Adicionar Carrinho</a>
            {% endif %}
          </div>
        </div>
      </div>
      {% endfor %}
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="product-pagination text-center">
          <nav>
            <ul class="pagination">

              {% if pageNumber > 1 %}
              <li>
                <a href="{{constant('BASE_URL')}}/produtos?page={{pageNumber - 1}}" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              {% endif %}

              {% for counter in 1..totalPages %}
              <li><a href="{{constant('BASE_URL')}}/produtos?page={{counter}}">{{counter}}</a></li>
              {% endfor %}

              {% if pageNumber < totalPages %}
              <li>
                <a href="{{constant('BASE_URL')}}/produtos?page={{pageNumber + 1}}" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
              {% endif %}
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

{% endblock %}
{% block script %}
<script type="module" src="{{ constant('BASE_URL') }}/assets/js/toAllPages.js"></script>
{% endblock %}
