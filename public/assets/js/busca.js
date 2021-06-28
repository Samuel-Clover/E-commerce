
  $('body').on('submit', '.busca', function () {
    const formulario = $(this);
    const baseUrl = $('base').attr('data-url');
    $.ajax({
      url: `${baseUrl}/carrinho/busca`,
      method: 'post',
      dataType: 'json',
      data: formulario.serialize(),
    }).done((data) => {
      $('.single-sidebar > .thubmnail-recent').remove();
      if ($('#produto') !== '') {
        $('#produto > img.recent-thumb').remove();
        $('#produto > h3').remove();
        $('#produto > ins').remove();
        $('#produto > del').remove();
        $('#produto > .product-sidebar-price').remove();
        $('#produto > .thubmnail-recent').remove();
  
      }
      if (data.length == []) {
        $('#produto').append('<h3>Não existe esse produto</h3>');
      }
      $.each(data, (i, val) => {
        const url = `${baseUrl}/assets/img/${val.image}`;
        $('#produto').append(`
        <div class="thubmnail-recent">
        <img src=${url} class="recent-thumb">
        <h3><a href=${
          baseUrl
        }/detalhes/${
          val.id
        }>${
          val.name
        }</a></h3>
        <div class="product-sidebar-price">
        <ins>${val.price_from}</ins> <del>${val.price}</del>
        </div>`);

        $('#produto > .sidebar-title').text('Busca Resultado');
      });
    });
    return false;
  });
