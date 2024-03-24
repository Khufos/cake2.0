$('#InfoComplementar').ready(function() {
    let contador = document.getElementById('contadorDeCaracteresInformacaoComplementar');
    let caixaDeTextoInfoComplementar = document.getElementById('InfoComplementar');
    
    limitadorDeCaracteresDeInformacaoComplementar();

    contador.innerText = `${caixaDeTextoInfoComplementar.value.length} / ${quantidadeMaximaDeCaracteres}`;          
});

$('#InfoComplementar').on('keyup', function() {
    let contador = document.getElementById('contadorDeCaracteresInformacaoComplementar');
    let caixaDeTextoInfoComplementar = document.getElementById('InfoComplementar');
    
    limitadorDeCaracteresDeInformacaoComplementar();

    contador.innerText = `${caixaDeTextoInfoComplementar.value.length} / ${quantidadeMaximaDeCaracteres}`;            
});

$('#InfoComplementar').on('change', function(){
    if(inputInfoComplementarFocado){
        inputInfoComplementarFocado = false; 
        salvarProgresso();
    }
});

function limitadorDeCaracteresDeInformacaoComplementar() {
    let contador = document.getElementById('contadorDeCaracteresInformacaoComplementar');
    let caixaDeTextoInfoComplementar = document.getElementById('InfoComplementar');
    
    if(caixaDeTextoInfoComplementar.value.length < quantidadeMaximaDeCaracteres) {
        contador.style.color = 'black';
        contador.style.fontWeight = 'normal';
        return;
    }

    textoPermitido = caixaDeTextoInfoComplementar.value.substr(0, quantidadeMaximaDeCaracteres);
    caixaDeTextoInfoComplementar.value = textoPermitido;
    contador.style.color = 'red'
    contador.style.fontWeight = 'bold';

    return;
}
