(function (w, d, $) {
    
    console.log('testing...');
    
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
        
    });
    
})(window, document, jQuery);
