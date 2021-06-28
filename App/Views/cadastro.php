{% extends "template/ecommerce.html" %}
{% block content %}

<section class="box-cadastro">
  <div class="center">
    <div class="errors-container">
      {% if registrationMessage %}
      <div class="alert alert-danger">{{registrationMessage}}</div>
      {% endif %}
    </div>
    <div class="title">Cadastro</div>
    <hr>
    <form action="" method="post" name="registration-form">
      <input type="text" name="name" id="name" placeholder="Digite seu nome" required maxlength="255" />
      <input type="email" name="email" id="email" placeholder="Digite seu email" required>
      <input type="password" name="password1" id="password1" placeholder="Digite sua senha" required minlength="8" maxlength="50">
      <input type="password" name="password2" id="password2" placeholder="Repita sua senha" required minlength="8" maxlength="50">
      <input type="tel" name="phone" id="phone" placeholder="Digite seu telefone" required minlength="8" maxlength="16">
      <input type="text" name="address" id="address" placeholder="Digite seu endereço" required maxlength="255">
      <input type="submit" name="action" value="Cadastrar" required>
    </form>
  </div>
</section>
{% endblock %}

{% block script %}
<script type="module" src="{{ constant('BASE_URL') }}/assets/js/toAllPages.js"></script>
<script type="module" src="{{ constant('BASE_URL') }}/assets/js/cadastro.js"></script>
{% endblock %}
