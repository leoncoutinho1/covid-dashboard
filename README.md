## Painel de estatísticas do COVID19

Tecnologias utilizadas:
- Laravel
- Sqlite
- Redis
- ChartJS

- Pré-requisitos:
    - [PHP](https://www.php.net/downloads)
    - [Composer](https://getcomposer.org/download/)
    - [Redis](https://redis.io/download)
    
### Fazendo o download do projeto

Abaixo descrevo os passos necessários para baixar e configurar o projeto:

1. Após instalação dos pré-requisitos fazer o download pelo github ou executar o comando abaixo no terminal:
`git clone https://github.com/leoncoutinho1/covid-dashboard.git`

2. Instalar as dependências da aplicação com o comando:
`composer install`

3. Renomear o arquivo '.env.example' para '.env' e substituir as seguintes informações:
    APP_NAME=Painel_COVID19
    ...
    DB_CONNECTION=sqlite
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=.../database/database.sqlite   <-- aqui deve ser inserido o caminho absoluto do arquivo
    DB_USERNAME=root
    DB_PASSWORD=
    ...
    CACHE_DRIVER=redis

4. Iniciar a aplicação com o comando:
`php artisan serve`

### Utilizando a aplicação

Após se registrar, a aplicação redireciona para tela principal onde podem ser visualizados os dados do país selecionado:

<img src='/public/img/geral.png'/>

Para selecionar outro país basta utilizar o select option conforme na figura abaixo:

<img src='/public/img/option.png'/>

Para extrair relatório passando a data desejada pode ser acessado o menu Relatório.

<img src='/public/img/relatorio.png' />

No menu dados são exibidas algumas informações do país selecionado no formato PDF.


## Author

* **Leonardo Coutinho** - [@leoncoutinho1](https://github.com/leoncoutinho1/)
