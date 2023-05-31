-- Tabela "Histórico"
CREATE TABLE Historico (
  id_historico INT PRIMARY KEY,
  id_imovel INT,
  data_atualizacao DATE,
  descricao TEXT,
  FOREIGN KEY (id_imovel) REFERENCES Imovel(id_imovel)
);