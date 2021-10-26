@once
@component('boilerplate::minify')
<script>
    loadStylesheet('{!! mix('/plugins/select2/select2.min.css', '/assets/vendor/boilerplate') !!}');
    loadScript('{!! mix('/plugins/select2/select2.full.min.js', '/assets/vendor/boilerplate') !!}', () => {
        loadScript('{!! mix('/plugins/select2/i18n/'.App::getLocale().'.js', '/assets/vendor/boilerplate') !!}', () => {
            $.extend(true,$.fn.select2.defaults,{
                language:'{{ App::getLocale()}}',
                direction:'@lang('boilerplate::layout.direction')'}
            );

            $(document).on('select2:open',(e)=>{
                let t = $(e.target);
                if(t && t.length){
                    let id=t[0].id||t[0].name;
                    document.querySelector(`input[aria-controls*='${id}']`).focus();
                }
            });
        });
    });
</script>
@endcomponent
@endonce