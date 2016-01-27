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

    function randomFooterMessage() {
        var footer = [
            "Lots of love from Philly.",
            "Cheesesteaks for everyone!",
            "#snacktacular"
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