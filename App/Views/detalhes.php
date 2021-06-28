{% extends "template/ecommerce.html" %}

{% block content %}

<style>
  .width-300-height-400 {
    max-width: 300px;
    max-height: 400px;
  }

  .submit-review label {
    display: inline;
  }

  .submit-review label:not(:first-child) {
    margin-left: 15px;
  }
</style>

<div class="product-big-title-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="product-bit-title text-center">
          <h2>Informações do Produto</h2>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="single-product-area">
  <div class="zigzag-bottom"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="single-sidebar">
          <h2 class="sidebar-title">Pesquisa de Produtos</h2>
          <form method="POST" class="busca">
            <input type="text" placeholder="Pesquisa de Produtos..." name="busca">
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
          <div class="product-breadcroumb">
            <a href="">Produto</a>
            <a href="">{{ product.category }}</a>
            <a href="">{{ product.name }}</a>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="product-images">
                <div class="product-main-img">
                  <img class="width-300-height-400" src="{{ constant('BASE_URL')}}/assets/img/{{ product.image }}" alt="{{ product.name }}">
                </div>

                <div class="product-gallery">
                  {% for image in product.images %}
                  <img src="{{ constant('BASE_URL')}}/assets/img/{{ image.url }}" alt="{{ product.name }}">
                  {% endfor %}
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="product-inner">
                <h2 class="product-name">{{ product.name }}</h2>
                <div class="product-inner-price">
                  <ins>{{ product.price_from }}</ins> <del>{{ product.price }}</del>
                </div>

                <div class="cart">
                  {% if userId %}
                  <button
                    data-product_id="{{product.id}}"
                    onclick="addProductToTheCart(
                      { id: '{{product.id}}', name: '{{product.name}}', price: '{{product.price_from}}'}
                    )"
                    class="add_to_cart_button"
                    type="submit"
                  >Adicionar ao Carrinho</button>
                  {% endif %}
                </div>


                <div role="tabpanel">
                  <ul class="product-tab" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Descrição</a></li>
                    {% if userId and userHasNotVoted %}
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Avaliações</a></li>
                    {% endif %}
                  </ul>
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                      <h2>Product Description</h2>
                      <p>{{ product.description }}</p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile">
                      <h2>Reviews</h2>
                      <form action="{{storeRatesRoute}}" method="POST">
                        <div class="submit-review">
                          <div class="rating-chooser">
                            <p>Your rating</p>

                            <div class="rating-wrap-post">
                              {% for i in 1..5 %}
                              <label for="star-{{i}}">{{i}}</label>
                              <input type="radio" name="stars" value="{{i}}" id="star-{{i}}" aria-label="star-{{i}}" />
                              {% endfor %}
                              <!--<i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>-->
                            </div>
                          </div>
                          <p><label for="review">Your review</label> <textarea name="comment" id="" cols="30" rows="10"></textarea></p>
                          <input type="hidden" name="productId" value="{{product.id}}" />
                          <p><input type="submit" value="Submit"></p>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>


          <div class="related-products-wrapper">
            <h2 class="related-products-title">PRODUTOS RELACIONADOS</h2>
            <div class="related-products-carousel">
              {% for similarProduct in similarProducts %}
              <div class="single-product">
                <div class="product-f-image">
                  <img src="{{ constant('BASE_URL')}}/assets/img/{{ similarProduct.image }}" alt="">
                  <div class="product-hover">
                    {% if userId %}
                    <a href="#" data-product_id='{{similarProduct.id}}' onclick="addProductToTheCart('{{similarProduct.id}}', '{{similarProduct.name}}', '{{similarProduct.price_from}}')" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Carrinho</a>
                    {% endif %}
                    <a href="{{constant('BASE_URL')}}/detalhes/{{ similarProduct.id }}" class="view-details-link"><i class="fa fa-link"></i> Detalhes</a>
                  </div>
                </div>

                <h2><a href="{{constant('BASE_URL')}}/detalhes/{{ similarProduct.id }}">{{ similarProduct.name }}</a></h2>

                <div class="product-carousel-price">
                  <ins>{{ similarProduct.price_from }}</ins> <del>{{ similarProduct.price }}</del>
                </div>
              </div>
              {% endfor %}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{% endblock %}
{% block script %}
<script type="module" src="{{ constant('BASE_URL') }}/assets/js/toAllPages.js"></script>
<script type="module" src="{{ constant('BASE_URL') }}/assets/js/busca.js"></script>
{% endblock %}
