# Passos para executar
Sugiro utilizar o  [Homestead](https://laravel.com/docs/6.x/homestead) como ambiente de execução, mas caso já possua o ambiente configurado localmente só seguir os passos.

**Rodar composer!**
> php composer install

**Criar arquivo .env**
Execute o seguinte comando e altere dentro do arquivo .env os dados referentes a conexão com o banco de dados
> copy .env.example .env

**Gerar a chave do aplicativo laravel**
> php artisan key:generate

**Executar migrações**
> php artisan migrate

**Gerar link simbolico para os arquivos**
> php artisan storage:link

**Colocar as filas para executar**
> php artisan queue:work

**Acompanhar logs**
> tail -f ./storage/logs/crawler
