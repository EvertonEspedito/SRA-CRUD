# Sistema de Agendamentos Acadêmicos

Pequeno sistema em PHP para gerenciamento de agendamentos entre alunos e professores, com papel de administrador.

Principais arquivos
- [home.php](home.php) — página inicial com hero e link para login
- [login.php](login.php) — formulário de autenticação
- [valida_login.php](valida_login.php) — validação do login e criação de sessão
- [index.php](index.php) — redireciona usuário para o painel conforme tipo
- [includes/header.php](includes/header.php) e [includes/footer.php](includes/footer.php) — layout comum (header/footer)
- [includes/conexao.php](includes/conexao.php) — conexão MySQL
- [includes/protecao.php](includes/protecao.php) — proteção de páginas (sessão)
- Pastas de área: [admin/](admin), [professor/](professor), [aluno/](aluno)
- CSS principais: [css/style.css](css/style.css), [css/home.css](css/home.css), [css/login.css](css/login.css)

Funcionalidades
- Registro e gerenciamento de usuários (admin)
- Agendamento por aluno (criar/editar/cancelar)
- Aprovação/recusa por professor (com motivo)
- Relatórios (CSV / impressão)
- Painéis separados para admin / professor / aluno

Instalação rápida (XAMPP/LAMP)
1. Copie o diretório para a pasta do servidor (ex.: /opt/lampp/htdocs/agendamento).
2. Crie o banco de dados MySQL e importe a estrutura:
   - Banco: `agendamento`
   - Usuários: tabela `usuarios` (id, nome, email, senha, tipo)
   - Agendamentos: tabela `agendamentos` (id, aluno_id, professor_id, data, hora, status, motivo_recusa)
3. Ajuste credenciais em [includes/conexao.php](includes/conexao.php) se necessário.
4. Acesse no navegador: http://localhost/agendamento/home.php

Exemplo mínimo de tabelas (SQL)
```sql
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150),
  email VARCHAR(150) UNIQUE,
  senha VARCHAR(255),
  tipo ENUM('aluno','professor','admin')
);

CREATE TABLE agendamentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  aluno_id INT,
  professor_id INT,
  data DATE,
  hora TIME,
  status VARCHAR(20) DEFAULT 'pendente',
  motivo_recusa TEXT,
  FOREIGN KEY (aluno_id) REFERENCES usuarios(id),
  FOREIGN KEY (professor_id) REFERENCES usuarios(id)
);
```

Roteiro de uso
- Acesse [home.php](home.php) e clique em "Login" → [login.php](login.php).
- Usuários existentes fazem login; nova conta deve ser criada via painel admin ([admin/usuarios.php](admin/usuarios.php)).
- Após login, [index.php](index.php) redireciona para o painel apropriado.

Soluções rápidas para problemas comuns
- Botão "Login" não funciona: verifique CSS `.layer`/`pointer-events` em [css/home.css](css/home.css) (overlay não deve bloquear cliques).  
- Erro de conexão: confirme dados em [includes/conexao.php](includes/conexao.php).
- Sessões: todas as páginas usam session_start() em [includes/header.php](includes/header.php) e [includes/protecao.php](includes/protecao.php).

Boas práticas / melhorias sugeridas
- Usar prepared statements em todas as consultas que recebem dados do usuário (evitar SQL injection).
- Validar e sanitizar entradas (HTML + server-side).
- Adicionar cadastro de usuário com confirmação por admin ou fluxo de registro.
- Separar CSS/JS em assets versionados e usar build básico (opcional).

Licença
- Projeto para fins educacionais — adapte conforme necessário.

Contato
- Abra uma issue ou edite os arquivos diretamente no diretório do