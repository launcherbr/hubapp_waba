<?php
/**
 * HubApp WABA WHMCS - Hooks Oficiais
 * Versão: 1.0.7
 * Mapeamento de 12 templates com suporte a Header/Footer fixos.
 */

if (!defined("WHMCS")) die("Access Denied");

use WHMCS\Database\Capsule;
use HubAppWabaModule\HubAppWabaClient;

require_once __DIR__ . '/lib/HubAppWabaClient.php';

/**
 * Função auxiliar para despachar o template baseado no evento.
 */
function waba_dispatch($eventKey, $uid, $params) {
    $templateName = Capsule::table('tbladdonmodules')
        ->where('module', 'hubapp_waba')
        ->where('setting', 'tplname_' . $eventKey)
        ->value('value');

    if (empty($templateName)) return;

    return HubAppWabaClient::sendTemplate($uid, $templateName, $params);
}

// 1. Fatura Gerada
// Variáveis: {{1}} Nome, {{2}} ID, {{3}} Valor, {{4}} Vencimento, {{5}} Link
add_hook('InvoiceCreationPreEmail', 1, function($vars) {
    $inv = Capsule::table('tblinvoices')->where('id', $vars['invoiceid'])->first();
    if (!$inv) return;
    $cli = Capsule::table('tblclients')->where('id', $inv->userid)->first();
    $url = Capsule::table('tblconfiguration')->where('setting', 'SystemURL')->value('value') . "viewinvoice.php?id=" . $vars['invoiceid'];

    waba_dispatch('InvoiceCreated', $cli->id, [
        $cli->firstname, 
        $vars['invoiceid'], 
        $inv->total, 
        fromMySQLDate($inv->duedate), 
        $url
    ]);
});

// 2. Pagamento Confirmado
// Variáveis: {{1}} Nome, {{2}} ID da Fatura
add_hook('InvoicePaid', 1, function($vars) {
    $inv = Capsule::table('tblinvoices')->where('id', $vars['invoiceid'])->first();
    $cli = Capsule::table('tblclients')->where('id', $inv->userid)->first();
    waba_dispatch('InvoicePaid', $cli->id, [$cli->firstname, $vars['invoiceid']]);
});

// 3, 4 e 5. Lembretes de Fatura (1º, 2º e 3º avisos)
// Variáveis: {{1}} Nome, {{2}} ID, {{3}} Vencimento, {{4}} Link
add_hook('InvoicePaymentReminder', 1, function($vars) {
    $inv = Capsule::table('tblinvoices')->where('id', $vars['invoiceid'])->first();
    $cli = Capsule::table('tblclients')->where('id', $inv->userid)->first();
    $url = Capsule::table('tblconfiguration')->where('setting', 'SystemURL')->value('value') . "viewinvoice.php?id=" . $vars['invoiceid'];
    
    $type = ($vars['type'] == 'first') ? 'First' : (($vars['type'] == 'second') ? 'Second' : 'Third');

    waba_dispatch('InvoicePaymentReminder' . $type, $cli->id, [
        $cli->firstname, 
        $vars['invoiceid'], 
        fromMySQLDate($inv->duedate), 
        $url
    ]);
});

// 6. Resposta em Ticket
// Variáveis: {{1}} Nome, {{2}} Assunto, {{3}} Link
add_hook('TicketAdminReply', 1, function($vars) {
    $ticket = Capsule::table('tbltickets')->where('id', $vars['ticketid'])->first();
    $cli = Capsule::table('tblclients')->where('id', $ticket->userid)->first();
    $url = Capsule::table('tblconfiguration')->where('setting', 'SystemURL')->value('value') . "viewticket.php?tid=" . $ticket->tid . "&c=" . $ticket->c;

    waba_dispatch('TicketAdminReply', $cli->id, [$cli->firstname, $ticket->title, $url]);
});

// 7. Admin: Novo Ticket
// Variáveis: {{1}} Assunto, {{2}} Nome Cliente, {{3}} Prioridade
add_hook('TicketOpen', 1, function($vars) {
    $config = Capsule::table('tbladdonmodules')->where('module', 'hubapp_waba')->pluck('value', 'setting');
    if ($config['tplname_TicketOpenAdmin'] && $config['admin_whatsapp']) {
        $clientName = ($vars['userid']) ? Capsule::table('tblclients')->where('id', $vars['userid'])->value('firstname') : "Visitante";
        HubAppWabaClient::sendTemplateByNumber($config['admin_whatsapp'], $config['tplname_TicketOpenAdmin'], [
            $vars['subject'], 
            $clientName, 
            $vars['priority']
        ]);
    }
});

// 8. Alerta de Login Admin
// Variáveis: {{1}} Usuário
add_hook('AdminLogin', 1, function($vars) {
    $config = Capsule::table('tbladdonmodules')->where('module', 'hubapp_waba')->pluck('value', 'setting');
    if ($config['tplname_AdminLogin'] && $config['admin_whatsapp']) {
        HubAppWabaClient::sendTemplateByNumber($config['admin_whatsapp'], $config['tplname_AdminLogin'], [$vars['username']]);
    }
});

// 9. Serviço Ativado
// Variáveis: {{1}} Nome, {{2}} Domínio, {{3}} Usuário, {{4}} Senha
add_hook('AfterModuleCreate', 1, function($vars) {
    $p = $vars['params'];
    $firstName = Capsule::table('tblclients')->where('id', $p['userid'])->value('firstname');
    waba_dispatch('AfterModuleCreate', $p['userid'], [
        $firstName, 
        $p['domain'], 
        $p['username'], 
        $p['password']
    ]);
});

// 10. Serviço Suspenso
// Variáveis: {{1}} Nome, {{2}} Domínio
add_hook('AfterModuleSuspend', 1, function($vars) {
    $p = $vars['params'];
    $firstName = Capsule::table('tblclients')->where('id', $p['userid'])->value('firstname');
    waba_dispatch('AfterModuleSuspend', $p['userid'], [$firstName, $p['domain']]);
});

// 11. Expiração de Domínio
// Variáveis: {{1}} Nome, {{2}} Domínio, {{3}} Dias, {{4}} Data
add_hook('DomainRenewalNotice', 1, function($vars) {
    $dom = Capsule::table('tbldomains')->where('id', $vars['domainid'])->first();
    $cli = Capsule::table('tblclients')->where('id', $dom->userid)->first();
    waba_dispatch('DomainRenewalNotice', $cli->id, [
        $cli->firstname, 
        $dom->domain, 
        $vars['daysuntilexpiry'], 
        fromMySQLDate($dom->expirydate)
    ]);
});