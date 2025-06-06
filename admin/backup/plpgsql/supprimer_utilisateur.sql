CREATE OR REPLACE FUNCTION supprimer_utilisateur(text) RETURNS TEXT AS
'
DECLARE
    nom_utilisateur ALIAS FOR $1;
    utilisateur_existant TEXT;
BEGIN
    SELECT nom INTO utilisateur_existant FROM utilisateurs WHERE nom = nom_utilisateur;

    IF utilisateur_existant IS NULL THEN
        RETURN ''Aucun utilisateur trouvé'';
    ELSE
        DELETE FROM utilisateurs WHERE nom = nom_utilisateur;
        RETURN ''Utilisateur supprimé'';
    END IF;
END;
'
LANGUAGE 'plpgsql';
