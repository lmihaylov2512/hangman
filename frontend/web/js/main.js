(function (w, d, $) {
    
    $(d).ready(function (e) {
        
        $('.game-alphabet .btn.btn-default').on('click', function (e) {
            var el = $(this),
                url = $('.game-action').data('url');
                
            if (el.data('used')) {
                return;
            }    
           
            $.ajax({
                type: 'post',
                url: url,
                data: { input: el.data('input') }
            }).done(function (res) {
                el.data('used', 1);
                el.removeClass('btn-default').addClass(res.success ? 'btn-success' : 'btn-danger');
            });
        });
        
        if ($('#donut-games').length && typeof window.donutGamesData !== 'undefined') {
            Morris.Donut({
                element: 'donut-games',
                data: window.donutGamesData
            });
        }
        
    });
    
})(window, document, jQuery);
