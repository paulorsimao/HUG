-- Tabela "Sinistro"
CREATE TABLE Sinistro (
  id_sinistro INT PRIMARY KEY,
  id_imovel INT,
  data_ocorrencia DATE,
  descricao TEXT,
  valor_prejuizo DECIMAL(10,2),
  FOREIGN KEY (id_imovel) REFERENCES Imovel(id_imovel)
);