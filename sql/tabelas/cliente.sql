-- Tabela "Cliente"
CREATE TABLE cliente (
    id_cliente SERIAL PRIMARY KEY,
    id_pessoa INT NOT NULL,
    FOREIGN KEY (id_pessoa) REFERENCES pessoa(id_pessoa)
);

CREATE INDEX idx_fk_cliente_pessoa ON cliente (id_pessoa);