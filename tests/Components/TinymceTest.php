<?php

namespace Sebastienheyd\Boilerplate\Tests\Components;

class TinymceTest extends TestComponent
{
    public function testTinymceComponentNoName()
    {
        $expected = <<<'HTML'
<code>&lt;x-boilerplate::tinymce>The name attribute has not been set</code>
HTML;

        $view = $this->blade('<x-boilerplate::tinymce id="test" />');
        $view->assertSee($expected, false);
    }

    public function testTinymceComponent()
    {
        $expected = <<<'HTML'
<div class="form-group test" id="test">
    <label for="test">test</label>
    <textarea id="test" name="test" style="visibility:hidden"></textarea>
</div>
<script>loadScript("",()=>{tinymce.defaultSettings={plugins:"autoresize fullscreen codemirror link lists table media image imagetools paste customalign gpt",toolbar:"undo redo | styleselect | bold italic underline | customalignleft aligncenter customalignright | gpt link media image | bullist numlist | table | code fullscreen",contextmenu:"link image imagetools table spellchecker bold italic underline",toolbar_drawer:"sliding",toolbar_sticky_offset:$('nav.main-header').outerHeight(),codemirror:{config:{theme:'storm'}},menubar:!1,removed_menuitems:'newdocument',remove_linebreaks:!1,forced_root_block:!1,force_p_newlines:!0,relative_urls:!1,verify_html:!1,branding:!1,statusbar:!1,browser_spellcheck:!0,encoding:'UTF-8',image_uploadtab:!1,deprecation_warnings:!1,gpt:{'tooltip':"Generate text with GPT",'title':"Generate with GPT",'route':"/admin/gpt",},paste_preprocess:function(plugin,args){args.content=args.content.replace(/<(\/)*(\\?xml:|meta|link|span|font|del|ins|st1:|[ovwxp]:)((.|\s)*?)>/gi,'');args.content=args.content.replace(/\s(class|style|type|start)=("(.*?)"|(\w*))/gi,'');args.content=args.content.replace(/<(p|a|div|span|strike|strong|i|u)[^>]*?>(\s|&nbsp;|<br\/>|\r|\n)*?<\/(p|a|div|span|strike|strong|i|u)>/gi,'')},skin:window.matchMedia("(prefers-color-scheme: dark)")?"boilerplate-dark":'oxide',content_css:window.matchMedia("(prefers-color-scheme: dark)")?"boilerplate-dark":'',};setInterval(()=>{if(tinymce.editors.length>0){$(tinymce.editors).each((i,e)=>{if($('#'+e.id).length===0){tinymce.get(e.id).remove()}})}})});</script><script>whenAssetIsLoaded('',()=>{window.MCE_test=tinymce.init({selector:'#test',toolbar_sticky:!1,})});</script>
HTML;

        $view = $this->blade('<x-boilerplate::tinymce id="test" name="test" group-id="test" group-class="test" label="test"/>@stack("js")');
        $view->assertSee($expected, false);
    }
}
