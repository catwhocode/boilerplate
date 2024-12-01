<?php

namespace Sebastienheyd\Boilerplate\Tests\Components;

class DatetimepickerTest extends TestComponent
{
    public function testDatepickerNoArgs()
    {
        $expected = <<<'HTML'
<code>&lt;x-boilerplate::datetimepicker> The name attribute has not been set</code>
HTML;

        $view = $this->blade('<x-boilerplate::datetimepicker />');
        $view->assertSee($expected, false);
    }

    public function testDatepickerName()
    {
        $expected = <<<'HTML'
<div class="form-group">
    <div class="input-group" id="test" data-target-input="nearest">
        <input class="form-control datetimepicker-input" type="text" name="test_local" value data-toggle="datetimepicker" data-target="#test" autocomplete="off">
    </div>
    <input type="hidden" name="test" value>
</div>
<script>loadScript('',()=>{moment.locale('en');registerAsset('momentjs')});</script><script>loadStylesheet('');whenAssetIsLoaded('momentjs',()=>{loadScript('',()=>{registerAsset('datetimepicker',()=>{$.fn.datetimepicker.Constructor.Default=$.extend({},$.fn.datetimepicker.Constructor.Default,{locale:"en",icons:$.extend({},$.fn.datetimepicker.Constructor.Default.icons,{time:'far fa-clock',date:'far fa-calendar',up:'fas fa-arrow-up',down:'fas fa-arrow-down',previous:'fas fa-chevron-left',next:'fas fa-chevron-right',today:'far fa-calendar-check',clear:'fas fa-trash',close:'fas fa-times'})})})})});</script><script>whenAssetIsLoaded('datetimepicker',()=>{window.DTP_test=$('#test').datetimepicker({format:"L",buttons:{showToday:!1,showClear:!1,showClose:!1},useCurrent:!1,});$('#test').on('change.datetimepicker',()=>{$('input[name="test"]').val('');if($('input[name="test_local"]').val()!==''){let date=$('#test').datetimepicker('viewDate').format('YYYY-MM-DD');$('input[name="test"]').val(date).trigger('change')}})});</script>
HTML;

        $view = $this->blade('<x-boilerplate::datetimepicker id="test" name="test" />');
        $view->assertSee($expected, false);
    }

    public function testDatepickerLabel()
    {
        $expected = <<<'HTML'
<div class="form-group">
    <label>Test</label>
    <div class="input-group" id="test" data-target-input="nearest">
        <input class="form-control datetimepicker-input" type="text" name="test_local" value data-toggle="datetimepicker" data-target="#test" autocomplete="off">
    </div>
    <input type="hidden" name="test" value>
</div>
<script>loadScript('',()=>{moment.locale('en');registerAsset('momentjs')});</script><script>loadStylesheet('');whenAssetIsLoaded('momentjs',()=>{loadScript('',()=>{registerAsset('datetimepicker',()=>{$.fn.datetimepicker.Constructor.Default=$.extend({},$.fn.datetimepicker.Constructor.Default,{locale:"en",icons:$.extend({},$.fn.datetimepicker.Constructor.Default.icons,{time:'far fa-clock',date:'far fa-calendar',up:'fas fa-arrow-up',down:'fas fa-arrow-down',previous:'fas fa-chevron-left',next:'fas fa-chevron-right',today:'far fa-calendar-check',clear:'fas fa-trash',close:'fas fa-times'})})})})});</script><script>whenAssetIsLoaded('datetimepicker',()=>{window.DTP_test=$('#test').datetimepicker({format:"L",buttons:{showToday:!1,showClear:!1,showClose:!1},useCurrent:!1,});$('#test').on('change.datetimepicker',()=>{$('input[name="test"]').val('');if($('input[name="test_local"]').val()!==''){let date=$('#test').datetimepicker('viewDate').format('YYYY-MM-DD');$('input[name="test"]').val(date).trigger('change')}})});</script>
HTML;

        $view = $this->blade('<x-boilerplate::datetimepicker id="test" name="test" label="Test" />');
        $view->assertSee($expected, false);
    }

    public function testDatepickerClass()
    {
        $expected = <<<'HTML'
<div class="form-group">
    <div class="input-group" id="test" data-target-input="nearest">
        <input class="form-control datetimepicker-input test-class" type="text" name="test_local" value data-toggle="datetimepicker" data-target="#test" autocomplete="off">
    </div>
    <input type="hidden" name="test" value>
</div>
<script>loadScript('',()=>{moment.locale('en');registerAsset('momentjs')});</script><script>loadStylesheet('');whenAssetIsLoaded('momentjs',()=>{loadScript('',()=>{registerAsset('datetimepicker',()=>{$.fn.datetimepicker.Constructor.Default=$.extend({},$.fn.datetimepicker.Constructor.Default,{locale:"en",icons:$.extend({},$.fn.datetimepicker.Constructor.Default.icons,{time:'far fa-clock',date:'far fa-calendar',up:'fas fa-arrow-up',down:'fas fa-arrow-down',previous:'fas fa-chevron-left',next:'fas fa-chevron-right',today:'far fa-calendar-check',clear:'fas fa-trash',close:'fas fa-times'})})})})});</script><script>whenAssetIsLoaded('datetimepicker',()=>{window.DTP_test=$('#test').datetimepicker({format:"L",buttons:{showToday:!1,showClear:!1,showClose:!1},useCurrent:!1,});$('#test').on('change.datetimepicker',()=>{$('input[name="test"]').val('');if($('input[name="test_local"]').val()!==''){let date=$('#test').datetimepicker('viewDate').format('YYYY-MM-DD');$('input[name="test"]').val(date).trigger('change')}})});</script>
HTML;

        $view = $this->blade('<x-boilerplate::datetimepicker id="test" name="test" class="test-class" />');
        $view->assertSee($expected, false);
    }

    public function testDatepickerHelp()
    {
        $expected = <<<'HTML'
<div class="form-group">
    <div class="input-group" id="test" data-target-input="nearest">
        <input class="form-control datetimepicker-input" type="text" name="test_local" value data-toggle="datetimepicker" data-target="#test" autocomplete="off">
    </div>
    <small class="form-text text-muted">The user will receive an invitation by e-mail to login in which it will allow him to enter his new password</small>
    <input type="hidden" name="test" value>
</div>
<script>loadScript('',()=>{moment.locale('en');registerAsset('momentjs')});</script><script>loadStylesheet('');whenAssetIsLoaded('momentjs',()=>{loadScript('',()=>{registerAsset('datetimepicker',()=>{$.fn.datetimepicker.Constructor.Default=$.extend({},$.fn.datetimepicker.Constructor.Default,{locale:"en",icons:$.extend({},$.fn.datetimepicker.Constructor.Default.icons,{time:'far fa-clock',date:'far fa-calendar',up:'fas fa-arrow-up',down:'fas fa-arrow-down',previous:'fas fa-chevron-left',next:'fas fa-chevron-right',today:'far fa-calendar-check',clear:'fas fa-trash',close:'fas fa-times'})})})})});</script><script>whenAssetIsLoaded('datetimepicker',()=>{window.DTP_test=$('#test').datetimepicker({format:"L",buttons:{showToday:!1,showClear:!1,showClose:!1},useCurrent:!1,});$('#test').on('change.datetimepicker',()=>{$('input[name="test"]').val('');if($('input[name="test_local"]').val()!==''){let date=$('#test').datetimepicker('viewDate').format('YYYY-MM-DD');$('input[name="test"]').val(date).trigger('change')}})});</script>
HTML;

        $view = $this->blade('<x-boilerplate::datetimepicker id="test" name="test" help="boilerplate::users.create.help" />');
        $view->assertSee($expected, false);
    }

    public function testDatepickerError()
    {
        $expected = <<<'HTML'
<div class="form-group">
    <div class="input-group" id="test" data-target-input="nearest">
        <input class="form-control datetimepicker-input is-invalid" type="text" name="fielderror_local" value data-toggle="datetimepicker" data-target="#test" autocomplete="off">
    </div>
    <div class="error-bubble"><div>Error message</div></div>
    <input type="hidden" name="fielderror" value>
</div>
<script>loadScript('',()=>{moment.locale('en');registerAsset('momentjs')});</script><script>loadStylesheet('');whenAssetIsLoaded('momentjs',()=>{loadScript('',()=>{registerAsset('datetimepicker',()=>{$.fn.datetimepicker.Constructor.Default=$.extend({},$.fn.datetimepicker.Constructor.Default,{locale:"en",icons:$.extend({},$.fn.datetimepicker.Constructor.Default.icons,{time:'far fa-clock',date:'far fa-calendar',up:'fas fa-arrow-up',down:'fas fa-arrow-down',previous:'fas fa-chevron-left',next:'fas fa-chevron-right',today:'far fa-calendar-check',clear:'fas fa-trash',close:'fas fa-times'})})})})});</script><script>whenAssetIsLoaded('datetimepicker',()=>{window.DTP_test=$('#test').datetimepicker({format:"L",buttons:{showToday:!1,showClear:!1,showClose:!1},useCurrent:!1,});$('#test').on('change.datetimepicker',()=>{$('input[name="fielderror"]').val('');if($('input[name="fielderror_local"]').val()!==''){let date=$('#test').datetimepicker('viewDate').format('YYYY-MM-DD');$('input[name="fielderror"]').val(date).trigger('change')}})});</script>
HTML;

        $view = $this->withoutMix()->withViewErrors(['fielderror' => 'Error message'])->rawBlade('<x-boilerplate::datetimepicker id="test" name="fielderror" />');
        $view->assertSee($expected, false);
    }

    public function testDatepickerPrependAppendText()
    {
        $expected = <<<'HTML'
<div class="form-group">
    <div class="input-group" id="test" data-target-input="nearest">
        <div class="input-group-prepend" data-toggle="datetimepicker" data-target="#test">
            <span class="input-group-text">test</span>
        </div>
        <input class="form-control datetimepicker-input" type="text" name="test_local" value data-toggle="datetimepicker" data-target="#test" autocomplete="off">
        <div class="input-group-append" data-toggle="datetimepicker" data-target="#test">
            <span class="input-group-text">test</span>
        </div>
    </div>
    <input type="hidden" name="test" value>
</div>
<script>loadScript('',()=>{moment.locale('en');registerAsset('momentjs')});</script><script>loadStylesheet('');whenAssetIsLoaded('momentjs',()=>{loadScript('',()=>{registerAsset('datetimepicker',()=>{$.fn.datetimepicker.Constructor.Default=$.extend({},$.fn.datetimepicker.Constructor.Default,{locale:"en",icons:$.extend({},$.fn.datetimepicker.Constructor.Default.icons,{time:'far fa-clock',date:'far fa-calendar',up:'fas fa-arrow-up',down:'fas fa-arrow-down',previous:'fas fa-chevron-left',next:'fas fa-chevron-right',today:'far fa-calendar-check',clear:'fas fa-trash',close:'fas fa-times'})})})})});</script><script>whenAssetIsLoaded('datetimepicker',()=>{window.DTP_test=$('#test').datetimepicker({format:"L",buttons:{showToday:!1,showClear:!1,showClose:!1},useCurrent:!1,});$('#test').on('change.datetimepicker',()=>{$('input[name="test"]').val('');if($('input[name="test_local"]').val()!==''){let date=$('#test').datetimepicker('viewDate').format('YYYY-MM-DD');$('input[name="test"]').val(date).trigger('change')}})});</script>
HTML;

        $view = $this->blade('<x-boilerplate::datetimepicker id="test" name="test" prepend-text="test" append-text="test" />');
        $view->assertSee($expected, false);
    }

    public function testDatepickerPrependAppendIcon()
    {
        $expected = <<<'HTML'
<div class="form-group">
    <div class="input-group" id="test" data-target-input="nearest">
        <div class="input-group-prepend" data-toggle="datetimepicker" data-target="#test">
            <span class="input-group-text"><span class="fas fa-calendar"></span></span>
        </div>
        <input class="form-control datetimepicker-input" type="text" name="test_local" value data-toggle="datetimepicker" data-target="#test" autocomplete="off">
        <div class="input-group-append" data-toggle="datetimepicker" data-target="#test">
            <span class="input-group-text"><span class="fas fa-calendar"></span></span>
        </div>
    </div>
    <input type="hidden" name="test" value>
</div>
<script>loadScript('',()=>{moment.locale('en');registerAsset('momentjs')});</script><script>loadStylesheet('');whenAssetIsLoaded('momentjs',()=>{loadScript('',()=>{registerAsset('datetimepicker',()=>{$.fn.datetimepicker.Constructor.Default=$.extend({},$.fn.datetimepicker.Constructor.Default,{locale:"en",icons:$.extend({},$.fn.datetimepicker.Constructor.Default.icons,{time:'far fa-clock',date:'far fa-calendar',up:'fas fa-arrow-up',down:'fas fa-arrow-down',previous:'fas fa-chevron-left',next:'fas fa-chevron-right',today:'far fa-calendar-check',clear:'fas fa-trash',close:'fas fa-times'})})})})});</script><script>whenAssetIsLoaded('datetimepicker',()=>{window.DTP_test=$('#test').datetimepicker({format:"L",buttons:{showToday:!1,showClear:!1,showClose:!1},useCurrent:!1,});$('#test').on('change.datetimepicker',()=>{$('input[name="test"]').val('');if($('input[name="test_local"]').val()!==''){let date=$('#test').datetimepicker('viewDate').format('YYYY-MM-DD');$('input[name="test"]').val(date).trigger('change')}})});</script>
HTML;

        $view = $this->blade('<x-boilerplate::datetimepicker id="test" name="test" prepend-text="fas fa-calendar" append-text="fas fa-calendar" />');
        $view->assertSee($expected, false);
    }

    public function testDatepickerPrependAppend()
    {
        $expected = <<<'HTML'
<div class="form-group">
    <div class="input-group" id="test" data-target-input="nearest">
        <div class="input-group-prepend" data-toggle="datetimepicker" data-target="#test">
            test
        </div>
        <input class="form-control datetimepicker-input" type="text" name="test_local" value data-toggle="datetimepicker" data-target="#test" autocomplete="off">
        <div class="input-group-append" data-toggle="datetimepicker" data-target="#test">
            test
        </div>
    </div>
    <input type="hidden" name="test" value>
</div>
<script>loadScript('',()=>{moment.locale('en');registerAsset('momentjs')});</script><script>loadStylesheet('');whenAssetIsLoaded('momentjs',()=>{loadScript('',()=>{registerAsset('datetimepicker',()=>{$.fn.datetimepicker.Constructor.Default=$.extend({},$.fn.datetimepicker.Constructor.Default,{locale:"en",icons:$.extend({},$.fn.datetimepicker.Constructor.Default.icons,{time:'far fa-clock',date:'far fa-calendar',up:'fas fa-arrow-up',down:'fas fa-arrow-down',previous:'fas fa-chevron-left',next:'fas fa-chevron-right',today:'far fa-calendar-check',clear:'fas fa-trash',close:'fas fa-times'})})})})});</script><script>whenAssetIsLoaded('datetimepicker',()=>{window.DTP_test=$('#test').datetimepicker({format:"L",buttons:{showToday:!1,showClear:!1,showClose:!1},useCurrent:!1,});$('#test').on('change.datetimepicker',()=>{$('input[name="test"]').val('');if($('input[name="test_local"]').val()!==''){let date=$('#test').datetimepicker('viewDate').format('YYYY-MM-DD');$('input[name="test"]').val(date).trigger('change')}})});</script>
HTML;

        $view = $this->blade('<x-boilerplate::datetimepicker id="test" name="test"><x-slot name="prepend">test</x-slot><x-slot name="append">test</x-slot></x-boilerplate::datetimepicker>');
        $view->assertSee($expected, false);
    }

    public function testDatepickerJs()
    {
        $expected = <<<'HTML'
<div class="form-group">
    <div class="input-group" id="test" data-target-input="nearest">
        <input class="form-control datetimepicker-input" type="text" name="test_local" value data-toggle="datetimepicker" data-target="#test" autocomplete="off">
    </div>
    <input type="hidden" name="test" value>
</div>
<script>loadScript('',()=>{moment.locale('en');registerAsset('momentjs')});</script><script>loadStylesheet('');whenAssetIsLoaded('momentjs',()=>{loadScript('',()=>{registerAsset('datetimepicker',()=>{$.fn.datetimepicker.Constructor.Default=$.extend({},$.fn.datetimepicker.Constructor.Default,{locale:"en",icons:$.extend({},$.fn.datetimepicker.Constructor.Default.icons,{time:'far fa-clock',date:'far fa-calendar',up:'fas fa-arrow-up',down:'fas fa-arrow-down',previous:'fas fa-chevron-left',next:'fas fa-chevron-right',today:'far fa-calendar-check',clear:'fas fa-trash',close:'fas fa-times'})})})})});</script><script>whenAssetIsLoaded('datetimepicker',()=>{window.DTP_test=$('#test').datetimepicker({format:"L",buttons:{showToday:!1,showClear:!1,showClose:!1},useCurrent:!1,});$('#test').on('change.datetimepicker',()=>{$('input[name="test"]').val('');if($('input[name="test_local"]').val()!==''){let date=$('#test').datetimepicker('viewDate').format('YYYY-MM-DD');$('input[name="test"]').val(date).trigger('change')}})});</script>
HTML;

        $view = $this->blade('<x-boilerplate::datetimepicker id="test" name="test" />@stack("js")');
        $view->assertSee($expected, false);
    }

    public function testDatepickerValue()
    {
        $expected = <<<'HTML'
<div class="form-group">
    <div class="input-group" id="test" data-target-input="nearest">
        <input class="form-control datetimepicker-input" type="text" name="test_local" value="01/01/2022" data-toggle="datetimepicker" data-target="#test" autocomplete="off">
    </div>
    <input type="hidden" name="test" value="2022-01-01">
</div>
<script>loadScript('',()=>{moment.locale('en');registerAsset('momentjs')});</script><script>loadStylesheet('');whenAssetIsLoaded('momentjs',()=>{loadScript('',()=>{registerAsset('datetimepicker',()=>{$.fn.datetimepicker.Constructor.Default=$.extend({},$.fn.datetimepicker.Constructor.Default,{locale:"en",icons:$.extend({},$.fn.datetimepicker.Constructor.Default.icons,{time:'far fa-clock',date:'far fa-calendar',up:'fas fa-arrow-up',down:'fas fa-arrow-down',previous:'fas fa-chevron-left',next:'fas fa-chevron-right',today:'far fa-calendar-check',clear:'fas fa-trash',close:'fas fa-times'})})})})});</script><script>whenAssetIsLoaded('datetimepicker',()=>{window.DTP_test=$('#test').datetimepicker({format:"L",buttons:{showToday:!1,showClear:!1,showClose:!1},useCurrent:!1,});$('#test').on('change.datetimepicker',()=>{$('input[name="test"]').val('');if($('input[name="test_local"]').val()!==''){let date=$('#test').datetimepicker('viewDate').format('YYYY-MM-DD');$('input[name="test"]').val(date).trigger('change')}})});</script>
HTML;

        $view = $this->blade('<x-boilerplate::datetimepicker id="test" name="test" value="2022-01-01" />');
        $view->assertSee($expected, false);

        $view = $this->blade('<x-boilerplate::datetimepicker id="test" name="test" value="2022-01-01 00:00:00" />');
        $view->assertSee($expected, false);

        $view = $this->blade('<x-boilerplate::datetimepicker id="test" name="test" :value="Illuminate\Support\Carbon::createFromFormat(\'Y-m-d H:i:s\', \'2022-01-01 00:00:00\')" />');
        $view->assertSee($expected, false);
    }

    public function testDatetimepickerValue()
    {
        $expected = <<<'HTML'
<div class="form-group">
    <div class="input-group" id="test" data-target-input="nearest">
        <input class="form-control datetimepicker-input" type="text" name="test_local" value="01/01/2022 00:00:00" data-toggle="datetimepicker" data-target="#test" autocomplete="off">
    </div>
    <input type="hidden" name="test" value="2022-01-01 00:00:00">
</div>
<script>loadScript('',()=>{moment.locale('en');registerAsset('momentjs')});</script><script>loadStylesheet('');whenAssetIsLoaded('momentjs',()=>{loadScript('',()=>{registerAsset('datetimepicker',()=>{$.fn.datetimepicker.Constructor.Default=$.extend({},$.fn.datetimepicker.Constructor.Default,{locale:"en",icons:$.extend({},$.fn.datetimepicker.Constructor.Default.icons,{time:'far fa-clock',date:'far fa-calendar',up:'fas fa-arrow-up',down:'fas fa-arrow-down',previous:'fas fa-chevron-left',next:'fas fa-chevron-right',today:'far fa-calendar-check',clear:'fas fa-trash',close:'fas fa-times'})})})})});</script><script>whenAssetIsLoaded('datetimepicker',()=>{window.DTP_test=$('#test').datetimepicker({format:"L HH:mm:ss",buttons:{showToday:!1,showClear:!1,showClose:!1},useCurrent:!1,});$('#test').on('change.datetimepicker',()=>{$('input[name="test"]').val('');if($('input[name="test_local"]').val()!==''){let date=$('#test').datetimepicker('viewDate').format('YYYY-MM-DD HH:mm:ss');$('input[name="test"]').val(date).trigger('change')}})});</script>
HTML;

        $view = $this->blade('<x-boilerplate::datetimepicker id="test" name="test" value="2022-01-01" format="L HH:mm:ss" />');
        $view->assertSee($expected, false);

        $view = $this->blade('<x-boilerplate::datetimepicker id="test" name="test" value="2022-01-01 00:00:00" format="L HH:mm:ss" />');
        $view->assertSee($expected, false);

        $view = $this->blade('<x-boilerplate::datetimepicker id="test" name="test" :value="Illuminate\Support\Carbon::createFromFormat(\'Y-m-d H:i:s\', \'2022-01-01 00:00:00\')" format="L HH:mm:ss" />');
        $view->assertSee($expected, false);
    }
}
