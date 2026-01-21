# Sistema de Agendamentos Acadêmicos

Este projeto é um **sistema de relatórios de agendamentos** desenvolvido
em **PHP, HTML, CSS e JavaScript**, voltado para **administradores e
professores**.

## 🎯 Funcionalidades

### 👨‍💼 Administrador

-   Visualizar todos os agendamentos
-   Ver estatísticas gerais:
    -   Total de agendamentos
    -   Aceitos
    -   Recusados
    -   Pendentes
-   Análise automática:
    -   Taxa de aceite
    -   Taxa de recusa
    -   Diagnóstico do fluxo
-   Gráficos simulados com CSS (sem bibliotecas externas)
-   Exportar relatório:
    -   CSV
    -   PDF (modo impressão)

### 👨‍🏫 Professor

-   Visualizar apenas seus próprios agendamentos
-   Estatísticas individuais
-   Relatório focado no desempenho do professor
-   Exportação em CSV e PDF

## 🛠 Tecnologias Utilizadas

-   PHP 8+
-   MySQL / MariaDB
-   HTML5
-   CSS3 (Flexbox e Grid)
-   JavaScript Vanilla
-   PDF via `window.print()`
-   Gráficos simulados com CSS (sem Chart.js)

## 📁 Estrutura de Arquivos

    /css
     └── relatorio.css
    /js
     └── relatorio.js
    /admin
     └── relatorio.php
    /professor
     └── relatorio_professor.php
    /export
     ├── export_csv.php
     └── export_pdf.php

## 📊 Análises Geradas

-   Média de aceitação
-   Comparação entre aceitos e recusados
-   Diagnóstico automático do sistema:
    -   Fluxo equilibrado
    -   Alta taxa de recusas
    -   Baixa demanda

## ✅ Requisitos

-   Servidor Apache (XAMPP / LAMP)
-   PHP habilitado
-   Banco de dados configurado
-   Navegador moderno

## 🚀 Como Executar

1.  Clone ou copie o projeto para o diretório do servidor
2.  Configure o banco de dados
3.  Ajuste as sessões de login
4.  Acesse:
    -   `/admin/relatorio.php`
    -   `/professor/relatorio_professor.php`

## 📌 Observações

-   Nenhuma biblioteca externa é necessária
-   Ideal para projetos acadêmicos
-   Fácil adaptação para outros contextos

------------------------------------------------------------------------

Desenvolvido para fins educacionais.