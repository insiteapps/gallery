/** =============================
 * site manager.js
 * * ===========================
 * @author Patrick Chito-voro
 * @copyright 2014 Chito Systems.
 *
 * ============================= */

(function ($) {
    "use strict";
    /*global jQuery, document, window*/

    $(document).ready(function () {
        GalleryManager.init();
        GalleryManager.initializeLiveHandlers();

    });


    var GalleryManager = function () {


        return {
            init: function () {

                // Load Gallery Masonry
                var gallery_masonry = $(".gallery-masonry");
                if (gallery_masonry.length > 0) {
                    gallery_masonry.each(function () {
                        $(this).masonry({
                            itemSelector: '.gallery-item'
                        });
                    });
                }

                // Animated thumbnails
                var $lightgallery = $('#lightgallery');
                if ($lightgallery.length) {
                    /*
                    $lightgallery.justifiedGallery({
                        border: 6
                    }).on('jg.complete', function() {
                        $lightgallery.lightGallery({
                            thumbnail: false
                        });
                    });
                    */

                    $lightgallery.lightGallery({
                        thumbnail: false
                    });
                };

                /*
                 jQuery("a[rel^='prettyPhoto']").prettyPhoto({
                 animation_speed: 'fast',
                 theme: 'light_square',
                 slideshow: 3000,
                 autoplay_slideshow: true
                 });
                 */
            },
            initializeLiveHandlers: function () {
                if ($('.isotopeWrapper,.isotopeContainer').length) {

                    var $container = $('.isotopeWrapper,.isotopeContainer');
                    var $resize = $('.isotopeWrapper,.isotopeContainer').attr('id');
                    // initialize isotope

                    $container.isotope({
                        itemSelector: '.isotopeItem,.item',
                        resizable: false, // disable normal resizing
                        masonry: {
                            columnWidth: $container.width() / $resize
                        }


                    });
                    var $grid = $container.imagesLoaded(function () {
                        $grid.isotope({
                            itemSelector: '.isotopeItem,.item',
                            percentPosition: true
                        });
                     //   ThemeManger.setSameAgeSize();
                    });

                    $('#filter a').click(function () {
                        $('#filter a').removeClass('current');
                        $(this).addClass('current');
                        var selector = $(this).attr('data-filter');
                        $container.isotope({
                            filter: selector,
                            animationOptions: {
                                duration: 1000,
                                easing: 'easeOutQuart',
                                queue: false
                            }
                        });
                        return false;
                    });


                    $(window).smartresize(function () {
                        $container.isotope({
                            // update columnWidth to a percentage of container width
                            masonry: {
                                columnWidth: $container.width() / $resize
                            }
                        });
                    });


                }

                if ($('.imgHover').length) {

                    $('.imgHover article').hover(
                        function () {

                            var $this = $(this);

                            var fromTop = ($('.imgWrapper', $this).height() / 2 - $('.iconLinks', $this).height() / 2);
                            $('.iconLinks', $this).css('margin-top', fromTop);

                            $('.mediaHover', $this).height($('.imgWrapper', $this).height());

                            $('.mask', this).css('height', $('.imgWrapper', this).height());
                            $('.mask', this).css('width', $('.imgWrapper', this).width());
                            $('.mask', this).css('margin-top', $('.imgWrapper', this).height());


                            $('.mask', this).stop(1).show().css('margin-top', $('.imgWrapper', this).height()).animate({marginTop: 0}, 200, function () {

                                $('.iconLinks', $this).css('display', 'block');
                                if (Modernizr.csstransitions) {
                                    $('.iconLinks a').addClass('animated');


                                    $('.iconLinks a', $this).removeClass('flipOutX');
                                    $('.iconLinks a', $this).addClass('bounceInDown');

                                } else {

                                    $('.iconLinks', $this).stop(true, false).fadeIn('fast');
                                }


                            });


                        }, function () {

                            var $this = $(this);


                            $('.mask', this).stop(1).show().animate({marginTop: $('.imgWrapper', $this).height()}, 200, function () {

                                if (Modernizr.csstransitions) {
                                    $('.iconLinks a', $this).removeClass('bounceInDown');
                                    $('.iconLinks a', $this).addClass('flipOutX');

                                } else {
                                    $('.iconLinks', $this).stop(true, false).fadeOut('fast');
                                }

                            });

                        });
                }

                if ($("a.image-link").length) {

                    $("a.image-link").click(function (e) {

                        var items = [];

                        items.push({src: $(this).attr('href')});

                        if ($(this).data('gallery')) {

                            var $arraySrc = $(this).data('gallery').split(',');

                            $.each($arraySrc, function (i, v) {
                                items.push({
                                    src: v
                                });
                            });
                        }

                        $.magnificPopup.open({
                            type: 'image',
                            mainClass: 'mfp-fade',
                            items: items,
                            gallery: {
                                enabled: true
                            }
                        });

                        e.preventDefault();
                    });

                }


                if ($("a.image-iframe").length) {
                    $('a.image-iframe').magnificPopup({type: 'iframe', mainClass: 'mfp-fade'});
                }
            }
        }
    }();
}(jQuery));
