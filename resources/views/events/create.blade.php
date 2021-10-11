@extends('layouts.main')
@section('title', 'criar evento')

@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>crie seu evento</h1>
        <form action="/events" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">imagem do evento</label>
                <input type="file"  id="image" name="image" class="from-control-file">
            </div>
            <div class="form-group">
                <label for="title">evento</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="nome do evento">
            </div>
            <div class="form-group">
                <label for="date">data do evento</label>
                <input type="date" class="form-control" id="date" name="date">
            </div>

            <div class="form-group">
                <label for="state">Estado</label>

                <select name="state" id="state" class="form-control">
                    <option>Estado</option>
                    <option value="acre">Acre</option>
                    <option value="alagoas">Alagoas</option>
                    <option value="amapa">Amapá</option>
                    <option value="amazonas">Amazonas</option>
                    <option value="bahia">Bahia</option>
                    <option value="ceara">Ceará</option>
                    <option value="distrito federal">Distrito Federal</option>
                    <option value="espirito santo">Espírito Santo</option>
                    <option value="goias">Goiás</option>
                    <option value="minas gerais">Minas Gerais</option>
                    <option value="maranhao">Maranhão</option>
                    <option value="mato grosso">Mato Grosso</option>
                    <option value="mato grosso do sul">Mato Grosso do Sul</option>
                    <option value="para">Pará</option>
                    <option value="paraiba">Paraíba</option>
                    <option value="parana">Paraná</option>
                    <option value="pernambuco">Pernambuco</option>
                    <option value="piaui">Piauí</option>
                    <option value="rio de janeiro">Rio de Janeiro</option>
                    <option value="rio grande do norte">Rio Grande do Norte</option>
                    <option value="rio grande do sul">Rio Grande do Sul</option>
                    <option value="rondonia">Rondônia</option>
                    <option value="roraima">Roraima</option>
                    <option value="santa catarina">Santa Catarina</option>
                    <option value="sao paulo">São Paulo</option>
                    <option value="sergipe">Sergipe</option>
                    <option value="tocantis">Tocantins</option>
                </select>  
            </div>

            <div class="form-group">
                <div id="wrapper-cities">
                    <label for="city">Cidade</label>
                    <select id="city" name="city" class="form-control"></select>
                </div> 
            </div>

            <div class="form-group">
                <label for="title">o evento é privado?</label>
                <div class="form-group">
                    <input type="radio"  id="private" name="private" value="0"> Não
                </div>
                <div class="form-group">
                    <input type="radio"  id="private" name="private" value="1"> Sim
                </div>
            </div>
            <div class="form-group">
                <label for="title">descrição</label>
                    <textarea name="description" id="description" class="form-control" 
                    placeholder="o que vai acontecer no evento?"></textarea>
            </div>
            <div class="form-group">
                <label for="title">adicione itens de infraestrutura</label>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="cadeiras"> cadeiras
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="palco"> palco
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="cerveja gratis"> cerveja gratis
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="open food"> open food
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="brindes"> brindes
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="criar evento">
        </form>
    </div>

@endsection