# Teste para Desenvolvedor Fullstack

- Para executar o projeto basta disponibilizar o mesmo em um servidor web que rode PHP 5.4 como virtualHost com modulo rewrite habilitado;
- Caso execute em um servidor LINUX, deve dar permissão de escrita nos diretorios:
-- data/cache
-- dta/DoctrineORMModule
-- data/upload
- Deve ser executado o script sql que esta no diretorio resource/avaliacao-essentia.sql
- Configurar o arquivo config/define/production.php com os parametros da base de dados nas variaveis:
-- define('ENV_DB_HOST',       '127.0.0.1');
-- define('ENV_DB_NAME',       'essentia');
-- define('ENV_DB_USER',       'root');
-- define('ENV_DB_PASSWORD',   '');
- O projeto possui composer configurado, mas esta versionado todas as bibliotecas
