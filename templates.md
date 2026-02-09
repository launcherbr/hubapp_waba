# 📝 Guia de Modelos HubApp WABA

Este guia detalha a configuração visual e estrutural necessária no **Gerenciador de Negócios da Meta** para que as automações do WHMCS funcionem corretamente.

---

## 🏛️ Estrutura Global (Branding)
Para todos os templates onde o módulo estiver configurado com **Header** e **Footer** ativos, utilize:

* **Cabeçalho (Header):** Tipo "Texto". Conteúdo: `LD | HubApp`
* **Rodapé (Footer):** Conteúdo: `LD | HubApp - Launcher & Co.`

---

## 📋 Definição dos Modelos e Amostras (Utility)

Configure todos os modelos abaixo na categoria **Utilidade (Utility)**. Ao enviar para aprovação, utilize as amostras sugeridas para evitar rejeições.

### 1. Faturamento e Cobrança
As variáveis devem seguir a ordem exata para que o `hooks.php` preencha os dados corretamente.

| Nome do Template | Texto Sugerido (Corpo) | Amostras (Samples) para Aprovação |
| :--- | :--- | :--- |
| `fatura_gerada` | Olá {{1}}, sua fatura #{{2}} no valor de R$ {{3}} foi gerada com vencimento em {{4}}. Link: {{5}} | {{1}}: João, {{2}}: 1050, {{3}}: 59.90, {{4}}: 15/02/2026, {{5}}: https://exemplo.com/fatura |
| `fatura_paga` | Obrigado {{1}}! Confirmamos o pagamento da fatura #{{2}}. Seus serviços seguem ativos. | {{1}}: João, {{2}}: 1050 |
| `fatura_atrasada_1` | ⚠️ Olá {{1}}, lembramos que a fatura #{{2}} venceu em {{3}}. Para evitar suspensão, pague em: {{4}} | {{1}}: João, {{2}}: 1050, {{3}}: 10/02/2026, {{4}}: https://exemplo.com/fatura |
| `fatura_atrasada_2` | ⚠️ Oi {{1}}, o pagamento da fatura #{{2}} (vencida em {{3}}) ainda não consta. Precisa de ajuda? Link: {{4}} | {{1}}: João, {{2}}: 1050, {{3}}: 10/02/2026, {{4}}: https://exemplo.com/fatura |
| `aviso_suspensao` | ❌ ATENÇÃO {{1}}! A fatura #{{2}} (vencimento {{3}}) está com atraso crítico. Pague agora para evitar bloqueio: {{4}} | {{1}}: João, {{2}}: 1050, {{3}}: 10/02/2026, {{4}}: https://exemplo.com/fatura |

### 🛠️ Suporte e Administração
| Nome do Template | Texto Sugerido (Corpo) | Amostras (Samples) para Aprovação |
| :--- | :--- | :--- |
| `ticket_resposta` | Olá {{1}}, seu ticket "{{2}}" recebeu uma nova resposta. Acesse para ler: {{3}} | {{1}}: João, {{2}}: Erro no Site, {{3}}: https://exemplo.com/ticket |
| `admin_novo_ticket` | Alerta Admin: Novo ticket "{{1}}" aberto por {{2}}. Prioridade: {{3}}. | {{1}}: Erro no Site, {{2}}: João Silva, {{3}}: Alta |
| `admin_login` | Segurança: O usuário {{1}} acabou de acessar o painel administrativo do WHMCS. | {{1}}: administrador_xyz |

### 📦 Entrega e Domínios
| Nome do Template | Texto Sugerido (Corpo) | Amostras (Samples) para Aprovação |
| :--- | :--- | :--- |
| `servico_ativo` | Tudo pronto {{1}}! Seu serviço {{2}} foi ativado. User: {{3}} / Senha: {{4}} | {{1}}: João, {{2}}: meusite.com, {{3}}: joao_user, {{4}}: senha123 |
| `dominio_alerta` | Olá {{1}}, seu domínio {{2}} expira em {{3}} dias ({{4}}). Renove agora para não perder a titularidade. | {{1}}: João, {{2}}: meusite.com, {{3}}: 5, {{4}}: 20/02/2026 |

### 💬 Envio Manual
| Nome do Template | Texto Sugerido (Corpo) | Amostras (Samples) para Aprovação |
| :--- | :--- | :--- |
| `aviso_geral` | Aviso importante da HubApp: {{1}}. Em caso de dúvidas, fale conosco. | {{1}}: O sistema passará por manutenção às 22h. |

---

## ⚠️ Regras de Segurança (Anti-Rejeição)

1.  **Variáveis Abraçadas**: Nunca deixe uma variável no início ou fim absoluto.
    * ❌ `{{1}}, como vai?`
    * ✅ `Olá {{1}}, como vai?`
2.  **Limpeza Automática**: O módulo remove quebras de linha (`\n`) das variáveis. Se desejar quebras de linha na mensagem, insira-as diretamente no texto fixo do template no Gerenciador da Meta.
3.  **Links**: Se o template contiver links, forneça o link completo do seu WHMCS na amostra de aprovação.