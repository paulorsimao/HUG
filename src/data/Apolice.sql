-- Tabela "Apólice"
CREATE TABLE Apolice (
  id_apolice INT PRIMARY KEY,
  id_imovel INT,
  id_cliente INT,
  data_inicio DATE,
  data_fim DATE,
  valor_cobertura DECIMAL(10,2),
  FOREIGN KEY (id_imovel) REFERENCES Imovel(id_imovel),
  FOREIGN KEY (id_cliente) REFERENCES Cliente(id_cliente)
);