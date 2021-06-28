// $(() => {
//   const formulario = $(this);
//   const baseUrl = $('base').attr('data-url');
//   const idstate = location.pathname.match(/\d+/);
//   console.log(`${baseUrl}/detalhes/${idstate}/search`)
//     $('body').on('submit', '.busca', function () {
//       const formulario = $(this);
//       const baseUrl = $('base').attr('data-url');
//       const idstate = location.pathname.match(/\d+/);
//       $.ajax({
//         url: `${baseUrl}/detalhes/${idstate}/search`,
//         method: 'post',
//         dataType: 'json',
//         data: formulario.serialize(),
//       }).done((data) => {
//         $('.single-sidebar > .thubmnail-recent').remove();
//         if ($('img') !== '') {
//           $('img.recent-thumb').remove();
//           $('h3').remove();
//           $('ins').remove();
//           $('del').remove();
//           $('.product-sidebar-price').remove();
//           $('.thubmnail-recent').remove();
//         }
//         if (data.length === []) {
//           $('#produto').append('<h3>Não existe esse produto</h3>');
//         }
  
//         $.each(data, (i, val) => {
//           $('#produto').append('<div>');
//           $('#produto > div').addClass('thubmnail-recent');
//           const url = `${baseUrl}/assets/img/${val.image}`;
//           $('#produto').append(`<img src=${url}>`);
//           $('#produto img').addClass('recent-thumb');
//           $('#produto').append(
//             `<h3><a href=${
//               baseUrl
//             }/detalhes/${
//               val.id
//             }>${
//               val.name
//             }</a></h3>`,
//           );
//           $('#produto').append('<div>');
//           $('#produto > div').addClass('product-sidebar-price');
//           $('#produto').append(`<ins>${val.price_from}</ins>`);
//           $('#produto').append(`<del>${val.price}</del>`);
//           $('ins, del').css('margin', '0 3px');
//           $('ins').css({ 'text-decoration': 'none', color: '#5a88ca' });
//           $('#produto > .sidebar-title').text('Busca Resultado');
//         });
//       });
//       return false;
//     });
//   });
  