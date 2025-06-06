CREATE OR REPLACE FUNCTION supprimer_tiramisu(text) RETURNS TEXT AS
'
DECLARE
    nom ALIAS FOR $1;
    nom_existant TEXT;
BEGIN
    SELECT nom_tiramisu INTO nom_existant FROM tiramisus WHERE nom_tiramisu = nom;

    IF nom_existant IS NULL THEN
        RETURN ''Aucun tiramisu trouvé'';
    ELSE
        DELETE FROM tiramisus WHERE nom_tiramisu = nom;
        RETURN ''Tiramisu supprimé'';
    END IF;
END;
'
LANGUAGE 'plpgsql';
