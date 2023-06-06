-- Tabela "Cliente"
CREATE TABLE cliente (
    id_cliente serial PRIMARY KEY,
    id_pessoa INT
    FOREIGN KEY (id_pessoa) REFERENCES pessoa(id_pessoa)
);