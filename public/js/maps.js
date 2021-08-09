var geocoder;
var map;
var marker;

var quebrarEnderecoGoogleMaps = function(endereco, atualizaEndereco){
    var retorno = endereco.split(",");
    var bairro = retorno[1].split("-");
    var cidade = retorno[2].split("-");

    if(atualizaEndereco != 0){
        //$('.rua').val(retorno[0]);
        //$('.bairro').val(bairro.length > 2?bairro[2]:bairro[1]);
        //$(".cidade").val(cidade[0]);
        //$('#meuCep').val(retorno.length > 4?retorno[3]:'');
    }
}

function initialize() {
    var lat = $('#latitude').val();
    var lng = $('#longitude').val();

    if(lat == '' && lng == ''){
        var latlng = new google.maps.LatLng(-16.327343764817037, -48.957660955619815); //Coordenada Inicial
        var options = {
            zoom: 15,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("jMap"), options);

        geocoder = new google.maps.Geocoder();

        marker = new google.maps.Marker({
            map: map,
            draggable: true,
        });

        marker.setPosition(latlng);
    }else{
        var latlng = new google.maps.LatLng(lat, lng); //Coordenada Inicial
        var options = {
            zoom: 17,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("jMap"), options);

        geocoder = new google.maps.Geocoder();

        marker = new google.maps.Marker({
            map: map,
            draggable: true,
        });

        marker.setPosition(latlng);
    }
}

$(document).ready(function () {
    initialize(); //Inicializando Mapa

    var carregarNoMapa = function(endereco) {
        geocoder.geocode({ 'address': endereco + ', Brasil', 'region': 'BR' }, function (results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();

                    $('#latitude').val(latitude);
                    $('#longitude').val(longitude);

                    quebrarEnderecoGoogleMaps(results[0].formatted_address, 0);

                    var location = new google.maps.LatLng(latitude, longitude);
                    marker.setPosition(location);
                    map.setCenter(location);
                    map.setZoom(16);
                }
            }
        });
    }

    //Localização Reversa
    google.maps.event.addListener(marker, 'drag', function () {
        geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {

                    $('#latitude').val(marker.getPosition().lat());
                    $('#longitude').val(marker.getPosition().lng());

                    //quebrarEnderecoGoogleMaps(results[0].formatted_address, 1)
                }
            }
        });
    });
    $("#meuCep").mask("99999-999");
    $('#meuCep').on('blur', function(){
        var endereco = '';
        var cep = $(this).val().replace(/\D/g, '');
        if (cep != "") {
            var validacep = /^[0-9]{8}$/;
            if(validacep.test(cep)) {
                //Preenche os campos com "..." enquanto consulta webservice.
                $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $(".rua").val(dados.logradouro);
                        $(".bairro").val(dados.bairro);
                        $(".cidade").val(dados.localidade);
                        $(".uf").val(dados.uf);
                        endereco = dados.logradouro + ', ' + dados.localidade + '-' + dados.uf;
                        carregarNoMapa(endereco);
                    } //end if.
                    else {
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                alert("Formato de CEP inválido.");
            }
        }
    });
});