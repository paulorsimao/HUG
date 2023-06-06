-- Tabela "Corretor"
CREATE TABLE corretor (
    id_corretor SERIAL PRIMARY KEY,
    FOREIGN KEY (id_pessoa) REFERENCES pessoa(id_pessoa)
);