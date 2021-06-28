{% extends "template/ecommerce.html" %}
{% block content %}

<section class="box-login">
  <div class="center">
    <div class="errors-container">
      {% if loginMessage %}
      <div class="alert alert-danger">{{loginMessage}}</div>
      {% endif %}
    </div>
    <div class="title">Login</div>
    <hr>
    <form action="" method="post" name="login-form">
      <input type="email" name="email" id="email" placeholder="Digite seu email" required>
      <input type="password" name="password" id="password" placeholder="Digite sua senha" required>
      <input type="submit" name="action" value="Entrar">
    </form>
  </div>
</section>
{% endblock %}

{% block script %}
<script type="module" src="{{ constant('BASE_URL') }}/assets/js/toAllPages.js"></script>
<script type="module" src="{{ constant('BASE_URL') }}/assets/js/login.js"></script>
{% endblock %}
