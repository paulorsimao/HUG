CREATE OR REPLACE FUNCTION registrar_historico()
RETURNS TRIGGER AS $$
DECLARE
    acao TEXT;
    descricao TEXT;
BEGIN
    IF TG_OP = 'UPDATE' THEN
        acao := 'Atualização de imóvel';
        descricao := 'Imóvel ID: ' || OLD.id_imovel || ' - ';

        IF OLD.tipo <> NEW.tipo THEN
            descricao := descricao || 'Tipo alterado de ' || OLD.tipo || ' para ' || NEW.tipo || '. ';
        END IF;

        IF OLD.area <> NEW.area THEN
            descricao := descricao || 'Área alterada de ' || OLD.area || ' para ' || NEW.area || '. ';
        END IF;

        IF OLD.valor <> NEW.valor THEN
            descricao := descricao || 'Valor alterado de ' || OLD.valor || ' para ' || NEW.valor || '. ';
        END IF;

        IF OLD.descricao <> NEW.descricao THEN
            descricao := descricao || 'Descrição alterada de ' || OLD.descricao || ' para ' || NEW.descricao || '. ';
        END IF;

        IF OLD.id_seguradora <> NEW.id_seguradora THEN
            descricao := descricao || 'Seguradora alterada de ' || OLD.id_seguradora || ' para ' || NEW.id_seguradora || '. ';
        END IF;

        IF OLD.rua <> NEW.rua THEN
            descricao := descricao || 'Rua alterada de ' || OLD.rua || ' para ' || NEW.rua || '. ';
        END IF;

        IF OLD.numero <> NEW.numero THEN
            descricao := descricao || 'Número alterado de ' || OLD.numero || ' para ' || NEW.numero || '. ';
        END IF;

        IF OLD.bairro <> NEW.bairro THEN
            descricao := descricao || 'Bairro alterado de ' || OLD.bairro || ' para ' || NEW.bairro || '. ';
        END IF;

        IF OLD.cidade <> NEW.cidade THEN
            descricao := descricao || 'Cidade alterada de ' || OLD.cidade || ' para ' || NEW.cidade || '. ';
        END IF;

        IF OLD.estado <> NEW.estado THEN
            descricao := descricao || 'Estado alterado de ' || OLD.estado || ' para ' || NEW.estado || '. ';
        END IF;

        IF OLD.cep <> NEW.cep THEN
            descricao := descricao || 'CEP alterado de ' || OLD.cep || ' para ' || NEW.cep || '. ';
        END IF;

    ELSIF TG_OP = 'DELETE' THEN
        acao := 'Exclusão de imóvel';
        descricao := 'Imóvel ID: ' || OLD.id_imovel;
    END IF;

    INSERT INTO historico (id_imovel, data_atualizacao, descricao)
    VALUES (OLD.id_imovel, CURRENT_DATE, descricao || acao);

    RETURN NULL;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER imovel_historico_trigger
AFTER UPDATE OR DELETE ON imovel
FOR EACH ROW
EXECUTE FUNCTION registrar_historico();
