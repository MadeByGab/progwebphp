
Nome: Gabriel Nascimento Feitosa Breguedo
Data: 31/03/2026
------
(Postei no repisótrio sem a pasta porque não consigo por pasta la, mas precisa por rodape, cabeçalho e conexao em uma pasta chamada includes, dentro da pasta aulas.)
```
Aula/
├── index.php           # Página de login
├── produtos.php        # Grid de produtos (área restrita)
├── logout.php          # Encerra a sessão do usuário
└── includes/
    ├── conexao.php     # Conexão com o banco PostgreSQL
    ├── cabecalho.php   # Header reutilizável (include)
    └── rodape.php      # Footer reutilizável (include)
```

## ⚙️ Funcionalidades

- Login com validação via banco de dados (`$_POST` + sessão PHP)
- Proteção de páginas — redireciona para login se não autenticado
- Grid de produtos com checkbox de seleção
- Exibição de status do produto (Ativo / Desativado)
- Logout com destruição de sessão
- Includes para reaproveitamento de código (cabeçalho e rodapé)

## 🗄️ Banco de Dados

Banco: `Produtos` (PostgreSQL)

### Tabela `usuario`
| Campo | Tipo | Descrição |
|---|---|---|
| idusuario | integer (PK) | ID do usuário |
| username | varchar(50) | Nome de usuário |
| password | varchar(32) | Senha |
| status | boolean | Ativo/Inativo |

### Tabela `produto`
| Campo | Tipo | Descrição |
|---|---|---|
| idproduto | integer (PK) | ID do produto |
| produtonome | varchar(100) | Nome do produto |
| produtopreco | real | Preço |
| produtofoto | varchar(150) | Caminho da foto |
| produtostatus | boolean | Ativo/Inativo |

## 🚀 Como Rodar Localmente

### Pré-requisitos
- XAMPP com Apache
- PostgreSQL + PgAdmin 4
- Extensão `pgsql` habilitada no `php.ini`

### Passo a passo

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/seu-repositorio.git
   ```

2. Mova a pasta para:
   ```
   C:\xampp\htdocs\Aula\
   ```

3. No PgAdmin, crie um banco chamado `Produtos` e execute o script SQL para criar as tabelas e inserir os dados iniciais.

4. Ajuste as credenciais em `includes/conexao.php`:
   ```php
   $conn = pg_connect("host=localhost dbname=Produtos user=postgres password=SUA_SENHA");
   ```

5. Inicie o Apache no XAMPP e acesse:
   ```
   http://localhost/Aula/
   ```

6. Login padrão:
   - **Usuário:** `admin`
   - **Senha:** `123456`

## 📚 Conceitos Aplicados

- `$_POST` para captura de dados do formulário de login
- `$_SESSION` para controle de autenticação entre páginas
- `pg_connect()` / `pg_query()` / `pg_fetch_assoc()` para operações no PostgreSQL
- `include` para reutilização de componentes (cabeçalho e rodapé)
- `htmlspecialchars()` para prevenção de XSS
- `pg_escape_string()` para segurança nas queries
