
## TCC Engenharia de Software

Código fonte do trabalho de conclusão de curso. 
Estou deixando abaixo algumas instruçẽos de comandos para rodar para criar as tabelas usando as migrations do Larvel e algumas URLS que criei para popular registros no banco a fim de testar o sistema e popular as telas com dados. 

**Rodar comandos abaixo no artisan (terminal)**

- php artisan serve -> Inicia servidor PHP já com a index dentro da public
- php artisan migrate --seed -> cria o banco de dados e roda as seeds predefinidas
- php artisan storage:link -> cria link simbolico para as imagens que ficam guardadas no storage

- /userSeed -> cria 10 usuários com nome e e-mail aleatórios