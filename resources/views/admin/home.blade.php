@extends('layouts.app')
@section('contents')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

            <script type='text/javascript' src='http://bi.mineco.gob.gt/javascripts/api/viz_v1.js'></script>
            <div class='tableauPlaceholder' style='width: 1920px; height: 837px;'>
                <object class='tableauViz' width='1920' height='837' style='display:none;'>
                    <param name='host_url' value='http%3A%2F%2Fbi.mineco.gob.gt%2F' /> 
                    <param name='embed_code_version' value='3' /> 
                    <param name='site_root' value='' />
                    <param name='name' value='inventarios&#47;DBInventarios' />
                    <param name='tabs' value='no' />
                    <param name='toolbar' value='yes' />
                    <param name='showAppBanner' value='false' />
                    <param name='filter' value='iframeSizedToWindow=true' />
                </object>
            </div>


            <!-- <div class='tableauPlaceholder' id='viz1587676388403' style='position: relative'>
            <noscript><a href='#'><img alt=' ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;in&#47;inventarios&#47;DBInventarios&#47;1_rss.png' style='border: none' /></a>
            </noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> 
            <param name='site_root' value='' /><param name='name' value='inventarios&#47;DBInventarios' /><param name='tabs' value='no' />
            <param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;in&#47;inventarios&#47;DBInventarios&#47;1.png' />
             <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' />
             <param name='display_count' value='yes' /><param name='filter' value='publish=yes' /></object></div>                            
            </div> -->
        </div>
        <!-- <script>
         var divElement = document.getElementById('viz1587676388403');                 
                var vizElement = divElement.getElementsByTagName('object')[0];                 
                    if ( divElement.offsetWidth > 800 ) { vizElement.style.width='100%';
                        vizElement.style.height=(divElement.offsetWidth*0.75)+'px';} 
                    else if ( divElement.offsetWidth > 500 ){
                             vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';
                            } 
                      else 
                      { 
                          vizElement.style.width='100%';vizElement.style.height='1427px';
                      }                    
                      
                    var scriptElement = document.createElement('script');       
                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';          
                    vizElement.parentNode.insertBefore(scriptElement, vizElement); 
        
        </script> -->
    </div>
@endsection
@section('breadcrumb')
    Inicio
@endsection
