-- Stored Procedure para UPDATE na tabela Imovel
CREATE PROCEDURE sp_UpdateImovel
    @id_imovel INT,
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
     UPDATE imovel
    SET tipo = @tipo,
        area = @area,
        valor = @valor,
        descricao = @descricao,
        id_seguradora = @id_seguradora,
        rua = @rua,
        numero = @numero,
        bairro = @bairro,
        cidade = @cidade,
        estado = @estado,
        cep = @cep
    WHERE id_imovel = @id_imovel;
END;
