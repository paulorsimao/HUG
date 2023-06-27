CREATE OR REPLACE FUNCTION public.relatorio_imoveis(data_inicial date DEFAULT NULL::date, data_final date DEFAULT NULL::date)
 RETURNS TABLE(id_imovel integer, descricao_imovel character varying, id_cliente integer, nome_cliente character varying, id_seguradora integer, nome_seguradora character varying, qtd_apolices bigint, valor_apolices numeric, qtd_sinistros bigint, valor_sinistros numeric)
 LANGUAGE plpgsql
AS $function$
BEGIN 
    RETURN QUERY
	
    WITH apolices AS (
        SELECT
            COUNT(a.id_apolice) AS qtd,
            SUM(a.valor_cobertura) AS valor,
            a.id_imovel
        FROM
            apolice a
        where
        	(data_inicial is null or a.data_inicio >= data_inicial)
    	and
        	(data_final is null or a.data_inicio <= data_final)
        GROUP BY
            a.id_imovel
    ),
    sinistros AS (
        SELECT
            COUNT(id_sinistro) AS qtd,
            SUM(s.valor_prejuizo) AS valor,
            s.id_imovel
        FROM
            sinistro s
        where
        	(data_inicial is null or s.data_ocorrencia >= data_inicial)
    	and
        	(data_final is null or s.data_ocorrencia <= data_final)
        GROUP BY
            s.id_imovel
    )
    SELECT 
        i.id_imovel,
        i.descricao,
        c.id_cliente,
        p.nome ,
        seg.id_seguradora ,
        seg.nome ,
        COALESCE(a.qtd, 0),
        COALESCE(a.valor, 0),
        COALESCE(s.qtd, 0),
        COALESCE(s.valor, 0)
    FROM 
        imovel i
    LEFT JOIN cliente c ON c.id_cliente = i.id_cliente
    left join pessoa p on p.id_pessoa = c.id_pessoa 
    LEFT JOIN seguradora seg ON seg.id_seguradora = i.id_seguradora 
    LEFT JOIN apolices a ON a.id_imovel = i.id_imovel 
    LEFT JOIN sinistros s ON s.id_imovel = i.id_imovel;
    
    RETURN;
END;
$function$
;