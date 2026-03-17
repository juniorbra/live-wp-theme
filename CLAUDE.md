# CLAUDE.md — Tema WordPress: Aliança Consultoria e Engenharia

## Sobre o Projeto

Tema WordPress customizado (from scratch, sem page builder) para a **Aliança Consultoria e Engenharia** — empresa B2B de alto padrão com mais de 20 anos de experiência em consultoria técnica nas áreas de Engenharia, Economia, Finanças e Atuária.

Escritórios em **Rio de Janeiro** e **São Paulo**. Atende empresas nacionais e multinacionais de grande porte.

## Identidade e Tom

- Corporativo, técnico, sóbrio e confiável
- Público-alvo: advogados, gestores jurídicos, diretores financeiros, seguradoras, construtoras
- Sigilo e discrição são valores centrais do negócio — evitar linguagem sensacionalista
- Todo o conteúdo é em **português brasileiro**

## Serviços da Empresa

1. **Assistência Técnica em Processos Judiciais, Arbitragens e Mediações** — suporte técnico especializado para questões complexas em Engenharia
2. **Análise de Equilíbrio Econômico-Financeiro de Contratos** — identificação, quantificação e valoração de desequilíbrios contratuais
3. **Pareceres Técnicos e Laudos de Engenharia** — laudos especializados para suporte técnico judicial e extrajudicial
4. **Pareceres Técnicos e Laudos de Economia, Finanças e Atuária** — análises detalhadas em economia, atuária e finanças
5. **Gerenciamento de Projetos e Obras** — Engenharia do Proprietário, coordenação de projetos, acompanhamento e fiscalização

## Setores Atendidos

Fundos de pensão, seguradoras, resseguradoras, empresas reguladoras de sinistros, escritórios de advocacia, instituições financeiras, bancos, mercado financeiro, construtoras, incorporadoras, shopping centers, mercado varejista (vestuário, farmacêutico, alimentos), concessionárias de serviços públicos, condomínios, portos e aeroportos.

## Estrutura de Arquivos do Tema

```
wp-alianca-engenharia/
├── style.css               # Cabeçalho do tema (Theme Name, Version etc.)
├── functions.php           # Registro de scripts, CPTs, configurações
├── front-page.php          # Página inicial (hero, serviços, depoimentos etc.)
├── page-quem-somos.php     # Página institucional
├── page-contato.php        # Página de contato
├── header.php              # Cabeçalho global (nav, logo)
├── footer.php              # Rodapé global
├── archive-servicos.php    # Listagem de serviços (CPT)
├── single-servicos.php     # Página individual de serviço
├── archive-noticias.php    # Listagem de notícias/blog (CPT)
├── single-noticias.php     # Post individual de notícia
├── home.php                # Blog index
├── archive.php             # Arquivo genérico
├── single.php              # Post padrão
├── search.php              # Resultados de busca
├── page.php                # Página padrão
├── 404.php                 # Página de erro
├── comments.php            # Comentários
├── assets/
│   ├── css/main.css        # CSS principal (design tokens + componentes)
│   └── js/navigation.js    # JS do menu mobile
└── docker-compose.yml      # Ambiente de desenvolvimento local
```

## Ambiente de Desenvolvimento

- Rodando via **Docker Compose** localmente
- Volumes Docker externos: `live-wp-theme_*` (declarados como `external: true` no compose)
- Proxy via **Cloudflare Tunnel** — não usar IP direto para testar URLs públicas

## Convenções de Código

- CSS usa **design tokens** em variáveis CSS (`:root`) definidas em `assets/css/main.css`
- Classes CSS seguem convenção **BEM** (`.hero__title`, `.btn--accent` etc.)
- PHP segue padrões WordPress (funções prefixadas com `alianca_`, escape com `esc_url()`, `esc_html()`)
- Sem dependência de page builders (Elementor, Divi etc.) — HTML/PHP puro
- WordPress `Text Domain`: `alianca`

## Responsividade

- Mobile-first
- Breakpoint principal desktop: `64rem` (1024px)
- Breakpoint tablet: `48rem` (768px)
- Breakpoint small mobile: `36rem` (576px)

## Integrações

- **WhatsApp**: CTA principal para agendamento de consultas (`ALIANCA_WHATSAPP_URL`)
- **LinkedIn**: botão no hero linkando para a empresa
- Contato via formulário na `page-contato.php`
