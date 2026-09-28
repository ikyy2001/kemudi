(function ($) {
  'use strict';

  function hideLoader() {
    var $loader = $('.loader');
    if (!$loader.length) return;
    $loader.stop(true, true).hide().css({
      display: 'none',
      pointerEvents: 'none',
      visibility: 'hidden'
    });
  }

  function bindTreeview() {
    $(document).off('click.kemudiTree', '.sidebar-menu li.treeview > a')
      .on('click.kemudiTree', '.sidebar-menu li.treeview > a', function (e) {
        var href = ($(this).attr('href') || '').trim();
        var isPlaceholder = !href || href === '#' || href.indexOf('javascript:') === 0;
        if (!isPlaceholder) return;

        e.preventDefault();
        e.stopImmediatePropagation();

        var $li = $(this).parent('li');
        var $menu = $li.children('ul.treeview-menu');
        var opening = !$li.hasClass('menu-open');

        $li.siblings('li.treeview.menu-open').removeClass('menu-open active')
          .children('ul.treeview-menu').slideUp(180);

        $li.toggleClass('menu-open', opening);
        if (opening) {
          $li.addClass('active');
          $menu.slideDown(180);
        } else {
          $menu.slideUp(180);
        }
      });
  }

  function bindSidebarToggleFallback() {
    $(document).off('click.kemudiToggle', '.sidebar-baru')
      .on('click.kemudiToggle', '.sidebar-baru', function (e) {
        if (typeof $.AdminLTE !== 'undefined' && $.AdminLTE.pushMenu) {
          return;
        }
        e.preventDefault();
        if ($(window).width() > 767) {
          $('body').toggleClass('sidebar-collapse');
        } else {
          $('body').toggleClass('sidebar-open');
        }
      });
  }

  function markActiveMenu() {
    var url = window.location.href.split('#')[0];
    $('.sidebar-menu a').each(function () {
      var href = this.href;
      if (!href || href.indexOf('#') === href.length - 1) return;
      if (href === url || href + '/' === url || url.indexOf(href) === 0) {
        $(this).parent('li').addClass('active');
        $(this).closest('li.treeview').addClass('active menu-open');
      }
    });
  }

  $(function () {
    hideLoader();
    setTimeout(hideLoader, 800);
    bindTreeview();
    bindSidebarToggleFallback();
    markActiveMenu();

    if ($.fn.dropdown) {
      $('.dropdown-toggle').dropdown();
    }
    if ($.fn.tooltip) {
      $('[data-toggle="tooltip"]').tooltip();
    }
  });
})(jQuery);
