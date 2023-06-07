# HUG Sistema

## Instalar php
- Baixar e instalar o **[Wampserver](https://sourceforge.net/projects/wampserver/)**;
- Habilitar **Versão 7 do PHP**:
    - Nas configurações do **Wampserver** na bandeja do **Windows** clicar em **PHP -> Version -> Selecionar a versão 7**;
- Habilitar extensão do postgres:
    - Nas configurações do **Wampserver** na bandeja do **Windows** clicar em **PHP -> PHP Extensions**;
    - Habilitar **pgsql**;
    - Habilitar **pdo_pgsql**;
- Colocar o projeto na pasta `www` do **Wampserver**. (Geralmente a pasta Wampserver fica no c:/);
- Copiar o arquivo `example.env` na pasta sistema para o arquivo `.env` e alterar todas variaveis de ambiente de acordo com usa necessidade;

## Instalar postgres
- Seguir esse passo a passo: **[instalar postgres](https://blog.cod3r.com.br/como-instalar-o-postgresql-no-windows/#:~:text=Como%20instalar%20o%20PostgreSQL%20no%20Windows%201%20Download,fazer%20as%20configura%C3%A7%C3%B5es%20necess%C3%A1rias%20na%20sua%20aplica%C3%A7%C3%A3o.%20)**;
- As variáveis usadas na instalação devem ser informadas no arquivo `.env`.

## Rodar o sistema
- Iniciar o apache;
- Abrir `localhost/[pasta-do-projeto]/sistema/imovel`.
