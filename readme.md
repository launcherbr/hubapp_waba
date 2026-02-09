# 📱 HubApp WABA WHMCS (API Oficial Meta)

Módulo de integração profissional para envio de notificações via **WhatsApp Business API (WABA)** diretamente pela infraestrutura da Meta. Desenvolvido para garantir alta entrega, conformidade e identidade visual consistente.

---

## 🚀 Funcionalidades

* **Conexão Direta (Graph API)**: Dispensa gateways intermediários, utilizando o endpoint oficial da Meta.
* **Sanitização Inteligente**: Tratamento automático de variáveis para evitar o erro Meta #132018 (proibição de quebras de linha em parâmetros).
* **Régua de Cobrança em 3 Níveis**: Mensagens diferenciadas para 1º, 2º e 3º avisos de atraso.
* **Componentes Fixos (Branding)**: Suporte nativo para Cabeçalho e Rodapé institucionais (LD | HubApp).
* **Gestão de Templates**: Mapeamento completo para 12 eventos essenciais do WHMCS.

---

## 📂 Estrutura do Módulo

* `hubapp_waba.php`: Interface administrativa e configurações de endpoint.
* `hooks.php`: Lógica de gatilhos e organização das variáveis `{{n}}`.
* `lib/HubAppWabaClient.php`: Motor de envio, tratamento de JSON e componentes fixos.
* `index.php`: Camada de segurança para proteção de diretórios.

---

## 🛠️ Configuração Técnica

### 1. Endpoint e Credenciais
No painel do módulo, configure:
* **Endpoint WABA**: `https://graph.facebook.com/v21.0/SEU_PHONE_NUMBER_ID/`
* **API Token**: Seu Token de Acesso Permanente gerado no Meta for Developers.

### 2. Criação de Templates (Meta Business Suite)
Para garantir a aprovação e o funcionamento:
* **Categoria**: Utilize "Utilidade" (Utility).
* **Variáveis**: Devem estar cercadas por texto fixo. O módulo removerá `\n` automaticamente das variáveis para evitar rejeição da API.
* **Componentes**: Se ativar Header/Footer no módulo, o template na Meta deve possuir esses campos ativos.

---

## 📋 Mapeamento de Variáveis (Exemplos)

| Evento | Ordem das Variáveis no Corpo |
| :--- | :--- |
| **Fatura Gerada** | `{{1}}` Nome, `{{2}}` ID, `{{3}}` Valor, `{{4}}` Vencimento, `{{5}}` Link |
| **Lembretes Atraso** | `{{1}}` Nome, `{{2}}` ID, `{{3}}` Vencimento, `{{4}}` Link |
| **Ticket Suporte** | `{{1}}` Nome, `{{2}}` Assunto, `{{3}}` Link |
| **Ativação Serviço** | `{{1}}` Nome, `{{2}}` Domínio, `{{3}}` User, `{{4}}` Pass |

---

## 📥 Instalação

1.  Suba a pasta `hubapp_waba` para `/modules/addons/`.
2.  Ative em **Ajustes > Módulos Addon**.
3.  Configure o **WhatsApp Admin** para receber os testes de conexão.
4.  Mapeie os nomes dos seus templates aprovados na tabela de configurações.

---

## 🆘 Suporte

Desenvolvido por **HubApp** | Mantido por **Launcher & Co.**
Suporte técnico e atualizações: [licencas.digital](https://licencas.digital)