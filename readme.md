# 📱 HubApp WABA WHMCS (API Oficial Meta)

Módulo de integração profissional para envio de notificações via **WhatsApp Business API (WABA)** diretamente pela infraestrutura da Meta. Desenvolvido para garantir alta entrega e conformidade com as políticas da API Oficial.

---

## 🚀 Funcionalidades

* **Conexão Direta (Graph API)**: Dispensa gateways intermediários (v21.0+).
* **Sanitização v1.0.8**: Tratamento automático de variáveis para evitar o erro Meta #132018.
* **Branding Nativo**: Suporte para Cabeçalho e Rodapé institucionais (LD | HubApp).
* **Segurança**: Substituição de envio de senhas por links diretos de acesso.

---

## 📂 Estrutura do Módulo

* `hubapp_waba.php`: Interface administrativa v1.0.9.
* `hooks.php`: Lógica de gatilhos e despacho de variáveis.
* `lib/HubAppWabaClient.php`: Motor de envio e limpeza de strings.
* `index.php`: Proteção de diretórios.

---

## 📋 Mapeamento Técnico de Variáveis

Ao configurar seus templates na Meta, as variáveis `{{n}}` receberão os seguintes dados vindos do WHMCS:

| Evento | Variável 1 | Variável 2 | Variável 3 | Variável 4 | Variável 5 |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Fatura Gerada** | Nome | ID Fatura | Valor | Vencimento | Link Fatura |
| **Fatura Paga** | Nome | ID Fatura | - | - | - |
| **Lembretes Atraso** | Nome | ID Fatura | Vencimento | Link Fatura | - |
| **Ticket Resposta** | Nome | Assunto | Link Ticket | - | - |
| **Serviço Ativado** | Nome | Domínio | Link Serviço | - | - |
| **Serviço Suspenso** | Nome | Domínio | Link Serviço | - | - |
| **Expiração Domínio** | Nome | Domínio | Dias | Data Exp. | Link Renova |
| **Login Admin** | User | - | - | - | - |
| **Aviso Manual** | Conteúdo | - | - | - | - |

---

## 🛠️ Configuração Rápida

1. **Endpoint**: `https://graph.facebook.com/v21.0/ID_DO_NUMERO/`
2. **Token**: Insira o Token de Acesso Permanente da Meta.
3. **Mapeamento**: No painel do addon, insira os nomes dos templates conforme aprovados na Meta (ex: `fatura_gerada`).

---

## 🆘 Suporte e Documentação de Modelos

* **Modelos de Texto**: Veja o arquivo `TEMPLATES.md` para sugestões de textos anti-rejeição.
* **Desenvolvido por**: HubApp / Launcher & Co.
* **Suporte**: [licencas.digital](https://licencas.digital)