<?php
$renovaSessao = $this->Js->request(
        array('controller' => 'Usuarios', 'action' => 'renovaSessao', '/?trs=1')
        );

?>
<script type="text/javascript">

    $(document).ready(function() {
        //Momento que vai aparecer o Tempo restante
        if(<?php echo $this->Session->read('perfilLimitado') === true ?>){
            var horaFim = "<?php echo $this->Session->read('horaFinal'); ?>" //Hora Final 
            var minutoFim = "<?php echo $this->Session->read('minutoFinal'); ?>" //Minuto Final
            var FimSessaoHora = parseInt(horaFim);
            var FimSessaoMinutos = parseInt(minutoFim) - 10;
        
            var hr = new Date()
            if(hr.getHours() >= FimSessaoHora){
                if(FimSessaoMinutos <= hr.getMinutes()){
                   startCountdown();                  
                }
            }
        }else{
            startCountdown();
        }
    });
    if(<?php echo $this->Session->read('perfilLimitado') === true ?>){  
        var horaFim = "<?php echo $this->Session->read('horaFinal'); ?>" //Hora Final 
        var minutoFim = "<?php echo $this->Session->read('minutoFinal'); ?>" //Minuto Final

        var tempoFimSessao = horaFim; // Timestamp com tempo do fim da sessao  
        var tempoFimSessaoMinutos = minutoFim;   
        var tempoAtual = new Date().getHours(); // Timestamp com o timestamp atual
        var minutosAtual = new Date().getMinutes();
        console.log(minutosAtual);
        var segundosAtual = new Date().getSeconds();
        console.log(segundosAtual);

        var tempoDiff = tempoFimSessao - tempoAtual; // Calcula a diferença pra pegar o tempo de sessão
        var tempoSegundos = parseInt((((tempoDiff) * 60) * 60) - (minutosAtual * 60)) - (segundosAtual + (tempoFimSessaoMinutos * 60)); // Convertendo timestamp em segundos
        var tempo = (tempoSegundos);
        var tempoAlert = 30; // Tempo limite para o alert 
        var timeoutId;
    }else{
        var tempoFimSessao = <?php echo $this->Session->read('Config.time'); ?>; // Timestamp com tempo do fim da sessao     
        var tempoAtual = <?php echo time(); ?>; // Timestamp com o timestamp atual
        var tempoDiff = tempoFimSessao - tempoAtual; // Calcula a diferença pra pegar o tempo de sessão
        var tempoSegundos = parseInt(((tempoDiff / 60) * 60)); // Convertendo timestamp em segundos
        var tempo = tempoSegundos;
        var tempoAlert = 30; // Tempo limite para o alert 
        var timeoutId;  
    }


    function startCountdown() {
        // Se o tempo não for zerado
        if ((tempo - 1) >= 0) {
            // Pega a parte inteira da hora
            var hora = parseInt(tempo / 3600);
            // Pega a parte inteira dos minutos
            var min = parseInt((tempo / 60) % 60);
            // Calcula os segundos restantes
            var seg = parseInt(tempo % 60);
            // Formata o número menor que dez, ex: 08, 07, ...
            if (min < 10) {
                min = "0" + min;
                min = min.substr(0, 2);
            }
            if (seg <= 9) {
                seg = "0" + seg;
            }
            //Verifica se está acabando a sessão para exibir o alert de renovação
            if (seg <= tempoAlert && min === '00' && hora === '00') {
                $.alerts.okButton = "Renovar (" + seg + ")";
                $.alerts.cancelButton = "Sair";
                jConfirm('A algum tempo que você está ocioso(a) no SIGAD. Deseja renovar a sessão?', 'Você ainda está aqui?', function(r) {
                    if (r) {
                        clearTimeout(timeoutId);
                        tempo = tempoSegundos;
                        startCountdown();
                        //Renova completamente a sessão do cake
                        <?php echo $renovaSessao; ?>
                    } else {
                        window.open('/usuarios/logout', '_self');
                    }
                });
            }
            // Cria a variável para formatar no estilo hora/cronômetro
            horaImprimivel = '  Tempo restante da sessão <br> 0' + hora +':' + min + ':' + seg;
            //JQuery pra setar o valor
            $("#sessao").html(horaImprimivel).slideDown(300);
            // Define que a função será executada novamente em 1000ms = 1 segundo
            timeoutId = setTimeout('startCountdown()', 1000);
            //Reseta contador quando um elemento tipo submit é clicado
            $(":submit").click(function() {
                clearTimeout(timeoutId);
                tempo = tempoSegundos;
                startCountdown();
            });
            //Renova o contador quando uma requisição ajax é iniciada
            $(document).ajaxStart(function() {
                clearTimeout(timeoutId);
                tempo = tempoSegundos;
                startCountdown();
            });
            // diminui o tempo
            tempo--;
            // Quando o contador chegar a zero faz esta ação
        } else {
            window.open('/usuarios/logout', '_self');
        }
    }
</script>
<style type="text/css">
    #sessao {
        background-size: 15px;
        background-repeat: no-repeat;
        background-position: 2%;
        padding-right: 10px;
        color:#fff;
    }
</style>
<div id="sessao" class="sessao" style="float: right; height: 15px; font-size: 11px; margin-top: 11px; text-align: right; display: none;">
    
</div>
