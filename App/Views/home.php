{% extends "template/ecommerce.html" %}

{% block content %}

<style>
  .width-300-height-400 {
    max-width: 300px;
    max-height: 400px;
  }
</style>

<div class="slider-area">
  <!-- Slider -->
  <div class="block-slider block-slider4">
    <ul class="" id="bxslider-home4">
      {% for product in products %}
      <li>
        <img class="width-300-height-400" src="{{ constant('BASE_URL') }}/assets/img/{{ product.image }}" alt="Slide">
        <div class="caption-group">
          <h2 class="caption title">
            {{ product.name }}
          </h2>
          <h4 class="caption subtitle"></h4>
          <a class="caption button-radius" href="{{ constant('BASE_URL') }}/detalhes/{{ product.id }}"><span class="icon"></span>Comprar
          </a>
        </div>
      </li>
      {% endfor %}
    </ul>
  </div>
  <!-- ./Slider -->
</div> <!-- End slider area -->

<div class="promo-area">
  <div class="zigzag-bottom"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="single-promo promo1">
          <i class="fa fa-refresh"></i>
          <p>1 de garantia</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="single-promo promo2">
          <i class="fa fa-truck"></i>
          <p>Frete Grátis</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="single-promo promo3">
          <i class="fa fa-lock"></i>
          <p>Pagamento Seguro</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="single-promo promo4">
          <i class="fa fa-gift"></i>
          <p>Novos Produtos</p>
        </div>
      </div>
    </div>
  </div>
</div> <!-- End promo area -->

<div class="maincontent-area">
  <div class="zigzag-bottom"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="latest-product">
          <h2 class="section-title">Ultimos Produtos</h2>
          <div class="product-carousel">
            {% for newProduct in newProducts %}
            <div class="single-product">
              <div class="product-f-image">
                <img src="{{ constant('BASE_URL') }}/assets/img/{{ newProduct.image }}" alt="{{ newProduct.name }}">
                <div class="product-hover">
                  {% if userId %}
                  <a
                    data-product_id="{{ newProduct.id }}"
                    onclick="addProductToTheCart(
                      { id: '{{ newProduct.id }}', name: '{{ newProduct.name }}', price: '{{ newProduct.price_from }}' }
                    )"
                    href="#"
                    class="add-to-cart-link"
                  ><i class="fa fa-shopping-cart"></i> Carrinho</a>
                  {% endif %}
                  <a href="{{ constant('BASE_URL') }}/detalhes/{{ newProduct.id }}" class="view-details-link"><i class="fa fa-link"></i> Detalhes</a>
                </div>
              </div>

              <h2><a href="{{ constant('BASE_URL') }}/detalhes/{{ newProduct.id }}">{{ newProduct.name }}</a></h2>

              <div class="product-carousel-price">
                <ins>{{ newProduct.price_from }}</ins> <del>{{ newProduct.price }}</del>
              </div>
            </div>
            {% endfor %}
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- End main content area -->

<div class="brands-area">
  <div class="zigzag-bottom"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="brand-wrapper">
          <div class="brand-list">
            {% for brand in brands %}
            <img class="width-300-height-400" src="{{ constant('BASE_URL') }}/assets/img/{{ brand.image }}" alt="{{ brand.name }} logo">
            {% endfor %}
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- End brands area -->

<div class="product-widget-area">
  <div class="zigzag-bottom"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="single-product-widget">
          <h2 class="product-wid-title">Procurados</h2>
          <a href="" class="wid-view-more">Visualizar Todos</a>
          {% for featuredProduct in featuredProducts %}
          <div class="single-wid-product">
            <a href="{{ constant('BASE_URL') }}/detalhes/{{ featuredProduct.id }}">
              <img src="{{ constant('BASE_URL') }}/assets/img/{{ featuredProduct.image }}" alt="{{ featuredProduct.name }}" class="product-thumb"></a>
            <h2><a href="{{ constant('BASE_URL') }}/detalhes/{{ featuredProduct.id }}">{{ featuredProduct.name }}</a></h2>
            <div class="product-wid-rating">
              {% for star in 1..featuredProduct.rating %}
              <i class="fa fa-star"></i>
              {% endfor %}
            </div>
            <div class="product-wid-price">
              <ins>{{ featuredProduct.price_from }}</ins> <del>{{ featuredProduct.price }}</del>
            </div>
          </div>
          {% endfor %}
        </div>
      </div>
      <div class="col-md-4">
        <div class="single-product-widget">
          <h2 class="product-wid-title">Recentes</h2>
          <a href="" class="wid-view-more">Visualizar Todos</a>
          {% for recentProduct in recentProducts %}
          <div class="single-wid-product">
            <a href="{{ constant('BASE_URL') }}/detalhes/{{ recentProduct.id }}">
              <img src="{{ constant('BASE_URL') }}/assets/img/{{ recentProduct.image }}" alt="{{ recentProduct.name }}" class="product-thumb"></a>
            <h2><a href="{{ constant('BASE_URL') }}/detalhes/{{ recentProduct.id }}">{{ recentProduct.name }}</a></h2>
            <div class="product-wid-rating">
              {% for star in 1..recentProduct.rating %}
              <i class="fa fa-star"></i>
              {% endfor %}
            </div>
            <div class="product-wid-price">
              <ins>{{ recentProduct.price_from }}</ins> <del>{{ recentProduct.price }}</del>
            </div>
          </div>
          {% endfor %}
        </div>
      </div>
      <div class="col-md-4">
        <div class="single-product-widget">
          <h2 class="product-wid-title">Lançamentos</h2>
          <a href="" class="wid-view-more">Visualizar Todos</a>
          {% for productRelease in productReleases %}
          <div class="single-wid-product">
            <a href="{{ constant('BASE_URL') }}/detalhes/{{ productRelease.id }}">
              <img src="{{ constant('BASE_URL') }}/assets/img/{{ productRelease.image }}" alt="{{ productRelease.name }}" class="product-thumb"></a>
            <h2><a href="{{ constant('BASE_URL') }}/detalhes/{{ productRelease.id }}">{{ productRelease.name }}</a></h2>
            <div class="product-wid-rating">
              {% for star in 1..productRelease.rating %}
              <i class="fa fa-star"></i>
              {% endfor %}
            </div>
            <div class="product-wid-price">
              <ins>{{ productRelease.price_from }}</ins> <del>{{ productRelease.price }}</del>
            </div>
          </div>
          {% endfor %}
        </div>
      </div>
    </div>
  </div>
</div> <!-- End product widget area -->
{% endblock %}
{% block script %}
<script type="module" src="{{ constant('BASE_URL') }}/assets/js/toAllPages.js"></script>
{% endblock %}
