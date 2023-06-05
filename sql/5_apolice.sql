-- Tabela "Apólice"
CREATE TABLE apolice (
  id_apolice INT PRIMARY KEY,
  id_imovel INT,
  id_cliente INT,
  data_inicio DATE,
  data_fim DATE,
  valor_cobertura DECIMAL(10,2),
  FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel),
  FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
);