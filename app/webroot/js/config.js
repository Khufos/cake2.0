var endHost = window.location.hostname;
var subdominio = endHost.search('sigad.')
/* Configura os endereços dos itens de acordo com o endereço do servidor*/
var endImageCalendario = "/img/calendar.gif";
var endListaAssistido = endHost + "/";
if (subdominio != -1) { // eh subdominio
    endListaAssistido = endHost + "/";
    endImageCalendario = '/img/calendar.gif';
}


