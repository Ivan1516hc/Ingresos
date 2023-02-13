@extends('layouts.template')

<script src="../../js/cards.js"></script>

@section('content')
    <!--Content Start-->
    <div class="content transition">
        <div class="container-fluid dashboard">
            <h3>INGRESOS</h3>
            <div class="row" id='cardsDiv'>
            </div>
            <div class="collapse" id="caja">
            </div>
            <div class="collapse" id="catalogos">
            </div>
            <div class="collapse" id="reportes">
            </div>
            <div class="collapse" id="administracion">
            </div>
        </div>
    </div>
@endsection
