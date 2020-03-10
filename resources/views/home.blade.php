@extends('layouts.app')

@section('content')

@foreach ($clients as $client)
<div id="{{$client->id}}" class="grid-item" onclick="openModal({{$client->id}})">
    <div class="placeholder">
        <div class="gallery-curve-wrapper">
            <div class="gallery-header">
                <p>{{$client->name}}</p>
                <p class="green-text"> CPF: {{$client->cpf}}</p>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Structure -->
<div id="modal-client" class="modal bottom-sheet">
    <div class="modal-contents">
        <h3 class="center orange-text">Dívidas</h3>
        <table class="centered striped">
            <thead>
                <tr>
                    <th>Valor Original</th>
                    <th>Vencimento</th>
                    <th>Dias em atraso</th>
                    <th>Valor C/Juros</th>
                    <th>Parcelas</th>
                    <th>Valor Comissão</th>

                </tr>
            </thead>

            <tbody class="debtsClients">
            </tbody>
        </table>
        <hr>
        <h5 class="center purple-text" id="total">Total: </h5>
    </div>
</div>


<div class="fixed-action-btn">
    <a class="btn-floating btn-large purple modal-trigger  btn tooltipped pulse" data-background-color="red lighten-3" data-position="left" data-delay="50" data-tooltip="Editar configurações dívida" href="#modal1">
        <i class="large material-icons">mode_edit</i>
    </a>
</div>


<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4 class="center orange-text">Configurações dívida</h4>
        <form class="col s12" method="POST" action="admin/debt_configs">
            <div class="row">
                <div class="input-field col s12">
                    <input id="quant_parcel" name="quant_parcel" type="number" class="validate" value="{{ $configs->quant_parcel }}" min="1">
                    <label for="disabled">Quantidade de Parcelas</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="value_tax" name="value_tax" type="number" class="validate" value="{{ $configs->value_tax }}" step="0.01" min="0.01">
                    <label for="disabled">Valor dos Juros (em porcentagem)</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="sale_commission" name="sale_commission" type="number" class="validate" value="{{ $configs->sale_commission }}"  step="0.01" min="0.01">
                    <label for="disabled">Porcentagem Comissão (em porcentagem)</label>
                </div>
            </div>

            <div class="row">
                <!-- Switch -->
                <div class="col s12">
                    <div class="switch">
                        <label>
                            Simples
                            <input type="checkbox" name="tipo" value="1" @if ($configs->tax_id == 2) checked="checked" @endif>
                            <span class="lever"></span>
                            Composto
                        </label>
                    </div>
                </div>
            </div>
    </div>

    <div class="modal-footer">
        <button class="modal-action waves-effect waves-green btn-flat " type="submit">Salvar</button>
        </form>
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Fechar</a>
    </div>
</div>

@endsection
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/materialize.min.js') }}"></script>

<script>
    function openModal(client) {

        $.ajax({
            type: 'POST',
            url: './admin/getDebts',
            data: {
                "id": client
            },
            success: function(data) {
                if (data['debts'].length > 0) {
                    console.log(data);
                    $session = data['session'];
                    $.each(data['debts'], function(k, v) {
                        total += parseFloat(v['valueTotal']);
                        $element = "<tr><td>" + v['value'] + "</td><td>" + v['created_at'] + "</td><td>" + v['daysLate'] + "</td><td>" + v['valueTotalFormat'] + "</td>" + "<td>" + v['parcels'] + "</td>" + "<td>" + v['salesComis'] + "</td></tr>";
                        $(".debtsClients").append($element);
                    });
                    $("#total").append(data['total']);
                    $(".loader").hide();
                    $('#modal-client').modal('open');
                } else {
                    M.toast({
                        html: 'Cliente não possui dívidas'
                    }, 5000);
                }
            }
        });
    }
</script>