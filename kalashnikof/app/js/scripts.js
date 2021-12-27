jQuery(document).ready(function ($) {
    var scripts = {
        init: function (){
            // Input mask || phone, email 
            this.inpuMask();
            // Scroll to item by id   
            this.scrollTo(); 
            // Fancybox custom class
            this.popUp(); 
            // Contacts form 7 validate handler
            this.cf7Handler();
            this.cf7Acceptation();
        },
        inpuMask: function (){
            $('input[name="email"]').inputmask({ alias: "email" });
            $('input[type="tel"]').inputmask("+7 (999) 999-9999");
        },
        scrollTo: function (){
            var button = $(".scroll-to");

            button.on("click", function () {
                var section = $($(this).attr('href'));
    
                $([document.documentElement, document.body]).animate(
                    {
                        scrollTop: section.offset().top - 60
                    },
                    1000
                );
            });
        },
        popUp: function (){            
            $(document).on('click','.popup',function(event){
                $.fancybox.close(true);
                $.fancybox.open($(this));
            });
        },
        cf7Validate: function ( form ) {
            form_field = form.find('.wpcf7-form-control');

            form_field.each(function () {
                var field = $(this);

                if (field.attr('aria-required') == 'true' && field.val() == '') {
                    field.attr('aria-invalid', 'true');
                    field.addClass('wpcf7-not-valid');
                } else {
                    field.removeClass('wpcf7-not-valid');
                }
            });
        },
        cf7Handler: function () {
            var this_area = this;

            document.addEventListener('wpcf7invalid', function (event) {
                var form_id = event.detail.id;
                var form = $('#' + form_id).find('form');
                this_area.cf7Validate(form);
        
            }, false);
        },
        cf7Acceptation: function (){
            $('.wpcf7-acceptance input[type="checkbox"]').attr('checked', 'checked');
        },
        scrollToTop: function (){
            var button = $('#top-button');

            $(window).scroll(function() {
                if ($(window).scrollTop() > 300) {
                    button.addClass('show');
                } else {
                    button.removeClass('show');
                }
            });
            
            button.on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({scrollTop:0}, '300');
            });
        },
    }
    scripts.init();

});
