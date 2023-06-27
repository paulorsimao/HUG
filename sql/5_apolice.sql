-- Tabela "Apólice"
CREATE TABLE apolice (
    id_apolice SERIAL PRIMARY KEY,
    id_imovel INT NOT NULL,
    id_corretor_pessoa NOT NULL,
    id_corretor_seguradora NOT NULL,
    data_inicio DATE NOT NULL,
    data_fim DATE NOT NULL,
    valor_cobertura DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel),
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
    FOREIGN KEY (id_corretor_seguradora, id_corretor_pessoa) REFERENCES corretor(id_seguradora, id_pessoa);
);
