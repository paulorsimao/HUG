-- Stored Procedure para INSERT na tabela Imovel
CREATE PROCEDURE sp_InserirImovel
    @tipo INT,
    @area DECIMAL(10, 2),
    @valor DECIMAL(10, 2),
    @descricao VARCHAR(255),
    @id_seguradora INT,
    @rua VARCHAR(100),
    @numero INT,
    @bairro VARCHAR(50),
    @cidade VARCHAR(50),
    @estado VARCHAR(50),
    @cep VARCHAR(10)
AS
BEGIN
    INSERT INTO imovel (tipo, area, valor, descricao, id_seguradora, rua, numero, bairro, cidade, estado, cep)
    VALUES (@tipo, @area, @valor, @descricao, @id_seguradora, @rua, @numero, @bairro, @cidade, @estado, @cep);
END;
