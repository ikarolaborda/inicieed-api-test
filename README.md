# API Teste Inicie Educação

Esta API foi desenvolvida para o teste de desenvolvedor da Inicie Educação, utilizando as seguintes tecnologias:
* [PHP](https://php.com)
* [Laravel](https://laravel.com/)
* [MySQL](https://www.mysql.com/) # Somente para uso local se julgar necessario
* [Docker](https://www.docker.com/)
* [Docker Compose](https://docs.docker.com/compose/)
* [Swagger](https://swagger.io/)

## Instalação

Aviso: para usar este aplicativo de forma mais simples e objetiva, tenha instalado localmente o  [Docker](https://www.docker.com/) e o [Docker Compose](https://docs.docker.com/compose/).

1 - Para instalar o projeto, clone este repo e a seguir, execute os comandos abaixo:

```bash
    make build
    make dci
```

Deve-se atentar para o fato de que o arquivo ``.env`` necessita um valor para a chave ``GOREST_ACCESS_TOKEN``, que pode ser obtido no site [GoRest](https://gorest.co.in/).

Isso criará os containers necessários para rodar o app.

### Teste e Documentação
Este projeto usa o [Swagger](https://swagger.io/) para documentação de endpoints. Para acessar a documentação, acesse o link abaixo:
```bash
        http://localhost:8000/
```
Para correr os testes, use o comando abaixo:
```bash
    make test
```

### Disclaimer
- Esta aplicação foi requerida com um nível de complexidade baixo, portanto, algumas abstrações que deveriam estar presentes em um cenário real, foram deixadas de lado. 
Por exemplo, a separação de responsabilidades entre as entidades/concerns, temos nesta aplicação, somente um controller ``ApiController`` que contempla todos os endpoints, mas no cenário real, podemos enxergar 3
entidades distintas ``User``, ``Post`` e ``Comment``. Sendo assim, deveriam existir 3 servicos distintos, cada um com sua responsabilidade, e cada um com seu respectivo controller.
- O Arquivo de testes unitários tem como ultimo teste um teste end to end (e2e), que não deveria estar ali, mas como não foi exigido complexidade similar à real, optei por deixá-lo ali.
