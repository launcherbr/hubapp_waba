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

## 📋 Definição dos Modelos e Amostras (Utility)

| Nome do Template | Texto Sugerido (Corpo com Proteção) | Amostras (Samples) |
| :--- | :--- | :--- |
| `fatura_gerada` | Olá {{1}}, sua fatura #{{2}} no valor de R$ {{3}} foi gerada com vencimento para o dia {{4}}. Acesse seu boleto no link {{5}} para pagamento. | {{1}}: João, {{2}}: 1050, {{3}}: 59.90, {{4}}: 15/02/2026, {{5}}: https://exemplo.com/f |
| `fatura_paga` | Obrigado {{1}}! Confirmamos o recebimento do pagamento referente à fatura #{{2}} em nosso sistema. | {{1}}: João, {{2}}: 1050 |
| `fatura_atrasada_1` | ⚠️ Olá {{1}}, lembramos que a fatura #{{2}} venceu em {{3}}. Pedimos que regularize através do link {{4}} para evitar suspensões. | {{1}}: João, {{2}}: 1050, {{3}}: 10/02/2026, {{4}}: https://exemplo.com/f |
| `fatura_atrasada_2` | ⚠️ Oi {{1}}, o pagamento da fatura #{{2}} (vencida em {{3}}) ainda não foi identificado. Utilize o link {{4}} para concluir o acerto. | {{1}}: João, {{2}}: 1050, {{3}}: 10/02/2026, {{4}}: https://exemplo.com/f |
| `aviso_suspensao` | ❌ ATENÇÃO {{1}}! A fatura #{{2}} (vencida em {{3}}) está com atraso crítico. Regularize agora pelo link {{4}} para manter seu serviço ativo. | {{1}}: João, {{2}}: 1050, {{3}}: 10/02/2026, {{4}}: https://exemplo.com/f |
| `ticket_resposta` | Olá {{1}}, o seu ticket de suporte "{{2}}" recebeu uma nova resposta. Você pode visualizar os detalhes no link {{3}} agora mesmo. | {{1}}: João, {{2}}: Erro no Site, {{3}}: https://exemplo.com/t |
| `admin_novo_ticket` | Alerta Admin: Um novo ticket com o assunto "{{1}}" foi aberto por {{2}}. A prioridade definida é {{3}}. Consulte sua área administrativa. | {{1}}: Erro no Site, {{2}}: João Silva, {{3}}: Alta |
| `admin_login` | Segurança: O usuário administrador {{1}} realizou um novo acesso ao painel do WHMCS neste momento. | {{1}}: admin_xyz |
| `servico_ativo` | Tudo pronto {{1}}! O seu serviço {{2}} foi ativado com sucesso. Seu usuário é {{3}} e a senha definida é {{4}}. Guarde seus dados. | {{1}}: João, {{2}}: meusite.com, {{3}}: joao_user, {{4}}: senha123 |
| `dominio_alerta` | Olá {{1}}, seu domínio {{2}} expira em {{3}} dias, na data {{4}}. Renove agora para garantir a titularidade. | {{1}}: João, {{2}}: meusite.com, {{3}}: 5, {{4}}: 20/02/2026 |
| `aviso_geral` | Comunicado HubApp: {{1}}. Caso tenha qualquer dúvida sobre esta informação, por favor, entre em contato. | {{1}}: Teremos uma manutenção programada hoje. |

---

## ⚠️ Regras Cruciais para Aprovação

1. **Variáveis Proibidas no Fim**: Note que todos os modelos acima terminam com um ponto final ou uma frase curta (ex: "...agora mesmo", "...para pagamento"). Isso é obrigatório.
2. **Saudação no Início**: Da mesma forma, evite começar o template direto com `{{1}}`. Use sempre "Olá", "Oi" ou "Aviso".
3. **Link Seguro**: Sempre que usar uma variável para link (como a `{{5}}` na fatura), coloque um texto explicativo antes e um ponto final depois.

## 📥 Instalação

1.  Suba a pasta `hubapp_waba` para `/modules/addons/`.
2.  Ative em **Ajustes > Módulos Addon**.
3.  Configure o **WhatsApp Admin** para receber os testes de conexão.
4.  Mapeie os nomes dos seus templates aprovados na tabela de configurações.

---

## 🆘 Suporte

Desenvolvido por **HubApp** | Mantido por **Launcher & Co.**
Suporte técnico e atualizações: [licencas.digital](https://licencas.digital)
