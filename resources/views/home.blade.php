@extends('layouts.app')

@section('content')
<div class="container">
    {{--<div class="row">--}}
    @desktop
    <div id="wrapper" style="width: 100%; height: 100%; overflow: auto; -webkit-overflow-scrolling: touch;">
        <iframe  src="https://www.meteoblue.com/en/weather/widget/three/puntarenas_costa-rica_3622228?geoloc=fixed&nocurrent=0&noforecast=0&days=7&tempunit=CELSIUS&windunit=KILOMETER_PER_HOUR&layout=bright"  frameborder="0" scrolling="NO" allowtransparency="true" sandbox="allow-same-origin allow-scripts allow-popups allow-popups-to-escape-sandbox" style="width: 100%;height: 598px; overflow: auto;" class="embed-responsive-item"></iframe>
    </div>
    @elsedesktop
    <a class="weatherwidget-io" href="https://forecast7.com/en/9d22n83d34/puntarenas-province/" data-label_1="PUNTARENAS" data-label_2="WEATHER" data-font="Roboto" data-icons="Climacons Animated" data-theme="pure" data-basecolor="rgba(255, 255, 255, 0)" >PUNTARENAS WEATHER</a>
    <script>
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
    </script>
    @enddesktop



</div>
@endsection
