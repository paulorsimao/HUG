-- Tabela "Corretor"
CREATE TABLE corretor (
    id_corretor SERIAL PRIMARY KEY,
    id_seguradora INT,
    id_pessoa INT,
    FOREIGN KEY (id_pessoa) REFERENCES pessoa(id_pessoa)
    FOREIGN KEY (id_seguradora) REFERENCES seguradora(id_seguradora)
);