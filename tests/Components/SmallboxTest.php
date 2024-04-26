<?php

namespace Sebastienheyd\Boilerplate\Tests\Components;

class SmallboxTest extends TestComponent
{
    public function testSmallboxComponentEmpty()
    {
        $expected = <<<'HTML'
<div class="small-box bg-info">
    <div class="inner">
        <h3>0</h3>
        <p>&nbsp;</p>
    </div>
    <div class="icon"><i class="fas fa-cubes"></i></div>
</div>
HTML;

        $view = $this->blade('<x-boilerplate::smallbox />');
        $view->assertSee($expected, false);
    }

    public function testSmallboxComponentFull()
    {
        $expected = <<<'HTML'
<div class="small-box bg-primary extra-class" id="test">
    <div class="inner">
        <h3>1234</h3>
        <p>Dashboard</p>
    </div>
    <div class="icon"><i class="far fa-envelope"></i></div>
    <a href="#" class="small-box-footer">
        Dashboard&nbsp;<i class="fas fa-arrow-circle-right ml-1"></i>
    </a>
</div>
HTML;

        $view = $this->blade('<x-boilerplate::smallbox id="test" color="primary" class="extra-class" nb="1234" text="boilerplate::layout.dashboard" icon="far fa-envelope" link="#" link-text="boilerplate::layout.dashboard" />');
        $view->assertSee($expected, false);
    }
}
