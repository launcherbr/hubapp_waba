# 📝 Guia de Modelos HubApp WABA (Versão Anti-Rejeição Final)

Este guia contém os textos corrigidos para cadastro na Meta. Todos os modelos terminam com **texto fixo** após a última variável para garantir a aprovação na categoria **Utilidade**.

---

## 🏛️ Estrutura Global (Branding)
* **Cabeçalho (Header):** Texto: `LD | HubApp`
* **Rodapé (Footer):** Texto: `LD | HubApp - Launcher & Co.`

---

## 📋 Modelos para Cadastro na Meta

| Nome do Template | Texto Sugerido (Corpo do Template) | Amostras (Samples) |
| :--- | :--- | :--- |
| `fatura_gerada` | Olá {{1}}, sua fatura #{{2}} no valor de R$ {{3}} foi gerada com vencimento em {{4}}. Você pode acessar seu boleto no link {{5}} para realizar o pagamento agora. | {{1}}: João, {{2}}: 1050, {{3}}: 59.90, {{4}}: 15/02/2026, {{5}}: https://sua.loja/f |
| `fatura_paga` | Obrigado {{1}}! Confirmamos o recebimento do pagamento referente à fatura #{{2}} com sucesso em nosso sistema. | {{1}}: João, {{2}}: 1050 |
| `fatura_atrasada` | ⚠️ Olá {{1}}, lembramos que a fatura #{{2}} venceu em {{3}}. Pedimos que regularize através do link {{4}} para evitar suspensões em sua conta. | {{1}}: João, {{2}}: 1050, {{3}}: 10/02/2026, {{4}}: https://sua.loja/f |
| `ticket_resposta` | Olá {{1}}, o seu ticket de suporte "{{2}}" recebeu uma nova resposta. Você pode visualizar os detalhes no link {{3}} para acompanhar o atendimento. | {{1}}: João, {{2}}: Erro no Site, {{3}}: https://sua.loja/t |
| `servico_ativo` | Boas notícias {{1}}! O seu novo plano para {{2}} já está liberado. Você pode conferir as instruções e dados de acesso no link {{3}} de forma segura. | {{1}}: João, {{2}}: meusite.com, {{3}}: https://sua.loja/s |
| `servico_suspenso` | Olá {{1}}, informamos que o seu serviço {{2}} foi temporariamente suspenso. Para entender o motivo e reativar sua conta, acesse o link {{3}} imediatamente. | {{1}}: João, {{2}}: meusite.com, {{3}}: https://sua.loja/s |
| `dominio_expirando` | Prezado(a) {{1}}, o domínio {{2}} expira em {{3}} dias, na data {{4}}. Para evitar que seu site fique fora do ar, renove pelo link {{5}} o quanto antes. | {{1}}: João, {{2}}: meusite.com, {{3}}: 5, {{4}}: 20/02/2026, {{5}}: https://sua.loja/d |
| `admin_novo_ticket` | Alerta Admin: Um novo ticket com o assunto "{{1}}" foi aberto por {{2}}. A prioridade definida para este atendimento é {{3}} no momento. | {{1}}: Erro no Site, {{2}}: João Silva, {{3}}: Alta |
| `admin_login` | Segurança: O usuário administrador {{1}} realizou um novo acesso ao painel de gestão do WHMCS através deste dispositivo. | {{1}}: admin_xyz |
| `aviso_geral` | Comunicado HubApp: {{1}}. Caso tenha qualquer dúvida sobre esta informação, entre em contato com nosso suporte oficial. | {{1}}: Teremos uma manutenção programada hoje. |

---

## ⚠️ Regras Cruciais de Cadastro

1. **Variáveis no Fim**: Note que todos os modelos acima terminam com palavras como "...agora", "...no momento" ou "...dispositivo". O ponto final sozinho após a variável causa rejeição.
2. **Nomes dos Templates**: Use exatamente os nomes da coluna "Nome do Template" para que o mapeamento no WHMCS funcione.
3. **Links**: Sempre inclua um link real nas amostras de aprovação para que a Meta valide a categoria Utilidade.