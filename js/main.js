$(function(){
    $(document).on('scroll', function() {
        if ($(document).scrollTop() >= 120) {
            $('header').addClass('scrolling');
        } else {
            $('header').removeClass('scrolling');
        }
    });
    $(document).on('click', '.mobile-menu', function() {
        var $nav = $('#nav-overlay');

        $nav.toggleClass('hidden');
        setTimeout(function() {
            $nav.toggleClass('in');
        }, 100);
    });
    $(document).on('click', '.close', function() {
        var $nav = $('#nav-overlay');

        $nav.toggleClass('in');
        setTimeout(function() {
            $nav.toggleClass('hidden');
        }, 500);
    });
    $(document).on('click', 'h2.job-title', function() {
        $(this).toggleClass('in').next().toggleClass('in');
    });
    $(document).on('click', 'a[data-category-filter]', function() {
        var category = $(this).attr('data-category-filter');
        var $news = $('.news');
        var $tabs = $('#news-filters');

        $tabs.find('li').removeClass('active');
        $news.find('.news-container').removeClass('active');
        if (category == 'all') {
            $news.find('.news-container').addClass('active');
        } else {
            $news.find('[data-category = ' + category + ']').addClass('active');
        }
        $(this).parent().addClass('active');
    });

    $('.carousel').carousel('pause');

    var images = $('.jobs-hero').find('img');
    if (images.length > 1) {
        var total = images.length;
        var count = 0;

        function changeImage() {
            images.removeClass('in');
            $('.jobs-hero img:eq(' + count + ')').addClass('in');

            count++;
            if (count > total - 1){ count = 0; }
        }
        setInterval(changeImage, 5000);
    }

    $('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
          }
        }
    });

    function randomFooterMessage() {
        var footer = [
            "Lots of love from Philly.",
            "Cheesesteaks for everyone!",
            "#snacktacular",
            "It's pumpkin spice season.",
            "Check out our upcoming webinars."
        ];
        var random = Math.floor(Math.random() * footer.length);    
    
        $('.with-love h4').text(footer[random]);
    }
    function checkSuccessfulMessage() {
        var url = window.location.href;
        if (url.indexOf('?success') != -1) {
            $('.alert-success').removeClass('hidden');
        }
        if (url.indexOf('?failed') != -1) {
            $('.alert-danger').removeClass('hidden');
        }
    }

    checkSuccessfulMessage();
    randomFooterMessage();
});