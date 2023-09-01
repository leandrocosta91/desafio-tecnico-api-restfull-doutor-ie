# API Doutor IE!

O objetivo de desafio é mostrar a habilidade em construção de API restfull utilizando o framework Laravel. 

O projeto consiste em ter dois end-points: um para listagem de livros e outro para salvar livros.

Ao salvar livros, serão salvos os índices e páginas juntos

A seguir estão as instruções para o projeto executar. É necessário ter o docker instalado na máquina.

1. executar o comando `docker-compose -f "docker-compose.dev.yml" up -d`

2. Entrar no container api_doutor_ie e executar os comandos:
	2.1 `php artisan migrate`
	2.2 `composer install`
	2.3 `npm install`

2 Criar um usuario atravé da view

3. Executar o comando `php artisan passport:client --password` dentro do container

4. Importar arquivo **api-doutor-ie.postman_collection.json** para o postaman

5. Gerar o token através de um cliente http como o postman, acessando a URL http://localhost/oauth/token com o verbo POST
	5.1 Substituir os campos `client_id` e `client_secret` com os valores gerados no passo 2
	5.2 Substituir os campos `username` e `password` com os valores do usuario criado

6. Acessar a request livros.store para registrar livros (Em `Headers`, mudar usar o token gerado no passo 2 na chave `Authorization`)

7. Acessar a request livros.index para listar os livros (Em `Headers`, mudar usar o token gerado no passo 2 na chave `Authorization`)

## Stack utilizada

Versão do laravel 8.83.27
Versão do php 8.1.22
Versão do mysql 5.7.22
Versão do nginx 1.22.1