#!/bin/bash

arquivos_sql=$(find -name "*.sql")

docker exec -i postgres psql -U postgres -c "create database segurosseg"

for arquivo in $arquivos_sql; do
    sql=$(cat "$arquivo")

    docker exec -i postgres psql -U postgres -d segurosseg -c "$sql"
    sql_status=$?

    if [[ $sql_status -ne 0 ]]; then
        echo "Erro ao executar -> $arquivo"
        exit $sql_status
    else
        echo "$arquivo -> executado com sucesso."
    fi
done

echo "Criação concluída"