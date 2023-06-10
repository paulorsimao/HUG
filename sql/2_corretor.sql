-- Tabela "Corretor"
CREATE TABLE corretor (
    id_seguradora INT NOT NULL,
    id_pessoa INT NOT NULL,
    FOREIGN KEY (id_pessoa) REFERENCES pessoa(id_pessoa),
    FOREIGN KEY (id_seguradora) REFERENCES seguradora(id_seguradora)
);

ALTER TABLE corretor ADD PRIMARY KEY (id_seguradora, id_pessoa);
