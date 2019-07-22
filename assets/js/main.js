(function ($) {
  $(document).on('ready', function () {
    // Tooltips & Popovers
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    // Dismiss Popovers on next click
    $('.popover-dismiss').popover({
      trigger: 'focus'
    });

    // Header Search
    $('.u-header-search').each(function () {
      //Variables
      var $this = $(this),
        searchTarget = $this.data('search-target'),
        searchMobileInvoker = $this.data('search-mobile-invoker'),
        windowWidth = window.innerWidth;

      $(searchMobileInvoker).on('click', function (e) {
        e.stopPropagation();

        $(searchTarget).fadeToggle(400);
      });

      $(searchTarget).on('click', function (e) {
        e.stopPropagation();
      });

      $(window).on('click', function (e) {
        $(searchTarget).fadeOut(200);
      });

      if (windowWidth <= 768) {
        $(window).on('click', function (e) {
          $(searchTarget).fadeOut(400);
        });
      } else {
        $(window).off('click');
      }

      $(window).on('resize', function () {
        var windowWidth = window.innerWidth;

        if (windowWidth >= 768) {
          $(searchTarget).attr('style', '');

          $(window).off('click');
        } else {
          $(window).on('click', function (e) {
            $(searchTarget).fadeOut(400);
          });
        }
      });
    });

    // Custom Scroll
    $('.u-sidebar').mCustomScrollbar({
      scrollbarPosition: 'outside',
      scrollInertia: 150
    });

      $('#order_type').change(function() {
          if ($(this).val() == 2) {
              $('.subCat').show();
          } else {
              $('.subCat').hide();
          }
          if ($(this).val() == 3) {
              $('.subCat2').show();
          } else {
              $('.subCat2').hide();
          }
      });

      $('#subCater').change(function() {
          if ($(this).val() == 5 || $(this).val() == 6) {
              $('.subCater1').show();
              $('.subCater2').show();
          } else {
              $('.subCater1').hide();
              $('.subCater2').hide();
          }
      });
      $('#costly').keyup(function() {
          $priced = $('#priced').val();
          $costly = $('#costly').val();
          $sum = $priced * $costly;
          $fin = $(".finalPrice").val($sum);
          $place = $(".finalPrice").attr("placeholder", $sum);
      })

  });
})(jQuery);