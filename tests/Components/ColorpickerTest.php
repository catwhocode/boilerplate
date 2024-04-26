<?php

namespace Sebastienheyd\Boilerplate\Tests\Components;

class ColorpickerTest extends TestComponent
{
    public function testColorPickerNoArgs()
    {
        $expected = <<<'HTML'
<code>&lt;x-boilerplate::colorpicker> The name attribute has not been set</code>
HTML;

        $view = $this->blade('<x-boilerplate::colorpicker />');
        $view->assertSee($expected, false);
    }

    public function testColorPickerName()
    {
        $expected = <<<'HTML'
<div class="form-group">
    <input class="form-control" type="text" name="test" value id="test" autocomplete="off">
</div>
<script>loadScript('',()=>{loadStylesheet('',()=>{registerAsset('ColorPicker')})})</script><script>whenAssetIsLoaded('ColorPicker',()=>{window.CP_test=$('#test').spectrum({allowEmpty:!0,showInput:!0,showInitial:!0,clickoutFiresChange:!1,locale:'en',showSelectionPalette:!1,})});</script>
HTML;

        $view = $this->blade('<x-boilerplate::colorpicker name="test" id="test" />');
        $view->assertSee($expected, false);
    }

    public function testColorPickerLabel()
    {
        $expected = <<<'HTML'
<div class="form-group">
    <label>Test</label>
    <input class="form-control" type="text" name="test" value id="test" autocomplete="off">
</div>
<script>loadScript('',()=>{loadStylesheet('',()=>{registerAsset('ColorPicker')})})</script><script>whenAssetIsLoaded('ColorPicker',()=>{window.CP_test=$('#test').spectrum({allowEmpty:!0,showInput:!0,showInitial:!0,clickoutFiresChange:!1,locale:'en',showSelectionPalette:!1,})});</script>
HTML;

        $view = $this->blade('<x-boilerplate::colorpicker name="test" id="test" label="Test" />');
        $view->assertSee($expected, false);
    }

    public function testColorPickerClasses()
    {
        $expected = <<<'HTML'
<div class="form-group test" id="test">
    <label>Test</label>
    <input class="form-control test" type="text" name="test" value id="test" autocomplete="off">
</div>
<script>loadScript('',()=>{loadStylesheet('',()=>{registerAsset('ColorPicker')})})</script><script>whenAssetIsLoaded('ColorPicker',()=>{window.CP_test=$('#test').spectrum({allowEmpty:!0,showInput:!0,showInitial:!0,clickoutFiresChange:!1,locale:'en',showSelectionPalette:!1,})});</script>
HTML;

        $view = $this->blade('<x-boilerplate::colorpicker name="test" id="test" label="Test" group-class="test" group-id="test" class="test" />');
        $view->assertSee($expected, false);
    }

    public function testColorPickerPalettes()
    {
        $expected = <<<'HTML'
<div class="form-group">
    <input class="form-control" type="text" name="test" value id="test" autocomplete="off">
</div>
<script>loadScript('',()=>{loadStylesheet('',()=>{registerAsset('ColorPicker')})})</script><script>whenAssetIsLoaded('ColorPicker',()=>{window.CP_test=$('#test').spectrum({allowEmpty:!0,showInput:!0,showInitial:!0,clickoutFiresChange:!1,locale:'en',showSelectionPalette:!1,palette:["green"],selectionPalette:["red"],})});</script>
HTML;

        $view = $this->blade('<x-boilerplate::colorpicker name="test" id="test" :palette="[\'green\']" :selectionPalette="[\'red\']" />');
        $view->assertSee($expected, false);

        $view = $this->blade('<x-boilerplate::colorpicker name="test" id="test" :palette="[\'green\']" :selection-palette="[\'red\']" />');
        $view->assertSee($expected, false);
    }
}
