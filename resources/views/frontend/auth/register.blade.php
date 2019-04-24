<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro - {{config('app.name')}}</title>
    <link rel="stylesheet" href="{{ asset('css/base-front.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend-animation.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/post-9.css') }}">
    <script type="text/javascript">
            window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/11\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/11\/svg\/","svgExt":".svg","source":{"concatemoji":"https:\/\/sur.happyfeetsoccer.com.ec\/wp-includes\/js\/wp-emoji-release.min.js?ver=4.9.10"}};
            !function(a,b,c){function d(a,b){var c=String.fromCharCode;l.clearRect(0,0,k.width,k.height),l.fillText(c.apply(this,a),0,0);var d=k.toDataURL();l.clearRect(0,0,k.width,k.height),l.fillText(c.apply(this,b),0,0);var e=k.toDataURL();return d===e}function e(a){var b;if(!l||!l.fillText)return!1;switch(l.textBaseline="top",l.font="600 32px Arial",a){case"flag":return!(b=d([55356,56826,55356,56819],[55356,56826,8203,55356,56819]))&&(b=d([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]),!b);case"emoji":return b=d([55358,56760,9792,65039],[55358,56760,8203,9792,65039]),!b}return!1}function f(a){var c=b.createElement("script");c.src=a,c.defer=c.type="text/javascript",b.getElementsByTagName("head")[0].appendChild(c)}var g,h,i,j,k=b.createElement("canvas"),l=k.getContext&&k.getContext("2d");for(j=Array("flag","emoji"),c.supports={everything:!0,everythingExceptFlag:!0},i=0;i<j.length;i++)c.supports[j[i]]=e(j[i]),c.supports.everything=c.supports.everything&&c.supports[j[i]],"flag"!==j[i]&&(c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&c.supports[j[i]]);c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&!c.supports.flag,c.DOMReady=!1,c.readyCallback=function(){c.DOMReady=!0},c.supports.everything||(h=function(){c.readyCallback()},b.addEventListener?(b.addEventListener("DOMContentLoaded",h,!1),a.addEventListener("load",h,!1)):(a.attachEvent("onload",h),b.attachEvent("onreadystatechange",function(){"complete"===b.readyState&&c.readyCallback()})),g=c.source||{},g.concatemoji?f(g.concatemoji):g.wpemoji&&g.twemoji&&(f(g.twemoji),f(g.wpemoji)))}(window,document,window._wpemojiSettings);
        </script>
        <style type="text/css">
            body{
                overflow: hidden;
            }
img.wp-smiley,
img.emoji {
    display: inline !important;
    border: none !important;
    box-shadow: none !important;
    height: 1em !important;
    width: 1em !important;
    margin: 0 .07em !important;
    vertical-align: -0.1em !important;
    background: none !important;
    padding: 0 !important;
}

select:before {
    content: "\f0d7";
    font-family: FontAwesome;
    font-size: 15px;
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    right: 10px;
    pointer-events: none;
}

input[type='text'], input[type='email'], input[type='tel'], select{
        border-color: #e2e2e2!important;
    border-width: 1px 1px 1px 1px!important;
    border-radius: 50px 50px 50px 50px!important;
}

.elementor-field-group {
    padding-right: calc( 0px/2 );
    padding-left: calc( 0px/2 );
    margin-bottom: 12px;
}


button[type='submit'] {
    background-color: #1578bc!important;
    color: #ffffff!important;
    font-family: "Roboto Condensed", Sans-serif!important;
    font-size: 16px!important;
    font-weight: bold!important;
    text-transform: uppercase!important;
    line-height: 26px!important;
    border-radius: 50px 50px 50px 50px!important;
}

button[type='submit']:hover {
    background-color: #199447!important;
}

.elementor-9 .elementor-element.elementor-element-59bc091 .elementor-icon-list-text {
    color: #7a7a7a!important;
}

.elementor-icon-list-items .elementor-icon-list-item .elementor-icon-list-text {
    display: inline-block;
</style>
</head>
<body style="padding: 0 14px!important;">
   <div class="elementor-element elementor-element-627e0917 elementor-column elementor-col-50 elementor-top-column" data-id="627e0917" data-element_type="column">
        <div class="elementor-column-wrap  elementor-element-populated">
            <div class="elementor-widget-wrap">
                <div class="elementor-element elementor-element-723d65f0 elementor-button-align-center elementor-mobile-button-align-center elementor-widget elementor-widget-form" data-id="723d65f0" data-element_type="widget" data-widget_type="form.default">
                    <div class="elementor-widget-container">
                        <form class="elementor-form" method="post" id="registro-form" name="Registro" action="{{ route('register-user-post') }}">
                            {{ csrf_field() }}
                            <div class="elementor-form-fields-wrapper elementor-labels-">
                                <div class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-nombre_representante elementor-col-100 elementor-field-required">
                                    <label for="form-field-nombre_representante" class="elementor-field-label elementor-screen-only">Nombre</label><input size="1" type="text" name="representant[name]" id="form-field-nombre_representante" class="elementor-field elementor-size-md  elementor-field-textual" placeholder="Escribe tu Nombre" required="required" aria-required="true"> </div>
                                <div class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-apellido_representante elementor-col-100 elementor-field-required">
                                    <label for="form-field-apellido_representante" class="elementor-field-label elementor-screen-only">Apellido</label><input size="1" type="text" name="representant[last_name]" id="form-field-apellido_representante" class="elementor-field elementor-size-md  elementor-field-textual" placeholder="Escribe tu Apellido" required="required" aria-required="true"> </div>
                                <div class="elementor-field-type-email elementor-field-group elementor-column elementor-field-group-email elementor-col-100 elementor-md-100 elementor-sm-100 elementor-field-required">
                                    <label for="form-field-email" class="elementor-field-label elementor-screen-only">Email</label><input size="1" type="email" name="representant[email]" id="form-field-email" class="elementor-field elementor-size-md  elementor-field-textual" placeholder="Escribe tu Email" required="required" aria-required="true"> </div>
                                <div class="elementor-field-type-tel elementor-field-group elementor-column elementor-field-group-celular elementor-col-100 elementor-field-required">
                                    <label for="form-field-celular" class="elementor-field-label elementor-screen-only">Celular</label><input size="1" type="tel" name="representant[mobile]" id="form-field-celular" class="elementor-field elementor-size-md  elementor-field-textual" placeholder="Tu número Celular" required="required" aria-required="true" pattern="[0-9()#&amp;+*-=.]+" title="Only numbers and phone characters (#, -, *, etc) are accepted."> </div>
                                <div class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-nombre_hijo elementor-col-100 elementor-field-required">
                                    <label for="form-field-nombre_hijo" class="elementor-field-label elementor-screen-only">Nombre de tu Hijo(a)</label><input size="1" type="text" name="name" id="form-field-nombre_hijo" class="elementor-field elementor-size-md  elementor-field-textual" placeholder="Escribe el Nombre de tu Hijo(a)" required="required" aria-required="true"> </div>
                                <div class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-apellido_hijo elementor-col-100 elementor-field-required">
                                    <label for="form-field-apellido_hijo" class="elementor-field-label elementor-screen-only">Apellido de tu Hijo(a)</label><input size="1" type="text" name="last_name" id="form-field-apellido_hijo" class="elementor-field elementor-size-md  elementor-field-textual" placeholder="Escribe el Apellido de tu Hijo(a)" required="required" aria-required="true"> </div>
                                <div class="elementor-field-type-select elementor-field-group elementor-column elementor-field-group-edad elementor-col-100 elementor-field-required">
                                    <label for="form-field-edad" class="elementor-field-label elementor-screen-only">Selecciona la edad</label>
                                    <div class="elementor-field elementor-select-wrapper ">
                                        <select name="age" id="form-field-edad" class="elementor-field-textual elementor-size-md" required="required" aria-required="true">
                                            <option value="null">Selecciona la Edad de tu Hijo(a)</option>
                                            @foreach ($ages as $age)
                                                <option value="{{$age}}">{{$age}} años</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="elementor-field-type-select elementor-field-group elementor-column elementor-field-group-cancha elementor-col-100 elementor-field-required">
                                    <label for="form-field-cancha" class="elementor-field-label elementor-screen-only">Selecciona la cancha</label>
                                    <div class="elementor-field elementor-select-wrapper ">
                                        <select name="enrollment[field_id]" id="form-field-cancha" class="elementor-field-textual elementor-size-md" required="required" aria-required="true">
                                            <option value="null">Selecciona la Cancha más Cercana</option>
                                            @foreach ($fields as $field)
                                                <option value="{{$field->id}}">{{$field->name}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="elementor-field-type-select elementor-field-group elementor-column elementor-field-group-dia elementor-col-100 elementor-field-required">
                                    <label for="form-field-dia" class="elementor-field-label elementor-screen-only">Selecciona el día</label>
                                    <div class="elementor-field elementor-select-wrapper ">
                                        <select name="enrollment[day]" id="form-field-dia" class="elementor-field-textual elementor-size-md" required="required" aria-required="true" disabled="">
                                            <option value="null">Selecciona el día</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="elementor-field-type-select elementor-field-group elementor-column elementor-field-group-hora elementor-col-100 elementor-field-required">
                                    <label for="form-field-hora" class="elementor-field-label elementor-screen-only" disabled>Selecciona la hora</label>
                                    <div class="elementor-field elementor-select-wrapper ">
                                        <select name="enrollment[hour]" id="form-field-hora" class="elementor-field-textual elementor-size-md" required="required" aria-required="true" disabled="">
                                            <option value="null">Selecciona la hora</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="elementor-field-type-text">
                                    <input size="1" type="text" name="form_fields[98c086a]" id="form-field-98c086a" class="elementor-field elementor-size-md " style="display:none !important;"> </div> --}}
                                <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100">
                                    <button type="submit" class="elementor-button elementor-size-lg elementor-animation-grow" id="submit-form">
                                        <span>
                                            <span class="elementor-button-text">Reservar mi Demostración Gratuita</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="elementor-element elementor-element-59bc091 elementor-align-center elementor-icon-list--layout-traditional elementor-widget elementor-widget-icon-list" data-id="59bc091" data-element_type="widget" data-widget_type="icon-list.default">
                                    <div class="elementor-widget-container">
                                        <ul class="elementor-icon-list-items text-center">
                                            <li class="elementor-icon-list-item text-center" style="color: #7a7a7a;font-size: 13px;">
                                                <span class="elementor-icon-list-icon">
                                                    <i class="fa fa-shield" aria-hidden="true"></i>
                                                </span>
                                                <span class="elementor-icon-list-text">Privacidad 100% Garantizada</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    <script type="text/javascript" src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/components/register.js') }}"></script>
</body>
</html>